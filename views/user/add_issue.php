<?php
$page_title = "Add Issue";
include '../../config/db.php';
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: /CivilIssueResolution/user_login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'] ?? null;
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $image = $_FILES['image'] ?? null;

    if (!$user_id || empty($title) || empty($description) || empty($location)) {
        $error = "All fields are required.";
    } else {
        $imageData = file_get_contents($image['tmp_name']);

        $stmt = $conn->prepare("INSERT INTO posts (user_id, problem, description, problem_location, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssb", $user_id, $title, $description, $location, $null);

        $stmt->send_long_data(4, $imageData);

        if ($stmt->execute()) {
            header("Location: my_issues.php");
            exit();
        } else {
            $error = "Failed to submit issue.";
        }
    }
}
ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Report an Issue</h2>
    <?php if (isset($error))
        echo "<p class='text-red-500'>$error</p>"; ?>
    <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
        <input type="text" name="title" placeholder="Issue Title" class="input input-bordered w-full" required>
        <textarea name="description" placeholder="Describe the issue" class="textarea textarea-bordered w-full"
            required></textarea>
        <input type="text" name="location" placeholder="Location" class="input input-bordered w-full" required>
        <input type="file" name="image" class="file-input file-input-bordered w-full" required>
        <button type="submit" class="btn btn-primary w-full">Submit Issue</button>
    </form>
</div>

<?php $conn->close(); ?>
<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>