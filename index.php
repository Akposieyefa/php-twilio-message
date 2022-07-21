<?php
    require __DIR__ . '/vendor/autoload.php';
    
    use Orutu\Otp\Twilio;
    $twilio = new Twilio();
    
    if ( isset($_POST['submit']) ) {
        $phone_number = $_POST['phone_number'];
        $twilio->sendSms($phone_number);
    }
?>
 
<form method="post" >
    <p><input type="text" name="phone_number"/></p>
    <input type="submit" name="submit" value="Submit" />
</form>