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

// Set timezone to Indian Standard Time (IST)
date_default_timezone_set('Asia/Kolkata');




// Read the content of the location.txt file, with error handling
$lastDetectedLocation = file_get_contents("location.txt");

if ($lastDetectedLocation === FALSE) {
    $lastDetectedLocation = "Location not available"; // Fallback if file cannot be read
}

// Function to get images from the directory
function getImages($directory) {
    $images = glob("$directory/*.jpg");
    return $images;
}

// Folder where images are saved
$save_frame_dir = 'C:/xampp/htdocs/Final Project Code/save_frame'; // Adjust the path as necessary
$images = getImages($save_frame_dir);

// Count new images for notification
$imageCount = count($images);

// Initialize or retrieve the session variable for previous image count
if (!isset($_SESSION['previous_image_count'])) {
    $_SESSION['previous_image_count'] = 0; // Initialize on first load
}

$newImagesCount = $imageCount - $_SESSION['previous_image_count'];

// Update the previous image count for the next page load
$_SESSION['previous_image_count'] = $imageCount;


// Function to get image file creation time and convert to IST
function getImageTime($imagePath) {
    return date("Y-m-d H:i:s", filemtime($imagePath)); // Get the file modification time in IST
}

// Store the path to the uploaded audio file
$alarmSoundPath = 'C:\xampp\htdocs\Final Project Code\audio\emergency-alarm.mp3'; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weapon & Accident Detection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
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
        .notification-icon {
            position: relative;
        }
        .notification-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 14px;
        }
        .container {
            padding: 40px;
        }
        .search-form {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .search-form input, .search-form button {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-form input[type="text"] {
            width: 200px;
        }
        .search-form input[type="date"] {
            width: 150px;
        }
        .search-form button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .search-form button:hover {
            background-color: #45a049;
        }
        .detection-table {
            width: 100%;
            border-collapse: collapse;
        }
        .detection-table th, .detection-table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .detection-table th {
            background-color: #2b3e50;
            color: #fff;
        }
        .detection-table img {
            width: 150px;
            height: auto;
        }
        .detection-table button {
            padding: 8px 16px;
            background-color: #ffdd67;
            border: none;
            cursor: pointer;
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

         /* Chatbot Styles */
         .chatbot-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color:rgb(53, 128, 115);
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: background-color 0.3s ease;
        }

        .chatbot-icon:hover {
            background-color:rgb(33, 87, 90); /* Highlight color on hover */
        }

        .chatbot-icon img {
            width: 45px;
            height: 45px;
        }

        #chatbotModal {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 400px;
            height: 500px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            font-family: Arial, sans-serif;
            z-index: 9999;
            transition: all 0.3s ease;
        }

        #chatbotModal::before {
            content: "Chatbot JINI";
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 50px; /* Height of the header */
    background-color:rgb(80, 105, 131); /* Blue background */
    font-size: 18px; /* Adjust font size */
    font-weight: bold; /* Make the text bold */
    font-family: 'Arial', sans-serif; /* Change font family */
    text-transform: uppercase; /* Uppercase text */
    letter-spacing: 2px; /* Add some space between letters */
    color: #fff;    }

        #chatbotContent {
            width: 100%;
            height: 100%;
        }

        .chatbot-close-btn {
            position: absolute;
            top: 62px;
            right: 120px;
            background-color:rgb(232, 232, 232);
            color: rgb(65, 65, 65);
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
        }

        .chatbot-close-btn:hover {
            background-color: rgb(220, 219, 219);
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
            <a class="active" href="">Weapon</a>
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/index2.php#">Accident</a>
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/aboutus.php#">About Us</a>
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/analysis.php">Analysis</a>
            <a href="news.html">News</a>
            <a href="index.php?logout='1'" style="color: #fff; padding: 14px 20px; text-decoration: none;">Logout</a> <!-- Logout link -->
            <div class="notification-icon">
                <i class="fas fa-bell" style="font-size: 30px; color: #fff;"></i> <!-- Bell icon -->
                <?php if ($newImagesCount > 0): ?>
                    <span class="notification-count"><?php echo $newImagesCount; ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Integrated Search Form -->
        <div class="search-form">
            <input type="text" id="location" placeholder="Location" />
            <input type="email" id="alertReceiver" placeholder="Alert was sent to" />
            <input type="date" id="startDate" value="<?php echo date('Y-m-d'); ?>" />
            <input type="date" id="endDate" value="<?php echo date('Y-m-d'); ?>" />
            <button id="searchBtn" type="button">Search</button>
        </div>

        <!-- Table for displaying detections -->
        <table class="detection-table" id="detectionTable">
            <thead>
                <tr>
                    <th>Detection</th>
                    <th>Location</th>
                    <th>Alert was sent to</th>
                    <th>Time</th>
                    <th>Alert</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the images and display them in the table
                foreach ($images as $image) {
                    // Convert the absolute path to a relative path for the browser
                    $relativePath = str_replace('C:/xampp/htdocs', '', $image);

                    // Get the time the image was created in IST
                    $imageTime = getImageTime($image);

                    // Here you should dynamically fill in the 'Location' and 'Alert was sent to' fields
                    echo "<tr>
                            <td><img src='$relativePath' alt='Detection Image'></td>
                            <td>Pen</td>
                            <td>amishavartak1980@gmail.com</td>
                            <td>$imageTime</td>
                            <td><button type='button' onclick='viewImage(\"$relativePath\")'>View</button></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>


    <script>

        function viewImage(imagePath) {
            // Open the image in a new tab
            window.open(imagePath, '_blank');
        }

        document.getElementById('searchBtn').addEventListener('click', function () {
            const location = document.getElementById('location').value.toLowerCase().trim();
            const alertReceiver = document.getElementById('alertReceiver').value.toLowerCase().trim();
            const startDate = new Date(document.getElementById('startDate').value);
            const endDate = new Date(document.getElementById('endDate').value);

            const table = document.querySelector('.detection-table');
            const rows = table.getElementsByTagName('tr');

            // Loop through all table rows (except the header)
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                const rowLocation = cells[1].innerText.toLowerCase(); // Location column
                const rowEmail = cells[2].innerText.toLowerCase(); // Alert sent to column
                const rowTime = new Date(cells[3].innerText); // Time column

                const rowDateOnly = rowTime.toISOString().split('T')[0]; // Get YYYY-MM-DD

                // Check if the row matches the search criteria
                const isLocationMatch = location === '' || rowLocation.includes(location);
                const isEmailMatch = alertReceiver === '' || rowEmail.includes(alertReceiver);
                const isDateMatch = rowDateOnly >= startDate.toISOString().split('T')[0] && rowDateOnly <= endDate.toISOString()

                // Show or hide the row based on the match
                if (isLocationMatch && isEmailMatch && isDateMatch) {
                    rows[i].style.display = ''; // Show the row
                } else {
                    rows[i].style.display = 'none'; // Hide the row
                }
            }
        });

        // Function to open the chatbot with the BotPress link
        function openChatbot() {
            document.getElementById("chatbotModal").style.display = "block";
            const iframe = document.createElement('iframe');
            iframe.src = "https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/12/24/08/20241224080520-PIU05BXP.json";
            iframe.width = "100%";
            iframe.height = "100%";
            iframe.style.border = "none";
            document.getElementById("chatbotContent").appendChild(iframe);
        }

        // Function to close the chatbot
        function closeChatbot() {
            document.getElementById("chatbotModal").style.display = "none";
            const chatbotContent = document.getElementById("chatbotContent");
            // Remove the iframe when closing the modal
            chatbotContent.innerHTML = '';
        }


        
    </script>

    <!-- Chatbot Modal -->
    <div id="chatbotModal">
        <button class="chatbot-close-btn" onclick="closeChatbot()">Close</button>
        <div id="chatbotContent">
            <!-- BotPress iframe will be injected here -->
        </div>
    </div>

    <!-- Chatbot Icon -->
    <div class="chatbot-icon" onclick="openChatbot()">
        <img src="images/botimg.png" alt="Chatbot" /> <!-- Your custom chatbot icon -->
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
