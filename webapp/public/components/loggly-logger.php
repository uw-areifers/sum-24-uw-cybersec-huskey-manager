<?php

require __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;
use Monolog\Formatter\LogglyFormatter;

$logglyToken = $_ENV["LOGGLY_TOKEN"];

$logger = new Logger('UW Password Manager');
$logger->pushHandler(new LogglyHandler($logglyToken.'/tag/monolog', Logger::INFO));

$logger->info('Loggly Sending Informational Message');
?>