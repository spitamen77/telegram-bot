<?php
require_once "./vendor/autoload.php";
require_once "./lib/config.php";

use Bot\Bot;
use DataBase\DataBase;
use Word\Word;
//$start_time = microtime(true);
http_response_code(200);

$botan = new Bot();

$db = new DataBase();

/** sozlamalar **/
/** action inline-keyboard  */

$data = $botan::$call->callback_query->data ?? null;

if ($data !== null) {
    switch ($data) {
        case "info":
            $botan::call($data);
            $chat_id = $botan::$back->chat->id;
            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $botan::delMsg();
            $til = Word::getLang($db, $chat_id);

            $botan::setMessage($til->til("key12"));
            $botan::setMarkup(['text' => "🚦 " . $til->til("key13"), 'callback_data' => "znak_".Bot::OGOH."_1"], 1, 1);
            $botan::setMarkup(['text' => "🛑 " . $til->til("key14"), 'callback_data' => "znak_".Bot::IMTIYOZ."_89"], 2, 1);
            $botan::setMarkup(['text' => "⛔️ " . $til->til("key15"), 'callback_data' => "znak_".Bot::TAQIQ."_112"], 3, 1);
            $botan::setMarkup(['text' => "ℹ️ " . $til->til("key16"), 'callback_data' => "znak_".Bot::BUYUR."_16"], 4, 1);
            $botan::setMarkup(['text' => "🚸 " . $til->til("key17"), 'callback_data' => "znak_".Bot::AXBOROT."_46"], 5, 1);
            $botan::setMarkup(['text' => "🛠 " . $til->til("key18"), 'callback_data' => "znak_".Bot::SERVICE."_125"], 6, 1);
            $botan::setMarkup(['text' => "🎦 " . $til->til("key20"), 'callback_data' => "znak_".Bot::QOSHIMCHA."_1"], 7, 1);
            $botan::setMarkup(['text' => "📌 " . $til->til("key21"), 'callback_data' => "znak_".Bot::YOTIQ."_1"], 8, 1);
            $botan::setMarkup(['text' => "📍 " . $til->til("key22"), 'callback_data' => "znak_".Bot::TIK."_1"], 8, 2);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 9, 1);
            $botan::sText();
            break;

        case "stat":
            $botan::call($botan::$call->callback_query->data);
//            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $til = Word::getLang($db, $botan::$back->chat->id);
            function time_stats($type){
                $day = date('j');
                $month = date('m');
                $year = date('Y');
                $d = DateTime::createFromFormat('j-n-Y-H-i-s', "$day-$month-$year-0-00-10", new DateTimeZone('+0500'));
                switch ($type){
                    case 1:
                        return $d->getTimestamp();
                        break;
                    case 7:
                        return $d->getTimestamp()-(30*24*60*60);
                        break;
                    case 30:
                        return $d->getTimestamp()-(12*30*24*60*60);
                        break;
                }
            }
//
            $one_start = $db->getStart(time_stats(1),time());
            $one_created = $db->getCreated(time_stats(1),time());
            $week_start = $db->getStart(time_stats(7),time());
            $week_created = $db->getCreated(time_stats(7),time());
            $month_start = $db->getStart(time_stats(30),time());
            $month_created = $db->getCreated(time_stats(30),time());

            $text2 = "\n\n 1 kun uchun \n".
                "Test yechganlar: ".$one_start."\n".
                "Qo'shilganlar: ".$one_created."\n\n".
                "30 kun uchun \n".
                "Test yechganlar: ".$week_start."\n".
                "Qo'shilganlar: ".$week_created."\n\n".
                "1 yil uchun \n".
                "Test yechganlar: ".$month_start."\n".
                "Qo'shilganlar: ".$month_created;

            $botan::setMessage("📊 ".$til->til('key19').$text2);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::eText();
            break;
        case "continue":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
//            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $til = Word::getLang($db, $chat_id);
            $botan::setMessage($til->til("key11"));
            $botan::setMarkup(['text' => "📚 " . $til->til("key08"), 'callback_data' => "test"], 1, 1);
            $botan::setMarkup(['text' => "📄 " . $til->til("key09"), 'callback_data' => "bilet"], 2, 1);
            $botan::setMarkup(['text' => "🚦 " . $til->til("key10"), 'callback_data' => "belgi"], 3, 1);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 4, 1);
            $db->change_step($chat_id, 5); // bilet tanlashi uchun
            $botan::eText();
            break;
        case "test":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
