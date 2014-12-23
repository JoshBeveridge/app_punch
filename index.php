<?php
    require('functions.php');
?>

<!doctype html>

<html class="no-js" lang="en">

    <head>

        <!-- Metas -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>Punch!</title>

        <!-- Styles -->
        <link rel="stylesheet" href="assets/css/app.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>

        <!-- Scripts -->
        <script src="assets/bower_components/modernizr/modernizr.js"></script>

    </head>

    <body>

        <header>
            <h1>Hello!</h1>
        </header>

        <?php
            generateUserList();
        ?>

        <!-- Scripts -->
        <script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="assets/bower_components/foundation/js/foundation.min.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/app.js"></script>

    </body>

</html>
