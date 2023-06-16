<?php
use core\Core;
Core::getInstance()->pageParams["title"] = "Access Denied";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link rel="stylesheet" href="/themes/light/css/errorStyle.css">
</head>
<body>
<div class="alert alert-danger" role="alert">Error 403. Access Denied</div>
</body>
</html>