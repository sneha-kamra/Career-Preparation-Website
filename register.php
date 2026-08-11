<?php
include 'config/db.php';

$message = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        $message = "Registration Successful! You can login now.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    body {
        background:
            linear-gradient(rgba(15, 23, 42, 0.55), rgba(15, 23, 42, 0.55)),
            url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat fixed;
        font-family: 'Poppins', sans-serif;
        color: #1e293b;
    }

    .register-page {
        min-height: 100vh;
        padding: 60px 20px 80px;
    }

    .register-wrapper {
        max-width: 1180px;
        margin: 0 auto;
    }

    .register-card {
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 28px;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.18);
        overflow: hidden;
        animation: floatCard 4.5s ease-in-out infinite;
    }

    .register-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 690px;
    }

    .register-left {
        padding: 60px 50px;
        background:
            radial-gradient(circle at top left, rgba(37, 99, 235, 0.12), transparent 30%),
            radial-gradient(circle at bottom right, rgba(124, 58, 237, 0.12), transparent 35%),
            linear-gradient(135deg, rgba(239, 246, 255, 0.88), rgba(238, 242, 255, 0.88), rgba(248, 250, 252, 0.88));
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .register-badge {
        display: inline-block;
        padding: 10px 16px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, 0.16);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.8px;
        margin-bottom: 22px;
    }

    .register-left h1 {
        font-size: 46px;
        line-height: 1.15;
        color: #0f172a;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .register-left h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .register-left p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        margin-bottom: 30px;
        max-width: 520px;
    }

    .register-points {
        display: grid;
        gap: 16px;
    }

    .register-point {
        background: rgba(255, 255, 255, 0.74);
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 18px 20px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
    }

    .register-point h3 {
        font-size: 18px;
        color: #0f172a;
        margin-bottom: 6px;
    }

    .register-point p {
        margin: 0;
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .register-right {
        padding: 60px 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.96);
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

    .alert {
        padding: 14px 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    .success {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .error {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
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

    .register-btn {
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

    .register-btn:hover {
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

    @keyframes floatCard {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-8px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    @media (max-width: 992px) {
        .register-grid {
            grid-template-columns: 1fr;
        }

        .register-left,
        .register-right {
            padding: 40px 30px;
        }

        .register-left h1 {
            font-size: 38px;
        }

        .register-card {
            animation: none;
        }
    }

    @media (max-width: 576px) {
        .register-page {
            padding: 30px 14px 50px;
        }

        .register-left,
        .register-right {
            padding: 28px 20px;
        }

        .register-left h1 {
            font-size: 30px;
        }

        .form-box h2 {
            font-size: 28px;
        }
    }
</style>

<div class="register-page">
    <div class="register-wrapper">
        <div class="register-card">
            <div class="register-grid">

                <div class="register-left">
                    <span class="register-badge">NEW STUDENT REGISTRATION</span>
                    <h1>Join <span>CareerPrep</span> Today</h1>
                    <p>
                        Create your account to start smart placement preparation with topic-wise practice,
                        mock tests, readiness tracking, and focused skill improvement.
                    </p>

                    <div class="register-points">
                        <div class="register-point">
                            <h3>Build Strong Basics</h3>
                            <p>Practice aptitude, reasoning, verbal, and technical concepts in a structured way.</p>
                        </div>

                        <div class="register-point">
                            <h3>Prepare With Confidence</h3>
                            <p>Access mock tests and performance-based insights to improve your placement readiness.</p>
                        </div>

                        <div class="register-point">
                            <h3>Grow Step by Step</h3>
                            <p>Identify weak areas, improve consistently, and move closer to placement success.</p>
                        </div>
                    </div>
                </div>

                <div class="register-right">
                    <div class="form-box">
                        <h2>Create Account</h2>
                        <p class="form-subtitle">
                            Register now to begin your preparation journey and access your CareerPrep student portal.
                        </p>

                        <?php if (!empty($message)) { ?>
                            <div class="alert <?= strpos($message, 'Successful') !== false ? 'success' : 'error' ?>">
                                <?php echo $message; ?>
                            </div>
                        <?php } ?>

                        <form method="POST">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Create your password" required>
                            </div>

                            <button type="submit" name="register" class="register-btn">Create Account</button>
                        </form>

                        <div class="extra-links">
                            Already have an account? <a href="login.php">Login here</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>