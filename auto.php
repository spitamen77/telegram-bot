<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__. "/lib/config.php";

use Bot\Bot;
use DataBase\DataBase;
use Word\Word;
//$start_time = microtime(true);
header('Content-Type: application/json');

$botan = new Bot();

$db = new DataBase();

/** sozlamalar **/
/** action inline-keyboard  */

$data = $botan::$call->callback_query->data ?? null;

if ($data !== null) {
//    Bot::setFileLog($botan::$call->callback_query);
    switch ($data) {
        case "info":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
//            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $botan::delMsg();
            $til = Word::getLang($db, $chat_id);
//            Bot::setFileLog($botan::$call->callback_query);

            $botan::setMessage($til->til("key12"));
            $botan::setMarkup(['text' => "🚦 " . $til->til("key13"), 'callback_data' => "znak_".Bot::OGOH."_1"], 1, 1);
            $botan::setMarkup(['text' => "🛑 " . $til->til("key14"), 'callback_data' => "znak_".Bot::IMTIYOZ."_89"], 2, 1);
            $botan::setMarkup(['text' => "⛔️ " . $til->til("key15"), 'callback_data' => "znak_".Bot::TAQIQ."_112"], 3, 1);
            $botan::setMarkup(['text' => "ℹ️ " . $til->til("key16"), 'callback_data' => "znak_".Bot::BUYUR."_16"], 4, 1);
            $botan::setMarkup(['text' => "🚸 " . $til->til("key17"), 'callback_data' => "znak_".Bot::AXBOROT."_46"], 5, 1);
            $botan::setMarkup(['text' => "🛠 " . $til->til("key18"), 'callback_data' => "znak_".Bot::SERVICE."_125"], 6, 1);
            $botan::setMarkup(['text' => "🎦 " . $til->til("key20"), 'callback_data' => "znak_".Bot::QOSHIMCHA."_201"], 7, 1);
            $botan::setMarkup(['text' => "📌 " . $til->til("key21"), 'callback_data' => "znak_".Bot::YOTIQ."_207"], 8, 1);
            $botan::setMarkup(['text' => "📍 " . $til->til("key22"), 'callback_data' => "znak_".Bot::TIK."_1"], 8, 2);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 9, 1);
            $botan::sText();
            break;

        case "stat":
            $botan::call($data);
            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $til = Word::getLang($db, $botan::$back->chat->id);
            function time_stats($type){
                $timeShifts = [
                    1 => 0,
                    7 => -(31*24*60*60),
                    30 => -(365*24*60*60),
                ];
                $day = date('j');
                $month = date('m');
                $year = date('Y');
                $d = DateTime::createFromFormat('j-n-Y-H-i-s', "$day-$month-$year-0-00-10", new DateTimeZone('+0500'));
                return $d->getTimestamp() + $timeShifts[$type];
            }

            $statsPeriods = [1, 7, 30];
            $text2 = "\n\n";

            foreach ($statsPeriods as $period) {
                $start = $db->getStart(time_stats($period), time());
                $created = $db->getCreated(time_stats($period), time());
                $periodKey = $period === 1 ? 'key48' : ($period === 7 ? 'key51' : 'key52');

                $text2 .= $til->til($periodKey)."\n".
                    $til->til('key49').": ".$start."\n".
                    $til->til('key50').": ".$created."\n\n";
            }

            $botan::setMessage("📊 ".$til->til('key19').$text2);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::eText();

            break;
        case "continue":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
//            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $botan::delMsg();
            $til = Word::getLang($db, $chat_id);
            $botan::setMessage($til->til("key11"));
            $botan::setMarkup(['text' => "📚 " . $til->til("key08"), 'callback_data' => "test"], 1, 1);
            $botan::setMarkup(['text' => "📄 " . $til->til("key09"), 'callback_data' => "bilet"], 2, 1);
            $botan::setMarkup(['text' => "🚦 " . $til->til("key10"), 'callback_data' => "find"], 3, 1);
            $botan::setMarkup(['text' => "🔎 " . $til->til("key53"), 'callback_data' => "belgi"], 4, 1);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 5, 1);
            $db->change_step($chat_id, 5); // bilet tanlashi uchun
            $botan::sText();
            break;
        case "test":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
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
            sleep(0.2);

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
            sleep(0.2);
            $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");
            break;
        case "bilet":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
            $til = Word::getLang($db, $chat_id);
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::setReply();
//            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
            $botan::setMessage($til->til('key43'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "continue"], 1, 1);
            $ttt2 = $botan::eText();
            break;
        case "find":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
            $botan::setReply();
            $til = Word::getLang($db, $chat_id);
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $db->change_step($chat_id, 7);
//            $botan::delMsg();
            $botan::setMessage($til->til('key12'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "continue"], 1, 1);
            $ttt2 = $botan::eText();
            break;
        case "results":
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
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
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
            $til = Word::getLang($db, $chat_id);
            $db->change_step($chat_id, 3);
            $random = $db->random();
            $db->belgiSavol($chat_id, $random->id,$random->number);
            $db->update("start=".time(), "user_id='" . $chat_id."'", "users");
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
//            $ttt = $botan::sPhoto("belgi/".$random->image);
            $botan::setMessage($til->til('key27'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "continue"], 1, 1);
            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
