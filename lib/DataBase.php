<?php
/**
 * Created by PhpStorm.
 * Author: Abdujalilov Dilshod
 * Telegram: https://t.me/coloterra
 * Web: http://www.websar.uz
 * Project: autotest
 * Date: 27.01.2020 16:58
 */

namespace DataBase;

require_once "./lib/config.php";

class DataBase
{

    private static $db = null; // Единственный экземпляр класса, чтобы не создавать множество подключений
    private $mysqli; // Идентификатор соединения

    /* Получение экземпляра класса. Если он уже существует, то возвращается, если его не было, то создаётся и возвращается (паттерн Singleton) */
    public static function getDB() {
        if (self::$db == null) self::$db = new DataBase();
        return self::$db;
    }

    /* private-конструктор, подключающийся к базе данных, устанавливающий локаль и кодировку соединения */
    private function __construct() {
        $this->mysqli = new \MySQLi("localhost", DB_USER, DB_PASS, DB);
        $this->mysqli->query("SET NAMES 'utf8'");
    }

    public function add_user($chat_id,$lang)
    {
        if($this->mysqli->query("SELECT * FROM users WHERE user_id = $chat_id")->num_rows==1){
            $this->mysqli->query("UPDATE `users` SET `lang` = '$lang' WHERE `users`.`user_id` = $chat_id");
        }
        else $this->mysqli->query("INSERT INTO users (user_id, lang, step, created) VALUES ('".$chat_id."', '".$lang."', '2', '".time()."')");
    }

    public function edit_lang($chat_id,$lang)
    {
        $this->mysqli->query("UPDATE `users` SET `lang` = '$lang' WHERE `users`.`user_id` = $chat_id");
    }

    public function insert($table,$sql,$value)
    {
        $this->mysqli->query("INSERT INTO $table ($sql) VALUES ($value)");
    }

    public function change_step($chat_id,$step)
    {
        $this->mysqli->query("UPDATE `users` SET `step` = '$step' WHERE `users`.`user_id` = $chat_id");
    }

    public function update($sql='', $where, $table = "users")
    {
        $this->mysqli->query("UPDATE $table SET $sql WHERE $where");
    }

    public function select($where, $table = "users", $limit=false)
    {
        if ($limit) $new = $this->mysqli->query("SELECT * FROM $table WHERE $where ORDER BY id DESC LIMIT $limit");
        else $new = $this->mysqli->query("SELECT * FROM $table WHERE $where ORDER BY id");
        $news = [];
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        return $news;
    }

    public function selectOne($sql, $table)
    {
        $user = $this->mysqli->query("SELECT * FROM `".$table."` WHERE " . $sql);
        if ($user){
            $users = $user->fetch_object();
            return $users;
        }
        return false;
    }

    public function selectJoin($id)
    {
        $user = $this->mysqli->query("SELECT id, user_id, belgi_id, (SELECT image FROM belgilar WHERE id = belgi_savol.belgi_id) as image FROM belgi_savol WHERE user_id = $id");
        if ($user){
            $users = $user->fetch_object();
            return $users;
        }
        return false;
    }

    public function random()
    {
        $user = $this->mysqli->query("SELECT * FROM belgilar order by rand() limit 1");
        if ($user){
            $users = $user->fetch_object();
            return $users;
        }
        return false;
    }

    public function getUser($id,$type = 0)
    {
        $user = $this->mysqli->query("SELECT * FROM `users` WHERE `user_id` = '" . $id ."'");
        $users = $user->fetch_object();
        switch ($type){
            case 1:
                return $users->lang;
                break;
            default:
                return $users;
        }
    }

    public function getStep($id)
    {
        $user = $this->mysqli->query("SELECT * FROM `users` WHERE `user_id` = '" . $id ."'");
        $num = $user->num_rows;
        $users = $user->fetch_object();
        return $users->step;
    }

    public function getStart($start, $end)
    {
        $result = $this->mysqli->query("select count(*) as `c` FROM `users` WHERE `start` BETWEEN $start AND $end");
        $count = $result->fetch_object()->c;
        return $count;
    }

    public function getCreated($start, $end)
    {
        $user = $this->mysqli->query("SELECT COUNT(*) as `c` FROM `users` WHERE `created` BETWEEN $start AND $end");
        $order = $user->fetch_object()->c;
        return $order;
    }

