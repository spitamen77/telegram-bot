<?php
namespace Word;

require_once "./vendor/autoload.php";

class Word
{
    private static $db = null;
    private $lang;

    public static function getLang($user_id)
    {
        if (self::$db == null) self::$db = new Word($user_id);
        return self::$db;
    }

    private function __construct($user_id) {
        $db2 = DataBase::getDB();
        $this->lang = $db2->getUser($user_id,1);
    }

//    private static function lang($user_id)
//    {
//        $db2 = DataBase::getDB();
//        return $db2->getUser($user_id,1);
//    }

    public function til($key)
    {
        switch ($this->lang){
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
            "key31"=>"Avto Test (70) loyihasi asta-sekin rivojlantirib borilmoqda. Loyihani rivojlanishiga o'z hissangizni qo'shingizni so'raymiz.\n8600 0529 9828 6098\nAbdujalilov Dilshod",
            "key32"=>"Tilni o'gartirish",
            "key33"=>"Hududni o'zgartirish",
            "key34"=>"Telefon raqamini o'zgartirish",
            "key36"=>"Yangiliklar",
            "key37"=>"Bonuslar",
            "key38"=>"Tariflar",
            "key39"=>"Bog'lanish",
            "key41"=>"*Vaqt*:",
            "key42"=>"*Tarif*:",
            "key43"=>"*Manzil*:",
            "key44"=>"*Masofa*:",


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
            "key06"=>"Ma'lumotlar",
            "key07"=>"Настройки",
            "key08"=>"Тест по ПДД",
            "key09"=>"Выбрать билет",
            "key10"=>"Найти знака",
            "key11"=>"*Тест топшириш учун керакли бўлимни танланг*",
            "key12"=>"Йўл белгилари ва Йўл чизиқлари\nБелги рақамини киритиш. Мисол: 1.20 ёки 3.27",
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
            "key23"=>"❌ Белги топилмади. Керакли белгини топиш учун рақамини киритинг.\nМисол: 1.20 ёки 3.27",
            "key24"=>"Офарин топдингиз. Навбатдаги белгини топинг",
            "key25"=>"❌ тополмадингиз. Бошқатдан уриниб кўринг",
            "key27"=>"Ушбу белгининг рақамини киритинг\nМисол: 1.20 ёки 3.27",
            "key28"=>"🔁 Бошқа белги",
            "key30"=>"*Настройки*",
            "key31"=>"Avto Test (70) loyihasi asta-sekin rivojlantirib borilmoqda. Loyihani rivojlanishiga o'z hissangizni qo'shingizni so'raymiz.\n8600 0529 9828 6098\nAbdujalilov Dilshod",
            "key32"=>"Изменить язык",
            "key33"=>"Изменить региона",
            "key34"=>"Изменить номер телефона",
            "key36"=>"Новости и акции",
            "key37"=>"Бонусы",
            "key38"=>"Тарифы",
            "key39"=>"Связаться с нами",
            "key41"=>"*Дата и время*:",
            "key42"=>"*Тариф*:",
            "key43"=>"*Адрес*:",
            "key44"=>"*Расстояние*:",

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
            "key31"=>"Avto Test (70) loyihasi asta-sekin rivojlantirib borilmoqda. Loyihani rivojlanishiga o'z hissangizni qo'shingizni so'raymiz.\n8600 0529 9828 6098\nAbdujalilov Dilshod",
            "key32"=>"Tilni o'zgartirish",
            "key33"=>"Shahar almashtirish",
            "key34"=>"Telefon raqamini almashtirish",
            "key35"=>"`Ma'lumotlar bo'limi`",
            "key36"=>"Yangiliklar",
            "key37"=>"Bonuslar",
            "key38"=>"Tariflar",
            "key39"=>"Bog'lanish",
            "key40"=>"*Buyurtma raqami*:",
            "key41"=>"*Buyurtma vaqt*:",
            "key42"=>"*Tarif*:",
            "key43"=>"*Borish manzili*:",
            "key44"=>"*Masofa*:",

        ];
        return $word[$key];
    }

    public function __destruct() {

    }

}
