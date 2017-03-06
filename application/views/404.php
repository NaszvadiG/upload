
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>404 | Page Not Found</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo site_url() ?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo site_url() ?>public/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo site_url() ?>public/assets/css/waves.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo site_url() ?>public/assets/css/style.css" rel="stylesheet">
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message">Sorry, this page doesn't exist !</div>
        <div class="button-place">
            <a onclick="history.go(-1)" class="btn btn-default btn-lg waves-effect">Back to previous page</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo site_url() ?>public/assets/js/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo site_url() ?>public/assets/js/bootstrap.min.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo site_url() ?>public/assets/js//waves.js"></script>
</body>

</html>