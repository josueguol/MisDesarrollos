<?php
require_once 'vendor/autoload.php';
use GuzzleHttp\Client;


$politica = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=politics&lang=es&country=MX&media=True";
$economia = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=economics&lang=es&country=MX&media=True";
$ciencia = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=science&lang=es&country=MX&media=True";
$tecnologia = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=tech&lang=es&country=MX&media=True";
$deportes = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=sport&lang=es&country=MX&media=True";
$entretenimiento = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=entertainment&lang=es&country=MX&media=True";
$salud = "https://newscatcher.p.rapidapi.com/v1/latest_headlines?topic=beauty&lang=es&country=MX&media=True";
parseResponse(getJsonResponse($politica), "politica");
parseResponse(getJsonResponse($economia), "economia");
//parseResponse(getJsonResponse($ciencia), "ciencia");
//parseResponse(getJsonResponse($tecnologia), "tecnologia");
//parseResponse(getJsonResponse($deportes), "deportes");
//parseResponse(getJsonResponse($entretenimiento), "entretenimiento");
//parseResponse(getJsonResponse($salud), "salud");

// Ejecutar 3 veces al dia. Mañana tarde y noche


function parseResponse($feed, $category) {
    if ($feed['status'] !== 'ok') {
        return;
    }

    foreach($feed['articles'] as $article) {

        $postObject = createPostObject($article, $category);
        if ($postObject === NULL) {
            return;
        }
        $dateArray = explode(" ", $article['published_date']);
        $dateChars = array("-", ":");
        $dateDir = str_replace($dateChars, "", $dateArray[0]);
        $basepath = "/home/josueguol/composer/notas/" . $category . "/" . $dateDir;
        if(saveFile($article, $basepath, $article['link'])) {
            echo ($postObject['title'] . "\n");
            createPost($postObject);
        }
    }
}

/*
    array(
        "title" => "Hello Updated World1!",
        "content_raw" => "Howdy updated content.",
        "date" => "2017-02-01T14:00:00+10:00"
    );
*/
function createPostObject($article, $category) {
    $articleParsed = getJsonParse($article['link']);

    if (@array_key_exists('content_1', $media)) {
        return NULL;
    }
    $pathfilename = downloadMedia($articleParsed['lead_image_url']);
    $media = createMedia($pathfilename, $articleParsed['lead_image_url']);
    $status = @array_key_exists('id', $media) ? "publish" : "pending";

    // TODO: Clean content
    $body = $articleParsed['content_1'];

    $content = "<p>Autor: " . $article['author'] . "<br />";
    $content .= "Fuente: " . $article['clean_url'];
    $content .= "</p>";
    $content .= "<p>" . $body . "</p>";
    $content .= "<p>" . $article['rights'] . "</p>";
    $content .= "<p><a href=\"" . $article['link'] . "\" target=\"_blank\" class=\"button\">Click aquí para leer nota completa en la página del autor.</a></p><br /><br />";

    switch ($category) {
        case "salud":
            $category = "238";
        break;
        case "ciencia":
            $category = "237";
        break;
        case "deportes":
            $category = "236";
        break;
        case "economia":
            $category = "196";
        break;
        case "entretenimiento":
            $category = "239";
        break;
        case "tecnologia":
            $category = "3";
        break;
        default: // Política
            $category = "1";
    }

    $date = date('Y-m-d H:i:s',strtotime('-6 hour',strtotime($article['published_date'])));

    $postObject = array(
        "title" => $article['title'],
        "excerpt" => $articleParsed['excerpt'],
        "content" => $content,
        "date" => $date,
        "categories" => $category,
        "status" => $status
    );

    if (@array_key_exists('id', $media)) {
        $postObject["featured_media"] = $media['id'];
    }
    
    return $postObject;
}

