<?php
include('../config/db_connect.php');

if (isset($_POST['borrow'])) {
    $item_id = $_POST['item_id'];
    $borrower_id = $_POST['borrower_id'];
    $date_borrow = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO borrow (item_id, borrower_id, date_borrow) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $item_id, $borrower_id, $date_borrow);

    if ($stmt->execute()) {
        echo "<script>alert('Item borrowed successfully!'); window.location.href='return.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Borrow Item</title></head>
<body>
    <h2>Borrow Item</h2>
    <form method="POST">
        <label>Item ID:</label><br>
        <input type="number" name="item_id" required><br><br>
        <label>Borrower ID:</label><br>
        <input type="number" name="borrower_id" required><br><br>
        <button type="submit" name="borrow">Process Borrow</button>
        <a href="../items/view_items.php">Back to Dashboard</a>
    </form>
</body>
</html>
