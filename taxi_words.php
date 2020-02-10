<?php
class word {
    private static $db = null;
    private $lang;

    public static function getLang($user_id)
    {
        if (self::$db == null) self::$db = new word($user_id);
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
            "key45"=>"*Qo'shimcha xizmatlar*:",
            "key46"=>"*Jami to'lov*:",
            "key47"=>"So'nggi",
            "key48"=>"ta buyurtmalar",
            "key49"=>"so'm",
            "key50"=>"*O'chirish uchun ro'yxatdan kerakli manzilni tanlang*",
            "key51"=>"Manzil yuborish uchun \"*Geolokatsiyani yuborish*\" tugmasini bosing",
            "key52"=>"Telefon raqam yuborish",
            "key54"=>"*\"Telefon raqamni yuborish\"* tugmasiga bosing yoki telefon raqamingizni *998901234567* formatda kiriting",
            "key55"=>"Format: 998901234567",
            "key56"=>"*Tilni tanlang*",
            "key57"=>"*Profilni to'ldirilish darajasi*",
            "key58"=>"Ism",
            "key59"=>"Tug'ilgan sana",
            "key60"=>"Jins",
            "male"=>"Erkak",
            "female"=>"Ayol",
            "key65"=>"*Taklif va shikoyatlar uchun*",
            "key66"=>"Xabar yozish",
            "key67"=>"*Tug'ilgan sanangizni kiriting*",
            "key68"=>"*DD.MM.YYYY* formatda",
            "key69"=>"*Ismingizni kiriting*",
            "key70"=>"*Jinsni tanlang*",
            "key72"=>"*Shahringizni tanlang*",
            "key73"=>"Asaka",
            "key74"=>"Shahrixon",
            "key78"=>"Ko'rsatilmagan",
            "key79"=>"*Buyurtmani tasdiqlang*",
            "key80"=>"Tasdiqlash",
            "key81"=>"Buyurtmangiz qabul qilindi!",
            "key82"=>"*Avtomobil qidirilmoqda...*",
            "key84"=>"Buyurtmani bekor qilish",
            "key85"=>"*Ro'yhatdan tanlang yoki o'zingiz yozib kiriting*",
            "key86"=>"Boshqa insonga chaqirish",
            "key87"=>"Bagajli moshina",
            "key88"=>"*Boshqa insonning telefon raqamini kiriting*",
            "key92"=>"Marg'ilon",
            "key95"=>"Simvollardan foydalanmang",
            "key97"=>"*Tarifni yoki xizmatni tanlang*",
            "key98"=>"Ko'rsatilgan telefon raqamga SMS orqali aktivatsiya kodi yuborildi. \n*Iltimos SMS da ko'rsatligan kodni kiriting*",
            "key99"=>" - https://t.me/royaltaxibots",
            "key100"=>"Telefon raqam noto'g'ri formatda kiritildi!",
            "key101"=>"ismingiz to'g'rimi?",
            "key103"=>"O'zgartirish",
            "key104"=>"SMS da ko'rsatilgan kod noto'g'ri kiritildi. Iltimos qayta urunib ko'ring!",
            "key105"=>"Iltimos, ismingizni faqat harflardan foydalangan holda kiriting",
            "key107"=>"Telefon raqam noto'g'ri kiritilgan",
            "key108"=>"*Telefon raqamingiz yangi 998",
            "key109"=>"raqamga o'zgartirildi*",
            "key110"=>"*Sizda amaldagi buyurtma mavjud iltimos avvalgi buyurtma yakunlanishini kuting*",
            "key111"=>"*Manzil nomini kiriting*",
            "key112"=>"*📍 Eng yaqin mo'ljalni tanlang \n                           yoki \n✏️ O'zingiz yozib kiriting*",
            "key113"=>"*Yaqin mo'ljal topilmadi! Iltimos o'zingizga yaqin mo'ljal nomini yozib kiriting*",
            "key114"=>"Siz aktivlashtirilgansiz",
            "key115"=>"Avtomobil",
            "key116"=>"Haydovchi",
            "key117"=>"*Ko'rsatilgan manzilga haydovchi yetib keldi!*",
            "key118"=>"*Taksometr bo'yicha hisob boshlandi*%0AYo'lingiz bexatar bo'lsin!",
            "key119"=>"*RoyalTaxi xizmatlaridan foydalanganingiz uchun rahmat!*",
            "key120"=>"*Buyurtma bekor qilindi*",
            "key122"=>"Andijon shaxri",
            "key123"=>"Farg'ona shaxri",
            "key125"=>"*Iltimos xizmat sifatini baxolang!*\nSizning fikringiz xizmat sifatini yaxshilashga yordam beradi",
            "key126"=>"*Sizning fikringiz inobatga olindi!*\nXizmat sifatini yaxshilashga yordam berganingiz uchun rahmat",
            "key130"=>"Qo'shimcha xizmatlar",
            "key131"=>"*Haydovchi buyurtmangizni qabul qildi va siz bilan tez orada bog'lanadi!*",
            "key133"=>"*Sarflangan vaqt:*",
            "key134"=>"*Siz hozirda ushbu raqamdan foydalanmoqdasiz*",
            "key_1_ekonom"=>"minimal to'lov",//ANDIJON
            "key_2_ekonom"=>"minimal to'lov",//NAMANGAN
            "key_6_ekonom"=>"minimal to'lov",//MARGILAN
            "key_14_ekonom"=>"minimal to'lov",//FARGONA
            "key_23_ekonom"=>"minimal to'lov",//ASAKA
            "key_25_ekonom"=>"minimal to'lov",//SHAXRIXON
            "key_1_komfort"=>"minimal to'lov",//ANDIJON
            "key_2_komfort"=>"minimal to'lov",//NAMANGAN
            "key_6_komfort"=>"minimal to'lov",//MARGILAN
            "key_14_komfort"=>"minimal to'lov",//FARGONA
            "key_23_komfort"=>"minimal to'lov",//ASAKA
            "key_25_komfort"=>"minimal to'lov",//SHAXRIXON
            "key_1_dostavka"=>"minimal to'lov",//ANDIJON
            "key_2_dostavka"=>"minimal to'lov",//NAMANGAN
            "key_6_dostavka"=>"minimal to'lov",//MARGILAN
            "key_14_dostavka"=>"minimal to'lov",//FARGONA
            "key_23_dostavka"=>"minimal to'lov",//ASAKA
            "key_25_dostavka"=>"minimal to'lov",//SHAXRIXON
            "kalit_1_1" =>"Haydovchi muomilasi yomon",
            "kalit_1_2" =>"Avtomobil tozaligi yomon",
            "kalit_1_3" =>"Umumiy xizmat ko'rsatish yomon",
            "kalit_2_1" =>"Haydovchi muomilasi qoniqarsiz",
            "kalit_2_2" =>"Avtomobil tozaligi qoniqarsiz",
            "kalit_2_3" =>"Umumiy xizmat ko'rsatish qoniqarsiz",
            "kalit_3_1" =>"Haydovchi muomilasi o'rtacha",
            "kalit_3_2" =>"Avtomobil tozaligi o'rtacha",
            "kalit_3_3" =>"Umumiy xizmat ko'rsatish o'rtacha",
            "kalit_4_1" =>"Haydovchi muomilasi yaxshi",
            "kalit_4_2" =>"Avtomobil tozaligi yaxshi",
            "kalit_4_3" =>"Umumiy xizmat ko'rsatish yaxshi",
            "kalit_5_1" =>"Haydovchi muomilasi a'lo",
            "kalit_5_2" =>"Avtomobil tozaligi a'lo",
            "kalit_5_3" =>"Umumiy xizmat ko'rsatish a'lo",
            "key135"=>"Buyurtmani haqiqatdan ham bekor qilmoqchimisiz?",
            "key136"=>"Ha",
            "key137"=>"Yo'q",
            "key138"=>"Iltimos, avval \"*Geolokatsiyani yuborish*\" tugmasini bosib o'z manzilingizni yuboring!",
            "key139"=>"Ko'rsatilgan hududda Telegram orqali xizmat ko'rsatmaymiz. Buyurtma berish uchun operatorga qo'ng'iroq qiling",
            "key140"=>"*Itlimos, nima uchun bunday baho berganingizga izoh bering*",
            "key141"=>"Xatolik haqida habar berish",
            "key142"=>"Kordinatalar bo'yicha",

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
            "key45"=>"*Доп. услуги*:",
            "key46"=>"*Сумма к оплате*:",
            "key47"=>"Последние",
            "key48"=>"заказов",
            "key49"=>"сум",
            "key50"=>"*Чтобы удалить адрес выберите из списка*",
            "key51"=>"Чтобы отправить адрес, нажмите на кнопку \"*Отправить геолокацию*\"",
            "key52"=>"Отправить номер телефона",
            "key54"=>"Нажмите на кнопку *\"Отправить номер телефона\"* или напишите свой номер телефона в формате *998901234567*",
            "key55"=>"Формат: 998901234567",
            "key56"=>"*Выберите язык*",
            "key57"=>"*Процент заполненности профиля*",
            "key58"=>"Имя",
            "key59"=>"Дата рождения",
            "key60"=>"Пол",
            "male"=>"Мужской",
            "female"=>"Женский",
            "key65"=>"*Предложения и жалобы*",
            "key66"=>"Написать сообщение",
            "key67"=>"*Введите дату рождения*",
            "key68"=>"В формате *DD.MM.YYYY*",
            "key69"=>"*Введите ваше имя*",
            "key70"=>"*Выберите пол*",
            "key72"=>"*Выберите ваш город*",
            "key73"=>"Асака",
            "key74"=>"Шахрихан",
            "key78"=>"Не заданы",
            "key79"=>"*Подтвердите заказ*",
            "key80"=>"Подтвердить",
            "key81"=>"Ваш заказ принят!",
            "key82"=>"*Идет поиск автомобиля...*",
            "key84"=>"Отменить заказ",
            "key85"=>"*Выберите из списка или напишите свое пожелание*",
            "key86"=>"Заказать другому человеку",
            "key87"=>"Багаж",
            "key88"=>"*Введите номер телефона нового пассажира*",
            "key92"=>"Маргилан",
            "key95"=>"Нельзя использовать символы",
            "key97"=>"*Выберите тариф или услугу*",
            "key98"=>"Мы отправили СМС с кодом активации на ваш номер\n*Пожалуйста введите код из СМС*",
            "key99"=>" - https://t.me/royaltaxibot",
            "key100"=>"Номер телефона введен в неправильном формате",
            "key101"=>"это ваше настоящее имя?",
            "key103"=>"Изменить",
            "key104"=>"SMS da ko'rsatilgan kod noto'g'ri kiritildi. Iltimos qayta urunib ko'ring!",
            "key105"=>"Iltimos, ismingizni faqat harflardan foydalangan holda kiriting",
            "key107"=>"Неверно введен номер телефона",
            "key108"=>"*Telefon raqamingiz yangi 998",
            "key109"=>"raqamga o'zgartirildi*",
            "key110"=>"*Sizda amaldagi buyurtma mavjud iltimos avvalgi buyurtma yakunlanishini kuting*",
            "key111"=>"*Manzil nomini kiriting*",
            "key112"=>"*📍 Выберите ближайшую ориентир \n                           или \n✏️ Напишите сами*",
            "key113"=>"*Yaqin mo'ljal topilmadi! Iltimos o'zingizga yaqin mo'ljal nomini yozib kiriting*",
            "key114"=>"Siz aktivlashtirilgansiz",
            "key115"=>"Автомобиль",
            "key116"=>"Водитель",
            "key117"=>"*Водитель прибыл по указанному адресу!*",
            "key118"=>"*Расчет начался по Таксометру*%0Счастливого пути!",
            "key119"=>"*RoyalTaxi xizmatlaridan foydalanganingiz uchun rahmat!*",
            "key120"=>"*Ваш заказ отменен*",
            "key122"=>"Город Андижан",
            "key123"=>"Город Фергана",
            "key125"=>"*Iltimos xizmat sifatini baxolang!*\nSizning fikringiz xizmat sifatini yaxshilashga yordam beradi",
            "key126"=>"*Sizning fikringiz inobatga olindi!*\nXizmat sifatini yaxshilashga yordam berganingiz uchun rahmat",
            "key130"=>"Дополнительные услуги",
            "key131"=>"*Водитель принял Ваш заказ!*",
            "key133"=>"*В пути:*",
            "key134"=>"*Siz hozirda ushbu raqamdan foydalanmoqdasiz*",
            "key_1_ekonom"=>"минимальная стоимость",//ANDIJON
            "key_2_ekonom"=>"минимальная стоимость",//NAMANGAN
            "key_6_ekonom"=>"минимальная стоимость",//MARGILAN
            "key_14_ekonom"=>"минимальная стоимость",//FARGONA
            "key_23_ekonom"=>"минимальная стоимость",//ASAKA
            "key_25_ekonom"=>"минимальная стоимость",//SHAXRIXON
            "key_1_komfort"=>"минимальная стоимость",//ANDIJON
            "key_2_komfort"=>"минимальная стоимость",//NAMANGAN
            "key_6_komfort"=>"минимальная стоимость",//MARGILAN
            "key_14_komfort"=>"минимальная стоимость",//FARGONA
            "key_23_komfort"=>"минимальная стоимость",//ASAKA
            "key_25_komfort"=>"минимальная стоимость",//SHAXRIXON
            "key_1_dostavka"=>"минимальная стоимость",//ANDIJON
            "key_2_dostavka"=>"минимальная стоимость",//NAMANGAN
            "key_6_dostavka"=>"минимальная стоимость",//MARGILAN
            "key_14_dostavka"=>"минимальная стоимость",//FARGONA
            "key_23_dostavka"=>"минимальная стоимость",//ASAKA
            "key_25_dostavka"=>"минимальная стоимость",//SHAXRIXON
            "kalit_1_1" =>"Haydovchi muomilasi yomon",
            "kalit_1_2" =>"Avtomobil tozaligi yomon",
            "kalit_1_3" =>"Umumiy xizmat ko'rsatish yomon",
            "kalit_2_1" =>"Haydovchi muomilasi qoniqarsiz",
            "kalit_2_2" =>"Avtomobil tozaligi qoniqarsiz",
            "kalit_2_3" =>"Umumiy xizmat ko'rsatish qoniqarsiz",
            "kalit_3_1" =>"Haydovchi muomilasi o'rtacha",
            "kalit_3_2" =>"Avtomobil tozaligi o'rtacha",
            "kalit_3_3" =>"Umumiy xizmat ko'rsatish o'rtacha",
            "kalit_4_1" =>"Haydovchi muomilasi yaxshi",
            "kalit_4_2" =>"Avtomobil tozaligi yaxshi",
            "kalit_4_3" =>"Umumiy xizmat ko'rsatish yaxshi",
            "kalit_5_1" =>"Haydovchi muomilasi a'lo",
            "kalit_5_2" =>"Avtomobil tozaligi a'lo",
            "kalit_5_3" =>"Umumiy xizmat ko'rsatish a'lo",
            "key135"=>"Вы действительно хотите отменить заказ?",
            "key136"=>"Да",
            "key137"=>"Нет",
            "key138"=>"Iltimos, avval *\"Geolokatsiyani yuborish\"* tugmasini bosib o'z manzilingizni yuboring!",
            "key139"=>"Ko'rsatilgan hududda Telegram orqali xizmat ko'rsatmaymiz. Buyurtma berish uchun operatorga qo'ng'iroq qiling",
            "key140"=>"*Itlimos, nima uchun bunday baho berganingizga izoh bering*",
            "key141"=>"Сообщить об ошибке",
            "key142"=>"По координатам",
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
            "key45"=>"*Qo'shimcha hizmatlar*:",
            "key46"=>"*Umumiy summa*:",
            "key47"=>"So'nggi",
            "key48"=>"ta buyurtmalar",
            "key49"=>"so'm",
            "key50"=>"`O'chirish uchun ro'yhatdan kerakli manzilni tanlang:`",
            "key51"=>"Manzil yuborish uchun \"`Manzilni yuborish`\" tugmasini bosing",
            "key52"=>"Telefon raqam yuborish",
            "key53"=>"Manzilni yuborish",
            "key54"=>"Telefon raqam yuborish uchun pastda tugma mavjud!",
            "key55"=>"Format: 998977740369",
            "key56"=>"`Tilni tanlang`",
            "key57"=>"Profilni to'ldirish darajasi",
            "key58"=>"Ismi",
            "key59"=>"Tug'ilgan sana",
            "key60"=>"Jinsi",
            "male"=>"Erkak",
            "female"=>"Ayol",
            "key63"=>"`Tariflar bo'limi`",
            "key64"=>"`Bagaj`",
            "key65"=>"`Biz bilan quyidagi usullar orqali bog'lanishingiz mumkin:`",
            "key66"=>"Xabar yozish",
            "key67"=>"Tug'ilgan kuningizni kiriting",
            "key68"=>"Iltimos, `18.02.1993` formatida kiriting.",
            "key69"=>"*Ism, familiyani taxrirlash*",
            "key70"=>"*Jinsni belgilash*",
            "key71"=>"`Sizning tilingiz o'zgardi`",
            "key72"=>"`Shaharlardan birini tanlang!`",
            "key73"=>"Asaka",
            "key74"=>"Shaxrixon",
            "key75"=>"*Manzil: *",
            "key76"=>"*Tarif: *",
            "key77"=>"*Istaklar: *",
            "key78"=>"shart emas",
            "key79"=>"`Buyurtmani tasdiqlang`",
            "key80"=>"Buyurtmani tasdiqlash",
            "key81"=>"`Sizning buyurtmangiz qabul qilindi!`",
            "key82"=>"`Siz uchun moshina qidiryapmiz...`",
            "key83"=>"*Buyurtmangiz raqami*",
            "key84"=>"Buyurtmani bekor qilish",
            "key85"=>"`Ro'yhatdan tanlang yoki o'zingiz yozing!`",
            "key86"=>"Boshqa insonga chaqirish",
            "key87"=>"Bagajli moshina",
            "key88"=>"`Boshqa insonning telefon raqamini kiriting`",
            "key89"=>"*Misol*: *998977740369*",
            "key90"=>"`Royhatdan o'tmagansiz!`",
            "key91"=>"Telefon raqam yuborish",
            "key92"=>"Marg'ilon",
            "key93"=>"`Shaharlardan birini tanglang!`",
            "key94"=>"Ismingizni kiriting",
            "key95"=>"Simvollardan foydalanmang",

            "key97"=>"`Iltimos tarifni tanlang`",
            "key98"=>"Kodni kiriting",
            "key99"=>" - @Royaltaxibot aktivlashtirish kodi",
            "key100"=>"Telefon nomer hato kiritilgan",
            "key101"=>"ismingiz shumi?",
            "key102"=>"Ha",
            "key103"=>"Yo'q",
            "key104"=>"Kod hato kiritildi",
            "key105"=>"Iltimos, haqiqiy ismingizni kiritsangiz",
            "key106"=>" - @Royaltaxibot nomer almashtirish kodi",
            "key107"=>"Telefon raqami hato kiritilgan",
            "key108"=>"`Nomeringiz yangi 998",
            "key109"=>"nomerga o'zgartirildi`",
            "key110"=>"`Siz hozirda buyurtma bergansiz. Iltimos bir oz kuting!`",
            "key111"=>"Manzil nomini kiriting",
            "key112"=>"`Sizga eng yaqin bo'lgan joyni belgilang!`",
            "key113"=>"`Biz sizga yaqin bo'lgan joyni topa olmadik! Iltimos o'zingiz mo'ljalni kiriting`",
            "key114"=>"Siz aktivlashtirilgansiz",
            "key115"=>"Avtomobil",
            "key116"=>"Haydovchi",
            "key117"=>"Sizni kutmoqda",
            "key118"=>"Sizga oq yo'l tilaymiz...",
            "key119"=>"Buyurtmangiz bo'yicha hisob yakunlandi! Umumiy summa",
            "key120"=>"`Buyurtma bekor qilindi!`",

            "key122"=>"Andijon shaxri",
            "key123"=>"Farg'ona shaxri",
            "key124"=>"Bizning hizmatlarimizdan foydalanganiz uchun minnatdormiz",
            "key125"=>"Iltimos bizning hizmatimizni baholab bersangiz",
            "key126"=>"Rahmat, biz ovozingizni qadrlaymiz",
            "key127"=>"Ekonom",
            "key128"=>"Komfort",
            "key129"=>"Dostavka",
            "key130"=>"Istaklar:",
            "key131"=>"raqamli buyurtma. Sizni oldinga ketdi",
            "key132"=>"Kerakli joyni tanlang",
            "key133"=>"*Sarflangan vaqt:*",
            "key134"=>"*Siz hozirda ushbu raqamdan foydalanmoqdasiz*",
            "key_1_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ANDIJON
            "key_2_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//NAMANGAN
            "key_6_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//MARGILAN
            "key_14_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//FARGONA
            "key_23_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ASAKA
            "key_25_ekonom"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//SHAXRIXON

            "key_1_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ANDIJON
            "key_2_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//NAMANGAN
            "key_6_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//MARGILAN
            "key_14_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//FARGONA
            "key_23_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ASAKA
            "key_25_komfort"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//SHAXRIXON

            "key_1_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ANDIJON
            "key_2_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//NAMANGAN
            "key_6_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//MARGILAN
            "key_14_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//FARGONA
            "key_23_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//ASAKA
            "key_25_dostavka"=>"сум за 2 км и 1 мин ожидания, далее 800 сум/км и 300 сум/мин ожидания. За городом 1100 сум/км
                Выгодный тариф с автомобилями Matiz, Spark, Nexia 1-3",//SHAXRIXON
            "kalit_1_1" =>"A'lo",
            "kalit_1_2" =>"Yaxshi",
            "kalit_1_3" =>"Qoniqarli",
            "kalit_2_1" =>"A'lo",
            "kalit_2_2" =>"Yaxshi",
            "kalit_2_3" =>"Qoniqarli",
            "kalit_3_1" =>"A'lo",
            "kalit_3_2" =>"Yaxshi",
            "kalit_3_3" =>"Qoniqarli",
            "kalit_4_1" =>"A'lo",
            "kalit_4_2" =>"Yaxshi",
            "kalit_4_3" =>"Qoniqarli",
            "kalit_5_1" =>"A'lo",
            "kalit_5_2" =>"Yaxshi",
            "kalit_5_3" =>"Qoniqarli",
            "key135"=>"Rostan ham bekor qilmoqchimisiz",
            "key136"=>"✅ Ha",
            "key137"=>"❌ Yo'q",
            "key138"=>"Hazto so'z yoxiladi",
            "key139"=>"Hozirda ushbu hududda xizmat ko'rsatmaymiz!",
            "key140"=>"Nima uchun bunday baho berganingizga izox bering",
            "key141"=>"Сообщить об ошибке",
        ];
        return $word[$key];
    }

    public function __destruct() {

    }

}