    public function belgiSavol($chat_id,$id,$number)
    {
        if($this->mysqli->query("SELECT * FROM belgi_savol WHERE user_id = $chat_id")->num_rows==1){
            $this->mysqli->query("UPDATE `belgi_savol` SET `belgi_id` = '$id', `number` = '$number' WHERE `belgi_savol`.`user_id` = $chat_id");
        }
        else $this->mysqli->query("INSERT INTO belgi_savol (user_id, belgi_id, number) VALUES ('".$chat_id."', '".$id."', '".$number."')");
    }

    /* При уничтожении объекта закрывается соединение с базой данных */
    public function __destruct() {
        if ($this->mysqli) $this->mysqli->close();
    }
}


class data
{
    protected static $data;

    public static function setup($data = [])
    {
        self::$data = $data;
    }

    public static function query($SQL)
    {

        return self::$data->query($SQL);
    }

    public static function user($users = [])
    {
        self::query("INSERT INTO userss (user_id, user_phone, user_setting) VALUES ('".$users["user_id"]."', '".$users["user_phone"]."', '".$users["user_setting"]."')");
    }

    public static function add_user($chat_id,$lang)
    {
        if(self::query("SELECT * FROM userss WHERE user_id = $chat_id")->num_rows==1){
            self::query("UPDATE `userss` SET `lang` = '$lang' WHERE `userss`.`user_id` = $chat_id");
        }
        else self::query("INSERT INTO userss (user_id, user_phone, lang, step, created_time) VALUES ('".$chat_id."', '".null."', '".$lang."', '2', '".time()."')");
    }

    public static function add_address($chat_id,$client,$lat,$lon)
    {
        self::query("INSERT INTO address (client_id, user_id, lat, lon) VALUES ('".$client."', '".$chat_id."', '".$lat."', '".$lon."')");
    }

    public static function change_step($chat_id,$step)
    {
        self::query("UPDATE `userss` SET `step` = '$step' WHERE `userss`.`user_id` = $chat_id");
    }

    public static function edit_lang($chat_id,$lang)
    {
        self::query("UPDATE `userss` SET `lang` = '$lang' WHERE `userss`.`user_id` = $chat_id");
    }

    public static function insert($table,$sql,$value)
    {
        self::query("INSERT INTO $table ($sql) VALUES ($value)");
    }

    public static function add_clientid($chat_id,$id)
    {
        self::query("UPDATE `userss` SET `client_id` = '$id' WHERE `userss`.`user_id` = $chat_id");
    }

    public static function update_client($chat_id,$id,$phone)
    {
        self::query("UPDATE `userss` SET `client_id` = '$id', `user_phone` = $phone WHERE `userss`.`user_id` = $chat_id");
    }

    public static function update_address($user_id,$name)
    {
        self::query("UPDATE `address` SET `name` = '$name', `status` = 1 WHERE `address`.`status` = 0 AND `address`.`user_id` = $user_id");
    }

    public static function getStep($id)
    {
        $user = self::query("SELECT * FROM `userss` WHERE `user_id` = '" . $id ."'");
        $num = $user->num_rows;
        $users = $user->fetch_object();
        $user->close();
        return $users->step;
    }

    public static function getNoActive($id)
    {
        $user = self::query("SELECT * FROM `address` WHERE `user_id` = '" . $id ."' AND `status`=0");
        $num = $user->num_rows;
        $users = $user->fetch_object();
        $user->close();
        return $users;
    }

    public static function selectOne($sql, $table)
    {
        $user = self::query("SELECT * FROM $table WHERE $sql");
        $num = $user->num_rows;
        $users = $user->fetch_object();
        $user->close();
        return $users;
    }

    public static function add_code($chat_id,$vercode,$st=false)
    {
        self::query("UPDATE `userss` SET `code` = '$vercode', `user_phone`=$st WHERE `userss`.`user_id` = $chat_id");
    }

    public static function del_address($id)
    {
        self::query("DELETE FROM `address` WHERE `address`.`id` = $id");
    }

    public static function add_recode($chat_id,$vercode,$st=false)
    {
        self::query("UPDATE `userss` SET `code` = '$vercode', `re_phone`=$st WHERE `userss`.`user_id` = $chat_id");
    }

    public static function check($id,$val)
    {
        if(self::query("SELECT * FROM userss WHERE user_id = $id AND WHERE `user_phone` = '$val'")->num_rows==1):
            self::query("UPDATE `userss` SET `user_phone` = '$val' WHERE `userss`.`user_id` = $id");
            return true;
        else: return false;
        endif;

    }

