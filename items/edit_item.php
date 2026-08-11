<?php
include('../config/db_connect.php');

$item_id = $_GET['id'] ?? null;

if (isset($_POST['update'])) {
    $item_name = $_POST['item_name'];
    $condition = $_POST['condition_item'];

    $stmt = $conn->prepare("UPDATE item SET item_name = ?, condition_item = ? WHERE item_id = ?");
    $stmt->bind_param("ssi", $item_name, $condition, $item_id);
    $stmt->execute();
    echo "<script>alert('Item updated successfully!'); window.location.href='view_items.php';</script>";
}

if (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM item WHERE item_id = ?");
    $stmt->bind_param("i", $item_id);
    $stmt->execute();
    echo "<script>alert('Item deleted!'); window.location.href='view_items.php';</script>";
}

$stmt = $conn->prepare("SELECT * FROM item WHERE item_id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head><title>Edit Item</title></head>
<body>
    <h2>Edit / Delete Item</h2>
    <form method="POST">
        <label>Item Name:</label><br>
        <input type="text" name="item_name" value="<?= htmlspecialchars($item['item_name']) ?>" required><br><br>
        <label>Condition:</label><br>
        <input type="text" name="condition_item" value="<?= htmlspecialchars($item['condition_item']) ?>" required><br><br>
        <button type="submit" name="update">Update Item</button>
        <button type="submit" name="delete" onclick="return confirm('Delete this item?')">Delete Item</button>
        <a href="view_items.php">Back</a>
    </form>
</body>
</html>
