<?php
include('../config/db_connect.php');

if (isset($_POST['request'])) {
    $user_id = $_SESSION['user_id'] ?? 1;
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $request_date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO requests (user_id, item_id, request_date, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iisi", $user_id, $item_id, $request_date, $quantity);

    if ($stmt->execute()) {
        echo "<script>alert('Request submitted successfully!'); window.location.href='../items/view_items.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Request Item</title></head>
<body>
    <h2>Submit Item Request</h2>
    <form method="POST">
        <label>Item ID:</label><br>
        <input type="number" name="item_id" required><br><br>
        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1" required><br><br>
        <button type="submit" name="request">Submit Request</button>
        <a href="../items/view_items.php">Back to Dashboard</a>
    </form>
</body>
</html>
