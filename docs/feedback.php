<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require "lib/PHPMailer/src/Exception.php";
    require "lib/PHPMailer/src/PHPMailer.php";
    require "lib/PHPMailer/src/SMTP.php";

    $companyName = htmlspecialchars($_POST["company-name"]);
    $contactEmail = htmlspecialchars($_POST["contact-email"]);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try 
    {
        $mail->isSMTP();
        $mail->Host       = "smtp.yandex.ru";
        $mail->SMTPAuth   = true;
        $mail->Username   = "noreplay@lankit.ru";
        $mail->Password   = "11!!wwWW";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
 
        $mail->setFrom("noreplay@lankit.ru", "Lankit");
        $mail->addAddress("info@lankit.ru");

        $mail->isHTML(true);
        $mail->Subject = "Новая заявка с сайта lankit.ru";
        $mail->Body    = '<!DOCTYPE html><html lang="ru"><head> <meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1.0"> <title>Новая заявка с сайта</title></head><style> @media only screen and (max-width : 640px) { table[class="container"] { width: 98% !important; } td[class="bodyCopy"] p { padding: 0 15px !important; text-align: center !important; } td[class="spacer"] { width: 15px !important; } } @media only screen and (min-width: 250px) and (max-width: 480px) { td[class="spacer"] { display: none !important; } td[class="bodyCopy"] p { padding: 0 15px !important; text-align: center !important; } td[class="bodyCopy"] h1 { padding: 0 10px !important; } h1, h2 { line-height: 120% !important; } }</style><body> <body > <table width="550" bgcolor="#fcfcfc" style="border: 1px solid #dddddd; line-height: 135%;" class="container" align="center" cellpadding="0" cellspacing="0"> <tr> <td colspan="3" height="15">&nbsp;</td> </tr> <tr> <td bgcolor="#fcfcfc"> <table> <tr> <td width="30" class="spacer">&nbsp;</td> <td align="left" class="bodyCopy"> <h1 style="font-family: Arial, Helvetica, sans-serif; font-size: 32px; color: #404040; margin-top: 0; margin-bottom: 20px; padding: 0; line-height: 135%" class="headline">Новая заявка с сайта lankit.ru</h1> <p style="font-family: Arial, Helvetica, sans-serif; color: #555555; font-size: 14px; padding: 0 40px;">' . 
            'Организация: ' . $companyName . 
            '</p> <p style="font-family: Arial, Helvetica, sans-serif; color: #555555; font-size: 14px; padding: 0 40px;">' . 
            'Контактная почта: ' . $contactEmail . 
            '</p> <p style="font-family: Arial, Helvetica, sans-serif; color: #555555; font-size: 14px; padding: 0 40px;">' . 
            'Тема обращения: ' . $subject . 
            '</p> <p style="font-family: Arial, Helvetica, sans-serif; color: #555555; font-size: 14px; padding: 0 40px;">' . 
            'Запрос: ' . $message . 
            '</p> </td> <td width="30" class="spacer">&nbsp;</td> </tr> </table> </td> </tr> </table> </body></body></html>';

        $mail->send();
    } 
    catch (Exception $e) 
    {
        header("Content-Type: application/json;charset=utf-8");
        $res = (object)["success" => false];
        echo json_encode($res);
        exit;
    }

    header("Content-Type: application/json;charset=utf-8");
    $res = (object)["success" => true];
    echo json_encode($res);
    exit;
?>