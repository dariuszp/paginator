<?php

ini_set('display_errors', true);
ini_set('error_reporting', E_ALL);

require __DIR__ . '/../vendor/autoload.php';

$itemsAmount = 93;

$paginator = new \Dariuszp\Paginator\Paginator\Simple(
    '/article?page={page}&onPage={onPage}',
    $itemsAmount,
    5,
    10,
    2,
    false,
    false,
    false,
    false
);

$data = $paginator->getData();

$render = new \Dariuszp\Paginator\Render\Spaghetti();
$html = $render->render($data);

echo "<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport'
          content='width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <title>Document</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' >
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    {$html}
</body>
</html>";