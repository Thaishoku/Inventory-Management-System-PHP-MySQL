<?php
include('../config/db_connect.php');

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $condition = $_POST['condition_item'];
    $category_id = $_POST['category_id'];
    $location_id = $_POST['location_id'];

    $stmt = $conn->prepare("INSERT INTO item (item_name, condition_item, category_id, location_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $item_name, $condition, $category_id, $location_id);

    if ($stmt->execute()) {
        echo "<script>alert('Item added successfully!'); window.location.href='view_items.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Add New Item</title></head>
<body>
    <h2>Add Inventory Item</h2>
    <form method="POST">
        <label>Item Name:</label><br>
        <input type="text" name="item_name" required><br><br>
        <label>Condition:</label><br>
        <input type="text" name="condition_item" required><br><br>
        <label>Category ID:</label><br>
        <input type="number" name="category_id" required><br><br>
        <label>Location ID:</label><br>
        <input type="number" name="location_id" required><br><br>
        <button type="submit" name="submit">Save Item</button>
        <a href="view_items.php">Cancel</a>
    </form>
</body>
</html>
