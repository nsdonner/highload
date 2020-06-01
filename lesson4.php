<?php

/**
 * @param $id
 *
 * Функция чтения данных указанного пользователя из соответствующего шарда
 *
 */

function getUserData($id)
{
    $shard1 = '172.29.0.247';
    $shard2 = '172.29.0.246';
    // выбор шарда на основе четности id пользователя
    if ($id % 2 == 0) {
        $link = mysqli_connect($shard2, "root", "", "high");
    } else {
        $link = mysqli_connect($shard1, "root", "", "high");
    }
    if ($link == false) {
        print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
    } else {
        print("Соединение установлено успешно </br>");
    }
    $sql = "SELECT `DATA` FROM `data` WHERE  `ID`=" . (int)$id;
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($rows[0]['DATA']);
    mysqli_close($link);
}

getUserData(2);