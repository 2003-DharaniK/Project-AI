<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About AgroLinker Work Opportunities</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 50px auto;
        }

        .content {
            flex: 1;
        }

        h1 {
            font-size: 36px;
            color: #388e3c;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #666;
        }

        .highlight {
            color: #ff5722;
            font-weight: 600;
        }

        .content img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .image-section {
            flex: 1;
            padding-left: 30px;
        }

        @media(max-width: 900px) {
            .container {
                flex-direction: column;
            }

            .image-section {
                padding-left: 0;
                margin-top: 20px;
            }
        }

        /* Button */
        .cta-button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #ff5722;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #e64a19;
        }

        /* Breadcrumb container */
        .breadcrumb {
            display: flex;
            align-items: center;
            list-style: none;
            background-color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .breadcrumb li {
            margin-right: 10px;
        }

        .breadcrumb li a {
            text-decoration: none;
            color: #388e3c; /* Green color */
            font-weight: 500;
        }

        .breadcrumb li a:hover {
            text-decoration: underline;
        }

        .breadcrumb li::after {
            content: '>';
            margin-left: 10px;
            color: #888; /* Grey color for the arrow */
        }

        .breadcrumb li:last-child::after {
            content: '';
            margin-left: 0;
        }

        .breadcrumb li:last-child a {
            color: #555; /* Current page color (grey) */
            pointer-events: none; /* Disable the link for the current page */
            font-weight: 600;
        }
    </style>
</head>
<body>

    <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="careers.html">Careers</a></li>
        <li><a href="worker.html">Worker Opportunities</a></li>
    </ul>

    <div class="container">
        <div class="content">
            <h1>Why AgroLinker Provides Work Opportunities</h1>
            <p>At AgroLinker, we are committed to <span class="highlight">empowering individuals</span> and supporting the agricultural community. Our mission is to create <span class="highlight">sustainable jobs</span> that benefit both the environment and the people involved. By providing work opportunities, we aim to connect <span class="highlight">farmers</span> and workers in a way that maximizes the use of natural resources and ensures <span class="highlight">zero waste.</span></p>
            
            <p>Through these opportunities, we strive to bring <span class="highlight">economic stability</span> to those who need it the most. Whether you're a <span class="highlight">skilled professional</span> or looking for a chance to start anew, AgroLinker is here to offer <span class="highlight">meaningful work</span> that supports a brighter future for everyone involved.</p>

            <a href="form.php" class="cta-button">Join Us</a>
        </div>
        
        <div class="image-section">
            <img src="work.jpeg" alt="Work Opportunities" style="width: 90%;height: 40%;">
        </div>
    </div>

</body>
</html>
