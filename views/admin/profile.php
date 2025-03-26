<?php
$page_title = "Profile";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /CivilIssueResolution/admin_login.php");
    exit();
}

include '../../config/db.php';
$admin_id = $_SESSION['id'];

$query = "SELECT admin_name, admin_email FROM admin WHERE admin_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

ob_start();
?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Profile</h2>
    <div class="bg-base-100 p-6 rounded-lg shadow-md">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($admin['admin_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['admin_email']); ?></p>
    </div>
</div>

<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>