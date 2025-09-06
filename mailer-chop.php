<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST['companyName'] ?? '';
    $inn = $_POST['inn'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $price = $_POST['price'] ?? '';

    // Данные из JSON
    $dataJson = $_POST['data'] ?? '';
    $data = json_decode($dataJson, true) ?: [];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'Exception.php';
    require 'PHPMailer.php';
    require 'SMTP.php';

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.timeweb.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@codeseven.ru';
        $mail->Password = 'm9fsz83kk9';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('info@codeseven.ru', 'Заявка ЧОП');
        $mail->addAddress('ascwork86@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Новая заявка — Страхование ЧОП';

        $emailBody = "
            <h2>Новая заявка на страхование ЧОП</h2>
            <p><strong>Юр. лицо:</strong> {$companyName}</p>
            <p><strong>ИНН:</strong> {$inn}</p>
            <p><strong>Телефон:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Страховая сумма:</strong> {$price}</p>
            <p><strong>Стаж:</strong><br>{$data['experience']}</p>
            <p><strong>Количество объектов:</strong><br>{$data['objects']}</p>
            <p><strong>Лимит ответственности:</strong><br>{$data['liability']}</p>
            <p><strong>Франшиза:</strong><br>{$data['franchise']}</p>
            <p><strong>Финансовые риски:</strong><br>{$data['financialRisk']}</p>
        ";

        $mail->Body = $emailBody;
        $mail->AltBody = strip_tags("Заявка на страхование ЧОП\n\n" .
            "Юр. лицо: {$companyName}\n" .
            "ИНН: {$inn}\n" .
            "Телефон: {$phone}\n" .
            "Email: {$email}\n" .
            "Сумма: {$price}\n" .
            "Стаж: {$data['experience']}\n" .
            "Объекты: {$data['objects']}\n" .
            "Лимит: {$data['liability']}\n" .
            "Франшиза: {$data['franchise']}\n" .
            "Фин. риски: {$data['financialRisk']}"
        );

        // Прикрепляем файл, если есть
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $mail->addAttachment($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        }

        $mail->send();
        echo json_encode(['success' => true, 'message' => 'Сообщение успешно отправлено']);
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        echo json_encode(['success' => false, 'message' => 'Ошибка отправки: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Метод не поддерживается']);
}
?>