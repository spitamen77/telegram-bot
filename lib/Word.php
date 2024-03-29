<?php
namespace Word;

use function Sodium\increment;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__. "/config.php";


class Word
{
    private static $clone = null;
    private $db;
    public $lang;

    public static function getLang($db, $user_id)
    {
        if (self::$clone == null) self::$clone = new Word($db, $user_id);
        return self::$clone;
    }

    private function __construct($db, $user_id) {
        $this->db = $db;
        $this->lang = $this->db->getUser($user_id, 1);
    }

//    private static function lang($user_id)
//    {
//        $db2 = DataBase::getDB();
//        return $db2->getUser($user_id,1);
//    }

    public function til(string $key, string $lang = ''): string
    {
        if (!$lang) {
            $lang = $this->lang;
        }
        switch ($lang){
            case "uzk":
                return self::til_uzk($key);
                break;
            case "rus":
                return self::til_ru($key);
                break;
            case "uzl":
                return self::til_uzl($key);
                break;
//            default:
//                return self::lang($chat_id);
        }
        return '';
    }

    private static function til_uzl(string $key): string
    {
        $word = [
            "key01"=>"Assalomu alaykum!",
            "key02"=>"Ortga",
            "key03"=>"Testlar",
            "key04"=>"Natijalar",
            "key05"=>"Yo'l belgilari",
            "key06"=>"Ma'lumotlar",
            "key07"=>"Sozlamalar",
            "key08"=>"Test topshirish",
            "key09"=>"Biletni tanlash",
            "key10"=>"Belgilarni ko'rish",
            "key11"=>"Bilimingizni sinash uchun kerakli bo'limni tanlang",
            "key12"=>"Belgi raqamini kiriting. Misol: 1.20 yoki 3.27",
            "key13"=>"Ogohlanturuvchi belgilar",
            "key14"=>"Imtiyozli belgilar",
            "key15"=>"Ta'qiqlovchi belgilar",
            "key16"=>"Buyuruvchi belgilar",
            "key17"=>"Axborot-ishora belgilari",
            "key18"=>"Servis belgilari",
            "key19"=>"Statistika",
            "key20"=>"Qo'shimcha axborot belgilari",
            "key21"=>"Yotiq chiziqlar",
            "key22"=>"Tik chiziqlar",
            "key23"=>"❌ Belgi topilmadi. Kerakli belgini topish uchun belgi raqamini kiriting.\nMisol: 1.20 yoki 3.27",
            "key24"=>"✅ Ofarin topdingiz. Navbatdagi belgini toping",
            "key25"=>"❌ topolmadingiz. Boshqatdan urinib ko'ring",
            "key27"=>"Ushbu belgining raqamini kiriting\nMisol: 1.20 yoki 3.27",
            "key28"=>"🔁 Boshqa belgi",
            "key30"=>"Sozlamalar",
            "key31"=>"Avto Test (70) loyihasi asta-sekin rivojlantirib borilmoqda. Loyihani rivojlanishiga o'z hissangizni qo'shingizni so'raymiz.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Tilni o'zgartirish",
            "key33"=>"Ayni paytda xizmat test rejimida ishlamoqda, barcha funksiyalar mavjud emas.",
            "key34"=>"Tilni tanlang",
            "key35"=>"Vaqtingiz tugadi, 15 min ortiq bo'ldi",
            "key36"=>"Qoldi",
            "key37"=>"minut",
            "key38"=>"Bilet",
            "key39"=>"savol",
            "key40"=>"✅ Test topshirildi.",
            "key41"=>"Xatolari",
            "key42"=>"to'g'ri.",
            "key43"=>"Bilet raqamini kiriting. 1 dan 108 gacha",
            "key44"=>"Bilet nomeri hato kiritildi",
            "key45"=>"Jami qatnashilgan test",
            "key46"=>"Topshirganiz",
            "key47"=>"Kun savoli",
            "key48"=>"1 kun uchun",
            "key49"=>"Test yechganlar",
            "key50"=>"Qo'shilganlar",
            "key51"=>"30 kun uchun",
            "key52"=>"1 yil uchun",
            "key53"=>"Belgini aniqlash",
            "key54"=>"Test topshirilmadi. 2 ta xato qildiz",
            "key55"=>"Oʻzbekiston Respublikasining Ma'muriy javobgarlik toʻgʻrisidagi Kodeksi moddalari",
            "key56"=>"Jarimalar",
            "key57"=>"Eng kam ish haqining miqdorida jarima qiymati",
            "key58"=>"Transport vositasini boshqarish huquqidan mahrum qilish muddati",
            "key59"=>"Modda",

        ];
        return $word[$key] ?? '';
    }
  
