<?php
if(isset($_POST['contact'])) {
    function mail_callback($errno, $errstr) {
        echo "<h2>Fatal error!</h2>\n";
        echo '<p>Error ' . $errno . ': ' . substr(strrchr($errstr, 'mail.php):'), 2), "</p>\n";
        echo "<h4>Please, contact us at dev@lara.click</h4>\n";
        exit(1);
    }

    $mail_script = 'http://lara.click/mail.php';

    $options = array(
        'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($_POST),
            )
        );

    $context = stream_context_create($options);

    set_error_handler('mail_callback', E_WARNING);
    $response = file_get_contents($mail_script, false, $context);
    restore_error_handler();

    if($response == 'sent') {
        echo "<h3>Message has been sent.<br/>\nThank you</h3>";
    } else {
        echo "<h3>Message could not be sent.</h3>\n";
        echo "<p>Error:" . $response . "</p>\n";
    }
}
?>

<form method="POST">
    <p>Name: <input type="text" name="name" required></p>
    <p>Email: &nbsp;<input type="email" name="email" required></p>
    <p>Message: </p>
    <textarea name="message" rows="6" cols="40" required></textarea>
    <br />
    <input type="submit" name="contact" value="Send"> <input type="reset" value="Clear">
</form>
