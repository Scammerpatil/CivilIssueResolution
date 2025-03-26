<?php
$user_name = $_SESSION['name'];
$user_initials = strtoupper(substr($user_name, 0, 1));
if (strpos($user_name, ' ') !== false) {
    $name_parts = explode(" ", $user_name);
    $user_initials = strtoupper(substr($name_parts[0], 0, 1) . substr($name_parts[1], 0, 1));
}

$user_avatar = "../../image/admin.png";
?>

<header class="navbar w-full absolute inset-x-0 top-0 z-50 p-6 lg:px-8">
    <div class="mx-2 flex-1 px-2">
        <div class="flex items-center gap-2 lg:flex-1">
            <img class="h-8 w-auto" src="../../image/logo.png" alt="">
            <div class="flex flex-col items-start gap-1">
                <div class="flex items-baseline gap-[2px]">
                    <span class="text-primary font-extrabold text-xl">CIVIL</span>
                    <span class="text-accent font-semibold text-xl">ISSUE</span>
                    <span class="text-secondary font-extrabold text-xl">RESOLUTION</span>
                </div>
                <hr class="w-full border border-white" />
                <span class="text-sm text-white/70 italic">Problems are not stop signs, they are guidelines</span>
            </div>
        </div>
    </div>

    <div class="hidden gap-4 lg:flex lg:flex-1 lg:justify-end items-center">
        <!-- Theme Selector -->
        <div class="dropdown dropdown-left">
            <?php include "../../components/general/ThemeToggler.php" ?>
        </div>

        <!-- Admin Profile Dropdown -->
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost h-14 flex items-center">
                <img src="<?= $user_avatar; ?>" alt="avatar" class="rounded-full h-14 w-14" />
            </div>
            <ul tabindex="0" class="dropdown-content items-center menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                <div
                    class="bg-primary text-primary-content rounded-full w-14 h-14 flex justify-center items-center text-lg font-bold py-2">
                    <?= $user_initials; ?>
                </div>
                <p class="text-center font-bold mt-2"><?= htmlspecialchars($user_name); ?></p>
                <hr class="border border-base-content w-full my-2" />
                <div class="w-full">
                    <li class="text-base uppercase text-center"><a
                            href="/CivilIssueResolution/views/user/">Dashboard</a>
                    </li>
                    <li class="text-base uppercase text-center"><a
                            href="/CivilIssueResolution/views/user/profile.php">Profile</a></li>
                    <li class="text-base uppercase text-center"><a
                            href="/CivilIssueResolution/server/auth/logout.php">Logout</a>
                    </li>
                </div>
            </ul>
        </div>
    </div>
</header>