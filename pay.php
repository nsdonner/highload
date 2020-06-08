<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');

$channel = $connection->channel();
$channel->queue_declare('Payment', false, false, false, false);

$msg = new AMQPMessage('100$');
$channel->basic_publish($msg, '', 'Payment');
echo " [x] Money sent\n";

$channel->close();
$connection->close();
?>
