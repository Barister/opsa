<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitizeInput($_POST["name"]);
    $phone = sanitizeInput($_POST["phone"]);
    $email = sanitizeInput($_POST["email"]);
    $message = sanitizeInput($_POST["text"]);

    if (validateInputs($name, $phone, $email, $message)) {
        $to = "info@opsa-karelia.ru"; // Замените на вашу почту
        $subject = "Новое сообщение от формы обратной связи";
        $body = "Имя: " . $name . "\n"
            . "Телефон: " . $phone . "\n"
            . "E-mail: " . $email . "\n"
            . "Сообщение: " . $message;

        $headers = "From: " . $email . "\r\n"
            . "Reply-To: " . $email . "\r\n"
            . "Content-Type: text/plain; charset=utf-8\r\n";

        if (mail($to, $subject, $body, $headers)) {
            echo "Сообщение успешно отправлено.";
        } else {
            echo "Ошибка при отправке сообщения.";
        }
    } else {
        echo "Некорректные данные формы.";
    }
}

function sanitizeInput($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function validateInputs($name, $phone, $email, $message)
{
    if (empty($name) || empty($phone) || empty($message)) {
        return false; // Если обязательные поля не заполнены, возвращаем false
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false; // Если email некорректный, возвращаем false
    }

    return true; // Если все проверки пройдены, возвращаем true
}
?>
