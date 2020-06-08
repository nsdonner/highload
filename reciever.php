<?php
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('127.0.0.1', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('Order', false, false, false, false);
$channel->queue_declare('Payment', false, false, false, false);
$channel->queue_declare('Deliver', false, false, false, false);
$channel->queue_declare('Feedback', false, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$orderCallback = function($msg) {
    echo " [x] Order received ", $msg->body, "\n";
    };


$paymentCallback = function($msg) {
    echo " [x] Payment received ", $msg->body, "\n";
    };

$deliverCallback = function($msg) {
    echo " [x] Order delivered ", $msg->body, "\n";
    };

$feedbackCallback = function($msg) {
    echo " [x] Feedback received ", $msg->body, "\n";
    };



    
    $channel->basic_consume('Order', '', false, true, false, false, $orderCallback);
    $channel->basic_consume('Payment', '', false, true, false, false, $paymentCallback);
    $channel->basic_consume('Deliver', '', false, true, false, false, $deliverCallback);
    $channel->basic_consume('Feedback', '', false, true, false, false, $feedbackCallback);
    
    while(count($channel->callbacks)) {
        $channel->wait();
        
        }
        ?>