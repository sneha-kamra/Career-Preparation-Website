<?php
session_start();
include 'config/db.php';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    body {
        background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
    }

    .mock-page {
        min-height: 100vh;
        padding: 40px 20px 80px;
    }

    .mock-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .mock-hero {
        background:
            radial-gradient(circle at top right, rgba(37, 99, 235, 0.12), transparent 30%),
            radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.10), transparent 35%),
            linear-gradient(135deg, #eff6ff, #eef2ff, #f8fafc);
        border: 1px solid #dbeafe;
        border-radius: 28px;
        padding: 40px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        margin-bottom: 26px;
    }

    .mock-badge {
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
        box-shadow:
            0 0 10px rgba(37, 99, 235, 0.18),
            0 0 25px rgba(37, 99, 235, 0.08);
    }

    .mock-hero h1 {
        font-size: 42px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .mock-hero h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .mock-hero p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        max-width: 760px;
    }

    .mock-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 22px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
    }

    .info-card h3 {
        font-size: 16px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .info-card h2 {
        font-size: 28px;
        color: #0f172a;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .info-card p {
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .test-card,
    .empty-card,
    .login-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        margin-bottom: 24px;
    }

    .question-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.04);
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .question-card:hover {
        transform: translateY(-4px);
        border-color: #93c5fd;
        box-shadow: 0 16px 30px rgba(15, 23, 42, 0.07);
    }

    .question-title {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
        line-height: 1.7;
    }

    .option {
        margin: 10px 0;
    }

    .option label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.25s ease;
        font-weight: 500;
        color: #334155;
    }

    .option label:hover {
        background: #eff6ff;
        border-color: #2563eb;
    }

    .option input {
        width: auto;
        margin: 0;
        accent-color: #2563eb;
    }

    .submit-area {
        text-align: center;
        margin-top: 28px;
    }

    .btn-primary,
    .btn-secondary {
        display: inline-block;
        text-decoration: none;
        padding: 14px 24px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
        box-shadow: 0 10px 24px rgba(37, 99, 235, 0.20);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
    }

    .btn-secondary {
        background: #ffffff;
        color: #1e293b;
        border: 1px solid #cbd5e1;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.04);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        background: #f8fafc;
    }

    .card-title {
        font-size: 28px;
        color: #0f172a;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .card-text {
        color: #475569;
        line-height: 1.8;
        font-size: 15px;
        margin-bottom: 20px;
    }

    @media (max-width: 992px) {
        .mock-info-grid {
            grid-template-columns: 1fr;
        }

        .mock-hero h1 {
            font-size: 34px;
        }
    }

    @media (max-width: 768px) {
        .mock-page {
            padding: 30px 14px 50px;
        }

        .mock-hero,
        .info-card,
        .test-card,
        .empty-card,
        .login-card,
        .question-card {
            padding: 22px;
        }

        .mock-hero h1 {
            font-size: 28px;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="mock-page">
    <div class="mock-container">

        <div class="mock-hero">
            <span class="mock-badge">FULL LENGTH MOCK TEST</span>
            <h1>Attempt Your <span>Placement Mock Test</span></h1>
            <p>
                Test your aptitude, reasoning, technical, and verbal readiness through a mixed mock test.
                Attempt the questions carefully and submit your answers to view your performance analysis.
            </p>
        </div>

        <div class="mock-info-grid">
            <div class="info-card">
                <h3>Total Questions</h3>
                <h2>10</h2>
                <p>A balanced mock test with randomly selected questions from the question bank.</p>
            </div>

            <div class="info-card">
                <h3>Test Mode</h3>
                <h2>Mixed</h2>
                <p>Questions are selected from different categories for a placement-style experience.</p>
            </div>

            <div class="info-card">
                <h3>Result Type</h3>
                <h2>Instant</h2>
                <p>Get immediate score, percentage, and readiness status after submission.</p>
            </div>
        </div>

        <?php
        if (!isset($_SESSION['user_id'])) {
            ?>
            <div class="login-card">
                <h2 class="card-title">Login Required</h2>
                <p class="card-text"><strong>Please login first to attempt the mock test.</strong></p>
                <a href="login.php" class="btn-primary">Go to Login</a>
            </div>
            <?php
        } else {

            $questions = mysqli_query($conn, "SELECT * FROM questions ORDER BY RAND() LIMIT 10");

            if (mysqli_num_rows($questions) > 0) {
                echo "<div class='test-card'>";
                echo "<form method='POST' action='results.php'>";

                $qno = 1;
                while ($q = mysqli_fetch_assoc($questions)) {

                    echo "<div class='question-card'>";
                    echo "<div class='question-title'>Q" . $qno . ". " . htmlspecialchars($q['question']) . "</div>";

                    echo "<div class='option'>
                            <label>
                                <input type='radio' name='answers[".$q['id']."]' value='A' required>
                                <span>" . htmlspecialchars($q['option_a']) . "</span>
                            </label>
                          </div>";

                    echo "<div class='option'>
                            <label>
                                <input type='radio' name='answers[".$q['id']."]' value='B'>
                                <span>" . htmlspecialchars($q['option_b']) . "</span>
                            </label>
                          </div>";

                    echo "<div class='option'>
                            <label>
                                <input type='radio' name='answers[".$q['id']."]' value='C'>
                                <span>" . htmlspecialchars($q['option_c']) . "</span>
                            </label>
                          </div>";

                    echo "<div class='option'>
                            <label>
                                <input type='radio' name='answers[".$q['id']."]' value='D'>
                                <span>" . htmlspecialchars($q['option_d']) . "</span>
                            </label>
                          </div>";

                    echo "</div>";

                    $qno++;
                }

                echo "<input type='hidden' name='category_id' value='0'>";
                echo "<input type='hidden' name='subcategory' value='Mock Test'>";

                echo "<div class='submit-area'>";
                echo "<button type='submit' name='submit_test' class='btn-primary'>Submit Mock Test</button>";
                echo "</div>";

                echo "</form>";
                echo "</div>";
            } else {
                ?>
                <div class="empty-card">
                    <h2 class="card-title">No Questions Available</h2>
                    <p class="card-text"><strong>No questions are available for the mock test right now.</strong></p>
                    <a href="dashboard.php" class="btn-secondary">Back to Dashboard</a>
                </div>
                <?php
            }
        }
        ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>