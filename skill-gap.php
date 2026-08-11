<?php
session_start();
include 'config/db.php';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
html, body {
    background: linear-gradient(135deg, #f8fbff, #eef4ff) !important;
    font-family: 'Segoe UI', sans-serif !important;
    color: #1e293b !important;
    margin: 0;
    padding: 0;
}

body * {
    box-sizing: border-box;
}

.skill-gap-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8fbff, #eef4ff) !important;
    padding: 1px 0 40px;
}

.skill-hero {
    max-width: 1100px;
    margin: 30px auto;
    padding: 42px 40px;
    border-radius: 28px;
    background: linear-gradient(135deg, #eff6ff, #eef2ff) !important;
    border: 1px solid #dbeafe;
    box-shadow: 0 15px 40px rgba(15,23,42,0.05);
}

.skill-hero h1 {
    font-size: 48px;
    font-weight: 800;
    color: #1e3a8a !important;
    margin-bottom: 14px;
}

.skill-hero p {
    color: #64748b !important;
    font-size: 18px;
    line-height: 1.7;
}

.summary-grid {
    max-width: 1100px;
    margin: 20px auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

.summary-card {
    background: #ffffff !important;
    border: 1px solid #e2e8f0;
    border-radius: 22px;
    padding: 22px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.summary-card span {
    display: block;
    color: #64748b !important;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
}

.summary-card strong {
    font-size: 28px;
    font-weight: 800;
    color: #1e3a8a !important;
}

.content-card {
    max-width: 1100px;
    margin: 20px auto;
    background: #ffffff !important;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
}

.content-card h3 {
    margin-top: 0;
    margin-bottom: 18px;
    font-size: 26px;
    font-weight: 800;
    color: #0f172a !important;
}

.table-wrapper {
    overflow-x: auto;
}

.skill-table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 18px;
}

.skill-table thead th {
    background: linear-gradient(135deg, #eff6ff, #eef2ff) !important;
    color: #1e3a8a !important;
    font-size: 15px;
    font-weight: 800;
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid #dbeafe;
}

.skill-table tbody td {
    padding: 16px;
    color: #334155 !important;
    font-size: 15px;
    border-bottom: 1px solid #e2e8f0;
    vertical-align: middle;
}

.skill-table tbody tr:hover {
    background: #f8fbff !important;
}

.score-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
    background: #eff6ff;
    color: #1d4ed8;
    border: 1px solid #dbeafe;
}

.status-badge {
    display: inline-block;
    padding: 8px 14px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: 700;
}

.status-strong {
    background: #dcfce7 !important;
    color: #166534 !important;
    border: 1px solid #bbf7d0;
}

.status-average {
    background: #fef3c7 !important;
    color: #92400e !important;
    border: 1px solid #fde68a;
}

.status-weak {
    background: #fee2e2 !important;
    color: #b91c1c !important;
    border: 1px solid #fecaca;
}

.progress-area {
    margin-top: 8px;
}

.progress-track {
    width: 100%;
    max-width: 220px;
    height: 10px;
    background: #e2e8f0 !important;
    border-radius: 999px;
    overflow: hidden;
    margin-top: 8px;
}

.progress-fill {
    height: 100%;
    border-radius: 999px;
}

.fill-strong {
    background: linear-gradient(90deg, #22c55e, #4ade80) !important;
}

.fill-average {
    background: linear-gradient(90deg, #f59e0b, #fbbf24) !important;
}

.fill-weak {
    background: linear-gradient(90deg, #ef4444, #f87171) !important;
}

.improve-list {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-top: 10px;
}

.improve-box {
    background: linear-gradient(135deg, #fff7ed, #fef2f2) !important;
    border: 1px solid #fed7aa;
    border-radius: 18px;
    padding: 18px;
}

.improve-box h4 {
    margin: 0 0 8px;
    font-size: 18px;
    color: #9a3412 !important;
    font-weight: 800;
}

.improve-box p {
    margin: 0;
    color: #7c2d12 !important;
    line-height: 1.7;
    font-size: 15px;
}

.success-box {
    background: linear-gradient(135deg, #ecfdf5, #f0fdf4) !important;
    border: 1px solid #bbf7d0;
    border-radius: 18px;
    padding: 20px;
    color: #166534 !important;
    font-weight: 700;
    font-size: 16px;
}

.empty-box,
.login-box {
    max-width: 1100px;
    margin: 20px auto;
    padding: 26px;
    background: #ffffff !important;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    text-align: center;
}

.empty-box h3,
.login-box h3 {
    font-size: 28px;
    color: #0f172a !important;
    margin-bottom: 12px;
    font-weight: 800;
}

.empty-box p,
.login-box p {
    color: #64748b !important;
    font-size: 16px;
    line-height: 1.7;
    margin: 0;
}

@media (max-width: 900px) {
    .summary-grid {
        grid-template-columns: 1fr;
        margin-left: 14px;
        margin-right: 14px;
    }

    .skill-hero,
    .content-card,
    .empty-box,
    .login-box {
        margin-left: 14px;
        margin-right: 14px;
    }

    .skill-hero {
        padding: 28px 22px;
        margin-top: 20px;
    }

    .skill-hero h1 {
        font-size: 34px;
    }

    .skill-hero p {
        font-size: 16px;
    }

    .improve-list {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="skill-gap-page">
    <div class="skill-hero">
        <h1>Skill Gap Analyzer 🎯</h1>
        <p>Analyze your performance by subcategory, identify weak areas, and understand where you need more practice for placement preparation.</p>
    </div>

    <?php
    if (!isset($_SESSION['user_id'])) {
        echo '
        <div class="login-box">
            <h3>Please login first</h3>
            <p>You need to login to view your skill gap analysis and performance breakdown.</p>
        </div>';
    } else {
        $user_id = $_SESSION['user_id'];

        $query = mysqli_query($conn, "
            SELECT subcategory, AVG(percentage) as avg_score
            FROM results
            WHERE user_id = '$user_id' AND subcategory != 'Mock Test'
            GROUP BY subcategory
            ORDER BY avg_score ASC
        ");

        if (mysqli_num_rows($query) > 0) {

            $all_rows = [];
            $strong_count = 0;
            $average_count = 0;
            $weak_count = 0;

            while($row = mysqli_fetch_assoc($query)) {
                $avg = round($row['avg_score'], 2);

                if ($avg >= 80) {
                    $strong_count++;
                } elseif ($avg >= 50) {
                    $average_count++;
                } else {
                    $weak_count++;
                }

                $all_rows[] = $row;
            }

            $total_subcategories = count($all_rows);
    ?>

    <div class="summary-grid">
        <div class="summary-card">
            <span>Total Subcategories Analyzed</span>
            <strong><?php echo $total_subcategories; ?></strong>
        </div>

        <div class="summary-card">
            <span>Strong Areas</span>
            <strong><?php echo $strong_count; ?></strong>
        </div>

        <div class="summary-card">
            <span>Weak Areas</span>
            <strong><?php echo $weak_count; ?></strong>
        </div>
    </div>

    <div class="content-card">
        <h3>Performance by Subcategory</h3>

        <div class="table-wrapper">
            <table class="skill-table">
                <thead>
                    <tr>
                        <th>Subcategory</th>
                        <th>Average Score</th>
                        <th>Status</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($all_rows as $row) {
                        $subcategory = $row['subcategory'];
                        $avg = round($row['avg_score'], 2);

                        if ($avg >= 80) {
                            $status_text = "Strong 💪";
                            $status_class = "status-strong";
                            $fill_class = "fill-strong";
                        } elseif ($avg >= 50) {
                            $status_text = "Average ⚡";
                            $status_class = "status-average";
                            $fill_class = "fill-average";
                        } else {
                            $status_text = "Weak ❗";
                            $status_class = "status-weak";
                            $fill_class = "fill-weak";
                        }
                    ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($subcategory); ?></strong></td>
                        <td>
                            <span class="score-badge"><?php echo $avg; ?>%</span>
                        </td>
                        <td>
                            <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                        </td>
                        <td>
                            <div class="progress-area">
                                <div class="progress-track">
                                    <div class="progress-fill <?php echo $fill_class; ?>" style="width: <?php echo $avg; ?>%;"></div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="content-card">
        <h3>Areas to Improve</h3>

        <?php
        $weak_query = mysqli_query($conn, "
            SELECT subcategory, AVG(percentage) as avg_score
            FROM results
            WHERE user_id = '$user_id' AND subcategory != 'Mock Test'
            GROUP BY subcategory
            HAVING avg_score < 50
            ORDER BY avg_score ASC
        ");

        if (mysqli_num_rows($weak_query) > 0) {
            echo "<div class='improve-list'>";
            while($weak = mysqli_fetch_assoc($weak_query)) {
                echo "<div class='improve-box'>";
                echo "<h4>" . htmlspecialchars($weak['subcategory']) . "</h4>";
                echo "<p>Focus more on this area. Your average score here is <strong>" . round($weak['avg_score'], 2) . "%</strong>. Regular practice in this topic can improve your overall readiness score.</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='success-box'>Great! No major weak areas found. Your performance is balanced across all analyzed subcategories.</div>";
        }
        ?>
    </div>

    <?php
        } else {
            echo '
            <div class="empty-box">
                <h3>No practice results found yet</h3>
                <p>You have not attempted any tests yet. Start practicing MCQs and mock tests to generate your skill gap analysis.</p>
            </div>';
        }
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>