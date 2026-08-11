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

    .result-page {
        min-height: 100vh;
        padding: 50px 20px 80px;
    }

    .result-container {
        max-width: 1100px;
        margin: 0 auto;
    }

    .result-hero {
        background:
            radial-gradient(circle at top right, rgba(37, 99, 235, 0.12), transparent 30%),
            radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.10), transparent 35%),
            linear-gradient(135deg, #eff6ff, #eef2ff, #f8fafc);
        border: 1px solid #dbeafe;
        border-radius: 28px;
        padding: 38px;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
        margin-bottom: 28px;
    }

    .result-badge {
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

    .result-hero h1 {
        font-size: 40px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .result-hero h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .result-hero p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        max-width: 760px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .summary-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        transition: all 0.3s ease;
    }

    .summary-card:hover {
        transform: translateY(-5px);
        border-color: #93c5fd;
        box-shadow: 0 18px 34px rgba(15, 23, 42, 0.08);
    }

    .summary-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 14px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        border: 1px solid #dbeafe;
    }

    .summary-card h3 {
        font-size: 15px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .summary-card h2 {
        font-size: 30px;
        color: #0f172a;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .summary-card p {
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .status-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        margin-bottom: 28px;
    }

    .status-title {
        font-size: 26px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 16px;
    }

    .status-box {
        border-radius: 18px;
        padding: 22px;
        font-weight: 700;
        font-size: 18px;
        line-height: 1.7;
    }

    .status-excellent {
        background: linear-gradient(135deg, #ecfdf5, #f0fdf4);
        color: #047857;
        border: 1px solid #a7f3d0;
    }

    .status-good {
        background: linear-gradient(135deg, #fff7ed, #fffbeb);
        color: #c2410c;
        border: 1px solid #fdba74;
    }

    .status-poor {
        background: linear-gradient(135deg, #fef2f2, #fff1f2);
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    .info-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        margin-bottom: 28px;
    }

    .info-card h2 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .info-card p {
        color: #475569;
        line-height: 1.8;
        font-size: 15px;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 24px;
    }

    .btn-primary,
    .btn-secondary {
        display: inline-block;
        text-decoration: none;
        padding: 13px 22px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
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
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        background: #f8fafc;
    }

    .empty-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
    }

    .empty-card h2 {
        font-size: 28px;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .empty-card p {
        color: #475569;
        line-height: 1.7;
        font-size: 15px;
    }

    @media (max-width: 992px) {
        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .result-hero h1 {
            font-size: 32px;
        }
    }

    @media (max-width: 768px) {
        .result-page {
            padding: 30px 14px 50px;
        }

        .result-hero,
        .summary-card,
        .status-card,
        .info-card,
        .empty-card {
            padding: 22px;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .result-hero h1 {
            font-size: 28px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="result-page">
    <div class="result-container">

        <?php
        if (!isset($_SESSION['user_id'])) {
        ?>
            <div class="empty-card">
                <h2>Result</h2>
                <p><strong>Please login first.</strong></p>
                <div class="action-buttons">
                    <a href="login.php" class="btn-primary">Go to Login</a>
                    <a href="index.php" class="btn-secondary">Back to Home</a>
                </div>
            </div>
        <?php
        } elseif (isset($_POST['submit_test']) && isset($_POST['answers'])) {

            $user_id = $_SESSION['user_id'];
            $answers = $_POST['answers'];
            $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);
            $subcategory = mysqli_real_escape_string($conn, $_POST['subcategory']);

            $score = 0;
            $total_questions = count($answers);

            $subcategory_stats = [];

            foreach ($answers as $question_id => $selected_option) {
                $question_id = mysqli_real_escape_string($conn, $question_id);
                $selected_option = mysqli_real_escape_string($conn, $selected_option);

                $result = mysqli_query($conn, "SELECT correct_option, subcategory, category_id FROM questions WHERE id='$question_id'");
                $row = mysqli_fetch_assoc($result);

                if ($row) {
                    $question_subcategory = $row['subcategory'];
                    $question_category_id = $row['category_id'];

                    if (!isset($subcategory_stats[$question_subcategory])) {
                        $subcategory_stats[$question_subcategory] = [
                            'category_id' => $question_category_id,
                            'total' => 0,
                            'correct' => 0
                        ];
                    }

                    $subcategory_stats[$question_subcategory]['total']++;

                    if ($selected_option == $row['correct_option']) {
                        $score++;
                        $subcategory_stats[$question_subcategory]['correct']++;
                    }
                }
            }

            $wrong_answers = $total_questions - $score;
            $percentage = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;

            mysqli_query($conn, "INSERT INTO results (user_id, category_id, subcategory, total_questions, correct_answers, percentage)
                                 VALUES ('$user_id', '$category_id', '$subcategory', '$total_questions', '$score', '$percentage')");

            if ($subcategory == "Mock Test") {
                foreach ($subcategory_stats as $subcat => $data) {
                    $sub_total = $data['total'];
                    $sub_correct = $data['correct'];
                    $sub_percentage = ($sub_total > 0) ? ($sub_correct / $sub_total) * 100 : 0;
                    $sub_category_id = $data['category_id'];
                    $safe_subcat = mysqli_real_escape_string($conn, $subcat);

                    mysqli_query($conn, "INSERT INTO results (user_id, category_id, subcategory, total_questions, correct_answers, percentage)
                                         VALUES ('$user_id', '$sub_category_id', '$safe_subcat', '$sub_total', '$sub_correct', '$sub_percentage')");
                }
            }

            $result_title = ($subcategory == "Mock Test") ? "Mock Test Result" : "Practice Result";
        ?>

            <div class="result-hero">
                <span class="result-badge"><?php echo ($subcategory == "Mock Test") ? "MOCK TEST ANALYSIS" : "PRACTICE ANALYSIS"; ?></span>
                <h1><?php echo $result_title; ?> for <span><?php echo htmlspecialchars($subcategory); ?></span></h1>
                <p>
                    Here is your performance summary based on the answers you submitted. Review your score,
                    understand your readiness level, and continue improving with smart practice.
                </p>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-icon">📘</div>
                    <h3>Total Questions</h3>
                    <h2><?php echo $total_questions; ?></h2>
                    <p>Total number of questions attempted in this session.</p>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">✅</div>
                    <h3>Correct Answers</h3>
                    <h2><?php echo $score; ?></h2>
                    <p>Questions answered correctly based on the stored answer key.</p>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">❌</div>
                    <h3>Wrong Answers</h3>
                    <h2><?php echo $wrong_answers; ?></h2>
                    <p>Questions that need more improvement and revision.</p>
                </div>

                <div class="summary-card">
                    <div class="summary-icon">📊</div>
                    <h3>Percentage</h3>
                    <h2><?php echo number_format($percentage, 2); ?>%</h2>
                    <p>Your overall performance percentage in this attempt.</p>
                </div>
            </div>

            <div class="status-card">
                <h2 class="status-title">Readiness Status</h2>

                <?php
                if ($percentage >= 80) {
                    echo "<div class='status-box status-excellent'>Excellent! You are placement ready 🚀 Keep maintaining this strong performance and continue practicing consistently.</div>";
                } elseif ($percentage >= 50) {
                    echo "<div class='status-box status-good'>Good, but you still need improvement ⚡ You are on the right track, but more focused practice will help you perform better.</div>";
                } else {
                    echo "<div class='status-box status-poor'>Needs improvement ❗ Focus more on this topic and strengthen your understanding before your next attempt.</div>";
                }
                ?>
            </div>

            <div class="info-card">
                <h2>What You Should Do Next</h2>
                <p>
                    Review this result carefully and continue practicing the same topic to improve your score.
                    Consistent practice and repeated mock attempts will increase your readiness and confidence
                    for actual placement assessments.
                </p>

                <div class="action-buttons">
                    <?php
                    if ($subcategory == "Mock Test") {
                        echo "<a href='mock-test.php' class='btn-primary'>Try Mock Test Again</a>";
                    } else {
                        echo "<a href='practice.php?category_id=" . urlencode($category_id) . "&subcategory=" . urlencode($subcategory) . "' class='btn-primary'>Try Again</a>";
                    }
                    ?>
                    <a href="dashboard.php" class="btn-secondary">Back to Dashboard</a>
                    <a href="practice.php" class="btn-secondary">Practice More</a>
                </div>
            </div>

        <?php
        } else {
        ?>
            <div class="empty-card">
                <h2>Result</h2>
                <p>No result found.</p>
                <div class="action-buttons">
                    <a href="practice.php" class="btn-primary">Go to Practice</a>
                    <a href="dashboard.php" class="btn-secondary">Back to Dashboard</a>
                </div>
            </div>
        <?php
        }
        ?>

    </div>
</div>

<?php include 'includes/footer.php'; ?>