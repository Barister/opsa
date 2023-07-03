<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
//require '../PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'PHPMailer/language');
$mail->isHTML(true);                                  //Set email format to HTML

try {
    // //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    // $mail->Username   = 'user@example.com';                     //SMTP username
    // $mail->Password   = 'secret';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('info@opsa-karelia.ru', 'Гуру Администратор');
    $mail->addAddress('info@opsa-karelia.ru');               //Name is optional
    $mail->addAddress('cottages.karelia@gmail.com');               //Name is optional
    $mail->addAddress('opeskin@mail.ru');               //Name is optional
    //$mail->addReplyTo($_POST['email'], $_POST['name']);
    $mail->Subject = 'Опса.Карелия: запрос через форму обратной связи';
    

    //Content

    $body = '<h1>Встречайте запрос с сайта</h1>';

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Имя:</strong> '.$_POST['name'].'</p>';
    }

    if(trim(!empty($_POST['name']))){
        $body.='<p><strong>Телефон:</strong> '.$_POST['phone'].'</p>';
    }

    if(trim(!empty($_POST['email']))){
        $body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
    }

    if(trim(!empty($_POST['text']))){
        $body.='<p><strong>Сообщение:</strong> '.$_POST['text'].'</p>';
    }
    
    $mail->Body = $body;

    //Sending

    $mail->send();
    $message = 'Сообщение отправлено';
} catch (Exception $e) {
    $message = "Ошибка, сообщение не может быть отправлено. Сведения об ошибке: {$mail->ErrorInfo}";
}

// Saving the data to a file
$fileData = date('Y-m-d H:i:s') . ' - ' . $_POST['name'] . ' - ' . $_POST['email'] . ' - ' . $_POST['phone'] . ' - ' . $_POST['text'] ."\n";
file_put_contents('../logs/form_data.txt', $fileData, FILE_APPEND);

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);

?>