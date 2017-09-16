<?php

use Telegram\Bot;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__.'/vendor/autoload.php';

$log = new Logger('TelegramBot');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/info.log', Logger::INFO));
$tb = new Bot();

$request = file_get_contents("php://input");

$log->info($request);

echo $request;



