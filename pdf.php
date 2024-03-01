<?php
/**
 * Created by PhpStorm.
 * PHP version ^8.0
 *
 * @package  uzautotest
 * @author   Abdujalilov Dilshod <ax5165@gmail.com>
 * @license  https://www.php.net PHP License
 * @link     https://t.me/AbdujalilovD
 * @date     29.02.2024 18:12
 */

use DataBase\DataBase;

exit('PDF');
require __DIR__. '/vendor/autoload.php';
require_once __DIR__. "/lib/config.php";

// Инициализируем объект PDF
$pdf = new FPDF();
$db = new DataBase();

$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Допустим, $data - это массив данных, полученных из вашей таблицы `savol_data`
$arrays = $db->selectOfset("1", 'savol_data', 400, 800);


foreach ($arrays as $row) {
    // Проверяем, существует ли изображение
    if ($row->rasm) {
        // Добавляем изображение
        // Предполагается, что путь к изображению относительный и находится в той же директории, где выполняется скрипт
        $pdf->Image(BOT_URL . '/image/' . "savol/".$row->rasm, $pdf->GetX(), $pdf->GetY(), 80); // 40 - примерная ширина изображения в мм
        $pdf->Ln(60); // Оставляем место под изображение, добавляя отступ после него
    }
    // Собираем текстовые поля с окончанием _uzl
    if ($row->javob_d_uzl) {
        $text = 'Bilet: '.$row->bilet.', savol: '.$row->raqam."\n".
            $row->savol_uzl . "\n" .
            'A - '.$row->javob_a_uzl . "\n" .
            'B - '.$row->javob_b_uzl . "\n" .
            'C - '.$row->javob_c_uzl . "\n" .
            'D - '.$row->javob_d_uzl. "\n" .
            '+ '.$row->javob.'  @uzautotest_bot';
    } else {
        $text = 'Bilet: '.$row->bilet.', savol: '.$row->raqam."\n".
            $row->savol_uzl . "\n" .
            'A - '.$row->javob_a_uzl . "\n" .
            'B - '.$row->javob_b_uzl . "\n" .
            'C - '.$row->javob_c_uzl . "\n" .
            '+ '.$row->javob.'  @uzautotest_bot';
    }

    $encodedText = mb_convert_encoding($text, 'ISO-8859-1', 'UTF-8');
    // Добавляем текст в PDF
    $pdf->MultiCell(0, 10, $encodedText);
    $pdf->Ln(); // Добавляем небольшой отступ перед изображением


}

// Выводим PDF
$pdf->Output('I', 'test.pdf');
