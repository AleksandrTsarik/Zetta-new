<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST['companyName'] ?? '';
    $inn = $_POST['inn'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $price = $_POST['price'] ?? '';

    // Получаем data как JSON
    $dataJson = $_POST['data'] ?? '';
    $dataArray = json_decode($dataJson, true) ?: [];

    // Форматируем для письма
    $experience = $dataArray['experience'] ?? '';
    $objects = $dataArray['objects'] ?? '';
    $liability = $dataArray['liability'] ?? '';
    $franchise = $dataArray['franchise'] ?? '';
    $financialRisk = $dataArray['financialRisk'] ?? '';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.timeweb.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@codeseven.ru';
        $mail->Password = 'm9fsz83kk9';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('info@codeseven.ru', 'Zetta - Заявка ЧОП');
        //mail->addAddress('info@codeseven.ru');
        $mail->addAddress('ascwork86@gmail.com');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Новая заявка с сайта';

        $emailBody = "
            <h2>Новая заявка на страхование ЧОП</h2>
            <p><strong>Юр. лицо:</strong> {$companyName}</p>
            <p><strong>ИНН:</strong> {$inn}</p>
            <p><strong>Телефон:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Страховая сумма:</strong> {$price}</p>
            <p><strong>Стаж:</strong><br>{$experience}</p>
            <p><strong>Количество объектов:</strong><br>{$objects}</p>
            <p><strong>Лимит ответственности:</strong><br>{$liability}</p>
            <p><strong>Франшиза:</strong><br>{$franchise}</p>
            <p><strong>Финансовые риски:</strong><br>{$financialRisk}</p>
        ";

        $mail->Body = $emailBody;
        $mail->AltBody = strip_tags($emailBody);

        // Прикрепляем файл, если есть
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Сообщение успешно отправлено']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => "Ошибка отправки: {$mail->ErrorInfo}"]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Неверный метод запроса']);
}
?>