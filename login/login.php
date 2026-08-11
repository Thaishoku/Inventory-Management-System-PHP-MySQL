<?php
include('../config/db_connect.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if ($password === $row['password']) {
            $otp = sprintf("%06d", mt_rand(1, 999999));
            $_SESSION['temp_user'] = $row['user_id'];
            $_SESSION['temp_email'] = $row['email'];

            $stmt_otp = $conn->prepare("INSERT INTO otp_verification (email, otp_code) VALUES (?, ?)");
            $stmt_otp->bind_param("ss", $row['email'], $otp);
            $stmt_otp->execute();

            echo "<script>alert('Your OTP Code is: $otp'); window.location.href='otp_verify.php';</script>";
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>IMS Login</title></head>
<body>
    <h2>Inventory Management System Login</h2>
    <form method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
