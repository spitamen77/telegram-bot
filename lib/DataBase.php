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

use Bot\Bot;
use mysqli;

require_once __DIR__. "/config.php";

class DataBase
{

//    private static $db = null; // Единственный экземпляр класса, чтобы не создавать множество подключений
    private mysqli $mysqli; // Идентификатор соединения

    /* Получение экземпляра класса. Если он уже существует, то возвращается, если его не было, то создаётся и возвращается (паттерн Singleton) */
//    public static function getDB() {
//        if (self::$db == null) self::$db = new DataBase();
//        return self::$db;
//    }

    public function __construct() {
        $this->mysqli = new mysqli("127.0.0.1", DB_USER, DB_PASS, DB, 3306);
        $this->mysqli->set_charset('utf8mb4');
    }

    public function add_user2($chat_id, string $lang)
    {
        if($this->mysqli->query("SELECT * FROM users WHERE user_id = $chat_id")->num_rows==1){
            $this->mysqli->query("UPDATE `users` SET `lang` = '$lang' WHERE `users`.`user_id` = $chat_id");
        }
        else $this->mysqli->query("INSERT INTO users (user_id, lang, step, created) VALUES ('".$chat_id."', '".$lang."', '2', '".time()."')");
    }

    public function add_user($chat_id, string $lang)
    {
        $query = "INSERT INTO users (user_id, lang, step, created)
              SELECT ?, ?, '2', ?
              FROM dual
              WHERE NOT EXISTS (SELECT 1 FROM users WHERE user_id = ?)";
        $time = time();

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("issi", $chat_id, $lang, $time, $chat_id);

        if ($stmt->execute()) {
            // Здесь можно добавить код обработки успешной вставки, если необходимо
        } else {
            Bot::setFileLog([$chat_id, $lang]);
        }
    }

    public function edit_lang($chat_id, string $lang)
    {
        $this->mysqli->query("UPDATE `users` SET `lang` = '$lang' WHERE `users`.`user_id` = $chat_id");
    }

    public function insert(string $table, string $sql, $value)
    {
        $this->mysqli->query("INSERT INTO $table ($sql) VALUES ($value)");
    }

    public function change_step($chat_id,$step)
    {
        $this->mysqli->query("UPDATE `users` SET `step` = '$step', `kicked`=0 WHERE `users`.`user_id` = $chat_id");

    }

    public function update(string $sql='', string $where, string $table = "users")
    {
        $update = "UPDATE $table SET $sql WHERE $where";
//        file_put_contents('logs.log', $update.PHP_EOL, FILE_APPEND | LOCK_EX);
        $result = $this->mysqli->query("UPDATE $table SET $sql WHERE $where");
        if (!$result) {
            error_log("Ошибка выполнения запроса: " . $this->mysqli->error);
        }
    }

    public function select(string $where, string $table = "users", $limit=false)
    {
        if ($limit) $new = $this->mysqli->query("SELECT * FROM $table WHERE $where ORDER BY id DESC LIMIT $limit");
        else $new = $this->mysqli->query("SELECT * FROM $table WHERE $where ORDER BY id");
        $news = [];
        if ($new) {
            for($i=0; $i<$new->num_rows; $i++)
            {
                $news[]=$new->fetch_object();
            }
            return $news;
        } else {
            return null;
        }
    }

    public function selectOne(string $sql, string $table)
    {
        $select = "SELECT * FROM `".$table."` WHERE " . $sql. " LIMIT 1";
//        file_put_contents('logs.log', $select.PHP_EOL, FILE_APPEND | LOCK_EX);
        $query = $this->mysqli->query($select);
        if ($query && $query->num_rows > 0){
            $res = $query->fetch_object();
            if ($res) {
                return $res;
            }
        } else {
            Bot::setFileLog($this->mysqli->error);
        }
        return null;
    }

