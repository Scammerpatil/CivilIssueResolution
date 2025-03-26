<?php
$page_title = "View Solutions";
include '../../config/db.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: /CivilIssueResolution/admin_login.php");
    exit();
}

$admin_id = $_SESSION['id'];

$query = "SELECT p.problem, p.problem_location, p.posted_date, s.id AS solution_id, s.solution, s.solution_date, 
                 u.username AS user_name, f.feedback, f.rating, f.posted_date AS feedback_date 
          FROM solution s
          LEFT JOIN posts p ON s.post_id = p.pid
          LEFT JOIN users u ON p.user_id = u.id
          LEFT JOIN feedback f ON s.id = f.solution_id
          WHERE s.admin_id = ?
          ORDER BY s.solution_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Solutions Provided</h2>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="border p-4 rounded-lg shadow-lg space-y-2">
                    <h3 class="text-xl font-semibold"> <?= htmlspecialchars($row['problem']) ?> </h3>
                    <p class="text-sm text-base-content/60"><strong>Location:</strong>
                        <?= htmlspecialchars($row['problem_location']) ?></p>
                    <p class="text-sm text-base-content/60"><strong>Reported by:</strong>
                        <?= htmlspecialchars($row['user_name']) ?></p>
                    <p class="text-sm text-base-content/60"><strong>Solution:</strong> <?= htmlspecialchars($row['solution']) ?>
                    </p>
                    <p class="text-sm text-base-content/60"><strong>Resolved on:</strong> <?= $row['solution_date'] ?></p>

                    <?php if (!empty($row['feedback'])): ?>
                        <div class="border-t pt-3">
                            <p class="text-sm text-green-600"><strong>Feedback:</strong> <?= htmlspecialchars($row['feedback']) ?>
                            </p>
                            <p class="text-sm text-green-600"><strong>Rating:</strong> ⭐ <?= $row['rating'] ?>/5</p>
                            <p class="text-sm text-gray-500"><strong>Feedback given on:</strong> <?= $row['feedback_date'] ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-400">No feedback received yet.</p>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-base-content/50">No solutions provided yet.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>
<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>