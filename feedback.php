<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');

$channel = $connection->channel();
$channel->queue_declare('Feedback', false, false, false, false);

$msg = new AMQPMessage('Амнамнам!');
$channel->basic_publish($msg, '', 'Feedback');
echo " [x] Feedback sent\n";

$channel->close();
$connection->close();
?>
