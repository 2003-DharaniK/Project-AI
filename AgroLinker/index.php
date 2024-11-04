<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Style for Google Translate dropdown */
        .google-translate {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
            font-size: 16px;
        }

        .google-translate select {
            padding: 8px;
            background-color: #f1f1f1;
            border: none;
            border-radius: 4px;
            font-size: 14px;
        }
        .cards{
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="dashboard">
        <!-- Google Translate Widget -->
        <div class="google-translate" id="google_translate_element"></div>

        <!-- Left Toggle Menu -->
        <aside class="sidebar" id="sidebar">
            <div class="logo">
                <h2>Farmer Hub</h2>
            </div>
            <ul class="menu">
                <li class="menu-item"><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="menu-item"><a href="products.php"><i class="fas fa-seedling"></i> Products</a></li>
                <li class="menu-item"><a href="sales.php"><i class="fas fa-chart-line"></i> Sales</a></li>
                <li class="menu-item"><a href="invoice.php"><i class="fas fa-file-invoice-dollar"></i> Invoices</a></li>
                <li class="menu-item"><a href="order.php"><i class="fas fa-box-open"></i> Orders</a></li>
                <li class="menu-item"><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>                
                <li class="menu-item"><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li class="menu-item"><a href="power.php"><i class="fas fa-bolt"></i> Power Management</a></li>
                <li class="menu-item"><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <!-- Right Content Area -->
        <main class="content">
            <header>
                <h1>Welcome, Farmer!</h1>
            </header>
            <section class="cards">
                <div class="card" onclick="window.location.href='products.php';">
                    <i class="fas fa-seedling card-icon"></i>
                    <h3>Total Products</h3>
                    <p>50</p>
                    <span>New Arrivals: 10</span>
                </div>
                <div class="card" onclick="window.location.href='sales.php'">
                    <i class="fas fa-chart-line card-icon"></i>
                    <h3>Total Sales</h3>
                    <p>$20,000</p>
                    <span>+5% from last week</span>
                </div>                
                <div class="card" onclick="window.location.href='invoice.php';">
                    <i class="fas fa-file-invoice-dollar card-icon"></i>
                    <h3>Invoices</h3>
                    <p>150 Processed</p>
                    <span>Pending: 20</span>
                </div>
                <div class="card" onclick="window.location.href='order.php';">
                    <i class="fas fa-box-open card-icon"></i>
                    <h3>Orders</h3>
                    <p>320</p>
                    <span>Completed: 300</span>
                </div>
                <div class="card">
                    <i class="fas fa-chart-pie card-icon"></i>
                    <h3>Farm Statistics</h3>
                    <p>Efficiency: 80%</p>
                    <span>Daily Increase: 2%</span>
                </div>
            </section>
        </main>
    </div>

    <!-- Google Translate script -->
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({
          pageLanguage: 'en',
          includedLanguages: 'en,ta',
          layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
      }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>
</html>