//            $ttt2 = $botan::sText();
            if ($random->image) {
                $res = $botan::sendPhotoWithText("belgi/".$random->image);
            } else {
                $res = $botan::sText();
            }
            sleep(0.2);
            $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");
            break;

        case "forBack": // main oyna
            $botan::call($data);
            $chat_id = (int) $botan::$back->chat->id;
            $botan::setReply();
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main($db);
            $botan::eText();
            $db->change_step($chat_id, 7);
            break;
        // ** main menu **//

        case "setting":
            $botan::call($data);
            $til = Word::getLang($db, $botan::$back->chat->id);
            $botan::setReply();
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

        case "uzk": //2-step
        case "rus":
        case "uzl":
            $botan::call($data);
            $lang = substr($botan::$call->callback_query->data, 0, 3);
            $db->edit_lang($botan::$back->chat->id, $lang);
            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main($db);
            $botan::eText();
            break;
        default:
            $route = $data;
            $botan::call($route);

            $chat_id = (int) $botan::$back->chat->id;
            $pieces = explode("_", $route);
            $user = $db->getUser($chat_id, 0);
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
//            $botan::setChatId($chat_id);
//            $botan::setMessageId($user->first);
//            $botan::delMsg();
            $til = Word::getLang($db, $chat_id);
            if ($user) {
                if ($user->cron == 1) {
                    // cron orqali borgan bo'lsa
                    $db->update("cron=0", "user_id='" . $chat_id."'", "users");
                }
            } else {
                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                $botan::send_Out($botan::$chat->id, "/start");
            }

            if (preg_match("~^znak~", $route)) {

                $id = (int) $pieces[2];
                $belgi = $db->selectOne("id=".$id." AND child=".$pieces[1],"belgilar");

                if ($belgi) {
                    $next = $db->selectOne('child = '.$pieces[1].' AND id <> '.$belgi->id.' ORDER BY RAND()',"belgilar");
//                    $prive = $db->selectOne('child = '.$pieces[1].' AND id <> '.$next->id.'AND id <> '.$belgi->id.' ORDER BY RAND()',"belgilar");
                    $prive = $db->selectOne('child = \''.$pieces[1].'\' AND id <> \''.$next->id.'\' AND id <> \''.$belgi->id.'\' ORDER BY RAND()', "belgilar");

                    if (!$prive){
                        $prive_id = $next->id;
                    } else {
                        $prive_id = $prive->id;
                    }

                    $nomi = "name_".$user->lang;
                    $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                    $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive_id], 1, 1);
                    $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next->id], 1, 2);
                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);

                    if ($belgi->image) {
                        $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                    } else {
                        $res = $botan::sText();
                    }
                    sleep(0.2);
                    $db->update("second='".$res['result']['message_id']."', first=0", "user_id=" . $user->user_id, "users");
                }
                else{
                    $belgi = $db->selectOne('child = '.$pieces[1].' ORDER BY RAND()',"belgilar");
                    if ($belgi) {
                        $p_belgi = $db->selectOne('child = '.$pieces[1].' AND id <> '.$belgi->id.' ORDER BY RAND()',"belgilar");
                        $n_belgi = $db->selectOne('child = '.$pieces[1].' AND id <> '.$p_belgi->id.' AND id <> '.$belgi->id.' ORDER BY RAND()',"belgilar");
                        if (!$n_belgi) {
                            $next_id = $p_belgi->id;
                        } else {
                            $next_id = $n_belgi->id;
                        }

                        switch ($pieces[1]){
                            case Bot::OGOH:
                            case Bot::IMTIYOZ:
                            case Bot::TAQIQ:
                            case Bot::BUYUR:
                            case Bot::AXBOROT:
                            case Bot::SERVICE:
                            case Bot::QOSHIMCHA:
                            case Bot::YOTIQ:
    //                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                                $nomi = "name_".$user->lang;
                                $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                                $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$p_belgi->id], 1, 1);
                                $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next_id], 1, 2);
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);

                                if ($belgi->image) {
                                    $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                                } else {
                                    $res = $botan::sText();
                                }
                                sleep(0.2);
                                $db->update("second='".$res['result']['message_id']."', first=0", "user_id=" . $user->user_id, "users");
                                break;

                            case Bot::TIK:

                                $botan::setMessage($til->til("key33"));
                                $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::sText();
                                break;
                        }
                    } else {
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                        $botan::send_Out($chat_id, $til->til("key31")); //." `𝗨zа𝗨𝗍о𝗍𝖾ѕʈ_ხоt`"
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

                $last_q = $db->getMax("bilet_id=".$bilet." AND raqam=".$raqam.' AND user_id='.$chat_id,"tests");
                $current = $db->selectOne("id=".$last_q->max, "tests");

                if ($current){
                    $difference = time() - $current->created;
                } else {
                    Bot::setFileLog($route);
                    $difference = 10;
                    $raqam = $raqam - 1;
                    $current = $db->selectOne("bilet_id=".$bilet." AND raqam=".$raqam.' AND user_id='.$chat_id,"tests");
                }
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
//                    $sum = $db->getCount("`created`=".$current->created." AND result = ".Bot::ANSWER_FALSE, 'result', 'tests');
//
//                    if ($sum->total >= 2) {
//                        // ikkichi...
//                        $wrong = $db->select("`bilet_id` = ".$bilet." AND `result` = ".Bot::ANSWER_FALSE." AND `created` = ".$current->created, 'tests');
//                        $wrong_id = '';
//                        foreach ($wrong as $id) {
//                            $wrong_id .= "❌ ".$til->til('key38').": ".$bilet.", ".$til->til('key39').": ".$id->raqam."\n";
//                        }
//                        $botan::setMessage($til->til('key54')."\n".$wrong_id);
//                        $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
//                        $ttt2 = $botan::sText();
//                        return true;
//                    }
                }
                $answers = ['A', 'B', 'C', 'D'];
                $marks = [];

                foreach ($answers as $answer) {
                    if ($variant == $answer) {
                        $marks[$answer] = $variant == $true_answer ? '✅' : '❌';
                    } else {
                        $marks[$answer] = $true_answer == $answer ? '📌' : '';
                    }
                }

                if ($raqam != 10) {
                    // oldingi savoli
                    $random = $db->selectOne("bilet=".$bilet." AND raqam=".$raqam, "savol_data");
                    $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": $raqam\n";
                    $savol = 'savol_'.$til->lang;
                    $javob_a = 'javob_a_'.$til->lang;
                    $javob_b = 'javob_b_'.$til->lang;
                    $javob_c = 'javob_c_'.$til->lang;
                    $javob_d = 'javob_d_'.$til->lang;

                    if (@strlen($random->$javob_d)) {
                        $botan::setMessage($text.$random->$savol."\n".$marks['A']." A - ".$random->$javob_a."\n".$marks['B']." B - ".$random->$javob_b."\n".$marks['C']." C - ".
                            $random->$javob_c."\n".$marks['D']." D - ".$random->$javob_d."\n🚏");
                    } else {
                        $botan::setMessage($text.$random->$savol."\n".$marks['A']." A - ".$random->$javob_a."\n".$marks['B']." B - ".$random->$javob_b."\n".$marks['C']." C - ".
                            $random->$javob_c."\n🚏");
                    }
                    if ($random->rasm) {
                        $ttt2 = $botan::sendPhotoWithText("savol/".$random->rasm, false);
                    } else {
                        $ttt2 = $botan::sText(false);
                    }

                    //keyingi savoli
                    $raqam++;
                    $random = $db->selectOne("bilet=".$bilet." AND raqam=".$raqam, "savol_data");

                    sleep(0.2);
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
                    // oldingi savoli
                    $random = $db->selectOne("bilet=".$bilet." AND raqam=".$raqam, "savol_data");
                    $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": $raqam\n";
                    $savol = 'savol_'.$til->lang;
                    $javob_a = 'javob_a_'.$til->lang;
                    $javob_b = 'javob_b_'.$til->lang;
                    $javob_c = 'javob_c_'.$til->lang;
                    $javob_d = 'javob_d_'.$til->lang;

                    if (@strlen($random->$javob_d)) {
                        $botan::setMessage($text.$random->$savol."\n".$marks['A']." A - ".$random->$javob_a."\n".$marks['B']." B - ".$random->$javob_b."\n".$marks['C']." C - ".
                            $random->$javob_c."\n".$marks['D']." D - ".$random->$javob_d."\n🚏");
                    } else {
                        $botan::setMessage($text.$random->$savol."\n".$marks['A']." A - ".$random->$javob_a."\n".$marks['B']." B - ".$random->$javob_b."\n".$marks['C']." C - ".
                            $random->$javob_c."\n🚏");
                    }
                    if ($random->rasm) {
                        $ttt2 = $botan::sendPhotoWithText("savol/".$random->rasm, false);
                    } else {
                        $ttt2 = $botan::sText(false);
                    }

                    // bu ohirgi 10-test edi.
                    $answers = $db->select("`bilet_id` = ".$bilet." AND `created` = ".$current->created, 'tests');    // AND `result` = ".Bot::ANSWER_FALSE."
                    $text = "\n";
                    $i = 0;
                    foreach ($answers as $id) {
                        if ($id->result == Bot::ANSWER_TRUE) {
                            $text .= "✅ ".$til->til('key38').": ".$bilet.", ".$til->til('key39').": ".$id->raqam."\n";
                        } else {
                            $text .= "❌ ".$til->til('key38').": ".$bilet.", ".$til->til('key39').": ".$id->raqam."\n";
                            $i++;
                        }
                    }
                    $i = 10 - $i;

                    $botan::setMessage($til->til('key40')." $i - ".$til->til('key42')." \n".$text);
                    $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "continue"], 1, 1);
                    $ttt2 = $botan::sText();
                    return true;

                }
                sleep(0.2);
                if (isset($ttt2['result']['message_id'])) {
                    $db->update("second=" . $ttt2['result']['message_id'] . ", first=0", "user_id='" . $chat_id."'", "users");
                }
            }
            elseif (preg_match("~^jarima~", $route)) {
                // route - jarima_128-2
                $modda = $pieces[1];

                $current = $db->select("`modda`=".$modda, "jarima");

                if ($current){
                    $text = "\n";
                    $qoida = 'qoida_'.$til->lang;
                    foreach ($current as $jarima) {
                        $text .= "\n❗️ ".$jarima->$qoida;
                        $text .= "\n".'💸 Eng kam ish haqining miqdorida jarima qiymati: '.$jarima->jarima."\n";
                        if ($jarima->muddat) {
                            $text .= "\n 🛑Transport vositasini boshqarish huquqidan mahrum qilish muddati: ".$jarima->muddat."\n";
                        }

                    }

                    $botan::setMessage($modda ." - Modda "."\n".$text);
                    $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                    $ttt2 = $botan::sText();
                    return true;
                } else {
                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                    $botan::send_Out($chat_id, $til->til("key31"));
                }
            }
    }
}
elseif (isset($botan::$text)) {
    $chat_id = (int) $botan::$chat->id;
    $til = Word::getLang($db, $chat_id);
    switch ($botan::$text) {
        case "/":
        case "/start":
            $user = $db->getUser($chat_id);
            if (isset($user) && ($user->user_id == $chat_id)) {
                $step = $db->getStep($chat_id);
                switch ($step){
                    case 2: //lang
                        $botan::setChatId($chat_id);
                        $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                        $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzl"], 1, 1);
                        $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "rus"], 2, 1);
                        $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzk"], 3, 1);
                        $botan::sText();
                        break;
                    default:
                        {
                            $botan::setChatId($chat_id);
                            $botan::Main($db);
                            $botan::sText();
                        }

                }
            }else{
                $botan::setChatId($chat_id);
                $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzl"], 1, 1);
                $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "rus"], 2, 1);
                $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzk"], 3, 1);
                $botan::sText();
            }
