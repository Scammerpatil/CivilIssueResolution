<?php
$page_title = "Dashboard";
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: /CivilIssueResolution/user_login.php");
    exit();
}

include '../../config/db.php';
$user_name = $_SESSION['name'];
$user_role = $_SESSION['user_type'];
$user_id = $_SESSION['user_id'];

ob_start();
?>
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Welcome, <?php echo htmlspecialchars($user_name); ?> </h2>
    <p class="text-base-content/70">Here you can manage your account.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <div class="border p-4 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Your Reported Issues</h3>
            <ul class="list-disc list-inside mt-2">
                <?php
                $query = "SELECT pid, problem, status FROM posts WHERE user_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($row['problem']) . " - <strong>" .
                            ($row['status'] ? "Resolved" : "Pending") . "</strong></li>";
                    }
                } else {
                    echo "<li>No issues reported yet.</li>";
                }
                ?>
            </ul>
        </div>

        <div class="border p-4 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold">Your Profile</h3>
            <p class="text-base-content/60">Role: <?php echo ucfirst($user_role); ?></p>
            <p class="text-base-content/60">Name: <?php echo htmlspecialchars($user_name); ?></p>
            <a href="profile.php" class="btn btn-primary mt-3">View Profile</a>
        </div>
    </div>
</div>

<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>