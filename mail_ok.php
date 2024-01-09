<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$message = $_REQUEST['message'];
// $title = $_REQUEST['title'];

if($name == '' || $email == '' || $phone == '' || $message == ''){
    echo '비어있는 항목이 있습니다.';
    // echo $name."\n";
    // echo $email."\n";
    // echo $phone."\n";
    // echo $message."\n";
    // echo $title;
    // return;
}

// $file = $_FILES['mailfile'];

// $file_tmp_name = $file['tmp_name'];
// $file_name = $file['name'];

// echo $file_tmp_name."   ".$file_name;
// echo $_FILES['mailfile']['tmp_name'][0]."        ".$_FILES['mailfile']['tmp_name'][1];
// echo $_FILES['mailfile']['name'][0]."        ".$_FILES['mailfile']['name'][1];
// echo count($_FILES['mailfile']['name']);
// return;

require './vendor/autoload.php';
$mail = new PHPMailer(true);

// echo '          ';
// return;

try {
    //Server settings
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->SMTPDebug = 3;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = "";                  // email 보낼때 사용할 서버를 지정  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';            // SMTP username
    $mail->Password = '';  //  비밀번호
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to
    $mail_addr = 'huiso5389@naver.com';  //  받는 사람
    //echo $mail->Host; return;
    $mail->setFrom('', '희소웹서버');  //  보낸 사람 메일 & 이름
    $mail->addAddress($mail_addr);     // Add a recipient

    // if ($file_yn) {
    //     // $mail->addAttachment($file_tmp_name,$file_name);
    //     // $mail->addAttachment($_FILES['mailfile']['tmp_name'][0],$_FILES['mailfile']['name'][0]);
    //     // $mail->addAttachment($_FILES['mailfile']['tmp_name'][1],$_FILES['mailfile']['name'][1]);
    //     for($i=0; $i<count($_FILES['mailfile']['name']); $i++){
    //         $mail->addAttachment($_FILES['mailfile']['tmp_name'][$i],$_FILES['mailfile']['name'][$i]);
    //     }
    // }

    // 메일 제목
    $mail_title = "희소 웹서버로 온 문의입니다.";

    // 메일 내용
    $mail_contents = "이름 : ".$name."<br><br>";
    $mail_contents .= "이메일 : ".$email."<br><br>";
    $mail_contents .= "전화번호 : ".$phone."<br><br>";
    $mail_contents .= "내용 : ".$message."<br><br>";

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    //$mail->AddEmbeddedImage('../../image/img_main/sign_new.jpg', 'HEAD');  //이미지 첨부
    //$mail->AddEmbeddedImage('../../image/img_main/sign_new.jpg', 'FOOT');  //이미지 첨부
    $mail->isHTML(true);                                   // Set email format to HTML
    $mail->Subject = $mail_title;
    //$mail->Body = 'Hello, <b>my friend</b>! This message uses HTML!';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // $mail->addAttachment($att_file);

    $body_html = "<table width=550 cellpadding=0 cellspacing=0 align=left style=margin-bottom:15px;border:1px solid #6A759B;border-radius: 5px;background-color:#ffffff;>";
    $body_html = $body_html."<tr>";
    $body_html = $body_html."<td align=center height=70>";
    //$body_html = $body_html."<img src='cid:HEAD'>";
    $body_html = $body_html."</td>";
    $body_html = $body_html."</tr>";
    $body_html = $body_html."<tr>";
    $body_html = $body_html."<td colspan=3 height=650 valign=top>";
    $body_html = $body_html."<font>".nl2br($mail_contents);
    $body_html = $body_html."</font>";
    $body_html = $body_html."</td>";
    $body_html = $body_html."</tr>";
    $body_html = $body_html."<tr>";
    $body_html = $body_html."<td align=center height=70 colspan=3>";
    /*$body_html = $body_html."<img src='cid:FOOT'>";*/
    $body_html = $body_html."</td>";
    $body_html = $body_html."</tr>";
    $body_html = $body_html."</table>";

    $mail->Body    = $body_html;
    $mail->send();
//      echo 'Message has been sent /';
    echo 'success';
}
catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>