    public static function CheckAnd($name_uz,$lat, $lon)
    {
        self::query("INSERT INTO place (name_uz, name_ru, name_en, lat,lon,city_id) VALUES ('".$name_uz."', '".$name_uz."', '".$name_uz."', '".$lat."', '".$lon."', '14')");
//        if(self::query("SELECT id,user_id FROM userss WHERE user_id = $user_id")->num_rows==1){
//
//        }else{
//        }

    }


    public static function setCity($id,$city)
    {
        self::query("UPDATE userss SET user_setting = $city WHERE user_id = $id");
    }

    public static function order($orders = [],$geo=false)
    {
        if ($geo) {
            if(self::query("SELECT * FROM orderss WHERE user_id = ".$orders["user_id"]." AND `status` = 0")->num_rows>=1){
                self::query("UPDATE `orderss` SET `state_id` = ".$orders["state_id"].", `lat` = ".$orders["lat"].", `lon` = ".$orders["lon"].", `user_phone` = ".$orders["user_phone"]." WHERE `orderss`.`user_id` = ".$orders["user_id"]." AND `orderss`.`status`=0");
            }
            else self::query("INSERT INTO orderss (user_id, order_id, state_id, user_phone, client_id, lat, lon) VALUES ('".$orders["user_id"]."', '".$orders["order_id"]."', '".$orders["state_id"]."', '".$orders["user_phone"]."', '".$orders["client_id"]."', '".$orders["lat"]."', '".$orders["lon"]."')");
        }
        else self::query("INSERT INTO orderss (user_id, order_id, state_id, client_id) VALUES ('".$orders["user_id"]."', '".$orders["order_id"]."', '".$orders["state_id"]."', '".$orders["client_id"]."')");
    }

    public static function setOrder($user_id, $state_id, $place)
    {
        self::query("SET NAMES 'utf8'");
        self::query("UPDATE `orderss` SET `state_id` = ".$state_id.", `place` = '$place' WHERE `orderss`.`user_id` = ".$user_id." AND `orderss`.`status`=0");
    }

    public static function setTariffOrder($id,$tariff)
    {
        self::query("UPDATE `orderss` SET `tariff` = ".$tariff." WHERE `orderss`.`id` = $id");
    }

    public static function setOrderId($id,$order)
    {
        self::query("UPDATE `orderss` SET `order_id` = ".$order." WHERE `orderss`.`id` = $id");
    }

    public static function archive($user,$order, $adress="",$money,$date)
    {
        self::query("INSERT INTO archive(user_id,order_id,adress,money,date) VALUES ($user,$order,'$adress',$money,'$date')");
    }
    public static function update($sql='', $where, $table = "orderss")
    {
        self::query("UPDATE $table SET $sql WHERE $where");
    }

    public static function select($where, $table = "orderss", $limit=false)
    {
        if ($limit) $new = self::query("SELECT * FROM $table WHERE $where ORDER BY id DESC LIMIT $limit");
        else $new = self::query("SELECT * FROM $table WHERE $where ORDER BY id");
        $news = [];
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
    }

    public static function getOrders($all = false, $state = 4)
    {
        $news = [];
        $new = self::query("SELECT * FROM `orderss` WHERE NOT (status= 4 AND now='finished') AND NOT order_id=0");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
//        $orders = [];
//        if ($all == true) {
////            $order = self::query("SELECT * FROM orderss WHERE status != $state");
//            $order = self::query("SELECT id, user_id, order_id, status, now FROM `orderss` WHERE NOT (status= 4 AND now='finished')");
//        }else $order = self::query("SELECT * FROM `orderss` WHERE NOT (status= $state AND now='finished')");
//        for ($i=0; $i <= $order->num_rows ; $i++){
//            $orders[] = $order->fetch_object();
//        }
//        $order->close();
//        return $orders;
    }
    public static function getUser($id,$type = 0)
    {
        $user = self::query("SELECT * FROM `userss` WHERE `user_id` = '" . $id ."'");
        $num = $user->num_rows;
        $users = $user->fetch_object();
        $user->close();
        switch ($type){
            case 1:
                return $users->user_phone;
                break;
            case 2:
                return $users->user_setting;
                break;
            case 3:
                return $num;
                break;
            case 4:
                return $users->lang;
                break;
            default:
                return $users;
        }
    }

    public static function checkPlace($minLat,$maxLat,$minLng,$maxLng)
    {
        $news = [];
        $new = self::query("SELECT * FROM `place` WHERE (`lat` BETWEEN $minLat AND $maxLat) AND (`lon` BETWEEN $minLng AND $maxLng) ORDER BY id DESC LIMIT 5");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
    }

