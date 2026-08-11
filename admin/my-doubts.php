<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<div class="container">
    <h2>My Doubts & Replies</h2>
    <p>Here you can see your submitted doubts and admin responses.</p>

    <?php
    $query = mysqli_query($conn, "SELECT * FROM contact_messages WHERE user_id='$user_id' ORDER BY id DESC");

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
    ?>

        <div style="border:1px solid #ddd; padding:15px; margin-bottom:20px; border-radius:10px;">
            
            <h3><?php echo $row['subject']; ?></h3>

            <p><strong>Your Message:</strong><br>
            <?php echo nl2br(htmlspecialchars($row['message'])); ?></p>

            <?php if (!empty($row['reply_message'])) { ?>
                <p style="color:green;"><strong>Admin Reply:</strong><br>
                <?php echo nl2br(htmlspecialchars($row['reply_message'])); ?></p>
            <?php } else { ?>
                <p style="color:red;"><strong>Status:</strong> Not Replied Yet</p>
            <?php } ?>

            <p><small><?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?></small></p>
        </div>

    <?php
        }
    } else {
        echo "<p>No doubts submitted yet.</p>";
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>