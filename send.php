<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Получаем данные из формы
    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $email = strip_tags($_POST['email']);
    $message = strip_tags($_POST['message']);
    
    // Кому отправлять
    $to = "akish_mish@mail.ru";
    
    // Тема письма
    $subject = "=?UTF-8?B?" . base64_encode("Новая заявка с сайта МебельщикАртем") . "?=";
    
    // Формируем письмо
    $body = "
    <html>
    <head>
        <title>Новая заявка на перетяжку мебели</title>
    </head>
    <body>
        <h2>📋 Новая заявка с сайта</h2>
        <hr>
        <p><strong>👤 Имя:</strong> $name</p>
        <p><strong>📞 Телефон:</strong> $phone</p>
        <p><strong>📧 Email:</strong> $email</p>
        <p><strong>💬 Сообщение:</strong><br>$message</p>
        <hr>
        <p><small>Дата: " . date("d.m.Y H:i") . "</small></p>
    </body>
    </html>
    ";
    
    // Заголовки для HTML-письма
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: site@mebelartem.ru\r\n";
    
    // Отправляем
    if (mail($to, $subject, $body, $headers)) {
        header("Location: zakaz.html?success=1");
        exit;
    } else {
        header("Location: zakaz.html?error=1");
        exit;
    }
}
?>