// Upload Media
/*
    curl --request POST \
    --url "http://www.yoursite.com/wp-json/wp/v2/media" \
    --header "cache-control: no-cache" \
    --header "content-disposition: attachment; filename=tmp" \
    --header "authorization: Basic $base64credentials" \
    --header "content-type: image/png" \
    --data-binary "@/home/web/tmp.png" \
    --location
*/
function createMedia($pathfilename, $fileid) {
    $ch = curl_init();

    // TODO: determine media type
    $extension = substr(strrchr($pathfilename, "."), 1);
    $mediaType = NULL;
    if ($extension === 'png') {
        $mediaType = 'image/png';
    }
    if ($extension === 'jpeg' || $extension === 'jpg') {
        $mediaType = 'image/jpeg';
    }

    // TODO: determine filename
    $filename = substr(strrchr($pathfilename, "/"), 1);

    if ($mediaType === NULL) {
        return NULL;
    }

    $basepath = "/home/josueguol/composer/notas/img/";
    $jsonfile = $basepath . md5($fileid) . ".json";
    if (file_exists($jsonfile)) {
        return json_decode(file_get_contents($jsonfile), TRUE);
    }

    $data = file_get_contents($pathfilename);

    curl_setopt_array($ch, array(
        CURLOPT_URL => "https://www.notisapiens.com/wp-json/wp/v2/media",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_HTTPHEADER => array(
          "Authorization: Basic " . base64_encode("NotiSapiens:RmTM TJxn 1Njk 0B9G m0Kx LNw9"),
          "Cache-Control: no-cache",
          "Content-Disposition: attachment; filename=" . $filename,
          "Content-Type: " . $mediaType,
        ),
        CURLOPT_POSTFIELDS => $data
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    saveFile($result, $basepath, $fileid);

    return json_decode($result, TRUE);
}

function getCleanTitle($title) {

    $separator =  strpos($title,  " • ") !== false ? " • " : " - ";
    $separator = strpos($title, " | ") !== false ? " | " : $separator;

    $titleArray = explode($separator, $title, 2);
    $title_author = array (
        "title" => NULL,
        "author" => NULL
    );

    if (count($titleArray) > 1) {
        $title_author['title'] = $titleArray[0];
        $title_author['author'] = $titleArray[1];
    } else {
        $title_author['title'] = $titleArray[0];
    }

    return $title_author;
}

function downloadMedia($url) {
    if ($url === NULL) {
        return;
    }

    $basePath = "/home/josueguol/composer/notas/img";
    if (!file_exists($basePath)) {
        mkdir($basePath, 0744, TRUE);
    }

    $nameArray = explode("?", substr(strrchr($url, "/"), 1));
    $md5 = md5($url);
    $extension = substr(strrchr($nameArray[0], "."), 1);

    $filename = $basePath . '/' . $md5 . "." . $extension;
    if (file_exists($filename)) {
        return $filename;
    }

    grab_image($url, $filename);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    if ($extension == 'webp') {
        $filename = webptojpg($filename);
    } 

    return $filename;
}

function grab_image($url, $saveto) {
    $ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $raw = curl_exec($ch);
    curl_close ($ch);
    
    if (file_exists($saveto)){
        unlink($saveto);
    }

    $fp = fopen($saveto, 'x');

    fwrite($fp, $raw);
    fclose($fp);
}

function webptojpg($file) {
    $image = imagecreatefromwebp($file);
    $file_parts = pathinfo($file);
    $newfilename =  $file_parts['dirname'] . '/' . $file_parts['filename'] . ".jpg";
    imagejpeg($image, $newfilename, 100);

    if (file_exists($file)){
        unlink($file);
    }

    imagedestroy($image);

    return $newfilename;
}

function getJsonResponse($url) {

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: newscatcher.p.rapidapi.com",
            "x-rapidapi-key: 160b618330msh22c13da714b4b36p15c2e8jsn70065cfc03db"
        ],
    ]);
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);

    return json_decode($response, TRUE);
}

function getJsonParse($url) {
    $encodeUrl = urlencode($url);

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://news-parser1.p.rapidapi.com/article_v1?url=" . $encodeUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: news-parser1.p.rapidapi.com",
            "x-rapidapi-key: be12220680mshcefb2c61aa0aa99p143e8ejsn74b84553aa86"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return json_decode($response, TRUE);
}

function saveFile($data, $basepath, $fileid) {
    if (!file_exists($basepath)) {
        mkdir($basepath, 0744, TRUE);
    }
    
    $md5 = md5($fileid);
    $filename = $basepath . "/" . $md5 . ".json";

    if (file_exists($filename)) {
        return FALSE;
    }

    $file = fopen($filename, "w");
    fwrite($file, json_encode($data));
    fclose($file);

    return TRUE;
}

function createPost($postObject) {
    $base64 = base64_encode("NotiSapiens:RmTM TJxn 1Njk 0B9G m0Kx LNw9");
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://www.notisapiens.com/wp-json/wp/v2/',
        // You can set any number of default request options.
        'timeout'  => 9.0,
        'headers' => ['Content-Type' => 'application/json', "Accept" => "application/json", 'Authorization' => "Basic " . $base64],
        //ssl false
        'verify' => false
    ]); 
    $response = $client->post('posts/',
        [ 'body' => json_encode($postObject)]
    );
}