<?php
session_start();
$page_title = "Manage Issues";
include '../../config/db.php';

if ($_SESSION['user_type'] !== 'admin') {
    header("Location: /CivilIssueResolution/admin_login.php");
    exit();
}
$query = "SELECT * FROM posts ORDER BY posted_date DESC";
$result = $conn->query($query);
ob_start();
?>

<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Manage Reported Issues</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table-auto w-full border-collapse border border-base-content/30">
            <thead>
                <tr class="bg-base-content/20">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Title</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Location</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td class="border px-4 py-2"> <?= $row['pid'] ?> </td>
                        <td class="border px-4 py-2"> <img class="mask mask-squircle"
                                src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Issue Image" />
                        </td>
                        <td class="border px-4 py-2"> <?= htmlspecialchars($row['problem']) ?> </td>
                        <td class="border px-4 py-2"> <?= htmlspecialchars($row['description']) ?> </td>
                        <td class="border px-4 py-2"> <?= htmlspecialchars($row['problem_location']) ?> </td>
                        <td class="border px-4 py-2"> <?= $row['status'] ? "Resolved" : "Pending" ?> </td>
                        <td class="border px-4 py-2 flex gap-2 h-full items-center justify-center">
                            <a href="edit_issue.php?id=<?= $row['pid'] ?>" class="btn btn-warning">Edit</a>
                            <form method="POST" action="delete_issue.php" onsubmit="return confirm('Are you sure?');">
                                <input type="hidden" name="delete_id" value="<?= $row['pid'] ?>">
                                <button type="submit" class="btn btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center text-gray-500">No reported issues found.</p>
    <?php endif; ?>
</div>

<?php $conn->close(); ?>
<?php
$page_content = ob_get_clean();
include './components/layout.php';
?>