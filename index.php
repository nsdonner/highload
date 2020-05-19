<?php


// записываем состояние памяти до загрузки модулей
$s = '';
$usedMemory = memory_get_usage();


// подключаем модули
require_once('vendor/autoload.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// включаем Handler
$log = new Logger('highload');
$log->pushHandler(new StreamHandler('log/higload.local.log', Logger::INFO));


$log->info('Использовано памяти до загрузки модулей ' . $usedMemory);
$usedMemory = memory_get_usage() - $usedMemory;
$log->info('Загрузка модулей заняла дополнительно ' . $usedMemory);
$log->info('Общий занимаемый объём ' . memory_get_usage());
$usedMemory = memory_get_usage();

// функции для тестирования

function f($n)
{
    return ($n < 2 ? 1 : $n * f($n - 1));
}

function useSomeMemory($s)
{
    $s = $s . "qwertyuiopasdfghjklzxcvbnm,";
    return $s;
}

// функция записи потребления памяти в лог

function logMemoryUsage($break)
{
    global $usedMemory;
    global $log;
    $log->info('Общий занимаемый объём памяти на этапе ' . $break . ' ' . memory_get_usage() . ' Bytes');
    $usedMemory = memory_get_usage() - $usedMemory;
    $log->info('Разница между предыдущим этапом ' . $usedMemory . ' Bytes');
    $usedMemory = memory_get_usage();
}

// измерения

logMemoryUsage("до факториала");
f(10);
logMemoryUsage("после факториала");
$s = useSomeMemory($s);
logMemoryUsage("после функции со строкой");
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
$s = useSomeMemory($s);
logMemoryUsage("после нескольких функций со строкой");
