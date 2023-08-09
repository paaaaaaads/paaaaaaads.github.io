<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $to = "padronneil28@gmail.com"; 

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Compose the email body
    $email_body = "
    <h3>From: $name</h3>
    <p>$message</p>
    ";

    // Send the email
    if (mail($to, $subject, $email_body, $headers)) {
        echo "success"; // Return a success message to the client
    } else {
        echo "error"; // Return an error message to the client
    }
}
?>
