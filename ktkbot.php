<?php

use Telegram\Bot;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require __DIR__.'/vendor/autoload.php';

$log = new Logger('TelegramBot');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/info.log', Logger::INFO));

$tb = new Bot();

$log->info('Входящий запрос =', (array) $tb->getRequest());

$log->info('Результат ответа ='.$tb->execCommand());