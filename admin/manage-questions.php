<?php
include '../config/db.php';

$message = "";

/* ADD QUESTION */
if (isset($_POST['add_question'])) {
    $category_id = $_POST['category_id'];
    $subcategory = $_POST['subcategory'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    $sql = "INSERT INTO questions (category_id, question, option_a, option_b, option_c, option_d, correct_option, subcategory)
            VALUES ('$category_id','$question','$option_a','$option_b','$option_c','$option_d','$correct_option','$subcategory')";

    if (mysqli_query($conn, $sql)) {
        $message = "Question added!";
    }
}

/* DELETE QUESTION */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    mysqli_query($conn, "DELETE FROM questions WHERE id='$id'");
    header("Location: manage-questions.php");
    exit();
}

$categories = mysqli_query($conn, "SELECT * FROM categories");
$all_questions = mysqli_query($conn, "SELECT q.*, c.category_name 
                                     FROM questions q 
                                     JOIN categories c ON q.category_id = c.id 
                                     ORDER BY q.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Questions</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Add Question</h2>
    <p><?php echo $message; ?></p>

    <form method="POST">
        <label>Category</label>
        <select name="category_id" required>
            <?php while($row = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['category_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Subcategory</label>
        <input type="text" name="subcategory">

        <label>Question</label>
        <textarea name="question" required></textarea>

        <input type="text" name="option_a" placeholder="Option A" required>
        <input type="text" name="option_b" placeholder="Option B" required>
        <input type="text" name="option_c" placeholder="Option C" required>
        <input type="text" name="option_d" placeholder="Option D" required>

        <label>Correct Option</label>
        <select name="correct_option" required>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>

        <button type="submit" name="add_question">Add</button>
    </form>

    <hr>

    <h2>All Questions</h2>

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <tr>
            <th>S.No.</th>
            <th>Category</th>
            <th>Subcategory</th>
            <th>Question</th>
            <th>Action</th>
        </tr>

        <?php $serial = 1; ?> <!-- SERIAL NUMBER START -->

        <?php while($q = mysqli_fetch_assoc($all_questions)) { ?>
        <tr>
            <td><?php echo $serial++; ?></td> <!-- SERIAL NUMBER -->
            <td><?php echo $q['category_name']; ?></td>
            <td><?php echo $q['subcategory']; ?></td>
            <td><?php echo $q['question']; ?></td>
            <td>
                <a href="?delete=<?php echo $q['id']; ?>" 
                   onclick="return confirm('Delete this question?')">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>