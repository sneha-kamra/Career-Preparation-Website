<?php
session_start();
include 'config/db.php';
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<style>
body {
    background: linear-gradient(135deg, #f8fbff, #eef4ff);
    font-family: 'Poppins', sans-serif;
    color: #1e293b;
}

/* =========================
   LOGIN REQUIRED SECTION
========================= */
.login-required-page {
    min-height: 78vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px 70px;
    background:
        linear-gradient(rgba(15, 23, 42, 0.62), rgba(15, 23, 42, 0.62)),
        url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
}

.login-required-card {
    width: 100%;
    max-width: 720px;
    text-align: center;
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.45);
    border-radius: 30px;
    padding: 50px 40px;
    box-shadow: 0 28px 70px rgba(0, 0, 0, 0.22);
    animation: floatCard 4s ease-in-out infinite;
}

.lock-icon {
    width: 82px;
    height: 82px;
    margin: 0 auto 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 38px;
    background: linear-gradient(135deg, #dbeafe, #e0e7ff);
    box-shadow: 0 12px 25px rgba(37, 99, 235, 0.16);
}

.login-required-card h1 {
    font-size: 42px;
    color: #1e3a8a;
    margin-bottom: 12px;
    font-weight: 800;
}

.login-required-card p {
    color: #475569;
    font-size: 17px;
    line-height: 1.8;
    max-width: 560px;
    margin: 0 auto 26px;
}

.btn-login {
    display: inline-block;
    padding: 14px 28px;
    border-radius: 14px;
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    color: #ffffff;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 14px 30px rgba(37, 99, 235, 0.25);
}

.btn-login:hover {
    transform: translateY(-3px);
    background: linear-gradient(90deg, #1d4ed8, #4338ca);
}

.extra-info {
    margin-top: 28px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}

.extra-info span {
    background: #eff6ff;
    padding: 10px 15px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    color: #2563eb;
    border: 1px solid #dbeafe;
}

@keyframes floatCard {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

/* =========================
   PRACTICE PAGE
========================= */
.practice-hero {
    max-width: 1100px;
    margin: 30px auto;
    padding: 42px 40px;
    border-radius: 28px;
    background: linear-gradient(135deg, #eff6ff, #eef2ff);
    border: 1px solid #dbeafe;
    box-shadow: 0 15px 40px rgba(15, 23, 42, 0.05);
}

.practice-hero h1 {
    font-size: 52px;
    font-weight: 800;
    color: #1e3a8a;
    margin-bottom: 14px;
}

.practice-hero p {
    color: #64748b;
    font-size: 18px;
    line-height: 1.7;
}

.form-card {
    max-width: 1100px;
    margin: 20px auto;
    padding: 30px;
    border-radius: 24px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 700;
    margin-bottom: 8px;
    font-size: 15px;
    color: #334155;
}

select {
    width: 100%;
    padding: 16px 18px;
    border-radius: 14px;
    border: 1.5px solid #cbd5e1;
    font-size: 16px;
    background-color: #ffffff;
    color: #0f172a;
    transition: all 0.3s ease;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg fill='%2364748b' height='20' viewBox='0 0 20 20' width='20' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.5 7l4.5 5 4.5-5z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    background-size: 18px;
    padding-right: 46px;
}

select:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    outline: none;
}

select:hover {
    border-color: #94a3b8;
}

.btn-main {
    padding: 14px 24px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(90deg, #2563eb, #4f46e5);
    color: white;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.20);
    transition: all 0.3s ease;
}

.btn-main:hover {
    transform: translateY(-2px);
    background: linear-gradient(90deg, #1d4ed8, #4338ca);
}

.question-box {
    background: #ffffff;
    margin: 20px auto;
    padding: 24px;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
    max-width: 1100px;
}

.question-title {
    font-weight: 700;
    font-size: 18px;
    color: #0f172a;
    margin-bottom: 14px;
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
    margin-bottom: 0;
}

.option label:hover {
    background: #eff6ff;
    border-color: #2563eb;
}

.option input {
    width: auto;
    margin: 0;
}

.submit-area {
    text-align: center;
    margin: 30px auto 10px;
    max-width: 1100px;
}

.questions-header {
    max-width: 1100px;
    margin: 25px auto 10px;
    padding: 0 5px;
}

.questions-header h3 {
    font-size: 26px;
    font-weight: 800;
    color: #0f172a;
}

.questions-header span {
    color: #2563eb;
}

.empty-state {
    max-width: 1100px;
    margin: 20px auto;
    padding: 22px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04);
    color: #475569;
    font-weight: 600;
}

@media (max-width: 768px) {
    .practice-hero {
        padding: 28px 22px;
        margin: 20px 14px;
    }

    .practice-hero h1 {
        font-size: 34px;
    }

    .practice-hero p {
        font-size: 16px;
    }

    .form-card,
    .question-box,
    .empty-state,
    .questions-header,
    .submit-area {
        margin-left: 14px;
        margin-right: 14px;
    }

    .form-card {
        padding: 22px;
    }

    select {
        font-size: 15px;
        padding: 15px 16px;
        padding-right: 42px;
    }

    .login-required-page {
        padding: 30px 14px 50px;
        min-height: 72vh;
    }

    .login-required-card {
        padding: 34px 22px;
        border-radius: 22px;
        animation: none;
    }

    .login-required-card h1 {
        font-size: 30px;
    }

    .login-required-card p {
        font-size: 15px;
    }
}
</style>

<?php if (!isset($_SESSION['user_id'])) { ?>

<div class="login-required-page">
    <div class="login-required-card">
        <div class="lock-icon">🔒</div>
        <h1>Login Required</h1>
        <p>
            Please login to access practice questions and start improving your placement preparation with CareerPrep.
        </p>
        <a href="login.php" class="btn-login">Go to Login</a>

        <div class="extra-info">
            <span>✔ Practice MCQs</span>
            <span>✔ Build Skills</span>
            <span>✔ Track Progress</span>
        </div>
    </div>
</div>

<?php } else { ?>

<div class="practice-hero">
    <h1>Practice MCQs 📘</h1>
    <p>Select category and subcategory to start practicing smartly and improve your placement preparation step by step.</p>
</div>

<div class="form-card">
    <form method="GET" action="practice.php">
        <div class="form-group">
            <label for="category">Select Category</label>
            <select name="category_id" id="category" required onchange="updateSubcategories()">
                <option value="">Choose Category</option>
                <?php
                $categories = mysqli_query($conn, "SELECT * FROM categories");
                while($row = mysqli_fetch_assoc($categories)) {
                ?>
                    <option value="<?php echo $row['id']; ?>"
                        data-name="<?php echo $row['category_name']; ?>"
                        <?php if(isset($_GET['category_id']) && $_GET['category_id'] == $row['id']) echo 'selected'; ?>>
                        <?php echo $row['category_name']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="subcategory">Select Subcategory</label>
            <select name="subcategory" id="subcategory" required>
                <option value="">Choose Subcategory</option>
            </select>
        </div>

        <button type="submit" class="btn-main">Start Practice</button>
    </form>
</div>

<?php
if (isset($_GET['category_id']) && isset($_GET['subcategory']) && $_GET['subcategory'] != "") {
    $category_id = mysqli_real_escape_string($conn, $_GET['category_id']);
    $subcategory = mysqli_real_escape_string($conn, $_GET['subcategory']);

    $questions = mysqli_query($conn, "SELECT * FROM questions WHERE category_id='$category_id' AND subcategory='$subcategory'");

    if (mysqli_num_rows($questions) > 0) {
        echo "<div class='questions-header'>";
        echo "<h3>Questions for: <span>" . htmlspecialchars($subcategory) . "</span></h3>";
        echo "</div>";

        echo "<form method='POST' action='results.php'>";

        $qno = 1;
        while($q = mysqli_fetch_assoc($questions)) {
            echo "<div class='question-box'>";
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

        echo "<input type='hidden' name='category_id' value='" . htmlspecialchars($category_id) . "'>";
        echo "<input type='hidden' name='subcategory' value='" . htmlspecialchars($subcategory) . "'>";

        echo "<div class='submit-area'><button type='submit' name='submit_test' class='btn-main'>Submit Answers</button></div>";
        echo "</form>";
    } else {
        echo "<div class='empty-state'><strong>No questions found for this subcategory.</strong></div>";
    }
}
?>

<script>
function updateSubcategories() {
    const categorySelect = document.getElementById("category");
    const subcategorySelect = document.getElementById("subcategory");
    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
    const categoryName = selectedOption.getAttribute("data-name");

    const subcategories = {
        "Aptitude": ["Percentage", "Profit and Loss", "Time and Work", "Average", "Simple Interest", "Number System"],
        "Reasoning": ["Puzzles", "Coding-Decoding", "Blood Relations", "Direction Sense", "Seating Arrangement"],
        "Verbal": ["Grammar", "Synonyms", "Antonyms", "Reading Comprehension", "Sentence Correction"],
        "Technical": ["HTML", "CSS", "JavaScript", "PHP", "MySQL", "DBMS", "DSA", "Java", "C", "C++", "OOP"],
        "Interview": ["HR", "Self Introduction", "Resume", "Communication", "Strengths and Weaknesses"]
    };

    subcategorySelect.innerHTML = '<option value="">Choose Subcategory</option>';

    if (subcategories[categoryName]) {
        subcategories[categoryName].forEach(function(subcat) {
            let option = document.createElement("option");
            option.value = subcat;
            option.text = subcat;
            subcategorySelect.appendChild(option);
        });
    }

    <?php if(isset($_GET['subcategory'])) { ?>
        subcategorySelect.value = "<?php echo htmlspecialchars($_GET['subcategory']); ?>";
    <?php } ?>
}

window.onload = updateSubcategories;
</script>

<?php } ?>

<?php include 'includes/footer.php'; ?>