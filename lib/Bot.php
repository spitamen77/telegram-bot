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
    const OGOH = 1;
    const IMTIYOZ = 2;
    const TAQIQ = 3;
    const BUYUR = 4;
    const AXBOROT = 5;
    const SERVICE = 6;
    const QOSHIMCHA = 7;
    const YOTIQ = 8;
    const TIK = 9;

    const ANSWER_TRUE = 1;
    const ANSWER_FALSE = 9;

    protected static $data;
    public static $get;
    public static $call;
    public static $chat;
    public static $back;
    public static $from;
    public static $text;
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

    public function __construct() {
        $input = json_decode(file_get_contents('php://input'));

        self::$call = $input;
        if (property_exists($input, 'callback_query')) {
            self::$chat = $input->callback_query->message->chat;
            self::$text = $input->callback_query->message->text;
            self::setFileLog(['input->callback_query']);
        } else {
            self::$chat = $input->message->chat;

            if (isset($input->message)) {
                self::setFileLog(['input->message']);
                self::$text = $input->message->text;
                self::$chat = $input->message->chat;
            } else {
                self::$text = ""; // Или установить другое значение по умолчанию
                self::$chat = "";
                self::setFileLog($input);
            }
        }

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

    protected static function send(string $method, array $data = [])
    {
        $url = TELEGRAM_URL . TOKEN . "/" . $method;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_TIMEOUT,10);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function requestToTelegram($data, $chat_id, string $image)
    {
        $result = null;
        $data['chat_id'] = $chat_id;
        $data['photo'] = BOT_URL.'/image/'.$image;
        $url = TELEGRAM_URL . TOKEN . "/sendPhoto";
        if (is_array($data)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_POST, count($data));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch,CURLOPT_TIMEOUT,10);
            $result = curl_exec($ch);
            curl_close($ch);
        }

        return json_decode($result, true);
    }

    public static function sText()
    {
        $response = self::send("sendMessage",
            [
                'chat_id' => self::$chat_id,
                'text' => self::$message,
                'parse_mode' => self::$parse_mode,
//                'disable_web_page_preview' => self::$disable_web_page_preview,
//                'disable_notification' => self::$disable_notification,
                'reply_to_message_id' => self::$reply_to_message_id,
                'reply_markup' => json_encode(self::$reply_markup),
            ]
        );
        self::setFileLog($response);
        return json_decode($response, true);
    }

    public static function rText()
    {
        self::$reply_markup = ['remove_keyboard' => true];
//        self::dump(
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
//            )
        );
    }

    public static function sGeo()
    {
//        self::dump(
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
//            )
        );
    }

    public static function eText()
    {
        //        self::setFileLog($response);

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

    public static function sPhoto(string $url,$caption=false)
    {
        if ($caption)
            $result = self::send("sendPhoto",
                [
                    'chat_id' => self::$chat_id,
                    'photo' => BOT_URL.'/image/'.$url,
                    'caption' => $caption,
                ]
            );
        else  {
            $result = self::send("sendPhoto",
                [
                    'chat_id' => self::$chat_id,
                    'photo' => BOT_URL.'/image/'.$url,
                ]
            );
        }

        return json_decode($result, true);
    }
    public static function delMsg()
    {
//        self::dump(
            self::send("deleteMessage",
                [
                    'chat_id' => self::$chat_id,
                    'message_id' => self::$message_id
                ]
//            )
        );
    }
    public static function push()
    {
//        self::dump(
            self::send("answerCallbackQuery",
                [
                    'callback_query_id' => self::$chat_id,
                    'show_alert' => true,
                    'text' =>  self::$message
                ]
//            )
        );
    }

    public static function Send_Out($user_id, $text, $is_end = true)
    {
//        self::$reply_markup = ['remove_keyboard' => false];
//        self::dump(
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
//            )
        );
    }

    public static function Send_Hide($user_id, $text, $is_end = true)
    {
        return file_get_contents(TELEGRAM_URL.TOKEN."/sendMessage?chat_id=$user_id&text=$text&parse_mode=Markdown");
    }

    public static function Main($db)
    {
        if (self::$back) {
            $chat_id = self::$back->chat->id;
        }
        else {
            $chat_id = self::$chat->id;
        }
        $til = Word::getLang($db, $chat_id);
        self::setMessage($til->til('key01'));
        self::setMarkup(['text'=>"📚 ".$til->til('key03'),'callback_data'=>"continue"],1,1);
        self::setMarkup(['text'=>"🏆 ".$til->til('key04'),'callback_data'=>"results"],2,1);
        self::setMarkup(['text'=>"🚦 ".$til->til('key05'),'callback_data'=>"info"],2,2);
        self::setMarkup(['text'=>"📊 ".$til->til('key19'),'callback_data'=>"stat"],3,1);
        self::setMarkup(['text'=>"⚙️ ".$til->til('key07'),'callback_data'=>"setting"],3,2);
    }

    public static function setFileLog($data) {
        $fh = fopen('log.txt', 'a') or die('can\'t open file');
        ((is_array($data)) || (is_object($data))) ? fwrite($fh, print_r($data, TRUE)."\n") : fwrite($fh, $data . "\n");
        fclose($fh);
    }

    public function __destruct()
    {
        http_response_code(200);
    }

}