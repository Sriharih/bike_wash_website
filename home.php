<?php
session_start();
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bike Wash Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Navbar Styling */
        .navbar {
            background-color: white; /* Darker background for better contrast */
    color:  #111827;
    padding: 50px 20px;
    text-align: center;
        
            position: fixed;
            width: 100%;
            z-index: 10;
            top: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            color:  #111827;
        }

        .logo::before {
            font-size: 18px;
            margin-right: 8px;
            color: #1E3A8A;
        }

        .menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .menu a {
            margin-right: 20px;
            text-decoration: none;
            color:  #111827;
            font-size: 16px;
            padding: 10px;
            border-radius: 5px;
        }

        .menu a:hover {
            color:  #111827;
        }

        /* Login Button */
        .menu .login-btn {
            background-color: #111827;
            color: white;
            margin-right: 20px;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        .menu .login-btn:hover {
            background-color: #142865;
        }

        /* Hamburger Menu */
        .hamburger {
            color:  #111827;
            display: none;
            font-size: 26px;
            cursor: pointer;
            background: none;
            border: none;
            left: 50px;
            right: 20px; /* Align to right */
            top: 20px;
            transform: translateY(-50%); background: none;
        }

        /* Responsive Navbar */
        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background-color: white;
                text-align: center;
                padding: 10px 0;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                transform: translateY(-200%);
                transition: transform 0.3s ease-in-out;
            }

            .menu a {
                display: block;
                padding: 15px;
            }

            .hamburger {
                display: block;
            }
            .menu .login-btn{
                margin-right: 10px;
                font-size: 14px;
            }

            .menu.active {
                display: flex;
                transform: translateY(0);
            }
        }   

         /* Hero Section */
.hero {
    background: url('https://images.unsplash.com/photo-1558981852-426c6c22a060?auto=format&fit=crop&w=1350&q=80') center/cover no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    position: relative;
    padding: 20px;
}

/* Dark Overlay */
.hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5); /* Dark overlay */
}

/* Content Positioning */
.hero-content {
    position: relative;
    max-width: 700px;
    width: 90%;
}

/* Heading */
.hero h1 {
    font-size: 36px;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.8); /* Slight transparency */
}

/* Subtext */
.hero p {
    font-size: 18px;
    margin-bottom: 20px;
    color: rgba(255, 255, 255, 0.9);
}