//            $db->update("start=".time(), "user_id=" . $botan::$chat->id, "users");
            break;
        case "/info":
        case "/info Лойиха хакида":
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::send_Out($chat_id, $til->til("key31"));
            break;
        case "/control":
            $active = $db->selectCustom('COUNT(id) as c','second <> 0 AND updated_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)', 'users', 1);
            $kicked = $db->selectCustom('COUNT(id) as c','kicked = 1', 'users', 1);
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::send_Out($chat_id, "Aktivlar: ".$active->c."\n"."Kicked: ".$kicked->c);
            break;
        case '/jarima':
            $botan::setChatId($chat_id);
//            $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
            $jarimalar = $db->selectCustom('*','id IN ( SELECT MIN(id) FROM `jarima` GROUP BY modda) ORDER BY modda ASC', 'jarima');
            $i = 0; $row = 1;
            foreach ($jarimalar as $jarima) {
                $i++;
                if ($i % 5 == 0) {
                    $i = 0;
                    $row++;

                }
                $botan::setMarkup(['text' => $jarima->modda, 'callback_data' => "jarima_".$jarima->modda], $row, $i);
            }
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], $row + 1, 1);
            $botan::send_Out($chat_id, $til->til("key55"));

            break;

        default:
            $step = $db->getStep($chat_id);
            $position = stripos($botan::$text, '_kicked_');

            if ($position !== false) {
                // bizni blokladi(
                $db->update("kicked = 1", "user_id = ".$chat_id, 'users');
                echo "Botni ishlatganiz uchun rahmat.";
            } elseif (stripos($botan::$text, '_member_') !== false) {
                $db->change_step($chat_id, 7);
                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                $botan::send_Out($chat_id, "WELCOME");
            }
            else {
                switch ($step) {
                    case 2: //phone
                        $botan::setChatId($chat_id);
                        $botan::setMessage($til->til('key34', 'uzl')."\n" . $til->til('key34', 'rus')."\n" . $til->til('key34', 'uzk'));
                        $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzl"], 1, 1);
                        $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "rus"], 2, 1);
                        $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzk"], 3, 1);
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

                            $botan::setMessage($til->til('key24'));
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                            if ($belgi->image) {
                                $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                            } else {
                                $res = $botan::sText();
                            }
                            sleep(0.2);
                            $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");

                        }else{
                            $pieces = explode(",", $botText);
                            if (count($pieces) >= 2) {
                                $nomer = $pieces[0] . "." . $pieces[1];
                                $belgi = $db->selectOne("number='".$nomer."' AND user_id=".$chat_id, "belgi_savol");
                                if ($belgi){
                                    $random = $db->random();
                                    $db->belgiSavol($chat_id, $random->id,$random->number);
                                    $botan::setMessage($til->til('key24'));
                                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                    $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                                    if ($belgi->image) {
                                        $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                                    } else {
                                        $res = $botan::sText();
                                    }
                                    sleep(0.2);
                                    $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");
                                }else{
                                    $belgi = $db->selectJoin($chat_id);
                                    $botan::setMessage($til->til('key25'));
                                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                    $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                                    if ($belgi) {
                                        $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                                    } else {
                                        $res = $botan::sText();
                                    }
                                    sleep(0.2);
                                    $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");
                                }
                            } else {
                                $belgi = $db->selectJoin($chat_id);
                                $botan::setMessage($til->til('key25'));
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                                if ($belgi) {
                                    $res = $botan::sendPhotoWithText("belgi/".$belgi->image);
                                } else {
                                    $res = $botan::sText();
                                }
                                sleep(0.2);
                                $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");

                            }

                        }

                        break;

                    case 5:
                        if ($botan::$username == 'avtomaktabchorsu') {
                            break;
                        }
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
                        sleep(0.2);

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
                        sleep(0.2);
                        $db->update("second='".$res['result']['message_id']."', first=0", "user_id=" . $user->user_id, "users");

                        break;

                    case 7: //belgini topib beraman
                        $til = Word::getLang($db, $chat_id);
                        $botText = addslashes(trim($botan::$text));
