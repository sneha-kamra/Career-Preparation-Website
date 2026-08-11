<?php
session_start();
include 'config/db.php';

$message = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Invalid Email or Password!";
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    body {
        background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
    }

    .login-page {
        min-height: 100vh;
        padding: 60px 20px 80px;
    }

    .login-wrapper {
        max-width: 1180px;
        margin: 0 auto;
    }

    .login-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.35);
    border-radius: 26px;
    box-shadow: 0 25px 60px rgba(15, 23, 42, 0.18);
    overflow: hidden;

    /* ✨ floating effect */
    animation: floatCard 4.5s ease-in-out infinite;
}

    .login-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 680px;
    }

    .login-left {
        padding: 60px 50px;
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, 0.10), transparent 30%),
            radial-gradient(circle at bottom right, rgba(124, 58, 237, 0.10), transparent 35%),
            linear-gradient(135deg, #eff6ff, #eef2ff, #f8fafc);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-badge {
        display: inline-block;
        padding: 10px 16px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, 0.15);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.8px;
        margin-bottom: 22px;
    }

    .login-left h1 {
        font-size: 46px;
        line-height: 1.15;
        color: #0f172a;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .login-left h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .login-left p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 30px;
        max-width: 520px;
    }

    .login-points {
        display: grid;
        gap: 16px;
    }

    .login-point {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 18px 20px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
    }

    .login-point h3 {
        font-size: 18px;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .login-point p {
        margin: 0;
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .login-right {
        padding: 60px 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
    }

    .form-box {
        width: 100%;
        max-width: 460px;
    }

    .form-box h2 {
        font-size: 36px;
        color: #1e3a8a;
        margin-bottom: 10px;
        font-weight: 800;
    }

    .form-subtitle {
        color: #64748b;
        margin-bottom: 28px;
        font-size: 15px;
        line-height: 1.7;
    }

    .alert-error {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 15px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control {
        width: 100%;
        padding: 15px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 14px;
        font-size: 15px;
        outline: none;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #0f172a;
    }

    .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    .login-btn {
        width: 100%;
        border: none;
        padding: 15px 18px;
        border-radius: 14px;
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.22);
        margin-top: 8px;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(37, 99, 235, 0.28);
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
    }

    .extra-links {
        margin-top: 22px;
        text-align: center;
        color: #64748b;
        font-size: 14px;
    }

    .extra-links a {
        color: #2563eb;
        text-decoration: none;
        font-weight: 700;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .login-grid {
            grid-template-columns: 1fr;
        }

        .login-left,
        .login-right {
            padding: 40px 30px;
        }

        .login-left h1 {
            font-size: 38px;
        }
    }

    @media (max-width: 576px) {
        .login-page {
            padding: 30px 14px 50px;
        }

        .login-left,
        .login-right {
            padding: 28px 20px;
        }

        .login-left h1 {
            font-size: 30px;
        }

        .form-box h2 {
            font-size: 28px;
        }
    }
</style>

<div class="login-page">
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-grid">

                <div class="login-left">
                    <span class="login-badge">STUDENT LOGIN PORTAL</span>
                    <h1>Welcome Back to <span>CareerPrep</span></h1>
                    <p>
                        Access your placement preparation dashboard to continue MCQ practice,
                        attempt mock tests, and track your readiness score with smart analysis.
                    </p>

                    <div class="login-points">
                        <div class="login-point">
                            <h3>Practice Smarter</h3>
                            <p>Improve aptitude, reasoning, technical, and verbal performance through structured preparation.</p>
                        </div>

                        <div class="login-point">
                            <h3>Track Readiness</h3>
                            <p>Monitor your progress with performance-based readiness insights and improvement tracking.</p>
                        </div>

                        <div class="login-point">
                            <h3>Identify Skill Gaps</h3>
                            <p>Understand weaker sections clearly and focus on the areas that need more preparation.</p>
                        </div>
                    </div>
                </div>

                <div class="login-right">
                    <div class="form-box">
                        <h2>Student Login</h2>
                        <p class="form-subtitle">
                            Sign in to continue your preparation journey and access your personalized dashboard.
                        </p>

                        <?php if (!empty($message)) { ?>
                            <div class="alert-error"><?php echo $message; ?></div>
                        <?php } ?>

                        <form method="POST">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                            </div>

                            <button type="submit" name="login" class="login-btn">Login to Account</button>
                        </form>

                        <div class="extra-links">
                            Don’t have an account? <a href="register.php">Create one here</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>