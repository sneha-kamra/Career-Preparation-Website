<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

function getCategoryAverage($conn, $user_id, $category_name) {
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $category_name = mysqli_real_escape_string($conn, $category_name);

    $query = mysqli_query($conn, "
        SELECT AVG(r.percentage) AS avg_score
        FROM results r
        JOIN categories c ON r.category_id = c.id
        WHERE r.user_id = '$user_id' 
          AND c.category_name = '$category_name'
          AND r.subcategory != 'Mock Test'
    ");

    $row = mysqli_fetch_assoc($query);
    return ($row && $row['avg_score'] !== null) ? round($row['avg_score']) : 0;
}

$aptitude = getCategoryAverage($conn, $user_id, 'Aptitude');
$reasoning = getCategoryAverage($conn, $user_id, 'Reasoning');
$technical = getCategoryAverage($conn, $user_id, 'Technical');
$communication = getCategoryAverage($conn, $user_id, 'Interview');

$readiness_query = mysqli_query($conn, "
    SELECT AVG(percentage) AS overall_score
    FROM results
    WHERE user_id = '$user_id'
");

$readiness_row = mysqli_fetch_assoc($readiness_query);
$readiness_score = ($readiness_row && $readiness_row['overall_score'] !== null) ? round($readiness_row['overall_score']) : 0;

$focus_query = mysqli_query($conn, "
    SELECT COUNT(*) AS weak_count
    FROM (
        SELECT subcategory, AVG(percentage) AS avg_score
        FROM results
        WHERE user_id = '$user_id' AND subcategory != 'Mock Test'
        GROUP BY subcategory
        HAVING avg_score < 50
    ) AS weak_areas
");

$focus_row = mysqli_fetch_assoc($focus_query);
$focus_areas = $focus_row ? $focus_row['weak_count'] : 0;

$total_attempts_query = mysqli_query($conn, "
    SELECT COUNT(*) AS total_attempts
    FROM results
    WHERE user_id = '$user_id' AND subcategory = 'Mock Test'
");

$total_attempts_row = mysqli_fetch_assoc($total_attempts_query);
$mock_tests = $total_attempts_row ? $total_attempts_row['total_attempts'] : 0;

$has_any_data = ($aptitude > 0 || $reasoning > 0 || $technical > 0 || $communication > 0 || $readiness_score > 0);
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
    body {
        background: linear-gradient(135deg, #f8fbff, #eef4ff, #f8fafc);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #1e293b;
    }

    .dashboard-page {
        min-height: 100vh;
        padding: 50px 20px 80px;
    }

    .dashboard-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .dashboard-hero {
        background:
            radial-gradient(circle at top right, rgba(37, 99, 235, 0.12), transparent 30%),
            radial-gradient(circle at bottom left, rgba(124, 58, 237, 0.12), transparent 35%),
            linear-gradient(135deg, #eff6ff, #eef2ff, #f8fafc);
        border: 1px solid #dbeafe;
        border-radius: 28px;
        padding: 40px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
        margin-bottom: 35px;
    }

    .dashboard-badge {
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

    .dashboard-hero h1 {
        font-size: 42px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
    }

    .dashboard-hero h1 span {
        background: linear-gradient(90deg, #2563eb, #7c3aed);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .dashboard-hero p {
        font-size: 17px;
        color: #475569;
        line-height: 1.8;
        max-width: 760px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 35px;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 12px 30px rgba(15, 23, 42, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        border-color: #93c5fd;
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
    }

    .stat-icon {
        width: 54px;
        height: 54px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 16px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        border: 1px solid #dbeafe;
    }

    .stat-card h3 {
        font-size: 15px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .stat-card h2 {
        font-size: 30px;
        color: #0f172a;
        margin-bottom: 8px;
        font-weight: 800;
    }

    .stat-card p {
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .section-title {
        font-size: 28px;
        color: #0f172a;
        margin-bottom: 18px;
        font-weight: 800;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 22px;
        margin-bottom: 35px;
    }

    .dashboard-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 24px;
        padding: 26px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        border-color: #93c5fd;
        box-shadow: 0 18px 35px rgba(15, 23, 42, 0.08);
    }

    .dashboard-card .card-icon {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin-bottom: 18px;
        background: linear-gradient(135deg, #dbeafe, #ede9fe);
        border: 1px solid #dbeafe;
    }

    .dashboard-card h3 {
        font-size: 22px;
        color: #0f172a;
        margin-bottom: 10px;
        font-weight: 800;
    }

    .dashboard-card p {
        color: #475569;
        line-height: 1.7;
        font-size: 15px;
        margin-bottom: 18px;
    }

    .card-btn {
        display: inline-block;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 12px;
        background: linear-gradient(90deg, #2563eb, #4f46e5);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 10px 22px rgba(37, 99, 235, 0.18);
        transition: all 0.3s ease;
    }

    .card-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(90deg, #1d4ed8, #4338ca);
    }

    .progress-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 26px;
        padding: 30px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.05);
        margin-bottom: 35px;
    }

    .progress-section p {
        color: #64748b;
        margin-bottom: 25px;
        line-height: 1.7;
    }

    .progress-item {
        margin-bottom: 22px;
    }

    .progress-item:last-child {
        margin-bottom: 0;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 15px;
        color: #334155;
        font-weight: 600;
    }

    .progress-bar {
        width: 100%;
        height: 12px;
        background: #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 20px;
        background: linear-gradient(90deg, #2563eb, #7c3aed);
    }

    .no-progress-box {
        background: linear-gradient(135deg, #f8fbff, #eef4ff);
        border: 1px solid #dbeafe;
        border-radius: 18px;
        padding: 18px;
        color: #475569;
        font-weight: 600;
        margin-bottom: 24px;
    }

    .logout-card {
        background: linear-gradient(135deg, #fff1f2, #fff7ed);
        border: 1px solid #fecaca;
    }

    .logout-card .card-icon {
        background: linear-gradient(135deg, #fee2e2, #ffedd5);
        border: 1px solid #fecaca;
    }

    .logout-btn {
        display: inline-block;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 12px;
        background: linear-gradient(90deg, #dc2626, #ea580c);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 10px 22px rgba(220, 38, 38, 0.18);
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(90deg, #b91c1c, #c2410c);
    }

    @media (max-width: 992px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .dashboard-hero h1 {
            font-size: 34px;
        }
    }

    @media (max-width: 768px) {
        .dashboard-page {
            padding: 30px 14px 50px;
        }

        .dashboard-hero,
        .progress-section,
        .dashboard-card,
        .stat-card {
            padding: 22px;
        }

        .stats-grid,
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-hero h1 {
            font-size: 28px;
        }
    }
</style>

<div class="dashboard-page">
    <div class="dashboard-container">

        <div class="dashboard-hero">
            <span class="dashboard-badge">STUDENT DASHBOARD</span>
            <h1>Welcome back, <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span></h1>
            <p>
                Continue your placement preparation journey from one smart dashboard. Access practice,
                mock tests, readiness tracking, and skill gap analysis in a clean and structured way.
            </p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">📘</div>
                <h3>Practice Modules</h3>
                <h2>04</h2>
                <p>Aptitude, Reasoning, Technical, and Interview modules available.</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📝</div>
                <h3>Mock Tests Taken</h3>
                <h2><?php echo $mock_tests; ?></h2>
                <p>Total mock tests attempted by you so far.</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <h3>Readiness Score</h3>
                <h2><?php echo $readiness_score; ?>%</h2>
                <p>Your overall placement readiness based on test performance.</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🎯</div>
                <h3>Focus Areas</h3>
                <h2><?php echo $focus_areas; ?></h2>
                <p>Number of weak subcategories that need more attention.</p>
            </div>
        </div>

        <div class="progress-section">
            <h2 class="section-title">Preparation Progress</h2>
            <p>
                This section gives a quick visual overview of current preparation performance across key placement areas.
            </p>

            <?php if (!$has_any_data) { ?>
                <div class="no-progress-box">
                    No preparation data yet. Start practicing MCQs or take a mock test to see your real progress here.
                </div>
            <?php } ?>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Aptitude</span>
                    <span><?php echo $aptitude; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $aptitude; ?>%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Reasoning</span>
                    <span><?php echo $reasoning; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $reasoning; ?>%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Technical MCQs</span>
                    <span><?php echo $technical; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $technical; ?>%;"></div>
                </div>
            </div>

            <div class="progress-item">
                <div class="progress-label">
                    <span>Communication</span>
                    <span><?php echo $communication; ?>%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $communication; ?>%;"></div>
                </div>
            </div>
        </div>

        <h2 class="section-title">Quick Access Modules</h2>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <div class="card-icon">📘</div>
                <h3>MCQ Practice</h3>
                <p>Practice questions category-wise and strengthen your fundamentals step by step.</p>
                <a href="practice.php" class="card-btn">Start Practice</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📝</div>
                <h3>Mock Test</h3>
                <p>Attempt a mixed placement mock test and evaluate your performance level.</p>
                <a href="mock-test.php" class="card-btn">Take Mock Test</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📊</div>
                <h3>Readiness Score</h3>
                <p>Check your overall placement readiness based on your preparation and test data.</p>
                <a href="readiness-score.php" class="card-btn">Check Score</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">🎯</div>
                <h3>Skill Gap Analyzer</h3>
                <p>Find weak areas clearly and understand where you need more improvement.</p>
                <a href="skill-gap.php" class="card-btn">View Analysis</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">💬</div>
                <h3>My Doubts</h3>
                <p>View your submitted doubts and check admin replies in one place.</p>
                <a href="my-doubts.php" class="card-btn">View Replies</a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon">📩</div>
                <h3>Contact Support</h3>
                <p>Send feedback, ask questions, or contact support for suggestions and help.</p>
                <a href="contact.php" class="card-btn">Contact Us</a>
            </div>

            <div class="dashboard-card logout-card">
                <div class="card-icon">🚪</div>
                <h3>Logout</h3>
                <p>Securely log out from your student account when you finish your session.</p>
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>