//                    $botText = preg_replace('/\s|\+|-|@|#|&|%|$|=|_|:|;|!|\'|"|\(|\)/', '', $botan::$text);
                        $belgi = $db->selectOne("`number`='".$botText."'", "belgilar");
                        $getUser = $db->getUser($chat_id, 1);
                        if ($belgi){
                            $nomi = "name_".$getUser;
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
                            sleep(0.2);
                            $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");

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
                                    sleep(0.2);
                                    $db->update("second='".$res['result']['message_id']."', first=0", "user_id='" . $chat_id."'", "users");
                                }else{
                                    if ($botan::$username == 'avtomaktabchorsu') {
                                        break;
                                    }
                                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                    $botan::send_Out($chat_id, $til->til("key23"));
                                }
                            } else {
                                if ($botan::$username == 'avtomaktabchorsu') {
                                    break;
                                }
                                $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                                $botan::send_Out($chat_id, $til->til("key23"));
                            }

                        }
                        break;
                    default:
                    {
                        if ($botan::$username == 'avtomaktabchorsu') {
                            break;
                        }
                        $til = Word::getLang($db, $chat_id);
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                        $botan::send_Out($chat_id, $til->til("key23"));
                    }
                }
            }

    }
}
else {
    $botan::setMessage("Bu yerga qandek keldiz?");
    $botan::setMarkup(['text' => "⬅️ Avto Test (70)", 'callback_data' => "continue"], 1, 1);
    $botan::sText();
}
//$end_time = microtime(true);
//$execution_time = ($end_time - $start_time) * 1000;
//Bot::setFileLog([$start_time, $end_time, $execution_time]);

function generateQuestionText($random, $til, $timer = ''): string
{
    $text = $til->til('key38').": ".$random->bilet.", ".$til->til('key39').": ".$random->raqam."\n";
    $langFields = ['savol', 'javob_a', 'javob_b', 'javob_c', 'javob_d'];
    foreach ($langFields as $field) {
        $fieldName = $field . '_' . $til->lang;
        if (isset($random->$fieldName) && !empty($random->$fieldName)) {
            $text .= "\n" . ($field == 'savol' ? '' : strtoupper($field[-1]) . ' - ') . $random->$fieldName;
        }
    }
    return $text . $timer;
}
function setAnswerButtons($random, $raqam, $bilet) {
    global $botan; // Используем глобальный объект, если не передаем его через параметры
    $answers = ['A', 'B', 'C', 'D'];
    foreach ($answers as $answer) {
        if (isset($random->{'javob_' . strtolower($answer)}) && !empty($random->{'javob_' . strtolower($answer)})) {
            $callbackData = "savol_" . $answer . "_" . $bilet . "_" . $raqam . "_" . $random->javob;
            $botan::setMarkup(['text' => $answer, 'callback_data' => $callbackData], 1, ord($answer) - 65);
        }
    }
}
http_response_code(200);
return;