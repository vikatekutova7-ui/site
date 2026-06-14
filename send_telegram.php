<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Получаем данные из формы
    $name = strip_tags($_POST['name']);
    $phone = strip_tags($_POST['phone']);
    $email = strip_tags($_POST['email']);
    $message = strip_tags($_POST['message']);
    $date = date("d.m.Y H:i");
    
    // Ваши данные
    $token = "8938409756:AAHTlQ843rvUum2X_l-YgPS-YNMUEXtNjgM";
    $chat_id = "1056049497";
    
    // Формируем текст для Telegram
    $text = "📋 <b>НОВАЯ ЗАЯВКА</b>\n\n";
    $text .= "👤 <b>Имя:</b> $name\n";
    $text .= "📞 <b>Телефон:</b> $phone\n";
    $text .= "📧 <b>Email:</b> $email\n";
    $text .= "💬 <b>Сообщение:</b>\n$message\n\n";
    $text .= "📅 <i>$date</i>";
    
    // Отправляем в Telegram
    $url = "https://api.telegram.org/bot$token/sendMessage";
    
    $data = [
        'chat_id' => $chat_id,
        'text' => $text,
        'parse_mode' => 'HTML'
    ];
    
    $options = [
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data)
        ]
    ];
    
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    
    // Перенаправляем на страницу спасибо
    header("Location: zakaz.html?success=1");
    exit;
}
?>