<?php

namespace app\controllers;
use app\models\Main;
use R;
use vendor\core\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use vendor\core\base\View;
use PHPMailer\PHPMailer\PHPMailer;
use vendor\libs\Genpass;

class TestController extends AppController
{
    public function indexAction()
    {
        $model = new Main();

        $var = Genpass::gen();

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'miusov@gmail.com';
        $mail->Password = '*********';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('miusov86@gmail.com', 'Joe User');
        $mail->isHTML(false);

        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML <b>'.$var.'</b> message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            $res = 'Error: ' . $mail->ErrorInfo;
        } else {
            $res = 'OK';
        }


        $this->set(['res'=>$res]);

    }
}