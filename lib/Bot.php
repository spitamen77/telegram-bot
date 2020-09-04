<?php
/**
 * Created by PhpStorm.
 * Author: Abdujalilov Dilshod
 * Telegram: https://t.me/coloterra
 * Web: http://www.websar.uz
 * Project: autotest
 * Date: 27.01.2020 16:58
 */
namespace Bot;

require_once "./vendor/autoload.php";
require_once "./lib/config.php";

use Word\Word;

class Bot
{
    private static $db = null;
    const OGOH = 1;
    const IMTIYOZ = 2;
    const TAQIQ = 3;
    const BUYUR = 4;
    const AXBOROT = 5;
    const SERVOCE = 6;
    const QOSHIMCHA = 7;
    const YOTIQ = 8;
    const TIK = 9;
    protected static $api;
    protected static $data;
    public static $get;
    public static $call;
    public static $chat;
    public static $back;
    public static $from;
    public static $date;
    public static $id;
//	public static $u_id;
    public static $text;
//	public static $json;
    public static $latitude;
    public static $longitude;
    protected static $chat_id;
    protected static $message_id;
    protected static $message;
    protected static $parse_mode = "Markdown";
    protected static $disable_web_page_preview = false;
    protected static $disable_notification = false;
    protected static $reply_to_message_id;
    public static $reply_markup = [
        'inline_keyboard'=>
            [
                [
                    [
                        'text'=>"Ortga",
                        'callback_data'=>"forBack"
                    ]
                ]
            ]
    ];


    public static function getBot() {
        if (self::$db == null) self::$db = new bot();
        return self::$db;
    }
    /* private-конструктор, подключающийся к базе данных, устанавливающий локаль и кодировку соединения */
    private function __construct() {
        $input = json_decode(file_get_contents('php://input'));
        self::$api = TOKEN;
        self::$get = $input;
        self::$call = $input;
        self::$chat = self::$get->message->chat;
        self::$text = self::$get->message->text;
//        self::$json = json_encode(self::$call->callback_query);
//        self::$geo = self::$get->message->location;
//        self::$contact = self::$get->message->contact;
    }


    public static function on($command)
    {
        if (self::$text == $command) {
            return true;
        }
        else return false;
    }
    public static function call($callback_query)
    {
        if (self::$call->callback_query->data == $callback_query) {
            self::$back = self::$call->callback_query->message;
//			self::$u_id = self::$back->from->id;
            return true;
        }
        else return false;
    }
    public static function dump($value = "")
    {
        var_dump($value);
    }
    public static function setChatId($id)
    {
        self::$chat_id = $id;
    }
    public static function setMessageId($id)
    {
        self::$message_id = $id;
    }
    public static function setMessage($text)
    {
        self::$message = $text;
    }
    public static function setLat($lat)
    {
        self::$latitude = $lat;
    }
    public static function setLon($long)
    {
        self::$longitude = $long;
    }
    public static function setMode($mode = "Markdown")
    {
        self::$parse_mode = $mode;
    }
    public static function setHtml($mode = "HTML")
    {
        self::$parse_mode = $mode;
    }
    public static function setWeb($web = false)
    {
        self::$disable_web_page_preview = $web;
    }
    public static function setNot($not = false)
    {
        self::$disable_notification = $not;
    }
    public static function setReply($reply = NULL)
    {
        self::$reply_to_message_id = $reply;
    }
    public static function setMarkup($markup = [], $key = NULL, $col = NULL)
    {
        if($key!=0 && !is_null($key))--$key;
        if($col!=0 && !is_null($col))--$col;
        if (is_null($col))self::$reply_markup["inline_keyboard"][$key][] = $markup;
        else {
            self::$reply_markup["inline_keyboard"][$key][$col] = $markup;
        }
    }
    public static function setKeyboard($keyboard = [], $key = NULL, $val = NULL)
    {
        self::$reply_markup["keyboard"][--$key][--$val] = $keyboard;
//        self::$reply_markup["remove_keyboard"][--$key][--$val] = true;
    }
    public static function setFirstMarkup($keys = ["text","callback_data"], $values = ["Ortga","Back"])
    {
        self::$reply_markup = [
            'inline_keyboard'=>
                [
                    [
                        [
                            $keys[0]=>$values[0],
                            $keys[1]=>$values[1]
                        ]
                    ]
                ]
        ];
    }

