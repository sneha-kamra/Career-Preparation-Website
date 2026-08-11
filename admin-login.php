<?php
session_start();
include '../config/db.php';

$error = "";

if (isset($_POST['admin_login'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = mysqli_real_escape_string($conn, trim($_POST['password']));

    $query = mysqli_query($conn, "
        SELECT * FROM admin_users
        WHERE username = '$username' AND password = '$password'
    ");

    if (mysqli_num_rows($query) == 1) {
        $admin = mysqli_fetch_assoc($query);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header("Location: admin-messages.php");
        exit();
    } else {
        $error = "Invalid admin username or password.";
    }
}
?>

<?php include '../includes/header.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
    font-family: 'Segoe UI', sans-serif;
    color: #1e293b;
}
.admin-login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px 14px;
}
.admin-login-card {
    width: 100%;
    max-width: 500px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
}
.admin-login-card h1 {
    font-size: 32px;
    margin-bottom: 10px;
    color: #0f172a;
    font-weight: 800;
}
.admin-login-card p {
    color: #475569;
    line-height: 1.7;
    margin-bottom: 22px;
}
.form-group {
    margin-bottom: 18px;
}
.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 700;
    color: #334155;
}
.form-control {
    width: 100%;
    padding: 14px 16px;
    border-radius: 14px;
    border: 1px solid #cbd5e1;
    font-size: 15px;
    box-sizing: border-box;
}
.form-control:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
}
.btn-login {
    display: inline-block;
    width: 100%;
    border: none;
    cursor: pointer;
    padding: 14px 20px;
    border-radius: 14px;
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    color: #ffffff;
    font-weight: 700;
    font-size: 15px;
}
.error-msg {
    background: linear-gradient(135deg, #fef2f2, #fff1f2);
    color: #b91c1c;
    border: 1px solid #fecaca;
    padding: 14px 16px;
    border-radius: 14px;
    margin-bottom: 18px;
    font-weight: 700;
}
.back-link {
    display: inline-block;
    margin-top: 16px;
    color: #2563eb;
    text-decoration: none;
    font-weight: 600;
}
</style>

<div class="admin-login-page">
    <div class="admin-login-card">
        <h1>Admin Login</h1>
        <p>Login to access the admin support panel and manage student messages.</p>

        <?php if ($error != "") { ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php } ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Admin Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter admin username" required>
            </div>

            <div class="form-group">
                <label for="password">Admin Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter admin password" required>
            </div>

            <button type="submit" name="admin_login" class="btn-login">Login</button>
        </form>

        <a href="../index.php" class="back-link">← Back to Website</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>