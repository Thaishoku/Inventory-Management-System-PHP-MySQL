<?php
include('../config/db_connect.php');

if (!isset($_SESSION['temp_email'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['verify'])) {
    $otp_input = $_POST['otp_code'];
    $email = $_SESSION['temp_email'];

    $stmt = $conn->prepare("SELECT id FROM otp_verification WHERE email = ? AND otp_code = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("ss", $email, $otp_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['user_id'] = $_SESSION['temp_user'];
        unset($_SESSION['temp_user']);
        unset($_SESSION['temp_email']);
        echo "<script>alert('Verification Successful!'); window.location.href='../items/view_items.php';</script>";
    } else {
        echo "<script>alert('Invalid OTP Code!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>OTP Verification</title></head>
<body>
    <h2>Enter Verification Code</h2>
    <form method="POST">
        <label>6-Digit OTP:</label><br>
        <input type="text" name="otp_code" maxlength="6" required><br><br>
        <button type="submit" name="verify">Verify</button>
    </form>
</body>
</html>
