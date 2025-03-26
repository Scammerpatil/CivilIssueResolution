<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$page_title = "My Issues";
include '../../config/db.php';

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: /CivilIssueResolution/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $stmt = $conn->prepare("DELETE FROM posts WHERE pid = ? AND user_id = ?");
    $stmt->bind_param("ii", $delete_id, $user_id);
    $stmt->execute();
    header("Location: my_issues.php");
    exit();
}

$query = "SELECT * FROM posts WHERE user_id = ? ORDER BY posted_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$query = "SELECT p.*, s.solution, s.solution_date, u.admin_name AS admin_name 
          FROM posts p
          LEFT JOIN solution s ON p.pid = s.post_id
          LEFT JOIN admin u ON s.admin_id = u.admin_id
          WHERE p.user_id = ?
          ORDER BY p.posted_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">My Reported Issues</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="border p-4 rounded-lg shadow-lg space-y-1">
                    <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Issue Image"
                        class="w-full h-48 object-cover rounded-lg">
                    <hr class="border border-base-content w-full my-2" />
                    <div class="py-2 space-y-1">
                        <h3 class="text-xl font-semibold"> <?= htmlspecialchars($row['problem']) ?> </h3>
                        <p class="text-base-content/60"> <?= htmlspecialchars($row['description']) ?> </p>
                        <p class="text-sm text-base-content/50"><strong>Location:</strong>
                            <?= htmlspecialchars($row['problem_location']) ?> </p>
                        <p class="text-sm text-base-content/50"><strong>Posted on:</strong> <?= $row['posted_date'] ?> </p>

                        <p class="text-sm text-base-content/50"><strong>Feedback:</strong>
                            <?= $row['solution'] ? htmlspecialchars($row['solution']) : "Pending" ?>
                        </p>

                        <?php if ($row['solution']): ?>
                            <p class="text-sm text-base-content/50"><strong>Resolved by:</strong>
                                <?= htmlspecialchars($row['admin_name']) ?>
                            </p>
                            <p class="text-sm text-base-content/50"><strong>Resolved on:</strong>
                                <?= $row['solution_date'] ?>
                            </p>
                        <?php endif; ?>

                    </div>
                    <hr class="border border-base-content w-full my-2" />
                    <div class="flex space-x-3 mt-3 w-full items-center justify-between px-10">
                        <a href="edit_issue.php?id=<?= $row['pid'] ?>" class="btn btn-warning">Edit</a>
                        <form method="POST" onsubmit="return confirm('Are you sure you want to delete this issue?');">
                            <input type="hidden" name="delete_id" value="<?= $row['pid'] ?>">
                            <button type="submit" class="btn btn-error">Delete</button>
                        </form>
                        <button class="btn btn-<?= $row['status'] ? "success" : "error" ?> disabled">
                            <?= $row['status'] ? "Resolved" : "Pending" ?>
                        </button>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-500">No issues reported yet.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>
<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>