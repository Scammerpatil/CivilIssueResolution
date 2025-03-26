<?php
$current_page = basename($_SERVER['PHP_SELF']);
$user_type = $_SESSION['user_type'] ?? 'admin';
?>

<div class="drawer-side h-[calc(100vh-10rem)] overflow-y-auto">
    <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 text-base-content h-full w-80 p-4">
        <!-- Admin Sidebar -->
        <li class="text-lg <?= ($current_page == 'index.php') ? 'bg-primary text-white' : ''; ?>">
            <a href="index.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
        </li>
        <li class="text-lg <?= ($current_page == 'manage_issues.php') ? 'bg-primary text-white' : ''; ?>">
            <a href="manage_issues.php"><i class="fa-solid fa-tasks"></i> Pending Issues</a>
        </li>
        <li class="text-lg <?= ($current_page == 'feedbacks.php') ? 'bg-primary text-white' : ''; ?>">
            <a href="feedbacks.php"><i class="fa-solid fa-comments"></i> View Feedback</a>
        </li>
        <li class="menu-title">Account</li>
        <li class="text-lg <?= ($current_page == 'profile.php') ? 'bg-primary text-white' : ''; ?>">
            <a href="profile.php"><i class="fa-solid fa-user"></i> Profile</a>
        </li>
        <li class="text-lg">
            <a href="/CivilIssueResolution/server/auth/logout.php" class="text-red-500"><i
                    class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</div>