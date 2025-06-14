<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
function mailer($email,$body,$subject){
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = 'xxxx@gmail.com'; //change this to gmail account
    $mail->Password = 'xxxxx'; //contact me jewernestc@gmail.com on how to setup this
    $mail->SMTPOptions = array(
     'ssl' => array(
       'verify_peer' => false,
       'verify_peer_name' => false,
       'allow_self_signed' => true
      )
  );
  
  $address = explode(";",$email);
  $mail->setFrom('cebudotnetsolutions@gmail.com','Dotnetsolutions');
  for($i=0;$i<count($address);$i++){
    if($address[$i] != "")
    {
      $mail->addAddress($address[$i]);
    }
  }
  $mail->Subject = $subject;
  $mail->MsgHTML($body);

    $res = "";
  if(!$mail->send()) {
        $res = $mail->ErrorInfo;
    }
    else
    {
      $res = '55';
    }
    // echo json_encode($mail);
}
if ( $handle = fopen( 'testemail_1.csv', 'r' ) ) {
    $name ="";
    $fname = "";
    $email = "";
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
      $email = $row[0];
      $fname = $row[1];
      $name = $row[2];
      //print_r($email . ' ' . $fname);
        $mailtemplate = file_get_contents("table.html");
        $mail = mailer($email,$mailtemplate, $fname . ' transform your online presence');
        //print_r($mail);
    }
    fclose($handle);
}
?>