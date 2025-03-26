<?php
$page_title = "Profile";
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: /CivilIssueResolution/user_login.php");
    exit();
}

include '../../config/db.php';
$user_id = $_SESSION['user_id'];

$query = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

ob_start();
?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Your Profile</h2>

    <div class="border p-4 rounded-lg shadow-lg w-full md:w-1/2 mx-auto">
        <p class="text-lg font-semibold">Name: <?php echo htmlspecialchars($user['username']); ?></p>
        <p class="text-lg font-semibold">Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p class="text-lg font-semibold">Role: User</p>
    </div>
</div>

<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>