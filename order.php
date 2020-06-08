<?php
require_once __DIR__ . '/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');

$channel = $connection->channel();
$channel->queue_declare('Order', false, false, false, false);

$msg = new AMQPMessage('Кило варенья мешок печенья');
$channel->basic_publish($msg, '', 'Order');
echo " [x] Order sent\n";

$channel->close();
$connection->close();
?>
