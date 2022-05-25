<?php
    // wamiiiii wa3t9uuuuniiiii
    // wax7al u7na mdarbin m3a hadxiiiiii 


    
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code
    // Subscribe my channel if you are using this code


    use PHPMailer\PHPMailer\PHPMailer;
    function sendmail(){
        $name = "FSTAGE";  // Name of your website or yours
        $to = "yassinejrayfy36@gmail.com";  // mail of reciever
        $subject = "Tutorial or any subject";
        $body = "Send Mail Using PHPMailer - MS The Tech Guy";
        $from = "abdopro202@gmail.com";  // you mail
        $password = "abdopro200213";  // your mail password

        // Ignore from here

        require_once "PHPMailer/src/PHPMailer.php";
        require_once "PHPMailer/src/SMTP.php";
        require_once "PHPMailer/src/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }


        // sendmail();  // call this function when you want to

        //if (isset($_GET['sendmail'])) {
            sendmail();
        //}
?>