    protected static function send($method,$datas=[])
    {
        $url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_HTTPHEADER, ["Connection: Keep-Alive", "Keep-Alive: 120"]);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $datas);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_TIMEOUT, 10);

        $out = json_decode(curl_exec($ch));
        curl_close($ch);
        return $out;
    }

    public static function requestToTelegram($data, $chat_id, $image)
    {
        $result = null;
        $data['chat_id'] = $chat_id;
        $data['photo'] = "https://auto.websar.uz/telegram/image/".$image;
        $url = "https://api.telegram.org/bot" . TOKEN . "/sendPhoto";
        if (is_array($data)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $result = json_decode(curl_exec($ch));
            curl_close($ch);
        }
        return $result;
    }

    public static function sText()
    {
//		self::dump(
        return self::send("sendMessage",
            [
                'chat_id' => self::$chat_id,
                'text' => self::$message,
                'parse_mode' => self::$parse_mode,
//                'disable_web_page_preview' => self::$disable_web_page_preview,
//                'disable_notification' => self::$disable_notification,
                'reply_to_message_id' => self::$reply_to_message_id,
                'reply_markup' => json_encode(self::$reply_markup),
            ]
//			)
        );
    }

    public static function rText()
    {
        self::$reply_markup = ['remove_keyboard' => true];
        self::dump(
            self::send("sendMessage",
                [
                    'chat_id' => self::$chat_id,
                    'text' => self::$message,
                    'parse_mode' => self::$parse_mode,
//                    'disable_web_page_preview' => self::$disable_web_page_preview,
//                    'disable_notification' => self::$disable_notification,
                    'reply_to_message_id' => self::$reply_to_message_id,
                    'reply_markup' => json_encode(self::$reply_markup),
                ]
            )
        );
    }

    public static function sGeo()
    {
        self::dump(
            self::send("sendLocation",
                [
                    'chat_id' => self::$chat_id,
                    'latitude' => self::$latitude,
                    'longitude' => self::$longitude,
                    'parse_mode' => self::$parse_mode,
                    'disable_web_page_preview' => self::$disable_web_page_preview,
                    'disable_notification' => self::$disable_notification,
                    'reply_to_message_id' => self::$reply_to_message_id,
                    'reply_markup' => json_encode(self::$reply_markup)
                ]
            )
        );
    }

    public static function eText()
    {

        return self::send("editMessageText",
            [
                'chat_id' => self::$chat_id,
                'message_id' => self::$message_id,
                'text' => self::$message,
                'parse_mode' => self::$parse_mode,
//                'disable_web_page_preview' => self::$disable_web_page_preview,
                'reply_markup' => json_encode(self::$reply_markup),
//                    'remove_keyboard' => true
            ]
        );
    }

    public static function sPhoto($url,$caption=false)
    {
        if ($caption)
            return self::send("sendPhoto",
                [
                    'chat_id' => self::$chat_id,
                    'photo' => "https://auto.websar.uz/telegram/image/".$url,
                    'caption' => $caption,
                ]
            );
        else return self::send("sendPhoto",
            [
                'chat_id' => self::$chat_id,
                'photo' => "https://auto.websar.uz/telegram/image/".$url,
            ]
        );
    }
    public static function delMsg()
    {
        self::dump(
            self::send("deleteMessage",
                [
                    'chat_id' => self::$chat_id,
                    'message_id' => self::$message_id
                ]
            )
        );
    }
    public static function push()
    {
        self::dump(
            self::send("answerCallbackQuery",
                [
                    'callback_query_id' => self::$chat_id,
                    'show_alert' => true,
                    'text' =>  self::$message
                ]
            )
        );
    }

    public static function Send_Out($user_id, $text, $is_end = true)
    {
        self::$reply_markup = ['remove_keyboard' => true];
        self::dump(
            self::send("sendMessage",
                [
                    'chat_id' => $user_id,
                    'text' => $text,
                    'parse_mode' => self::$parse_mode,
//                    'disable_web_page_preview' => self::$disable_web_page_preview,
//                    'disable_notification' => self::$disable_notification,
                    'reply_to_message_id' => self::$reply_to_message_id,
                    'reply_markup' => json_encode(self::$reply_markup),
                ]
            )
        );
    }

    public static function Send_Hide($user_id, $text, $is_end = true)
    {
        return file_get_contents("https://api.telegram.org/bot".TOKEN."/sendMessage?chat_id=$user_id&text=$text&parse_mode=Markdown");
    }

    public static function Main()
    {
        if (self::$back) {
            $chat_id = self::$back->chat->id;
        }
        else {
            $chat_id = self::$chat->id;
        }
        $til = word::getLang($chat_id);
        self::setMessage($til->til('key01'));
        self::setMarkup(['text'=>"📚 ".$til->til('key03'),'callback_data'=>"continue"],1,1);
        self::setMarkup(['text'=>"🏆 ".$til->til('key04'),'callback_data'=>"myaddress"],2,1);
        self::setMarkup(['text'=>"🚦 ".$til->til('key05'),'callback_data'=>"info"],2,2);
        self::setMarkup(['text'=>"📊 ".$til->til('key19'),'callback_data'=>"stat"],3,1);
        self::setMarkup(['text'=>"⚙️ ".$til->til('key07'),'callback_data'=>"setting"],3,2);
    }

    public static function setFileLog($data) {
        $fh = fopen('log.txt', 'a') or die('can\'t open file');
        ((is_array($data)) || (is_object($data))) ? fwrite($fh, print_r($data, TRUE)."\n") : fwrite($fh, $data . "\n");
        fclose($fh);
    }

    public function __destruct() {
        header("Connection: close");
        if(session_id()){
            session_write_close(); //Closes writing to the output buffer.
        }
    }

}