    public function selectCustom(string $select, string $where, string $table, int $limit = 0)
    {
        if ($limit) {
            $limit = "LIMIT $limit";
            $query = $this->mysqli->query("SELECT $select FROM `$table` WHERE $where $limit");
            if ($query && $query->num_rows > 0){
                $res = $query->fetch_object();
                if ($res) {
                    return $res;
                }
            } else {
                Bot::setFileLog($this->mysqli->error);
            }
        } else {
            $query = $this->mysqli->query("SELECT $select FROM `$table` WHERE $where");
            $news = [];
            for($i=0; $i<$query->num_rows; $i++)
            {
                $news[]=$query->fetch_object();
            }
            return $news;
        }
        return null;
    }

    public function selectTrue($chat_id)
    {
        $query = $this->mysqli->query("SELECT SUM(created_count) AS total FROM ( SELECT COUNT(DISTINCT created) AS created_count FROM tests WHERE user_id = ".
            $chat_id." AND cron = 0 GROUP BY bilet_id HAVING SUM(result = 1) > 8 ) AS subquery");
        if ($query){
            return $query->fetch_object()->total ?? 0;
        }
        return 0;
    }

    public function getMax(string $where, string $table)
    {
        $query = $this->mysqli->query("SELECT MAX(id) as max FROM $table WHERE $where");
        if ($query && $query->num_rows > 0){
            $res = $query->fetch_object();
            if ($res) {
                return $res;
            }
        } else {
            Bot::setFileLog($this->mysqli->error);
        }
        return null;
    }

    public function getCount(string $where, string $column, string $table)
    {
        $query = $this->mysqli->query("SELECT COUNT($column) AS total FROM $table WHERE $where");
        if ($query){
            $res = $query->fetch_object();
            if ($res) {
                return $res;
            }
        }
        return null;
    }

    public function selectJoin($id)
    {
        $query = $this->mysqli->query("SELECT id, user_id, belgi_id, (SELECT image FROM belgilar WHERE id = belgi_savol.belgi_id) as image 
        FROM belgi_savol WHERE user_id = $id");
        if ($query){
            $res = $query->fetch_object();
            if ($res) {
                return $res;
            }
        }
        return null;
    }

    public function random(string $where = '`number` IS NOT NULL', string $table = 'belgilar')
    {
        $query = $this->mysqli->query("SELECT * FROM $table WHERE $where ORDER BY RAND() LIMIT 1");
        if ($query && $query->num_rows > 0){
            $res = $query->fetch_object();
            if ($res) {
                return $res;
            }
        } else {
            Bot::setFileLog($this->mysqli->error);
        }
        return null;
    }

    public function getUser($id, int $lang = 0)
    {
        if ($lang) {
            $query = $this->mysqli->query("SELECT `lang` FROM `users` WHERE `user_id` = " . $id);
            if ($query) {
                $users = $query->fetch_object();
                if ($users) {
                    return $users->lang;
                }
            }
            return 'uzk';
        } else {
            $query = $this->mysqli->query("SELECT * FROM `users` WHERE `user_id` = " . $id);
            if ($query) {
                $res = $query->fetch_object();
                if ($res) {
                    return $res;
                }
            }
        }
        return null; // Handle the case where the query fails
    }


    public function getStep($id)
    {
        $query = $this->mysqli->query("SELECT * FROM `users` WHERE `user_id` = " . $id);
        if ($query) {
            $users = $query->fetch_object();
            if ($users) {
                return $users->step;
            }
        } else {
            Bot::setFileLog($this->mysqli->error);
        }
        return 7;
    }

    public function getStart($start, $end)
    {
        $startDateTime = date('Y-m-d H:i:s', $start);
        $endDateTime = date('Y-m-d H:i:s', $end);

        $result = $this->mysqli->query("SELECT COUNT(*) AS `c` FROM `users` WHERE `updated_at` BETWEEN '$startDateTime' AND '$endDateTime'");

        return $result->fetch_object()->c;
    }

    public function getCreated($start, $end)
    {
        $startDateTime = date('Y-m-d H:i:s', $start);
        $endDateTime = date('Y-m-d H:i:s', $end);

        $query = $this->mysqli->query("SELECT COUNT(*) as `c` FROM `users` WHERE `created_at` BETWEEN '$startDateTime' AND '$endDateTime'");
        return @$query->fetch_object()->c;
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