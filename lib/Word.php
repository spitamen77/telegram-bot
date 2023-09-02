<?php
namespace Word;

require_once "./vendor/autoload.php";
require_once "./lib/config.php";


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

    public function til($key, $lang = '')
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
    }

    private static function til_uzl($key)
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
            "key10"=>"Belgini topish",
            "key11"=>"*Test topshirish uchun kerakli bo'limni tanlang*",
            "key12"=>"Yo'l belgilari va Yo'l chiziqlari\nBelgi raqamini kiritish. Misol: 1.20 yoki 3.27",
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
            "key24"=>"Ofarin topdingiz. Navbatdagi belgini toping",
            "key25"=>"❌ topolmadingiz. Boshqatdan urinib ko'ring",
            "key27"=>"Ushbu belgining raqamini kiriting\nMisol: 1.20 yoki 3.27",
            "key28"=>"🔁 Boshqa belgi",
            "key30"=>"*Sozlamalar*",
            "key31"=>"Avto Test (70) loyihasi asta-sekin rivojlantirib borilmoqda. Loyihani rivojlanishiga o'z hissangizni qo'shingizni so'raymiz.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Tilni o'gartirish",
            "key33"=>"Ayni paytda xizmat test rejimida ishlamoqda, barcha funksiyalar mavjud emas.",
            "key34"=>"Tilni tanlang",

        ];
        return $word[$key];
    }
  
    private static function til_ru($key)
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
            "key10"=>"Найти знака",
            "key11"=>"*Выберите раздел, который вам нужен для прохождения теста*",
            "key12"=>"Дорожные знаки и дорожные линии\nВведите номер знака. Пример: 1.20 или 3.27",
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
            "key24"=>"Отличная работа. Найдите следующий символ",
            "key25"=>"❌ Попробуйте другой",
            "key27"=>"Введите номер этого символа\nПример: 1.20 или 3.27",
            "key28"=>"🔁 Еще один знак",
            "key30"=>"*Настройки*",
            "key31"=>"Проект «Автотест (70)» постепенно развивается. Просим вас внести свой вклад в развитие проекта.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Изменить язык",
            "key33"=>"На данный момент сервис работает в тестовом режиме, не все функции доступны.",
            "key34"=>"Выберите язык",


        ];
        return $word[$key];
    }

    private static function til_uzk($key)
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
            "key10"=>"Белгини топиш",
            "key11"=>"*Тест топшириш учун керакли бўлимни танланг*",
            "key12"=>"Йўл белгилари ва Йўл чизиқлари\nБелги рақамини киритиш. Мисол: 1.20 ёки 3.27",
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
            "key24"=>"Офарин топдингиз. Навбатдаги белгини топинг",
            "key25"=>"❌ тополмадингиз. Бошқатдан уриниб кўринг",
            "key27"=>"Ушбу белгининг рақамини киритинг\nМисол: 1.20 ёки 3.27",
            "key28"=>"🔁 Бошқа белги",
            "key30"=>"*Созламалар*",
            "key31"=>"Avto Test (70) лойиҳаси аста-секин ривожлантириб борилмоқда. Лойиҳани ривожланишига ўз ҳиссангизни қўшингизни сўраймиз.\n9860 6004 0191 7320\nAbdujalilov Dilshod",
            "key32"=>"Тилни ўзгартириш",
            "key33"=>"Айни пайтда хизмат тест режимида ишламоқда, барча функциялар мавжуд емас.",
            "key34"=>"Тилни танланг",



        ];
        return $word[$key];
    }

    public function __destruct() {

    }

}
