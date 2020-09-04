<?php
header('Content-type: text/html; charset=utf-8');
require_once "./vendor/autoload.php";

$botan = Bot::getBot();

$db = DataBase::getDB();
/** sozlamalar **/
/** action inline-keyboard  */
if ($botan::$call->callback_query->data != NULL) {
    switch ($botan::$call->callback_query->data) {
        case "info":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $til = Word::getLang($chat_id);
            $botan::setMessage($til->til("key12"));
            $botan::setMarkup(['text' => "🚦 " . $til->til("key13"), 'callback_data' => "znak_".$botan::OGOH."_16"], 1, 1);
            $botan::setMarkup(['text' => "🛑 " . $til->til("key14"), 'callback_data' => "znak_".$botan::IMTIYOZ."_61"], 2, 1);
            $botan::setMarkup(['text' => "⛔️ " . $til->til("key15"), 'callback_data' => "znak_".$botan::TAQIQ."_70"], 3, 1);
            $botan::setMarkup(['text' => "ℹ️ " . $til->til("key16"), 'callback_data' => "znak_".$botan::BUYUR."_107"], 4, 1);
            $botan::setMarkup(['text' => "🚸 " . $til->til("key17"), 'callback_data' => "znak_".$botan::AXBOROT."_131"], 5, 1);
            $botan::setMarkup(['text' => "🛠 " . $til->til("key18"), 'callback_data' => "znak_".$botan::SERVICE."_1"], 6, 1);
            $botan::setMarkup(['text' => "🎦 " . $til->til("key20"), 'callback_data' => "znak_".$botan::QOSHIMCHA."_1"], 7, 1);
            $botan::setMarkup(['text' => "📌 " . $til->til("key21"), 'callback_data' => "znak_".$botan::YOTIQ."_1"], 8, 1);
            $botan::setMarkup(['text' => "📍 " . $til->til("key22"), 'callback_data' => "znak_".$botan::TIK."_1"], 8, 2);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 9, 1);
            $botan::eText();
            break;

        case "stat":
            $botan::call($botan::$call->callback_query->data);
            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
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
                "7 kun uchun \n".
                "Test yechganlar: ".$week_start."\n".
                "Qo'shilganlar: ".$week_created."\n\n".
                "30 kun uchun \n".
                "Test yechganlar: ".$month_start."\n".
                "Qo'shilganlar: ".$month_created;

            $botan::setMessage("📊 Statistika bo'limi".$text2);
            $botan::setMarkup(['text' => "⬅️ Bosh menyu", 'callback_data' => "forBack"], 1, 1);
            $botan::eText();
            break;
        case "continue":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $botan::setReply();
            $botan::setMessageId($botan::$back->message_id);
            $botan::setChatId($chat_id);
            $til = Word::getLang($chat_id);
            $botan::setMessage($til->til("key11"));
            $botan::setMarkup(['text' => "📚 " . $til->til("key08"), 'callback_data' => "test"], 1, 1);
            $botan::setMarkup(['text' => "📄 " . $til->til("key09"), 'callback_data' => "bilet"], 2, 1);
            $botan::setMarkup(['text' => "🚦 " . $til->til("key10"), 'callback_data' => "belgi"], 3, 1);
            $botan::setMarkup(['text' => "⬅️ ".$til->til("key02"), 'callback_data' => "forBack"], 4, 1);
            $botan::eText();
            break;
        case "belgi":
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $til = Word::getLang($chat_id);
            $db->change_step($chat_id, 3);
            $random = $db->random();
            $db->belgiSavol($chat_id, $random->id,$random->number);
            $user = $db->getUser($chat_id, 0);
            $db->update("start=".time(), "user_id=" . $chat_id, "users");
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::delMsg();
            $botan::setChatId($chat_id);
            $botan::setMessageId($user->first);
            $botan::delMsg();
            $ttt = $botan::sPhoto("belgi/".$random->image);
            $botan::setMessage($til->til('key27'));
            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
            $ttt2 = $botan::sText();
            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
            break;

        case "forBack": // main oyna
            $botan::call($botan::$call->callback_query->data);
            $chat_id = $botan::$back->chat->id;
            $botan::setReply();
            $botan::setChatId($chat_id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main();
//            $botan::setFirstButton("🚕 \"Royal\" Taxi",false);
            $botan::eText();
            $db->change_step($chat_id, 7);
            break;
        // ** main menu **//

        case "setting":
            $botan::call($botan::$call->callback_query->data);
            $til = Word::getLang($botan::$back->chat->id);
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
            $botan::Main();
            $botan::sText();
            break;
        case "uzk": //2-step
        case "rus":
        case "uzl":
            $botan::call($botan::$call->callback_query->data);
            $lang = substr($botan::$call->callback_query->data, 0, 3);
            $db->edit_lang($botan::$back->chat->id, $lang);
            $botan::setReply();
            $botan::setChatId($botan::$back->chat->id);
            $botan::setMessageId($botan::$back->message_id);
            $botan::Main();
            $botan::eText();
            break;
        default:
            $route = $botan::$call->callback_query->data;
            $botan::call($route);
            if (preg_match("~^znak~", $route)) {
                $chat_id = $botan::$back->chat->id;
                $pieces = explode("_", $route);
                $user = $db->getUser($chat_id, 0);
                $botan::setChatId($chat_id);
                $botan::setMessageId($botan::$back->message_id);
                $botan::delMsg();
                $botan::setChatId($chat_id);
                $botan::setMessageId($user->first);
                $botan::delMsg();
                $id = (int) $pieces[2]; $next = $id+1;  $prive = $id-1;
                $belgi = $db->selectOne("id=".$id." AND child=".$pieces[1],"belgilar");
                $til = Word::getLang($chat_id);
                if ($belgi){
                    $ttt = $botan::sPhoto("belgi/".$belgi->image);
                    $nomi = "name_".$user->lang;
                    $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                    $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                    $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                    $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                    $ttt2 = $botan::sText();
                    $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                }else{
                    switch ($pieces[1]){
                        case "1":
                            $belgi = $db->selectOne("id=16 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "2":
                            $belgi = $db->selectOne("id=61 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "3":
                            $belgi = $db->selectOne("id=70 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "4":
                            $belgi = $db->selectOne("id=107 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "5":
                            $belgi = $db->selectOne("id=131 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "6":
                            $belgi = $db->selectOne("id=1 AND child=".$pieces[1],"belgilar");
                            $ttt = $botan::sPhoto("belgi/".$belgi->image);
                            $nomi = "name_".$user->lang;
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$pieces[1]."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$pieces[1]."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "info"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                            break;
                        case "7":

                            break;
                        case "8":

                            break;
                        case "9":

                            break;
                    }
                }

            }
    }
//    endif;
}
/** action inline-keyboard  */

/** action text-message */
elseif (isset($botan::$text)) {
    switch ($botan::$text) {
        case "/":
        case "/start":
            $user = $db->getUser($botan::$chat->id);
            if ($user->user_id == $botan::$chat->id) {
                $step = $db->getStep($botan::$chat->id);
                switch ($step){
                    case 2: //lang
                        $botan::setChatId($botan::$chat->id);
                        $botan::setMessage("Tilni tanlang\n" .
                            "Выберите язык\n" .
                            "Тилни танланг");
                        $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                        $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                        $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                        $botan::sText();
                        break;
                    default:
                        {
                            $botan::setChatId($botan::$chat->id);
                            $botan::Main();
                            $botan::sText();
                        }

                }
            }else{
                $botan::setChatId($botan::$chat->id);
                $botan::setMessage("Tilni tanlang\n" .
                    "Выберите язык\n" .
                    "Тилни танланг");
                $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                $botan::sText();
            }
//            $db->update("start=".time(), "user_id=" . $botan::$chat->id, "users");
            break;
        case "/info":
            $til = Word::getLang($botan::$chat->id);
            $botan::send_Out($botan::$chat->id, $til->til("key31"));
            break;
        case "/info Лойиха хакида":
            $til = Word::getLang($botan::$chat->id);
            $botan::send_Out($botan::$chat->id, $til->til("key31"));
            break;
        default:
            $chat_id = $botan::$chat->id;
            $step = $db->getStep($chat_id);
            switch ($step) {
                case 2: //phone
                    $botan::setChatId($botan::$chat->id);
                    $botan::setMessage("Tilni tanlang\n" .
                        "Выберите язык\n" .
                        "Тилни танланг");
                    $botan::setMarkup(['text' => "🇺🇿 O'zbekcha", 'callback_data' => "uzlatin"], 1, 1);
                    $botan::setMarkup(['text' => "🇷🇺 Русский", 'callback_data' => "russian"], 2, 1);
                    $botan::setMarkup(['text' => "🇺🇿 Ўзбекча", 'callback_data' => "uzkril"], 3, 1);
                    $botan::sText();
                    break;
                case 3: //code
                    $til = Word::getLang($chat_id);
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
                        $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");

                    }else{
                        $pieces = explode(",", $botText);
                        $botan::setFileLog($pieces);
                        $nomer = $pieces[0].".".$pieces[1];
                        $belgi = $db->selectOne("number='".$nomer."' AND user_id=".$chat_id, "belgi_savol");
                        if ($belgi){
                            $random = $db->random();
                            $db->belgiSavol($chat_id, $random->id,$random->number);
                            $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$random->image);
                            $botan::setMessage($til->til('key24'));
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                        }else{
                            $belgi = $db->selectJoin($chat_id);
                            $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                            $botan::setMessage($til->til('key25'));
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 1, 1);
                            $botan::setMarkup(['text' => $til->til('key28'), 'callback_data' => "belgi"], 1, 2);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
//                            $botan::send_Out($chat_id, $til->til("key25"));
                        }
                    }

                    break;

                case 7: //belgini topib beraman
                    $til = Word::getLang($chat_id);
                    $botText = trim($botan::$text);
//                    $botText = preg_replace('/\s|\+|-|@|#|&|%|$|=|_|:|;|!|\'|"|\(|\)/', '', $botan::$text);
                    $belgi = $db->selectOne("number='".$botText."'", "belgilar");
                    $getUser = $db->getUser($chat_id, 1);
                    if ($belgi){
                        $nomi = "name_".$getUser;
                        $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                        $next = $belgi->id+1;  $prive = $belgi->id-1;
                        $botan::setChatId($chat_id);
                        $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                        $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$belgi->child."_".$prive], 1, 1);
                        $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$belgi->child."_".$next], 1, 2);
                        $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 2, 1);
                        $ttt2 = $botan::sText();
                        $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");

                    }else{
                        $pieces = explode(",", $botText);
                        $botan::setFileLog($pieces);
                        $nomer = $pieces[0].".".$pieces[1];
                        $belgi = $db->selectOne("number='".$nomer."'", "belgilar");
                        if ($belgi){
                            $nomi = "name_".$getUser;
                            $ttt = $botan::requestToTelegram([],$chat_id,"belgi/".$belgi->image);
                            $next = $belgi->id+1;  $prive = $belgi->id-1;
                            $botan::setChatId($chat_id);
                            $botan::setMessage($belgi->number." - ".$belgi->$nomi);
                            $botan::setMarkup(['text' => "⏪", 'callback_data' => "znak_".$belgi->child."_".$prive], 1, 1);
                            $botan::setMarkup(['text' => "⏩", 'callback_data' => "znak_".$belgi->child."_".$next], 1, 2);
                            $botan::setMarkup(['text' => "⬅️ " . $til->til("key02"), 'callback_data' => "forBack"], 2, 1);
                            $ttt2 = $botan::sText();
                            $db->update("second='".$ttt2->result->message_id."', first='".$ttt->result->message_id."'", "user_id=" . $chat_id, "users");
                        }else{
                            $botan::send_Out($chat_id, $til->til("key23"));
                        }
                    }
                    break;
                default:
                    {
                        $til = Word::getLang($chat_id);
                        $botan::send_Out($chat_id, $til->til("key23"));
                    }
            }
    }
}
exit('ok');
?>