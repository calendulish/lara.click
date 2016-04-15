<?php
if(isset($_POST['contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $formcontent="From: $name\nMessage: $message";
    $recipient = "dev@lara.click";
    $subject = "Contact from lara.click";
    $mailheader = "From: $email \r\n";
    mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
    echo "Thank You!";
} else {
?>

<form method="POST">
    <p>Nome: <input type="text" name="name" required></p>
    <p>Email: &nbsp;<input type="email" name="email" required></p>
    <p>Mensagem: </p>
    <textarea name="message" rows="6" cols="40" required></textarea>
    <br />
    <input type="submit" name="contact" value="Enviar"> <input type="reset" value="Limpar">
</form>

<?php
}
?>
