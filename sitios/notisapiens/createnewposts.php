<?php
require_once 'vendor/autoload.php';
use GuzzleHttp\Client;


$salud = "http://newsapi.org/v2/top-headlines?country=mx&category=health&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$entretenimiento = "http://newsapi.org/v2/top-headlines?country=mx&category=entertainment&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$ciencia = "http://newsapi.org/v2/top-headlines?country=mx&category=science&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$tecnologia = "http://newsapi.org/v2/top-headlines?country=mx&category=technology&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$economia = "http://newsapi.org/v2/top-headlines?country=mx&category=business&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$deportes = "http://newsapi.org/v2/top-headlines?country=mx&category=sports&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";
$otros = "http://newsapi.org/v2/top-headlines?country=mx&category=general&apiKey=e4f08cac67af4e4793fecdc6f49a5e74";

parseResponse(getJsonResponse($salud), "salud");
parseResponse(getJsonResponse($entretenimiento), "entretenimiento");
parseResponse(getJsonResponse($ciencia), "ciencia");
parseResponse(getJsonResponse($tecnologia), "tecnologia");
parseResponse(getJsonResponse($economia), "economia");
parseResponse(getJsonResponse($deportes), "deportes");
parseResponse(getJsonResponse($otros), "otros");

// Ejecutar cada 2 HORAS


function parseResponse($feed, $category) {
    if (@$feed['status'] !== 'ok') {
        return;
    }

    foreach($feed['articles'] as $article) {

        $postObject = createPostObject($article, $category);
        $dateArray = explode("T", $article['publishedAt']);
        $dateChars = array("-", ":");
        $dateDir = str_replace($dateChars, "", $dateArray[0]);
        $basepath = "/home/josueguol/composer/notas/" . $category . "/" . $dateDir;
        if(saveFile($article, $basepath, $article['urlToImage'])) {
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
    $pathfilename = downloadMedia($article['urlToImage']);

    $title_author = getCleanTitle($article['title']);

    $media = createMedia($pathfilename, $title_author['title']);

    // TODO: Analizar como pintar autor
    $autor = $title_author['author'] === NULL ? $article['author'] : $title_author['author'];

    $status = @array_key_exists('id', $media) ? "publish" : "pending";

    $content = "<p>Autor: " . $autor . "<br />";
    $content .= "Fuente: " . $article['source']['name'];
    $content .= "</p>";
    $content .= "<p>" . $article['content'] . "</p>";
    $content .= "<p><a href=\"" . $article['url'] . "\" target=\"_blank\" class=\"button\">LEER NOTA COMPLETA</a></p><br /><br />";

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
        default:
            $category = "1";
    }

    $postObject = array(
        "title" => $title_author['title'],
        "excerpt" => $article['description'],
        "content" => $content,
        "date" => $article['publishedAt'],
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
    file_put_contents($filename, file_get_contents($url));

    return $filename;
}

function getJsonResponse($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, TRUE);
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
    echo fwrite($file, json_encode($data));
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