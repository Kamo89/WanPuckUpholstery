<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debug (optional, you can remove this later)
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $service = $_POST['service'];
    $details = $_POST['details'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'kamohelomosiya89@gmail.com';
        $mail->Password = 'ghth ulfq cevs vkey'; // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('kamohelomosiya89@gmail.com', 'Website Quote Request');
        $mail->addAddress('owneremail@example.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Quote Request';
        $mail->Body    = "
            <h2>Quote Request Details</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Service:</strong> {$service}</p>
            <p><strong>Details:</strong> {$details}</p>
        ";

        // Handle file attachment
        if (isset($_FILES['images']) && $_FILES['images']['error'] == 0) {
            $mail->addAttachment($_FILES['images']['tmp_name'], $_FILES['images']['name']);
        }

        $mail->send();
        echo "✅ Your quote request has been sent successfully.";
    } catch (Exception $e) {
        echo "❌ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
