<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php'
require 'phpmailer/src/PHPMailer.php'

//Create a new PHPMailer instance
$mail = new PHPMailer(true);
$mail->Charset = 'UTF-8';
$mail->setLanguage('ru','phpmailer/language/');
$mail->IsHTML(true);
$mail->setFrom('www@www.com', "имя адресата");
$mail->addAddress('draganovmaksim9@gmail.com');
$mail->Subject = 'PHPMailer Тема письма';
$hand = "Лево";
if ($_POST['hand' == "right"]) {
	$hand = "Право";
}
$body = '<h1>Тело письма</h1>';
//проверка полей
if (trim(!empty($_POST['name']))) {
	$body.='<p><strong>Имя:<strong> '.$_POST['name'].'</p>';
}
if (trim(!empty($_POST['mail']))) {
	$body. = '<p><strong>Почта:<strong> '.$_POST['mail'].'</p>';
}
if (trim(!empty($_POST['hand']))) {
	$body. = '<p><strong>Почта:<strong> '.$_POST['hand'].'</p>';
}
if (trim(!empty($_POST['message']))) {
	$body. = '<p><strong>Почта:<strong> '.$_POST['message'].'</p>';
}
if (trim(!empty($_POST['age']))) {
	$body. = '<p><strong>Почта:<strong> '.$_POST['age'].'</p>';
}

if (!empty($_FILES['image']['tmp_name'])) {
	$filePath = __DIR__ . "/files/" . $_FILES['image']['name']
	if(copy($_FILES['image']['tmp_name'],$filePath)){
		$fileAttach = $filePath;
		$body.='<p><strong>Фото в приложении<strong></p>'
		$mail->addAttachment($fileAttach);
	}
}
$mail->Body = $body;

//send the message, check for errors
if (!$mail->send()) {
    $message 'ошибка: ';
} else {
    $message 'письмо отправлено!';
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($response);
?>