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
                <h1 class="text-4xl font-semibold text-white/80 uppercase">Contact Us</h1>
            </div>
        </div>
    </div>
    <marquee behavior="scroll" direction="left" class="text-center text-2xl text-base-content font-bold"
        style="font-size: 20px; font-weight: bold; padding: 10px; text-align: center;">
        Welcome to the Online Civilians Problem Resolution</marquee>

    <div class="px-10 py-10">
        <h2 class="text-3xl font-semibold text-primary mb-5">Contact Us</h2>

        <p class="text-lg text-base-content mb-5">
            We would love to hear from you! Whether you have questions about our services, need assistance with a civil
            issue, or simply want to reach out to our team, please feel free to contact us using the details below or by
            filling out the contact form. We are here to help!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Contact Form -->
            <div>
                <h3 class="text-2xl font-semibold text-primary mb-5">Get in Touch</h3>
                <form action="your_form_processing_script.php" method="POST">
                    <div class="mb-5">
                        <label for="name" class="block text-lg text-base-content">Full Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full px-4 py-2 border border-base-content rounded-md" placeholder="Your Name">
                    </div>
                    <div class="mb-5">
                        <label for="email" class="block text-lg text-base-content">Email Address</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 border border-base-content rounded-md" placeholder="Your Email">
                    </div>
                    <div class="mb-5">
                        <label for="message" class="block text-lg text-base-content">Message</label>
                        <textarea id="message" name="message" required
                            class="w-full px-4 py-2 border border-base-content rounded-md" placeholder="Your Message"
                            rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-full py-2 px-4 rounded-md">Send Message</button>
                </form>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-2xl font-semibold text-primary mb-5">Our Contact Information</h3>
                <p class="text-lg text-base-content mb-3"><strong>Email:</strong> contact@civilissueresolution.com</p>
                <p class="text-lg text-base-content mb-3"><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p class="text-lg text-base-content mb-3"><strong>Address:</strong> 1234 Justice Lane, Cityville,
                    Country
                </p>
                <p class="text-lg text-base-content mb-3"><strong>Business Hours:</strong> Monday to Friday, 9:00 AM -
                    6:00
                    PM</p>
            </div>
        </div>
    </div>

</body>

</html>