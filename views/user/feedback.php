<?php
$page_title = "Give Feedback";
include '../../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /CivilIssueResolution/user_login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$query = "SELECT p.*,s.id, s.solution, s.solution_date, u.admin_name AS admin_name 
          FROM posts p
          LEFT JOIN solution s ON p.pid = s.post_id
          LEFT JOIN admin u ON s.admin_id = u.admin_id
          WHERE p.user_id = ? AND s.solution IS NOT NULL
          ORDER BY p.posted_date DESC";


$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $feedback = trim($_POST['feedback']);
    $rating = intval($_POST['rating']);
    $solution_id = intval($_POST['solution_id']);

    if (!empty($feedback) && $rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare("INSERT INTO feedback (solution_id, user_id, feedback, rating, posted_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("iisi", $solution_id, $user_id, $feedback, $rating);

        if ($stmt->execute()) {
            header("Location: /CivilIssueResolution/views/user/feedback.php");
            exit();
        } else {
            $error = "Failed to submit feedback.";
        }
    } else {
        $error = "Please provide valid feedback and rating.";
    }
}

ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Give Feedback for Resolved Issues</h2>

    <?php if (isset($error))
        echo "<p class='text-red-500'>$error</p>"; ?>

    <?php if ($result->num_rows > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="border p-4 rounded-lg shadow-lg space-y-2">
                    <h3 class="text-xl font-semibold"> <?= htmlspecialchars($row['problem']) ?> </h3>
                    <p class="text-sm text-base-content/60"><strong>Location:</strong>
                        <?= htmlspecialchars($row['problem_location']) ?></p>
                    <p class="text-sm text-base-content/60"><strong>Resolved by:</strong>
                        <?= htmlspecialchars($row['admin_name']) ?>
                    </p>
                    <p class="text-sm text-base-content/60"><strong>Solution:</strong> <?= htmlspecialchars($row['solution']) ?>
                    </p>
                    <p class="text-sm text-base-content/60"><strong>Resolved on:</strong> <?= $row['solution_date'] ?></p>

                    <button onclick="openFeedbackModal(<?= $row['id'] ?>)" class="btn btn-primary w-full">Give
                        Feedback</button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-base-content/50">No resolved issues found.</p>
    <?php endif; ?>
</div>

<!-- Feedback Modal -->
<dialog id="feedbackModal" class="modal">
    <div class="modal-box">
        <h3 class="text-xl font-semibold mb-2 text-base-content">Submit Feedback</h3>
        <form action="" method="POST" class="space-y-3">
            <input type="hidden" name="solution_id" id="solution_id">
            <textarea name="feedback" placeholder="Your feedback..." class="textarea textarea-bordered w-full"
                required></textarea>
            <select name="rating" class="select select-bordered w-full" required>
                <option value="" disabled selected>Rate the solution (1-5)</option>
                <option value="1">1 - Poor</option>
                <option value="2">2 - Fair</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Very Good</option>
                <option value="5">5 - Excellent</option>
            </select>
            <div class="flex space-x-3">
                <button type="submit" class="btn btn-success">Submit</button>
                <button type="button" onclick="closeFeedbackModal()" class="btn btn-error">Cancel</button>
            </div>
        </form>
    </div>
</dialog>

<script>
    function openFeedbackModal(issueId) {
        document.getElementById("feedbackModal").showModal();
        document.getElementById("solution_id").value = issueId;
    }

    function closeFeedbackModal() {
        document.getElementById("feedbackModal").close();
        document.getElementById("feedbackModal").classList.add("hidden");
    }
</script>

<?php $conn->close(); ?>
<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>