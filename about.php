<!DOCTYPE html>
<html lang="en" data-theme="corporate">
<?php
include './components/general/Header.php';
include './config/db.php';
?>

<body style="font-family: Dosis, sans-serif;">
    <?php include './components/general/Navbar.php' ?>
    <div class="hero h-80 relative bg-overlay z-10 overflow-hidden" style="background-image: url(image/banner.jpg);">
        <div class="hero-content text-center">
            <div class="">
                <h1 class="text-4xl font-semibold text-white/80 uppercase">About Us</h1>
            </div>
        </div>
    </div>
    <marquee behavior="scroll" direction="left" class="text-center text-2xl text-base-content font-bold"
        style="font-size: 20px; font-weight: bold; padding: 10px; text-align: center;">
        Welcome to the Online Civilians Problem Resolution</marquee>

    <div class="px-10 py-10">
        <h2 class="text-3xl font-semibold text-primary mb-5">About Civil Issue Resolution System</h2>
        <p class="text-lg text-base-content mb-5">
            The Civil Issue Resolution System is an innovative project aimed at simplifying the process of resolving
            civil disputes and issues within communities. We understand that conflicts and disputes are inevitable in
            any society, but we believe that with the right tools and resources, these challenges can be managed
            effectively and efficiently. Our system provides a platform where civilians can report and address various
            issues such as property disputes, neighborhood conflicts, and other civil matters.
        </p>

        <p class="text-lg text-base-content mb-5">
            Our mission is to offer a streamlined, user-friendly platform that connects citizens with legal
            professionals, mediators, and relevant authorities. By utilizing technology, the Civil Issue Resolution
            System ensures that resolutions are reached in a timely, transparent, and fair manner. Whether it's through
            online mediation, legal advice, or access to appropriate government services, our system aims to reduce the
            burden on individuals, families, and communities by making conflict resolution more accessible.
        </p>

        <p class="text-lg text-base-content mb-5">
            With an intuitive interface and a comprehensive database of resources, we hope to empower citizens to take
            charge of their legal matters and resolve disputes without the need for costly and time-consuming court
            proceedings. Our goal is to foster peace, harmony, and understanding within communities through effective
            communication and resolution methods.
        </p>

        <h3 class="text-2xl font-semibold text-primary mt-5">Why Choose Us?</h3>
        <ul class="list-disc pl-5 text-lg text-base-content">
            <li>Simple and easy-to-use interface for reporting and resolving issues</li>
            <li>Access to legal experts and mediators for guidance and support</li>
            <li>Quick and efficient resolution processes</li>
            <li>Transparent and fair dispute resolution methods</li>
            <li>Empowering individuals and communities to handle their civil issues</li>
        </ul>
    </div>

</body>

</html>