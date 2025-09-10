<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../lib/Exception.php';
require '../lib/PHPMailer.php';
require '../lib/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inn = $_POST['inn'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $clmail = $_POST['email'] ?? '';
    $companyName = $_POST['companyName'] ?? '';
    //$material = implode(', ', $_POST['material']) ?? '';

    // $material = $_POST['material'] ?? '';
    // $items = explode(',', $material);
    // $materialFormatted = implode(',<br>', array_map('trim', $items));

        // Получаем material как JSON
    $materialJson = $_POST['material'] ?? '';
    $materialArray = json_decode($materialJson, true) ?: [];
    $materialFormatted = implode('<br>', array_map('trim', $materialArray));
    
    $price = $_POST['price'] ?? '';
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();


        $mail->Host = 'smtp.timeweb.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@codeseven.ru';
        $mail->Password = 'm9fsz83kk9';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;


        $mail->setFrom('info@codeseven.ru', 'Zetta - страховани имущества');
        $mail->addAddress('info@codeseven.ru');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Новая заявка с сайта';
        
        $emailBody = "
            <h2>Новая заявка по полису страхования имущества</h2>
            <p><strong>Наименование юр. лица:</strong> {$companyName}</p>
            <p><strong>ИНН:</strong> {$inn}</p>
            <p><strong>Телефон:</strong> {$phone}</p>
            <p><strong>E-mail:</strong> {$clmail}</p>
            <p><strong>Застрахованное имущество:</strong><br>{$materialFormatted}</p>
            <p><strong>Стоимость:</strong> {$price}</p>
        ";

        $mail->Body = $emailBody;
        $mail->AltBody = strip_tags($emailBody);

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Сообщение успешно отправлено']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Ошибка отправки: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
}
?>
