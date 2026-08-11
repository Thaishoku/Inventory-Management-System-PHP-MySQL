<?php
include('../config/db_connect.php');

if (isset($_POST['report'])) {
    $item_id = $_POST['item_id'];
    $reporter_name = $_POST['reporter_name'];
    $description = $_POST['description'];
    $report_date = date('Y-m-d');

    $stmt = $conn->prepare("INSERT INTO reports (item_id, report_date, description, reporter_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $item_id, $report_date, $description, $reporter_name);

    if ($stmt->execute()) {
        echo "<script>alert('Issue report submitted!'); window.location.href='../items/view_items.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Report Damaged/Missing Item</title></head>
<body>
    <h2>Report Damaged or Missing Item</h2>
    <form method="POST">
        <label>Item ID:</label><br>
        <input type="number" name="item_id" required><br><br>
        <label>Reporter Name:</label><br>
        <input type="text" name="reporter_name" required><br><br>
        <label>Issue Description:</label><br>
        <textarea name="description" rows="4" required></textarea><br><br>
        <button type="submit" name="report">Submit Report</button>
        <a href="../items/view_items.php">Back to Dashboard</a>
    </form>
</body>
</html>