//            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $til = Word::getLang($db, $chat_id);
            $user = $db->getUser($chat_id, 0);

            $random = $db->random('`raqam` = 1','`savol_data`');
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();

            $db->insert("`tests`", "`bilet_id`, `raqam`, `user_id`, `created`", "'".$random->bilet."', '1', '".$chat_id."', '".time()."'");

            $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": 1\n";
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
                $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
            } else {
                $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                    $random->$javob_c.$timer);
                $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
            }

            if ($random->rasm) {
                $res = $botan::sendPhotoWithText("savol/".$random->rasm);
            } else {
                $res = $botan::sText();
            }
            sleep(1);
            $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");
            break;
        case "bilet":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $til = Word::getLang($db, $chat_id);
            $user = $db->getUser($chat_id, 0);
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
            $botan::setMessage($til->til('key43'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "continue"], 1, 1);
            $ttt2 = $botan::sText();
            break;
        case "results":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $til = Word::getLang($db, $chat_id);
            $total = $db->selectCustom('COUNT(DISTINCT bilet_id) AS total', "`cron` = 0 AND `user_id` = $chat_id", 'tests', 1);
            $true_total = $db->selectTrue($chat_id);

            $text2 = "\n\n".$til->til('key45').": ".$total->total."\n".
                $til->til('key46').": ".$true_total;

            $botan::setMessage("📊 ".$til->til('key04').$text2);

            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::eText();
            break;
        case "belgi":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $til = Word::getLang($db, $chat_id);
            $db->change_step($chat_id, 3);
            $random = $db->random();
            $db->belgiSavol($chat_id, $random->id,$random->number);
            $user = $db->getUser($chat_id, 0);
            $db->update("start=".time(), "user_id=" . $chat_id, "users");
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
//            $ttt = $botan::sPhoto("belgi/".$random->image);
            $botan::setMessage($til->til('key27'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
//            $ttt2 = $botan::sText();
            if ($random->image) {
                $res = $botan::sendPhotoWithText("belgi/".$random->image);
            } else {
                $res = $botan::sText();
            }
            sleep(1);
            $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");
            break;

        case "forBack": // main oyna
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $botan::setReply();
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main($db);
            $botan::eText();
            $db->change_step($chat_id, 7);
            break;
        // ** main menu **//

        case "setting":
            $botan::call($botan::$call->callback_query->data);
            $til = Word::getLang($db, $botan::$back->chat->id);
//            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::setMessage($til->til('key32'));
            $user = $db->getUser($botan::$back->chat->id, 1);
            if ($user == "uzl") $icon_uz = "🔹 "; else $icon_uz = "";
            if ($user == "rus") $icon_ru = "🔹 "; else $icon_ru = "";
            if ($user == "uzk") $icon_en = "🔹 "; else $icon_en = "";
            $botan::setMarkup(['text' => $icon_uz."🇺🇿 O'zbekcha", 'callback_data' => "uzl"], 1, 1);
            $botan::setMarkup(['text' => $icon_ru."🇷🇺 Русский", 'callback_data' => "rus"], 2, 1);
            $botan::setMarkup(['text' => $icon_en."🇺🇿 Ўзбекча", 'callback_data' => "uzk"], 3, 1);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 4, 1);
            $botan::eText();
            break;

        // ** end main menu **//

        // ** end sub child main menu **//

        case "uzkril": //2-step
        case "russian":
        case "uzlatin":
            $botan::call($botan::$call->callback_query->data);
            $db->add_user($botan::$back->chat->id, substr($botan::$call->callback_query->data, 0, 3));
    //            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
            $botan::setChatId($botan::$back->chat->id);
            $botan::Main($db);
            $botan::sText();
            break;
        case "uzk": //2-step
        case "rus":
        case "uzl":
            $botan::call($botan::$call->callback_query->data);
            $lang = substr($botan::$call->callback_query->data, 0, 3);
            $db->edit_lang($botan::$back->chat->id, $lang);
//            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main($db);
            $botan::eText();
            break;
        default:
            $route = $botan::$call->callback_query->data;
            $botan::call($route);

            $chat_id = $botan::$back->chat->id;
            $pieces = explode("_", $route);
            $user = $db->getUser($chat_id, 0);
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
            $til = Word::getLang($db, $chat_id);

            if (preg_match("~^znak~", $route)) {

                $id = (int) $pieces[2];
                $belgi = $db->selectOne("id=".$id." AND child=".$pieces[1],"belgilar");

                if ($belgi){
                    $next = $id+1;
                    $prive = $id-1;
//                    $ttt = $botan::sPhoto("belgi/".$belgi->image);
                    $nomi = "name_".$user->lang;
                    $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                    $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                    $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);

                    if ($belgi->image) {
                        $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                    } else {
                        $res = $botan::sText();
                    }
                    sleep(1);
                    $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");
                }else{
                    $belgi = $db->selectOne('child = '.$pieces[1].' ORDER BY RAND()',"belgilar");
                    $p_belgi = $db->selectOne('child = '.$pieces[1].' AND id <> '.$belgi->id.' ORDER BY RAND()',"belgilar");
                    $n_belgi = $db->selectOne('child = '.$pieces[1].' AND id <> '.$p_belgi->id.' ORDER BY RAND()',"belgilar");

                    switch ($pieces[1]){
                        case "1":
                        case "2":
                        case "3":
                        case "4":
                        case "5":
                        case "6":
//                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$p_belgi->id], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$n_belgi->id], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);

                            if ($belgi->image) {
                                $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                            } else {
                                $res = $botan::sText();
                            }
                            sleep(1);
                            $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");
                            break;

                        case "7":
                        case "8":
                        case "9":

                            $botan::setMessage($til->til("key33"));
                            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::sText();
                            break;
                    }
                }

            }
            elseif (preg_match("~^savol~", $route)) {
                // route - savol_B_107_1_B
                $variant = $pieces[1];
                $bilet = $pieces[2];
                $raqam = (int) $pieces[3];
                $true_answer = $pieces[4];

                $last_q = $db->getMax("bilet_id=".$bilet." AND raqam=".$raqam,"tests");
                $current = $db->selectOne("id=".$last_q->max, "tests");

                if ($user->cron == 1) {
                    // cron orqali borgan bo'lsa
                    $db->update("cron=0", "user_id=" . $chat_id, "users");
                }

                $difference = time() - $current->created;
                $timer = '';

                if ($difference >= 900) {
                    // time out
                    $botan::setMessage('❌ '.$til->til('key35'));
                    $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
                    $ttt2 = $botan::sText();
                    return true;
                } else {
                    $remainingSeconds = 15 * 60 - $difference;
                    $minutes = floor($remainingSeconds / 60); // Полные минуты
                    $remainingSeconds = $remainingSeconds % 60; // Остаток в секундах
                    $timer = "\n".$til->til('key36')." " . str_pad($minutes, 2, '0', STR_PAD_LEFT)
                        . ":" . str_pad($remainingSeconds, 2, '0', STR_PAD_LEFT) . " ".$til->til('key37');
                }

                if ($variant == $true_answer) {
                    // true answer
                    $db->update("result=".Bot::ANSWER_TRUE, "id=" . $last_q->max, "tests");
                } else {
                    $db->update("result=".Bot::ANSWER_FALSE, "id=" . $last_q->max, "tests");

                    //tekshiramiz, 2 tadan ortiq bo'madimi false javoblari
                    $sum = $db->getCount("`created`=".$current->created." AND result = ".Bot::ANSWER_FALSE, 'result', 'tests');

                    if ($sum->total >= 2) {
                        // ikkichi...
                        $wrong = $db->select("`bilet_id` = ".$bilet." AND `result` = ".Bot::ANSWER_FALSE." AND `created` = ".$current->created, 'tests');
                        $wrong_id = '';
                        foreach ($wrong as $id) {
                            $wrong_id .= "❌ ".$til->til('key38').": ".$bilet.", ".$til->til('key39').": ".$id->raqam."\n";
                        }
                        $botan::setMessage("Test topshirilmadi. 2 ta xato qildiz\n".$wrong_id);
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
                        $ttt2 = $botan::sText();
                        return true;
                    }
                }

                if ($raqam != 10) {
                    $raqam++;
                    $random = $db->selectOne("bilet=".$bilet." AND raqam=".$raqam, "savol_data");

                    $db->insert("`tests`", "`bilet_id`, `raqam`, `user_id`, `created`", "'".
                        $random->bilet."', '".$raqam."', '".$chat_id."', '".$current->created."'");

                    $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": $raqam\n";
                    $savol = 'savol_'.$til->lang;
                    $javob_a = 'javob_a_'.$til->lang;
                    $javob_b = 'javob_b_'.$til->lang;
                    $javob_c = 'javob_c_'.$til->lang;
                    $javob_d = 'javob_d_'.$til->lang;

                    $botan::setMarkup(['text' => "A", 'callback_data' => "savol_A_".$random->bilet.'_'.$raqam.'_'.$random->javob], 1, 1);
                    $botan::setMarkup(['text' => "B", 'callback_data' => "savol_B_".$random->bilet.'_'.$raqam.'_'.$random->javob], 1, 2);
                    $botan::setMarkup(['text' => "C", 'callback_data' => "savol_C_".$random->bilet.'_'.$raqam.'_'.$random->javob], 2, 1);
                    if (@strlen($random->$javob_d)) {
                        $botan::setMarkup(['text' => "D", 'callback_data' => "savol_D_".$random->bilet.'_'.$raqam.'_'.$random->javob], 2, 2);
                        $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                            $random->$javob_c."\nD - ".$random->$javob_d.$timer);
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
                    } else {
                        $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                            $random->$javob_c.$timer);
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
                    }
                    if ($random->rasm) {
                        $ttt2 = $botan::sendPhotoWithText("savol/".$random->rasm);
                    } else {
                        $ttt2 = $botan::sText();
                    }


                } else {
                    // bu ohirgi 10-test edi.
                    $wrong = $db->select("`bilet_id` = ".$bilet." AND `result` = ".Bot::ANSWER_FALSE." AND `created` = ".$current->created, 'tests');
                    $wrong_id = '';
                    $text = '';
                    $i = 0;
                    foreach ($wrong as $id) {
                        $wrong_id .= "❌ ".$til->til('key38').": ".$bilet.", ".$til->til('key39').": ".$id->raqam."\n";
                        $i++;
                    }
                    $i = 10 - $i;
                    if ($wrong_id) {
                        $text = $til->til('key41').": ".$wrong_id;
                    }
                    $botan::setMessage($til->til('key40')." $i - ".$til->til('key42')." \n".$text);
                    $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
                    $ttt2 = $botan::sText();
                    return true;

                }
                sleep(1);
                if (isset($ttt2['result']['message_id'])) {
                    $db->update("second=" . $ttt2['result']['message_id'] . ", first=0", "user_id=" . $chat_id, "users");
                }
            }
    }
}
elseif (isset($botan::$text)) {
    $til = Word::getLang($db, $botan::$chat->id);
    switch ($botan::$text) {
        case "/":
        case "/start":
            $user = $db->getUser($botan::$chat->id);
            if ($user->user_id == $botan::$chat->id) {
                $step = $db->getStep($botan::$chat->id);
                switch ($step){
                    case 2: //lang
                        $botan::setChatId($botan::$chat->id);
                        $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                        $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                        $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                        $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                        $botan::sText();
                        break;
                    default:
                        {
                            $botan::setChatId($botan::$chat->id);
                            $botan::Main($db);
                            $botan::sText();
                        }

                }
            }else{
                $botan::setChatId($botan::$chat->id);
                $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                $botan::sText();
            }
//            $db->update("start=".time(), "user_id=" . $botan::$chat->id, "users");
            break;
        case "/info":
        case "/info Лойиха хакида":
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::send_Out($botan::$chat->id, $til->til("key31"));
            break;

        default:
            $chat_id = $botan::$chat->id;
            $step = $db->getStep($chat_id);
            switch ($step) {
                case 2: //phone
                    $botan::setChatId($botan::$chat->id);
                    $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                    $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                    $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                    $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                    $botan::sText();
                    break;
                case 3: //code
                    $til = Word::getLang($db, $chat_id);
                    $botText = trim($botan::$text);
                    $belgi = $db->selectOne("number='".$botText."' AND user_id=".$chat_id, "belgi_savol");
                    $botan::setChatId($chat_id);
                    $getUser = $db->getUser($chat_id, 1);
                    if ($belgi){
                        $random = $db->random();
                        $db->belgiSavol($chat_id, $random->id,$random->number);
                        $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$random->image);

                        $botan::setMessage($til->til('key24'));
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                        $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                        $ttt2 = $botan::sText();
                        sleep(1);
                        $db->update("second='".$ttt2['result']['message_id']."', first='".$ttt['result']['message_id']."'", "user_id=" . $chat_id, "users");

                    }else{
                        $pieces = explode(",", $botText);
                        if (count($pieces) >= 2) {
                            $nomer = $pieces[0] . "." . $pieces[1];
                            $belgi = $db->selectOne("number='".$nomer."' AND user_id=".$chat_id, "belgi_savol");
                            if ($belgi){
                                $random = $db->random();
                                $db->belgiSavol($chat_id, $random->id,$random->number);
                                $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$random->image);
                                $botan::setMessage($til->til('key24'));
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                                $ttt2 = $botan::sText();
                                sleep(1);
                                $db->update("second='".$ttt2['result']['message_id']."', first='".$ttt['result']['message_id']."'", "user_id=" . $chat_id, "users");
                            }else{
                                $belgi = $db->selectJoin($chat_id);
                                $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                                $botan::setMessage($til->til('key25'));
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                                $ttt2 = $botan::sText();
                                sleep(1);
                                $db->update("second='".$ttt2['result']['message_id']."', first='".$ttt['result']['message_id']."'", "user_id=" . $chat_id, "users");
//                            $botan::send_Out($chat_id, $til->til("key25"));
                            }
                        } else {
                            $belgi = $db->selectJoin($chat_id);
                            $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                            $botan::setMessage($til->til('key25'));
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                            $ttt2 = $botan::sText();
                            sleep(1);
                            $db->update("second='".$ttt2['result']['message_id']."', first='".$ttt['result']['message_id']."'", "user_id=" . $chat_id, "users");
//
                        }

                    }

                    break;

                case 5:
                    $botText = (int) trim($botan::$text);
                    $user = $db->getUser($chat_id, 0);
                    $random = $db->selectOne("bilet=".$botText." AND raqam=1", "savol_data");

                    $botan::setChatId($chat_id);
                    $botan::setMessageId($user->first);

                    if (!$random) {
                        $botan::setMessage($til->til("key44"));
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
                        $botan::sText();
                        return true;
                    }

                    $db->insert("`tests`", "`bilet_id`, `raqam`, `user_id`, `created`", "'".$random->bilet."', '1', '".$chat_id."', '".time()."'");

                    $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": 1\n";
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
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
                    } else {
                        $botan::setMessage($text.$random->$savol."\nA - ".$random->$javob_a."\nB - ".$random->$javob_b."\nC - ".
                            $random->$javob_c.$timer);
                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 3, 1);
                    }

                    if ($random->rasm) {
                        $res = $botan::sendPhotoWithText("savol/".$random->rasm);
                    } else {
                        $res = $botan::sText();
                    }
                    sleep(1);
                    $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $user->user_id, "users");

                    break;

                case 7: //belgini topib beraman
                    $til = Word::getLang($db, $chat_id);
                    $botText = trim($botan::$text);
