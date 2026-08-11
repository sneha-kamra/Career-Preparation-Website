<?php
session_start();
include 'config/db.php';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #f8fbff, #eef4ff);
    font-family: 'Segoe UI', sans-serif;
    color: #1e293b;
}

.readiness-hero {
    max-width: 1100px;
    margin: 30px auto;
    padding: 42px 40px;
    border-radius: 28px;
    background: linear-gradient(135deg, #eff6ff, #eef2ff);
    border: 1px solid #dbeafe;
    box-shadow: 0 15px 40px rgba(15,23,42,0.05);
}

.readiness-hero h1 {
    font-size: 48px;
    font-weight: 800;
    color: #1e3a8a;
    margin-bottom: 14px;
}

.readiness-hero p {
    color: #64748b;
    font-size: 18px;
    line-height: 1.7;
}

.dashboard-grid {
    max-width: 1100px;
    margin: 20px auto;
    display: grid;
    grid-template-columns: 1.4fr 1fr;
    gap: 20px;
}

.card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.card h3 {
    margin-bottom: 18px;
    font-size: 24px;
    font-weight: 800;
    color: #0f172a;
}

.score-layout {
    display: flex;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}

.score-circle {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    flex-shrink: 0;
}

.score-circle::before {
    content: "";
    position: absolute;
    width: 135px;
    height: 135px;
    background: #ffffff;
    border-radius: 50%;
}

.score-value {
    position: relative;
    z-index: 2;
    font-size: 32px;
    font-weight: 800;
    color: #1e3a8a;
}

.score-details {
    flex: 1;
    min-width: 250px;
}

.score-details h2 {
    font-size: 38px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 10px;
}

.status-badge {
    display: inline-block;
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
    margin-bottom: 16px;
}

.status-ready {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.status-medium {
    background: #fef3c7;
    color: #92400e;
    border: 1px solid #fde68a;
}

.status-low {
    background: #fee2e2;
    color: #b91c1c;
    border: 1px solid #fecaca;
}

.score-text {
    color: #64748b;
    font-size: 16px;
    line-height: 1.7;
}

.progress-track {
    width: 100%;
    height: 14px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
    margin: 18px 0 12px;
}

.progress-fill {
    height: 100%;
    border-radius: 999px;
}

.fill-ready {
    background: linear-gradient(90deg, #22c55e, #4ade80);
}

.fill-medium {
    background: linear-gradient(90deg, #f59e0b, #fbbf24);
}

.fill-low {
    background: linear-gradient(90deg, #ef4444, #f87171);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

.stat-box {
    background: linear-gradient(135deg, #f8fbff, #eef4ff);
    border: 1px solid #dbeafe;
    border-radius: 18px;
    padding: 18px;
}

.stat-box span {
    display: block;
    color: #64748b;
    font-size: 14px;
    margin-bottom: 8px;
    font-weight: 600;
}

.stat-box strong {
    font-size: 24px;
    font-weight: 800;
    color: #1e3a8a;
}

.legend-box {
    background: linear-gradient(135deg, #f8fbff, #eef4ff);
    border: 1px solid #dbeafe;
    border-radius: 18px;
    padding: 18px;
    margin-top: 15px;
}

.legend-box p {
    margin: 10px 0;
    color: #334155;
    font-size: 15px;
    line-height: 1.6;
}

.tips-list {
    padding-left: 18px;
    margin: 0;
}

.tips-list li {
    margin-bottom: 12px;
    color: #475569;
    line-height: 1.7;
    font-weight: 500;
}

.empty-box,
.login-box {
    max-width: 1100px;
    margin: 20px auto;
    padding: 26px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    text-align: center;
}

.empty-box h3,
.login-box h3 {
    font-size: 28px;
    color: #0f172a;
    margin-bottom: 12px;
    font-weight: 800;
}

.empty-box p,
.login-box p {
    color: #64748b;
    font-size: 16px;
    line-height: 1.7;
    margin: 0;
}

@media (max-width: 900px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
        margin-left: 14px;
        margin-right: 14px;
    }

    .readiness-hero {
        margin: 20px 14px;
        padding: 28px 22px;
    }

    .readiness-hero h1 {
        font-size: 34px;
    }

    .readiness-hero p {
        font-size: 16px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .score-layout {
        flex-direction: column;
        align-items: flex-start;
    }

    .score-circle {
        margin: auto;
    }

    .empty-box,
    .login-box {
        margin-left: 14px;
        margin-right: 14px;
    }
}
</style>

<div class="readiness-hero">
    <h1>Readiness Score 📊</h1>
    <p>See how prepared you are for placements based on your performance in practice tests and mock assessments.</p>
</div>

<?php
if (!isset($_SESSION['user_id'])) {
    echo '
    <div class="login-box">
        <h3>Please login first</h3>
        <p>You need to login to view your readiness score and performance insights.</p>
    </div>';
} else {
    $user_id = $_SESSION['user_id'];

    $query = mysqli_query($conn, "
        SELECT 
            AVG(percentage) AS overall_score,
            COUNT(*) AS total_attempts,
            MAX(percentage) AS best_score,
            MIN(percentage) AS lowest_score
        FROM results
        WHERE user_id = '$user_id'
    ");

    $row = mysqli_fetch_assoc($query);

    $overall_score = round($row['overall_score'], 2);
    $total_attempts = $row['total_attempts'];
    $best_score = $row['best_score'] ? round($row['best_score'], 2) : 0;
    $lowest_score = $row['lowest_score'] ? round($row['lowest_score'], 2) : 0;

    if ($overall_score > 0) {

        if ($overall_score >= 80) {
            $status_text = "Placement Ready";
            $status_class = "status-ready";
            $fill_class = "fill-ready";
            $message = "Excellent! Your performance shows that you are strongly prepared for placement opportunities.";
            $suggestion = "Keep practicing regularly and maintain your confidence with mock tests and interview preparation.";
            $circle_color = "#22c55e";
        } elseif ($overall_score >= 50) {
            $status_text = "Moderately Ready";
            $status_class = "status-medium";
            $fill_class = "fill-medium";
            $message = "You are improving well. A little more focused practice can make you placement ready.";
            $suggestion = "Focus on weak topics, increase consistency, and solve more timed MCQs and mock tests.";
            $circle_color = "#f59e0b";
        } else {
            $status_text = "Needs Improvement";
            $status_class = "status-low";
            $fill_class = "fill-low";
            $message = "Your current score shows that you need more preparation before placements.";
            $suggestion = "Strengthen basics, revise weak areas, and start daily practice to improve step by step.";
            $circle_color = "#ef4444";
        }

        $circle_degree = ($overall_score / 100) * 360;
?>

<div class="dashboard-grid">
    <div class="card">
        <h3>Overall Readiness</h3>
        <div class="score-layout">
            <div class="score-circle" style="background: conic-gradient(<?php echo $circle_color; ?> 0deg, <?php echo $circle_color; ?> <?php echo $circle_degree; ?>deg, #e2e8f0 <?php echo $circle_degree; ?>deg);">
                <div class="score-value"><?php echo $overall_score; ?>%</div>
            </div>

            <div class="score-details">
                <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                <h2><?php echo $overall_score; ?>%</h2>
                <p class="score-text"><?php echo $message; ?></p>

                <div class="progress-track">
                    <div class="progress-fill <?php echo $fill_class; ?>" style="width: <?php echo $overall_score; ?>%;"></div>
                </div>

                <p class="score-text"><?php echo $suggestion; ?></p>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>Performance Summary</h3>
        <div class="stats-grid">
            <div class="stat-box">
                <span>Total Attempts</span>
                <strong><?php echo $total_attempts; ?></strong>
            </div>

            <div class="stat-box">
                <span>Best Score</span>
                <strong><?php echo $best_score; ?>%</strong>
            </div>

            <div class="stat-box">
                <span>Lowest Score</span>
                <strong><?php echo $lowest_score; ?>%</strong>
            </div>

            <div class="stat-box">
                <span>Status</span>
                <strong><?php echo $status_text; ?></strong>
            </div>
        </div>
    </div>

    <div class="card">
        <h3>Readiness Interpretation</h3>
        <div class="legend-box">
            <p><strong style="color:#16a34a;">80% and above</strong> — Placement Ready</p>
            <p><strong style="color:#d97706;">50% to 79%</strong> — Moderately Ready</p>
            <p><strong style="color:#dc2626;">Below 50%</strong> — Needs Improvement</p>
        </div>
    </div>

    <div class="card">
        <h3>Improvement Tips</h3>
        <ul class="tips-list">
            <li>Practice aptitude, reasoning, verbal, and technical MCQs consistently.</li>
            <li>Take mock tests regularly to improve time management and confidence.</li>
            <li>Analyze wrong answers carefully and revise your weak topics.</li>
            <li>Prepare for interviews along with written test practice for complete readiness.</li>
        </ul>
    </div>
</div>

<?php
    } else {
        echo '
        <div class="empty-box">
            <h3>No practice results found yet</h3>
            <p>You have not attempted any test yet. Start practicing MCQs to generate your readiness score and performance analytics.</p>
        </div>';
    }
}
?>

<?php include 'includes/footer.php'; ?>