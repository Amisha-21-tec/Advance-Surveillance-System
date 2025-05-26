<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime and Traffic Analysis Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 5px;
        }
        .card1 {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 23%;
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 250px;
        }
        .card2 {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 23%;
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 300px;
            width: 2000px;
        }
        .card3 {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 23%;
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 550px;
            width: 480px;
        }
        .card4 {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 23%;
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 350px;
            width: 950px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        .card h3 {
            font-size: 18px;
            color: #2C3E50;
            margin-bottom: 10px;
        }
        .chart-container {
            width: 100%;
            height: 100%;
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
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/index.php">Weapon</a>
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/index2.php#">Accident</a>
            <a href="http://localhost/Final%20Project%20Code/Smart_Survilance_system/Client_Side/aboutus.php#">About Us</a>
            <a class="active" href="">Analysis</a>
            <a href="news.html">News</a>
            <a href="index.php?logout='1'" style="color: #fff; padding: 14px 20px; text-decoration: none;">Logout</a> <!-- Logout link -->
            <div class="notification-icon">
                <i class="fas fa-bell" style="font-size: 30px; color: #fff;"></i> <!-- Bell icon -->
            </div>

        </div>
    </div>


<div class="content">
    <!-- Arms Act Section -->
    <div class="section">
        <h2>Analysis Report (2022-2023)</h2>

        <div class="card-container">
            <div class="card1">
                <h3>Cases Under Arms Act</h3>
                <canvas id="casesChart" class="chart-container"></canvas>
            </div>

            <div class="card1">
                <h3>Arrests</h3>
                <canvas id="arrestsChart" class="chart-container"></canvas>
            </div>

            <div class="card1">
                <h3>Arms Recovered</h3>
                <canvas id="armsRecoveredChart" class="chart-container"></canvas>
            </div>

            <div class="card1">
                <h3>Use of Firearms</h3>
                <canvas id="firearmsChart" class="chart-container"></canvas>
            </div>
        </div>
    </div>

    <!-- Traffic Data Section -->
    <div class="section">
        <!--<h2>Traffic Data Analysis</h2> -->

        <div class="card-container">
            <div class="card2" >
                <h3>Traffic Fatalities (Line Chart)</h3>
                <canvas id="trafficLineChart" class="chart-container" width="900" height="130"></canvas>
            </div>

            <div class="card3">
                <h3>Traffic Fatalities Breakdown (Pie Chart)</h3>
                <canvas id="trafficPieChart" class="chart-container"></canvas>
            </div>

            <div class="card4">
                <h3>Traffic Fatalities vs Deaths (Scatter Plot)</h3>
                <canvas id="trafficScatterPlot" class="chart-container" width="550" height="160"></canvas>
            </div>
        </div>
    </div>
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


<script>
    // Data for Arms Act
    const years = ['2022', '2023'];
    const cases = [2227, 1853];
    const arrests = [2519, 2118];
    const armsRecovered = [782, 873];
    const firearmsUsed = [288, 248];

    // Traffic Data
    const trafficLabels = ["Speeding", "Drunk Driving", "Wrong Side", "Mobile Phone", "Jumping Signal", "Others"];
    const deaths = [119904, 4201, 9094, 3395, 1462, 30435];

    // Case Chart (Bar Graph)
    new Chart(document.getElementById('casesChart'), {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Cases Under Arms Act',
                data: cases,
                backgroundColor: '#FF5733',
                borderColor: '#C0392B',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Arrests Chart (Line Graph)
    new Chart(document.getElementById('arrestsChart'), {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: 'Arrests',
                data: arrests,
                fill: false,
                borderColor: '#2E86C1',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Arms Recovered (Histogram)
    new Chart(document.getElementById('armsRecoveredChart'), {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Arms Recovered',
                data: armsRecovered,
                backgroundColor: '#FF8C00',
                borderColor: '#D35400',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Use of Firearms (Area Chart)
    new Chart(document.getElementById('firearmsChart'), {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: 'Use of Firearms',
                data: firearmsUsed,
                fill: true,
                backgroundColor: '#FFCD00',
                borderColor: '#F39C12',
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Traffic Data - Pie Chart
    new Chart(document.getElementById('trafficPieChart'), {
        type: 'pie',
        data: {
            labels: trafficLabels,
            datasets: [{
                label: 'Traffic Fatalities by Category',
                data: deaths,
                backgroundColor: ['#FF5733', '#FF8C00', '#FFCD00', '#2E86C1', '#1F618D', '#27AE60'],
                borderColor: ['#C0392B', '#D35400', '#F39C12', '#3498DB', '#1F618D', '#2ECC71'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    // Traffic Data - Line Chart
    new Chart(document.getElementById('trafficLineChart'), {
        type: 'line',
        data: {
            labels: trafficLabels,
            datasets: [{
                label: 'Traffic Fatalities by Category',
                data: deaths,
                fill: false,
                borderColor: '#2E86C1',
                tension: 0.1,

            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Traffic Data - Scatter Plot
    new Chart(document.getElementById('trafficScatterPlot'), {
        type: 'scatter',
        data: {
            datasets: [{
                label: 'Traffic Fatalities vs Deaths',
                data: trafficLabels.map((label, index) => ({ x: index + 1, y: deaths[index] })),
                backgroundColor: '#FF5733'
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { type: 'linear', position: 'bottom' },
                y: { beginAtZero: true }
            }
        }
    });
</script>

</body>
</html>
