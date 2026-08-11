<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin-login.php");
    exit();
}

$success = "";

/* Delete message */
if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete']);
    mysqli_query($conn, "DELETE FROM contact_messages WHERE id = '$delete_id'");
    header("Location: admin-messages.php?deleted=1");
    exit();
}

/* Reply to message */
if (isset($_POST['send_reply'])) {
    $message_id = mysqli_real_escape_string($conn, $_POST['message_id']);
    $reply_message = mysqli_real_escape_string($conn, trim($_POST['reply_message']));

    if ($reply_message != "") {
        mysqli_query($conn, "
            UPDATE contact_messages
            SET reply_message = '$reply_message'
            WHERE id = '$message_id'
        ");
        header("Location: admin-messages.php?replied=1");
        exit();
    }
}

if (isset($_GET['deleted'])) {
    $success = "Message deleted successfully.";
}

if (isset($_GET['replied'])) {
    $success = "Reply saved successfully.";
}
?>

<?php include '../includes/header.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
    font-family: 'Segoe UI', sans-serif;
    color: #1e293b;
}
.messages-page {
    min-height: 100vh;
    padding: 50px 20px 80px;
}
.messages-container {
    max-width: 1250px;
    margin: 0 auto;
}
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.admin-badge {
    display: inline-block;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(37, 99, 235, 0.08);
    color: #2563eb;
    border: 1px solid rgba(37, 99, 235, 0.18);
    font-size: 13px;
    font-weight: 700;
}
.logout-btn {
    display: inline-block;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 12px;
    background: linear-gradient(90deg, #dc2626, #ea580c);
    color: #ffffff;
    font-weight: 700;
}
.messages-hero {
    background:
        radial-gradient(circle at top right, rgba(37, 99, 235, 0.12), transparent 30%),
        radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.10), transparent 35%),
        linear-gradient(135deg, #eff6ff, #eef2ff, #f8fafc);
    border: 1px solid #dbeafe;
    border-radius: 28px;
    padding: 40px;
    box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
    margin-bottom: 28px;
}
.messages-hero h1 {
    font-size: 38px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 12px;
}
.messages-hero p {
    font-size: 16px;
    color: #475569;
    line-height: 1.8;
}
.success-msg {
    background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
    color: #166534;
    border: 1px solid #bbf7d0;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 18px;
    font-weight: 700;
}
.messages-list {
    display: grid;
    gap: 20px;
}
.message-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
}
.message-header {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}
.message-header h2 {
    font-size: 22px;
    color: #0f172a;
    font-weight: 800;
    margin: 0 0 8px;
}
.meta {
    color: #475569;
    font-size: 14px;
    line-height: 1.7;
}
.type-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
}
.doubt { background: #dbeafe; color: #1d4ed8; border: 1px solid #bfdbfe; }
.feedback { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
.issue { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
.suggestion { background: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
.message-box,
.reply-box {
    margin-top: 14px;
    background: #f8fbff;
    border: 1px solid #dbeafe;
    border-radius: 16px;
    padding: 16px;
}
.message-box strong,
.reply-box strong {
    display: block;
    margin-bottom: 8px;
    color: #0f172a;
}
.message-box p,
.reply-box p {
    margin: 0;
    color: #334155;
    line-height: 1.8;
}
.reply-form {
    margin-top: 18px;
}
.reply-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
    color: #334155;
}
.reply-form textarea {
    width: 100%;
    min-height: 110px;
    padding: 14px 16px;
    border-radius: 14px;
    border: 1px solid #cbd5e1;
    font-size: 15px;
    box-sizing: border-box;
    resize: vertical;
}
.reply-form textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
}
.card-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 16px;
}
.btn-reply,
.btn-delete {
    display: inline-block;
    border: none;
    cursor: pointer;
    text-decoration: none;
    padding: 12px 18px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
}
.btn-reply {
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    color: #ffffff;
}
.btn-delete {
    background: linear-gradient(90deg, #dc2626, #ea580c);
    color: #ffffff;
}
.empty-box {
    text-align: center;
    padding: 30px;
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
}
@media (max-width: 768px) {
    .messages-page {
        padding: 30px 14px 50px;
    }
    .messages-hero,
    .message-card {
        padding: 22px;
    }
    .messages-hero h1 {
        font-size: 28px;
    }
}
</style>

<div class="messages-page">
    <div class="messages-container">

        <div class="topbar">
            <span class="admin-badge">Logged in as: <?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
            <a href="admin-logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="messages-hero">
            <h1>Student Queries & Replies</h1>
            <p>View all doubts, feedback, issues, and suggestions. You can reply to each message or delete it from the system.</p>
        </div>

        <?php if ($success != "") { ?>
            <div class="success-msg"><?php echo $success; ?></div>
        <?php } ?>

        <?php
        $query = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");

        if (mysqli_num_rows($query) > 0) {
            echo "<div class='messages-list'>";

            while ($row = mysqli_fetch_assoc($query)) {
                $type_class = "";
                if ($row['query_type'] == "Doubt") $type_class = "doubt";
                elseif ($row['query_type'] == "Feedback") $type_class = "feedback";
                elseif ($row['query_type'] == "Report Issue") $type_class = "issue";
                elseif ($row['query_type'] == "Suggestion") $type_class = "suggestion";
                ?>

                <div class="message-card">
                    <div class="message-header">
                        <div>
                            <h2><?php echo htmlspecialchars($row['subject']); ?></h2>
                            <div class="meta">
                                <strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?><br>
                                <strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?><br>
                                <strong>Date:</strong> <?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?>
                            </div>
                        </div>
                        <div>
                            <span class="type-badge <?php echo $type_class; ?>">
                                <?php echo htmlspecialchars($row['query_type']); ?>
                            </span>
                        </div>
                    </div>

                    <div class="message-box">
                        <strong>Student Message</strong>
                        <p><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
                    </div>

                    <?php if (!empty($row['reply_message'])) { ?>
                        <div class="reply-box">
                            <strong>Admin Reply</strong>
                            <p><?php echo nl2br(htmlspecialchars($row['reply_message'])); ?></p>
                        </div>
                    <?php } ?>

                    <form method="POST" action="" class="reply-form">
                        <input type="hidden" name="message_id" value="<?php echo $row['id']; ?>">
                        <label for="reply_<?php echo $row['id']; ?>">Reply Message</label>
                        <textarea name="reply_message" id="reply_<?php echo $row['id']; ?>" placeholder="Write your reply here..."><?php echo htmlspecialchars($row['reply_message']); ?></textarea>

                        <div class="card-actions">
                            <button type="submit" name="send_reply" class="btn-reply">Save Reply</button>
                            <a href="admin-messages.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this message?');">Delete</a>
                        </div>
                    </form>
                </div>

                <?php
            }

            echo "</div>";
        } else {
            echo "<div class='empty-box'><h3>No messages yet</h3><p>No student queries have been submitted yet.</p></div>";
        }
        ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>