    private static function til_ru(string $key): string
    {
        $word = [
            "key01"=>"Здравствуйте!",
            "key02"=>"Назад",
            "key03"=>"Тесты",
            "key04"=>"Результаты",
            "key05"=>"Дорожный знаки",
            "key06"=>"Информация",
            "key07"=>"Настройки",
            "key08"=>"Тест по ПДД",
            "key09"=>"Выбрать билет",
            "key10"=>"Смотрет знаки",
            "key11"=>"Выберите нужный раздел, чтобы проверить свои знания",
            "key12"=>"Введите номер знака. Пример: 1.20 или 3.27",
            "key13"=>"Предупреждающие знаки",
            "key14"=>"Знаки приоритета",
            "key15"=>"Запрещающие знаки",
            "key16"=>"Предписывающие знаки",
            "key17"=>"Информационно - указательные знаки",
            "key18"=>"Знаки сервиса",
            "key19"=>"Статистика",
            "key20"=>"Знаки дополнительной информации",
            "key21"=>"Горизонтальная разметка",
            "key22"=>"Вертикальная разметка",
            "key23"=>"❌ Значок не найден. Введите число, чтобы найти нужный знак.\nПример: 1.20 или 3.27",
            "key24"=>"✅ Отличная работа. Найдите следующий символ",
            "key25"=>"❌ Попробуйте другой",
            "key27"=>"Введите номер этого знака\nПример: 1.20 или 3.27",
            "key28"=>"🔁 Еще один знак",
            "key30"=>"Настройки",
            "key31"=>"Проект «Автотест (70)» постепенно развивается. Просим вас внести свой вклад в развитие проекта.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Изменить язык",
            "key33"=>"На данный момент сервис работает в тестовом режиме, не все функции доступны.",
            "key34"=>"Выберите язык",
            "key35"=>"Ваше время истекло, прошло более 15 минут.",
            "key36"=>"Осталось",
            "key37"=>"минут",
            "key38"=>"Билет",
            "key39"=>"вопрос",
            "key40"=>"✅ Тест пройден.",
            "key41"=>"Ошибки",
            "key42"=>"верно.",
            "key43"=>"Введите номер билета. От 1 до 108",
            "key44"=>"Номер билета введен неверно",
            "key45"=>"Общее количество посещенных тестов",
            "key46"=>"Успешное",
            "key47"=>"Вопрос дня",
            "key48"=>"На 1 день",
            "key49"=>"Сдали тесты",
            "key50"=>"Присоединился",
            "key51"=>"На 30 дней",
            "key52"=>"На 1 год",
            "key53"=>"Распознавание знака",
            "key54"=>"Тест не пройден. Вы сделали 2 ошибки",
            "key55"=>"Статьи Кодекса об административной ответственности Республики Узбекистан",
            "key56"=>"Штрафы",
            "key57"=>"Количество штрафа в размере МРЗП",
            "key58"=>"Срок лишения права управления транспортным средством",
            "key59"=>"Статьи",

        ];
        return $word[$key] ?? '';
    }

    private static function til_uzk(string $key): string
    {
        $word = [
            "key01"=>"Ассалому алайкум!",
            "key02"=>"Ортга",
            "key03"=>"Тестлар",
            "key04"=>"Натижалар",
            "key05"=>"Йўл белгилари",
            "key06"=>"Маълумотлар",
            "key07"=>"Созламалар",
            "key08"=>"Тест топшириш",
            "key09"=>"Билетни танлаш",
            "key10"=>"Белгиларни кўриш",
            "key11"=>"Билимингизни синаш учун керакли бўлимни танланг",
            "key12"=>"Белги рақамини киритинг. Мисол: 1.20 ёки 3.27",
            "key13"=>"Огоҳлантирувчи белгилар",
            "key14"=>"Имтиёзли белгилар",
            "key15"=>"Таъқиқловчи белгилар",
            "key16"=>"Буюрувчи белгилар",
            "key17"=>"Ахборот-ишора белгилари",
            "key18"=>"Сервис белгилари",
            "key19"=>"Статистика",
            "key20"=>"Қўшимча ахборот белгилари",
            "key21"=>"Ётиқ чизиқлар",
            "key22"=>"Тик чизиқлар",
            "key23"=>"❌ Белги топилмади. Керакли белгини топиш учун рақамини киритинг.\nМисол: 1.20 ёки 3.27",
            "key24"=>"✅ Офарин топдингиз. Навбатдаги белгини топинг",
            "key25"=>"❌ тополмадингиз. Бошқатдан уриниб кўринг",
            "key27"=>"Ушбу белгининг рақамини киритинг\nМисол: 1.20 ёки 3.27",
            "key28"=>"🔁 Бошқа белги",
            "key30"=>"Созламалар",
            "key31"=>"Avto Test (70) лойиҳаси аста-секин ривожлантириб борилмоқда. Лойиҳани ривожланишига ўз ҳиссангизни қўшингизни сўраймиз.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Тилни ўзгартириш",
            "key33"=>"Айни пайтда хизмат тест режимида ишламоқда, барча функциялар мавжуд емас.",
            "key34"=>"Тилни танланг",
            "key35"=>"Вақтингиз тугади, 15 мин ортиқ бўлди",
            "key36"=>"Қолди",
            "key37"=>"минут",
            "key38"=>"Билет",
            "key39"=>"савол",
            "key40"=>"✅ Тест топширилди.",
            "key41"=>"Хатолари",
            "key42"=>"тўғри.",
            "key43"=>"Билет рақамини киритинг. 1 дан 108 гача",
            "key44"=>"Билет номери ҳато киритилди",
            "key45"=>"Жами қатнашилган тест",
            "key46"=>"Топширганиз",
            "key47"=>"Кун саволи",
            "key48"=>"1 кун учун",
            "key49"=>"Тест йечганлар",
            "key50"=>"Қўшилганлар",
            "key51"=>"30 кун учун",
            "key52"=>"1 йил учун",
            "key53"=>"Белгини аниқлаш",
            "key54"=>"Тест топширилмади. 2 та хато қилдиз",
            "key55"=>"Ўзбекистон Республикасининг Маъмурий жавобгарлик тўғрисидаги Кодекси моддалари",
            "key56"=>"Жарималар",
            "key57"=>"Енг кам иш ҳақининг миқдорида жарима қиймати",
            "key58"=>"Транспорт воситасини бошқариш ҳуқуқидан маҳрум қилиш муддати",
            "key59"=>"Модда",

        ];
        return $word[$key] ?? '';
    }

}
