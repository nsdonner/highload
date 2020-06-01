<?php

class redisCacheProvider {
    private $connection = null;
    private function getConnection(){
        if($this->connection===null){
            $this->connection = new Redis();
            $this->connection->connect(REDIS_SERVER, REDIS_PORT);
        }
        return $this->connection;
    }

    public function get($key){
        $result = false;
        if($c = $this->getConnection()){
            $result = unserialize($c->get($key));
        }
        return $result;
    }
    public function set($key, $value, $time=0){
        if($c=$this->getConnection()){
            $c->set($key, serialize($value), $time);
        }
    }

    // метод проверки наличия ключа в кэше

    public function exists($key){
        if($c=$this->getConnection()){
            return $c->exists($key);
        }
    }


    public function del($key){
        if($c=$this->getConnection()){
            $c->delete($key);
        }
    }

    public function clear(){
        if($c=$this->getConnection()){
            $c->flushDB();
        }
    }
}


$redis = new redisCacheProvider();
//$redis->clear();....
if ($redis->exists(1) == 1){
    echo "from redis ";
    $start = microtime(true);
    $data = $redis->get(1);
    //print_r ($redis->get(1));
    echo (microtime(true) - $start). '</br>';
    $start = microtime(true);
    $data = $redis->get(1);
    //print_r ($redis->get(1));
    echo (microtime(true) - $start) . '</br>';
    $start = microtime(true);
    $data = $redis->get(1);
    //print_r ($redis->get(1));
    echo (microtime(true) - $start) . '</br>';
    $start = microtime(true);
    $data = $redis->get(1);
    //print_r ($redis->get(1));
    echo (microtime(true) - $start);
} else {
    echo "from DB";
    $start = microtime(true);
    $link = mysqli_connect("172.29.0.247", "root", "", "high");
    $sql = "SELECT * FROM `skytech`.`b_sale_basket` LIMIT 50000";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($link);
    //print_r($rows);
    echo (microtime(true) - $start) . '</br>';

    $start = microtime(true);
    $link = mysqli_connect("172.29.0.247", "root", "", "high");
    $sql = "SELECT * FROM `skytech`.`b_sale_basket` LIMIT 50000";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($link);
    //print_r($rows);
    echo (microtime(true) - $start) . '</br>';
    $start = microtime(true);
    $link = mysqli_connect("172.29.0.247", "root", "", "high");
    $sql = "SELECT * FROM `skytech`.`b_sale_basket` LIMIT 50000";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($link);
    //print_r($rows);
    echo (microtime(true) - $start) . '</br>';

    $start = microtime(true);
    $link = mysqli_connect("172.29.0.247", "root", "", "high");
    $sql = "SELECT * FROM `skytech`.`b_sale_basket` LIMIT 50000";
    $result = mysqli_query($link, $sql);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($link);
    //print_r($rows);
    echo (microtime(true) - $start) . '</br>';

    $redis->set(1,$rows,60);
}


