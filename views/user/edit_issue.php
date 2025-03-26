<?php
session_start();
$page_title = "Edit Issue";
include '../../config/db.php';

if (!isset($_SESSION['name'])) {
    header("Location: /CivilIssueResolution/login.php");
    exit();
}

$issue_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM posts WHERE pid = ?");
$stmt->bind_param("i", $issue_id);
$stmt->execute();
$result = $stmt->get_result();
$issue = $result->fetch_assoc();

if (!$issue) {
    echo "Issue not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);

    $stmt = $conn->prepare("UPDATE posts SET problem = ?, description = ?, problem_location = ? WHERE pid = ?");
    $stmt->bind_param("sssi", $title, $description, $location, $issue_id);

    if ($stmt->execute()) {
        header("Location: manage_issues.php");
        exit();
    } else {
        $error = "Failed to update issue.";
    }
}
ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Edit Issue</h2>
    <?php if (isset($error))
        echo "<p class='text-red-500'>$error</p>"; ?>
    <form action="" method="POST" class="space-y-4">
        <input type="text" name="title" value="<?= htmlspecialchars($issue['problem']) ?>"
            class="input input-bordered w-full" required>
        <textarea name="description" class="textarea textarea-bordered w-full"
            required><?= htmlspecialchars($issue['description']) ?></textarea>
        <input type="text" name="location" value="<?= htmlspecialchars($issue['problem_location']) ?>"
            class="input input-bordered w-full" required>
        <input type="text" name="feedback" value="<?= htmlspecialchars($issue['feedback']) ?>"
            class="input input-bordered w-full" required>
        <label class="flex items-center gap-2">
            <input type="checkbox" name="status" <?= $issue['status'] ? 'checked' : '' ?> class="checkbox"> Resolved
        </label>
        <button type="submit" class="btn btn-primary w-full">Update Issue</button>
    </form>
</div>

<?php $conn->close(); ?>

<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>