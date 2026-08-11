<?php
include('../config/db_connect.php');

if (isset($_POST['return'])) {
    $borrow_id = $_POST['borrow_id'];
    $date_returned = date('Y-m-d');

    $stmt = $conn->prepare("UPDATE borrow SET date_returned = ? WHERE borrow_id = ?");
    $stmt->bind_param("si", $date_returned, $borrow_id);
    $stmt->execute();
    echo "<script>alert('Item marked as returned!');</script>";
}

$sql = "SELECT borrow.borrow_id, item.item_name, borrower.borrower_name, borrow.date_borrow, borrow.date_returned 
        FROM borrow 
        JOIN item ON borrow.item_id = item.item_id 
        JOIN borrower ON borrow.borrower_id = borrower.borrower_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head><title>Borrow Records & Return</title></head>
<body>
    <h2>Active Borrow Records</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Borrow ID</th>
            <th>Item</th>
            <th>Borrower</th>
            <th>Date Borrowed</th>
            <th>Date Returned</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['borrow_id'] ?></td>
            <td><?= htmlspecialchars($row['item_name']) ?></td>
            <td><?= htmlspecialchars($row['borrower_name']) ?></td>
            <td><?= $row['date_borrow'] ?></td>
            <td><?= $row['date_returned'] ?? 'Not Returned' ?></td>
            <td>
                <?php if (!$row['date_returned']): ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="borrow_id" value="<?= $row['borrow_id'] ?>">
                    <button type="submit" name="return">Return</button>
                </form>
                <?php else: ?>
                Done
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br><a href="../items/view_items.php">Back to Dashboard</a>
</body>
</html>