/* Button Styling */
.btn {
    display: inline-block;
    background-color: #1e3a8a; /* Dark blue */
    color: white;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    transition: background 0.3s ease;
}
.btn:hover {
    background-color: #0f256e; /* Darker blue */
}
        .hero button {
            margin: 10px;
            padding: 10px 20px;
            background-color:  #111827;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

    
        .services {
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        .service:hover{
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .service-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .service {
            background: white;
            padding: 20px;
            border-radius: 10px;
            width: 250px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        
        .how-it-works {
            text-align: center;
            padding: 50px;
        }

        .steps {
            display: flex;
            justify-content: center;
            gap: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .step:hover{
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .step {
            width: 200px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
      

   


        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .footer {
    background-color: #111827; /* Darker background for better contrast */
    color: white;
    padding: 50px 20px;
    text-align: center;
}

.footer .container {
    max-width: 1200px;
    margin: auto;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
    justify-content: center;
    text-align: left;
}

.footer-section{
    display: block;
    margin-left: 20px;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
    color: white;
}

.brand {
    font-size: 22px;
    font-weight: bold;
    margin-left: 10px;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 15px;
    margin-right: 60px;
}

.social-links a {
    color: #9ca3af;
    font-size: 20px;
    transition: color 0.3s;
}

.social-links a:hover {
    color: #3b82f6;
}

.footer-section h3 {
    font-size: 18px;
    margin-bottom: 12px;
    margin-right: 60px;
    text-align:center;/*contact and working tim*/
}

ul {
    display: flex;
    flex-direction: column; /* Aligns items in a vertical list */
    align-items: flex-start; /* Aligns items to the left */
    gap: 5px; /* Adds space between each item */
    list-style: none; /* Removes default list styles */
    padding: 0;
}
ul li {
    display: flex;
    align-items: center; /* Ensures icon and text are in line */
    gap: 5px; /* Space between icon and text */
    font-size: 16px;

}
ul li i { /* Aligns icons properly */
    margin-right: 2px; /* Adds spacing between icon and text */
}


.footer-bottom {
    border-top: 1px solid #374151;
    margin-top: 30px;
    padding-top: 15px;
    font-size: 14px;
    text-align: center;
    color: #9ca3af;
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-section {
        margin-bottom: 15px;
    }

    .social-links {
        justify-content: center;
    }
}


        

    </style>
</head>
<body>
<nav class="navbar">
        <a href="#" class="logo">BikeWash</a>
        <button class="hamburger" onclick="toggleMenu()">☰</button>
        <div class="menu" id="nav-menu">
            <a href="home.php">Home</a>
            <a href="photoscroll.php">Gallery</a>
            <a href="Admine_login.php">Admin</a>
            <a href="<?php echo (isset($_SESSION['user']) || isset($_COOKIE['user'])) ? 'dashboard.html' : 'user_login.php'; ?>">
Book Service</a>
            <?php if (isset($_SESSION['user']) || isset($_COOKIE['user'])): ?>
    <a href="logout_confirm.php">
        <button style="background-color: #1e3a8a; color: white; padding: 12px 24px; font-size: 16px; font-weight: bold; border-radius: 5px; border: none; cursor: pointer; transition: background 0.3s ease;">
            Logout
        </button>
    </a>
<?php else: ?>
    <a href="user_login.php">
        <button style="background-color: #1e3a8a; color: white; padding: 12px 24px; font-size: 16px; font-weight: bold; border-radius: 5px; border: none; cursor: pointer; transition: background 0.3s ease;">
            Login
        </button>
    </a>
<?php endif; ?>



        </div>
    </nav>
    <div class="hero" >
        <div class="hero-content">
            <h1>PROFESSIONAL BIKE WASHING SERVICE</h1>
            <p>We provide premium bike washing services at your doorstep. Your bike deserves the best care.</p>
            <a href="<?php echo (isset($_SESSION['user']) || isset($_COOKIE['user'])) ? 'dashboard.html' : 'user_login.php'; ?>">
        <button>Book a Wash</button>
    </a>
        </div>
    </div>


    <section class="services">
        <h2>Our Services</h2>
        <div class="service-container">
            <div class="service">
                <h3>Basic Wash</h3>
                <p>A thorough exterior wash to remove dirt and grime.</p>
                <p class="price">$15</p>
            </div>
            <div class="service">
                <h3>Premium Wash</h3>
                <p>Includes chain degreasing, polishing, and detailed cleaning.</p>
                <p class="price">$25</p>
            </div>
            <div class="service">
                <h3>Pickup & Delivery</h3>
                <p>We pick up, clean, and deliver your bike back to you.</p>
                <p class="price">$35</p>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps">
            <div class="step">
                <h3>Book a Service</h3>
                <p>Select your service and schedule a convenient time.</p>
            </div>
            <div class="step">
                <h3>We Pick Up</h3>
                <p>Our dedicated team promptly arrives to collect your bike.</p>
            </div>
            <div class="step">
                <h3>Wash & delivery</h3>
                <p>Expert bike cleaning with easy pick-up and fast delivery.<p>
            </div>
          
    </section>




    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                            <h3>BikeWash</h3></span>
                    <ul>
                        <li>
                            <i data-lucide="phone" class="icon blue"></i> 
                            Professional bike washing services.
                        </li>
                           <li><i data-lucide="phone" class="icon blue"></i> 
                           We care for your bike like it's our own.
                        </li>
                        
                    </ul>

                    <div class="social-links">
                        <a href="index.html"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                          </svg><i data-lucide="facebook" class="icon"></i></a>
                        <a href="index.html"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z"/>
                          </svg><i data-lucide="twitter" class="icon"></i></a>
                        <a href="index.html"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                          </svg><i data-lucide="instagram" class="icon"></i></a>
                    </div>
                </div>
                
           
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                            <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                          </svg><i data-lucide="phone" class="icon blue" ></i>+91 9452345876</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                          </svg><i data-lucide="mail" class="icon blue"></i>contact@bikewash.com</li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                          </svg><i data-lucide="map-pin" class="icon blue"></i>123 Wash Street, Bike City, BC 12345</li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Working Hours</h3>
                    <ul>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                          </svg><i data-lucide="clock" class="icon blue" class="bi bi-clock"></i>Monday - Friday: <span class="text-gray">8:00 AM - 8:00 PM</span></li>
                        <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>
                          </svg><i data-lucide="clock" class="icon blue"></i>Saturday - Sunday: <span class="text-gray">9:00 AM - 6:00 PM</span></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <span id="year"></span> BikeWash. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script>
        
        function toggleMenu() {
            document.getElementById("nav-menu").classList.toggle("active");
        }
        document.getElementById("year").textContent = new Date().getFullYear();
        lucide.createIcons();
        function toggleMenu() {
            document.getElementById("nav-menu").classList.toggle("active");
        }
        document.getElementById("year").textContent = new Date().getFullYear();
        lucide.createIcons();

        document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".hamburger").addEventListener("click", function () {
        document.getElementById("nav-menu").classList.toggle("active");
    });
});

    </script>
</body>
</html>
