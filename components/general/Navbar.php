<header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <a class="flex items-center gap-2 lg:flex-1" href="/CivilIssueResolution/">
            <img class="h-8 w-auto" src="image/logo.png" alt="">
            <div class="flex flex-col items-start gap-1">
                <div class="flex items-baseline gap-[2px]">
                    <span class="text-primary font-extrabold text-xl">
                        CIVIL
                    </span>
                    <span class="text-accent font-semibold text-xl">
                        ISSUE
                    </span>
                    <span class="text-secondary font-extrabold text-xl">
                        RESOLUTION
                    </span>
                </div>
                <hr class="w-full border border-white" />
                <span class="text-sm text-white italic">
                    Problems are not stop signs, they are guidelines
                </span>
            </div>
        </a>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="about.php" class="text-lg font-semibold text-white/50 hover:text-secondary">ABOUT</a>
            <a href="contact.php" class="text-lg font-semibold text-white/50 hover:text-secondary">CONTACT</a>
        </div>
        <div class="hidden gap-2 lg:flex lg:flex-1 lg:justify-end">
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="text-lg font-semibold btn btn-success"> <i
                        class="fa-solid fa-right-to-bracket"></i>Login <i class="fa-solid fa-chevron-down"></i></div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                    <li class="text-center uppercase font-semibold w-full my-1"><a class="text-center"
                            href="admin_login.php">Admin</a></li>
                    <li class="text-center uppercase font-semibold w-full my-1"><a class="text-center"
                            href="user_login.php">User</a></li>
                </ul>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="text-lg font-semibold btn btn-success"><i
                        class="fa-solid fa-user"></i>Sign Up <i class="fa-solid fa-chevron-down"></i></div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                    <li class="text-center uppercase font-semibold w-full my-1"><a class="text-center"
                            href="admin_signup.php">Admin</a></li>
                    <li class="text-center uppercase font-semibold w-full my-1"><a class="text-center"
                            href="user_signup.php">User</a></li>
                </ul>
            </div>
            <div class="dropdown dropdown-left">
                <?php include "./components/general/ThemeToggler.php" ?>
            </div>
        </div>
    </nav>
</header>