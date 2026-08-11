<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : "";
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    body {
        background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
    }

    .contact-page {
        min-height: 100vh;
        padding: 50px 20px 80px;
    }

    .contact-container {
        max-width: 1150px;
        margin: 0 auto;
    }

    .contact-hero {
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

    .contact-badge {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 999px;
        background: rgba(37, 99, 235, 0.08);
        color: #2563eb;
        border: 1px solid rgba(37, 99, 235, 0.18);
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.8px;
        margin-bottom: 18px;
    }

    .contact-hero h1 {
        font-size: 42px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .contact-hero h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .contact-hero p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        max-width: 760px;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.1fr;
        gap: 24px;
    }

    .info-card,
    .form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
    }

    .info-card h2,
    .form-card h2 {
        font-size: 28px;
        color: #0f172a;
        margin-bottom: 14px;
        font-weight: 800;
    }

    .info-card p,
    .form-card p {
        color: #475569;
        line-height: 1.8;
        font-size: 15px;
    }

    .info-box {
        margin-top: 22px;
        display: grid;
        gap: 16px;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 16px;
        border-radius: 18px;
        background: linear-gradient(135deg, #f8fbff, #eef4ff);
        border: 1px solid #dbeafe;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        border: 1px solid #dbeafe;
    }

    .info-text h3 {
        margin: 0 0 6px;
        font-size: 18px;
        color: #0f172a;
        font-weight: 800;
    }

    .info-text p {
        margin: 0;
        color: #475569;
        font-size: 14px;
        line-height: 1.7;
    }

    .form-group {
        margin-bottom: 18px;
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
        padding: 14px 16px;
        border-radius: 14px;
        border: 1px solid #cbd5e1;
        font-size: 15px;
        color: #0f172a;
        background: #ffffff;
        transition: all 0.3s ease;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.10);
    }

    textarea.form-control {
        min-height: 140px;
        resize: vertical;
    }

    .submit-btn {
        display: inline-block;
        border: none;
        cursor: pointer;
        padding: 14px 24px;
        border-radius: 14px;
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
        font-weight: 700;
        font-size: 15px;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.20);
        transition: all 0.3s ease;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
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

    .error-msg {
        background: linear-gradient(135deg, #fef2f2, #fff1f2);
        color: #b91c1c;
        border: 1px solid #fecaca;
        padding: 14px 16px;
        border-radius: 14px;
        margin-bottom: 18px;
        font-weight: 700;
    }

    @media (max-width: 992px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .contact-hero h1 {
            font-size: 34px;
        }
    }

    @media (max-width: 768px) {
        .contact-page {
            padding: 30px 14px 50px;
        }

        .contact-hero,
        .info-card,
        .form-card {
            padding: 22px;
        }

        .contact-hero h1 {
            font-size: 28px;
        }
    }
</style>

<?php
$success = "";
$error = "";

if (isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $query_type = mysqli_real_escape_string($conn, trim($_POST['query_type']));
    $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));

    if ($name == "" || $email == "" || $query_type == "" || $subject == "" || $message == "") {
        $error = "Please fill all fields before submitting.";
    } else {
        $insert = mysqli_query($conn, "
            INSERT INTO contact_messages (user_id, name, email, query_type, subject, message)
            VALUES ('$user_id', '$name', '$email', '$query_type', '$subject', '$message')
        ");

        if ($insert) {
            $success = "Your message has been submitted successfully.";
        } else {
            $error = "Message could not be submitted. Please check your database table structure.";
        }
    }
}
?>

<div class="contact-page">
    <div class="contact-container">

        <div class="contact-hero">
            <span class="contact-badge">DOUBT & SUPPORT SYSTEM</span>
            <h1>Ask Your <span>Doubt or Feedback</span></h1>
            <p>
                Use this support form to ask doubts, report incorrect questions, share feedback, or send suggestions related to your placement preparation experience.
            </p>
        </div>

        <div class="contact-grid">
            <div class="info-card">
                <h2>How This Module Helps</h2>
                <p>
                    This page works as a smart student support system. It helps students communicate their doubts, suggestions, and issues directly through one professional form.
                </p>

                <div class="info-box">
                    <div class="info-item">
                        <div class="info-icon">❓</div>
                        <div class="info-text">
                            <h3>Doubt Submission</h3>
                            <p>Students can ask doubts related to aptitude, reasoning, technical MCQs, mock tests, or interview preparation.</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">⚠️</div>
                        <div class="info-text">
                            <h3>Issue Reporting</h3>
                            <p>Students can report incorrect answers, wrong questions, or technical problems in the platform.</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">💡</div>
                        <div class="info-text">
                            <h3>Feedback & Suggestions</h3>
                            <p>Students can share ideas for improving the dashboard, practice modules, mock tests, and analytics system.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h2>Submit Your Query</h2>
                <p>Fill the form below to send your doubt, issue, feedback, or suggestion.</p>

                <?php if ($success != "") { ?>
                    <div class="success-msg"><?php echo $success; ?></div>
                <?php } ?>

                <?php if ($error != "") { ?>
                    <div class="error-msg"><?php echo $error; ?></div>
                <?php } ?>

                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" value="<?php echo htmlspecialchars($user_name); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email address" value="<?php echo htmlspecialchars($user_email); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="query_type">Query Type</label>
                        <select name="query_type" id="query_type" class="form-control" required>
                            <option value="">Select Query Type</option>
                            <option value="Doubt">Doubt</option>
                            <option value="Feedback">Feedback</option>
                            <option value="Report Issue">Report Issue</option>
                            <option value="Suggestion">Suggestion</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter the subject of your query" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" class="form-control" placeholder="Write your doubt, issue, feedback, or suggestion here..." required></textarea>
                    </div>

                    <button type="submit" name="send_message" class="submit-btn">Submit Query</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>