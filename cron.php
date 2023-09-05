<?php
/**
 * Created by PhpStorm.
 * PHP version 7.4
 *
 * @category PhpStorm
 * @package  cron.php
 * @author   Abdujalilov Dilshod <ax5165@gmail.com>
 * @license  https://www.php.net PHP License
 * @link     https://github.com/spitamen77
 * @date     2023.09.03 20:30
 */

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__. "/lib/config.php";

use Bot\Bot;
use DataBase\DataBase;
use Word\Word;

http_response_code(200);

$botan = new Bot();

$db = new DataBase();

/** sozlamalar **/
/** action inline-keyboard  */

//$data = [12,45];
$arrays = $db->select("cron=0 AND (updated_at <= DATE_SUB(NOW(), INTERVAL 30 HOUR) OR (`updated_at` IS NULL AND created_at <= DATE_SUB(NOW(), INTERVAL 30 HOUR)))", 'users', '25'); //1 - yuborilgani

if ($arrays) {
    foreach ($arrays as $user) {
        $botan::setChatId($user->user_id);
        $til = Word::getLang($db, $user->user_id);

        $random = $db->random('`raqam` = 1','`savol_data`');

        $db->insert("`tests`", "`bilet_id`, `raqam`, `user_id`, `created`", "'".$random->bilet."', '1', '".$user->user_id."', '".time()."'");
        $db->update("cron = 1", "user_id=" . $user->user_id, "users");

        $text = $til->til('key47')."\n".$til->til('key38').": ".$random->bilet.", ".$til->til('key39').": 1\n";
        $savol = 'savol_'.$til->lang;
        $javob_a = 'javob_a_'.$til->lang;
        $javob_b = 'javob_b_'.$til->lang;
        $javob_c = 'javob_c_'.$til->lang;
        $javob_d = 'javob_d_'.$til->lang;

        $botan::setMarkup(['text' => "A", 'callback_data' => "savol_A_".$random->bilet.'_1_'.$random->javob], 1, 1);
        $botan::setMarkup(['text' => "B", 'callback_data' => "savol_B_".$random->bilet.'_1_'.$random->javob], 1, 2);

        $timer = "\n".$til->til('key36')." 14:59 ".$til->til('key37');

        $botan::setMarkup(['text' => "C", 'callback_data' => "savol_C_".$random->bilet.'_1_'.$random->javob], 2, 1);

        if (@strlen($random->$javob_d)) {
            $botan::setMarkup(['text' => "D", 'callback_data' => "savol_D_".$random->bilet.'_1_'.$random->javob], 2, 2);
            $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                $random->$javob_c."\nD - ".$random->$javob_d.$timer);
        } else {
            $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                $random->$javob_c.$timer);
        }
        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);

        if ($random->rasm) {
            $res = $botan::sendPhotoWithText("savol/".$random->rasm);
        } else {
            $res = $botan::sText();
        }
        sleep(0.2);
        $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");
    }
}
return;