    public static function getOrderLast($user_id)
    {
        $user = self::query("SELECT * FROM `orderss` WHERE `user_id` = '" . $user_id ."' AND `status`=0");
        $num = $user->num_rows;
        $order = $user->fetch_object();
        $user->close();
        return $order;
    }

    public static function add_rating($chat_id,$phone,$ball,$order_id)
    {
        self::query("INSERT INTO rating (phone, user_id, ball, order_id) VALUES ('".$phone."', '".$chat_id."', '".$ball."', '".$order_id."')");
    }

    public static function getRatingLast($user_id)
    {
        $user = self::query("SELECT * FROM `rating` WHERE `user_id` = '" . $user_id ."' AND `status`=0 ORDER BY id DESC LIMIT 1");
        $num = $user->num_rows;
        $order = $user->fetch_object();
        $user->close();
        return $order;
    }

    public static function getStart($start, $end)
    {
        $result = self::query("select count(*) as `c` FROM `userss` WHERE `start` BETWEEN $start AND $end AND `client_id` IS NOT NULL");
        $count = $result->fetch_object()->c;
        $result->close();
        return $count;
    }

    public static function getCreated($start, $end)
    {
        $user = self::query("SELECT COUNT(*) as `c` FROM `userss` WHERE `created_time` BETWEEN $start AND $end AND `client_id` IS NOT NULL");
        $order = $user->fetch_object()->c;
        $user->close();
        return $order;
    }

    public static function getOrderLastId($user_id)
    {
        $user = self::query("SELECT * FROM `orderss` WHERE `user_id` = '" . $user_id ."' AND (`status`=0 OR `status`=1)");
        $num = $user->num_rows;
        $order = $user->fetch_object();
        $user->close();
        return $order;
    }

    public static function getPlace($id)
    {
        $user = self::query("SELECT * FROM `place` WHERE `id` = '" . $id ."'");
        $num = $user->num_rows;
        $place = $user->fetch_object();
        $user->close();
        return $place;
    }

    public static function getTariffPrice($city,$text)
    {
        $user = self::query("SELECT tariff.*, tariff_sum.* FROM tariff LEFT JOIN tariff_sum ON tariff.$text = tariff_sum.tariff_id WHERE tariff.city_id=$city");
        $num = $user->num_rows;
        $tariff = $user->fetch_object();
        $user->close();
        return $tariff->price;
    }

    public static function getTariff($city,$text)
    {
        $user = self::query("SELECT tariff.*, tariff_sum.* FROM tariff LEFT JOIN tariff_sum ON tariff.$text = tariff_sum.tariff_id WHERE tariff.city_id=$city");
        $num = $user->num_rows;
        $tariff = $user->fetch_object();
        $user->close();
        return $tariff;
    }

    public static function getArchive($user)
    {
        $archives = "";
        $archive = self::query("SELECT * FROM `archive` WHERE user_id = '$user' ORDER BY order_id DESC LIMIT 5");
        for($i = 1;  $i <= $archive->num_rows; $i++)
        {
            $test = $archive->fetch_object();
            $archives .= $i . ") \t " . date('d.m.Y h:i', strtotime($test->date)) . " \t " . $test->money . "so'm \t " . $test->adress . " \n";
        }
        $archive->close();
        return $archives;
    }

    public static function getNews()
    {
        $news = [];
        $new = self::query("SELECT * FROM `news` ORDER BY `id` DESC LIMIT 5");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        return $news;
    }

    public static function getAddress($user)
    {
        $news = [];
        $new = self::query("SELECT * FROM `address` WHERE `user_id`=$user ORDER BY `id` DESC LIMIT 10");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
    }

    public static function getCoordinate()
    {
        $news = [];
        $new = self::query("SELECT * FROM `polygon`");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
    }

    public static function getAddressOne($user)
    {
        $user = self::query("SELECT * FROM `address` WHERE `id`=$user");
        $num = $user->num_rows;
        $tariff = $user->fetch_object();
        $user->close();
        return $tariff;
    }

    public static function getAllUsers()
    {
        $news = [];
        $new = self::query("SELECT * FROM `userss` WHERE `client_id` IS NOT NULL ORDER By id DESC");
        for($i=0; $i<$new->num_rows; $i++)
        {
            $news[]=$new->fetch_object();
        }
        $new->close();
        return $news;
    }

//    public function __destruct() {
//        if (self::$data) self::$data->close();
//    }

}