//                    $botText = preg_replace('/\s|\+|-|@|#|&|%|$|=|_|:|;|!|\'|"|\(|\)/', '', $botan::$text);
                    $belgi = $db->selectOne("number='".$botText."'", "belgilar");
                    $getUser = $db->getUser($chat_id, 1);
                    if ($belgi){
                        $nomi = "name_".$getUser;
//                        $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                        $next = $belgi->id+1;  $prive = $belgi->id-1;
                        $botan::setChatId($chat_id);
                        $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                        $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$belgi->child."_".$prive], 1, 1);
                        $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$belgi->child."_".$next], 1, 2);
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 2, 1);

                        if ($belgi->image) {
                            $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                        } else {
                            $res = $botan::sText();
                        }
                        sleep(1);
                        $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $chat_id, "users");

                    }else{
                        $pieces = explode(",", $botText);

                        if (count($pieces) >= 2) {
                            $nomer = $pieces[0].".".$pieces[1];
                            $belgi = $db->selectOne("number='".$nomer."'", "belgilar");
                            if ($belgi){
                                $nomi = "name_".$getUser;
//                                $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                                $next = $belgi->id+1;  $prive = $belgi->id-1;
                                $botan::setChatId($chat_id);
                                $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                                $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$belgi->child."_".$prive], 1, 1);
                                $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$belgi->child."_".$next], 1, 2);
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 2, 1);

                                if ($belgi->image) {
                                    $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                                } else {
                                    $res = $botan::sText();
                                }
                                sleep(1);
                                $db->update("second=".$res['result']['message_id'].", first=0", "user_id=" . $chat_id, "users");
                            }else{
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::send_Out($chat_id, $til->til("key23"));
                            }
                        } else {
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::send_Out($chat_id, $til->til("key23"));
                        }

                    }
                    break;
                default:
                    {
                        $til = Word::getLang($db, $chat_id);
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                        $botan::send_Out($chat_id, $til->til("key23"));
                    }
            }
    }
}
//$end_time = microtime(true);
//$execution_time = ($end_time - $start_time) * 1000;
//Bot::setFileLog([$start_time, $end_time, $execution_time]);
return;