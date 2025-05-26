<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Weapon & Accident Detection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Light background color */
        }
        .topnav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #2b3e50;
            padding: 15px;
        }
        .topnav .title {
            font-size: 22px;
            color: #ffdd67;
        }
        .nav-links {
            display: flex;
            gap: 20px; /* Space between links */
            margin-left: auto; /* Push links to the right */
            align-items: center; /* Center items vertically */
        }
        .nav-links a {
            color: #fff;
            text-decoration: none;
            padding: 14px 20px;
            transition: background-color 0.3s; /* Smooth transition */
        }
        .nav-links a:hover {
            background-color: #EAE4DD; /* Yellow background for hover */
            color: #2b3e50; /* Change text color for contrast */
        }
        .nav-links a.active {
            background-color: #ffdd67; /* Yellow background for active link */
            color: #2b3e50; /* Change text color for contrast */
        }
        .container {
            padding: 40px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Center the container */
            max-width: 800px; /* Limit width */
        }
        h1, h2 {
            color: #2b3e50; /* Heading color */
        }
        p {
            line-height: 1.6; /* Improve readability */
        }
        .footer {
    background-color: #2b3e50;
    color: #fff;
    padding: 20px 0;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    flex: 1;
    padding: 10px;
}

.footer-section h4 {
    margin-bottom: 10px;
    font-size: 18px;
    color: #f1c40f; /* Gold color for headings */
}

.footer-section p,
.footer-section ul {
    margin: 5px 0;
    font-size: 14px;
}

.footer-section ul {
    list-style-type: none;
    padding: 0;
}

.footer-section ul li {
    margin: 5px 0;
}

.footer-section a {
    color:rgb(231, 227, 209); /* Gold color for links */
    text-decoration: none;
}

.footer-section a:hover {
    text-decoration: underline;
}

.social-media {
    display: flex;
    gap: 15px; /* Space between icons */
}

.social-media a {
    color:rgb(126, 125, 123); /* Gold color for icons */
    font-size: 30px; /* Size of the icons */
}

.social-media a:hover {
    color: #fff; /* Change color on hover */
}

.footer-bottom {
    text-align: center;
    padding: 10px 0;
    background-color: #222;
}

.footer-bottom p {
    margin: 0;
    font-size: 12px;
}
    </style>
</head>
<body>
    <div class="topnav">
    <div class="logo">
            <img src="images/logo1.png" alt="Logo" style="height: 40px;"/> <!-- Adjust height as needed -->
        </div>
        <div class="title">Welcome to the Weapon & Accident Detection Platform</div>
        <div class="nav-links">
            <a href="index.php">Weapon</a>
            <a href="index2.php">Accident</a>
            <a class="active" href="about.php">About Us</a>
            <a href="analysis.php">Analysis</a>
            <a href="news.html">News</a>
            <a href="index.php?logout='1'" style="color: #fff; padding: 14px 20px; text-decoration: none;">Logout</a> <!-- Logout link -->
            <div class="notification-icon">
                <i class="fas fa-bell" style="font-size: 30px; color: #fff;"></i> <!-- Bell icon -->
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Welcome to Our Platform</h1>
        <p>We are dedicated to enhancing public safety through advanced technology in weapon and accident detection. Our system employs cutting-edge techniques to ensure rapid response and efficient monitoring.</p>
        
        <h2>Our Mission</h2>
        <p>Our mission is to provide a safer environment for communities by leveraging innovative solutions and promoting awareness about public safety.</p>
        
        <h2>Our Vision</h2>
        <p>We envision a world where technology and human efforts work hand in hand to prevent accidents and enhance safety measures, ultimately creating a better living environment for all.</p>

        <h2>Our Team</h2>
        <p>Our team consists of passionate professionals with diverse backgrounds in technology, safety, and community service. Together, we strive to make a significant impact in the field of safety and security.</p>
        
        <h2>Contact Us</h2>
        <p>If you have any questions or suggestions, feel free to reach out to us at <a href="mailto:amiv4488@gmail.com">amiv4488@gmail.com</a>.</p>
    </div>
    <div class="container">
        <h1>How to Use This System</h1>
        <p>Welcome to the <strong>Weapon & Accident Detection System</strong>. This system has been designed to enhance public safety through real-time detection and alerting mechanisms. Below is a comprehensive guide on how to effectively use this system.</p>

        <h2>1. Login to the System</h2>
        <p>Access the Login Page: Start by navigating to the login page of the system.</p>
        <p>Enter Your Credentials: Provide your username and password to access the dashboard.</p>
        <p>Forgot Password?: If you have trouble remembering your password, follow the instructions on the login page to reset it.</p>

        <h2>2. Understanding the Dashboard</h2>
        <p>Upon logging in, you will be directed to the dashboard where you can see the latest detections of weapons or accidents.</p>
        <p>The dashboard displays:</p>
        <ul>
            <li><strong>Notification Icon</strong>: This icon will show a badge indicating the number of new detections. Click on it for more details.</li>
            <li><strong>Detection Table</strong>: A table listing all detected images along with their timestamps, locations, and alert recipients.</li>
        </ul>

        <h2>3. Using the Image Detection Features</h2>
        <p>The system automatically captures images when a weapon or accident is detected. These images are uploaded to the server, along with the detection time and location data.</p>

        <h2>4. Email Alerts</h2>
        <p>Whenever an incident is detected:</p>
        <ul>
            <li>The system sends an automatic email alert to nearby hospitals and police stations.</li>
            <li>The email includes the location, time of detection, and a thumbnail of the captured image.</li>
        </ul>

        <h2>5. Sorting and Searching Images</h2>
        <p>You can easily sort and filter the detection images based on:</p>
        <ul>
            <li><strong>Time</strong>: Use the date range input fields to specify a start and end date.</li>
            <li><strong>Location</strong>: Enter specific locations to find relevant detections.</li>
            <li><strong>Email Alert Recipient</strong>: You can also search based on the email address that received the alert.</li>
        </ul>
        <p>Click the <strong>Search</strong> button after entering your criteria to display filtered results in the detection table.</p>

        <h2>6. Viewing Images</h2>
        <p>Each image in the detection table has a "View" button. Click it to open the full image in a new tab for a better view of the captured evidence.</p>

        <h2>7. Logging Out</h2>
        <p>Once you have finished using the system, log out by clicking the <strong>Logout</strong> link in the navigation menu. This will ensure your account remains secure.</p>
    </div>

    <footer class="footer">
        <div class="footer-container">
        <div class="footer-section">
            <img src="images/logo1.png" alt="Company Logo" style="height: 150px; margin-bottom: 10px;"> <!-- Adjust height as needed -->
        </div>
            <div class="footer-section">
                <h4>Contact Us</h4>
                <p>Email: info@example.com</p>
                <p>Phone: (123) 456-7890</p>
                <p>Address: 123 Main St, City, Country</p>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#privacy">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Follow Us</h4>
                <div class="social-media">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; Weapon & Accident Detection Platform. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
