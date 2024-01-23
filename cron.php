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

//require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__. "/lib/config.php";
//
//use Bot\Bot;
//use DataBase\DataBase;
//use Word\Word;
//
//header('Content-Type: application/json');
//
//$botan = new Bot();
//
//$db = new DataBase();
//
///** sozlamalar **/
///** action inline-keyboard  */
//
////$data = [12,45];
////$arrays = $db->select("cron=0 AND created_at = '2023-09-05 17:55:51'", 'users', '15'); //1 - yuborilgani
//$arrays = $db->select("(kicked = 0 AND cron=0) AND (updated_at <= DATE_SUB(NOW(), INTERVAL 30 HOUR) OR (`updated_at` IS NULL AND created_at <= DATE_SUB(NOW(), INTERVAL 30 HOUR)))", 'users', '15'); //1 - yuborilgani
//
//if ($arrays) {
//    foreach ($arrays as $user) {
//        $botan::setChatId($user->user_id);
//        $til = Word::getLang($db, $user->user_id);
//
//        $random = $db->random('`raqam` = 1','`savol_data`');
//
//        $db->insert("`tests`", "`bilet_id`, `raqam`, `user_id`, `created`", "'".$random->bilet."', '1', '".$user->user_id."', '".time()."'");
//
//        $text = $til->til('key47')."\n".$til->til('key38').": ".$random->bilet.", ".$til->til('key39').": 1\n";
//        $savol = 'savol_'.$til->lang;
//        $javob_a = 'javob_a_'.$til->lang;
//        $javob_b = 'javob_b_'.$til->lang;
//        $javob_c = 'javob_c_'.$til->lang;
//        $javob_d = 'javob_d_'.$til->lang;
//
//        $botan::setMarkup(['text' => "F1", 'callback_data' => "savol_A_".$random->bilet.'_1_'.$random->javob], 1, 1);
//        $botan::setMarkup(['text' => "F2", 'callback_data' => "savol_B_".$random->bilet.'_1_'.$random->javob], 1, 2);
//
//        $timer = "\n\n".$til->til('key36')." 14:59 ".$til->til('key37');
//
//        $botan::setMarkup(['text' => "F3", 'callback_data' => "savol_C_".$random->bilet.'_1_'.$random->javob], 1, 3);
//
//        if (@strlen($random->$javob_d)) {
//            $botan::setMarkup(['text' => "F4", 'callback_data' => "savol_D_".$random->bilet.'_1_'.$random->javob], 1, 4);
//            $botan::setMessage($text.$random->$savol."\nF1 - ".$random->$javob_a."\nF2 - ".$random->$javob_b."\nF3 - ".
//                $random->$javob_c."\nF4 - ".$random->$javob_d.$timer);
//        } else {
//            $botan::setMessage($text.$random->$savol."\nF1 - ".$random->$javob_a."\nF2 - ".$random->$javob_b."\nF3 - ".
//                $random->$javob_c.$timer);
//        }
//        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 2, 1);
//
//        if ($random->rasm) {
//            $res = $botan::sendPhotoWithText("savol/".$random->rasm);
//        } else {
//            $res = $botan::sText();
//        }
//        sleep(0.2);
//        $rw = $res['result']['message_id'];
//        if ($rw == 403) {
//            $db->update("second=".$rw.", cron=1, kicked = 1", "user_id=" . $user->user_id, "users");
//        } else {
//            $db->update("second=".$rw.", cron=1", "user_id=" . $user->user_id, "users");
//        }
//    }
//}
//http_response_code(200);
//return;

echo 'salom';