<?php
$page_title = "Dashboard";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: /CivilIssueResolution/admin_login.php");
    exit();
}

include '../../config/db.php';
$admin_name = $_SESSION['name'];

ob_start();
?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($admin_name); ?> </h2>
    <p class="text-base-content/70">Manage everything from here.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <a href="feedbacks.php" class="block p-4 btn btn-primary rounded-lg shadow-md hover:btn-primary/80">
            View Feedbacks
        </a>
    </div>
</div>

<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>