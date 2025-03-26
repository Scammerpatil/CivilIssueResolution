<?php
session_start();
$page_title = "Edit Issue";
include '../../config/db.php';

if (!isset($_SESSION['id'])) {
    header("Location: /CivilIssueResolution/admin_login.php");
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

$stmt = $conn->prepare("SELECT * FROM solution WHERE post_id = ?");
$stmt->bind_param("i", $issue_id);
$stmt->execute();
$solution_result = $stmt->get_result();
$existing_solution = $solution_result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $status = isset($_POST['status']) ? 1 : 0;
    $solution = trim($_POST['solution']);

    $stmt = $conn->prepare("UPDATE posts SET problem = ?, description = ?, problem_location = ?, status = ?, resolved_date = NOW() WHERE pid = ?");
    $stmt->bind_param("sssii", $title, $description, $location, $status, $issue_id);
    $stmt->execute();

    if ($status == 1 && !empty($solution)) {
        if ($existing_solution) {
            $stmt = $conn->prepare("UPDATE solution SET solution = ?, solution_date = CURRENT_TIMESTAMP WHERE post_id = ?");
            $stmt->bind_param("si", $solution, $issue_id);
        } else {
            $admin_id = $_SESSION['id'];
            $stmt = $conn->prepare("INSERT INTO solution (post_id, admin_id, solution) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $issue_id, $admin_id, $solution);
        }
        $stmt->execute();
    }

    header("Location: manage_issues.php");
    exit();
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

        <!-- Solution Input -->
        <textarea name="solution" class="textarea textarea-bordered w-full"
            placeholder="Enter solution here"><?= $existing_solution ? htmlspecialchars($existing_solution['solution']) : '' ?></textarea>

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