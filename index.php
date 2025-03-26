<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<?php
include './components/general/Header.php';
include './config/db.php';
?>

<body style="font-family: Dosis, sans-serif;">
    <?php include './components/general/Navbar.php' ?>
    <?php include './components/general/Hero.php' ?>

    <div class="px-10">
        <h2 class="text-2xl font-bold text-center my-6">All Reported Issues</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php
            $query = "
                SELECT 
                    p.*, 
                    s.solution, s.admin_id, s.solution_date, 
                    a.admin_name AS solver_name 
                FROM posts p
                LEFT JOIN solution s ON p.pid = s.post_id
                LEFT JOIN admin a ON s.admin_id = a.admin_id
                ORDER BY p.posted_date DESC";

            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)): ?>
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

                            <?php if ($row['solution']): ?>
                                <hr class="border border-base-content w-full my-2" />
                                <h3 class="text-lg font-bold text-green-600">Solution Provided</h3>
                                <p class="text-base-content/70"><?= htmlspecialchars($row['solution']) ?></p>
                                <p class="text-sm text-base-content/50"><strong>Solver:</strong>
                                    <?= htmlspecialchars($row['solver_name']) ?></p>
                                <p class="text-sm text-base-content/50"><strong>Resolved on:</strong> <?= $row['solution_date'] ?>
                                </p>
                            <?php else: ?>
                                <p class="text-sm text-red-500 font-semibold">No solution provided yet.</p>
                            <?php endif; ?>
                        </div>
                        <hr class="border border-base-content w-full my-2" />
                        <button class="btn btn-<?= $row['solution'] ? "success" : "error" ?> disabled">
                            <?= $row['solution'] ? "Resolved" : "Pending" ?>
                        </button>
                    </div>
                <?php endwhile; ?>
            <?php } else { ?>
                <p class="text-center text-base-content/500">No problems listed.</p>
            <?php } ?>
        </div>

        <div class="flex justify-center gap-4 my-6">
            <a href="user_login.php" class="btn btn-primary rounded-lg">Have an Issue? Add It</a>
            <a href="user_login.php" class="btn btn-success px-6 py-2 rounded-lg">Login</a>
        </div>
    </div>
</body>

</html>