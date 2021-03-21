<!DOCTYPE html>
<!-- release v4.3.5, copyright 2014 - 2016 Kartik Visweswaran -->
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>Upload Media</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="../js/fileinput.min.js" type="text/javascript"></script>
        <script src="../js/locales/es.js" type="text/javascript"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container kv-main">
            <div class="page-header">
                <h1>Carga de medios</h1>
            </div>
            <form enctype="multipart/form-data" >
                <input id="file-0a" class="file" type="file" name="file" class="file" data-overwrite-initial="true" data-min-file-count="1" multiple="false">
            </form>
            <hr>
        </div>
    </body>
	<script>
    $("#file-0a").fileinput({
        uploadUrl: '/media/upload/',
        language: 'es',
        allowedFileExtensions: ['jpg', 'png','gif'],
        allowedFileTypes: ['image']
    });

	</script>
</html>