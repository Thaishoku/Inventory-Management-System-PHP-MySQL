<?php
include('../config/db_connect.php');

$sql = "SELECT item.item_id, item.item_name, item.condition_item, 
               category.category_name, location.location_name 
        FROM item 
        LEFT JOIN category ON item.category_id = category.category_id 
        LEFT JOIN location ON item.location_id = location.location_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>Items Directory</title></head>
<body>
    <h2>Inventory Items List</h2>
    <a href="add_item.php">+ Add New Item</a> | 
    <a href="../borrow/borrow.php">Borrow Item</a> | 
    <a href="../request/request_item.php">Request Item</a> | 
    <a href="../report/report_item.php">Report Issue</a> | 
    <a href="../login/logout.php">Logout</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Condition</th>
            <th>Category</th>
            <th>Location</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['item_id'] ?></td>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td><?= htmlspecialchars($row['condition_item']) ?></td>
            <td><?= htmlspecialchars($row['category_name'] ?? 'N/A') ?></td>
            <td><?= htmlspecialchars($row['location_name'] ?? 'N/A') ?></td>
            <td>
                <a href="edit_item.php?id=<?= $row['item_id'] ?>">Edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
