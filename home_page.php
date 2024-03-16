<!DOCTYPE html>
<html>

<head>
    <title>Bus Booking System</title>
    <style>
        body {
            width: 100vw;
            height: 100vw;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: white; /* Set text color to white for the entire page */
        }

        div.navbar {
            background-color: #333;
            overflow: hidden;
            text-align: center; /* Center-align the navigation bar */
        }

        div.navbar a {
            display: inline-block; /* Display links as inline-block to control spacing */
            color: white;
            text-align: center;
            padding: 16px 30px;
            text-decoration: none;
        }

        div.navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        div.content {
            padding: 20px;
            text-align: center; /* Center-align the content */
        }

        h1 {
            font-family: monospace;
        }

        h2 {
            text-align: center;
            font-family: monospace;
        }

        form {
            margin-top: 20px;
        }

        select {
            padding: 8px;
        }

        .container {
            display: flex;
        }

        .intro {
            text-align: center;
        }

    .description {
        margin-top: 50px; /* Increased margin for more spacing */
        font-size: 18px;
        text-align: justify;
        line-height: 1.5; /* Adjust line height for better readability */
        max-width: 800px; /* Limit maximum width to prevent overly long lines */
        margin: 0 auto; /* Center-align the content */
        padding: 0 20px; /* Add padding to prevent text from sticking to the edges */
    }
</style>

    </style>
</head>

<body>
    <div class="navbar">
        <a href="home_page.php">HOME</a>
        <a href="skills.html">EXPLORE</a>
        <a href=".php">COLLAB</a>
        <a href=".php">EDITOR</a>
        <a href=".php">FEEDBACK</a>
        <a href="profile.php">PROFILE</a>
    </div>
    <div class="content">
        <br>
        <h1>Welcome To Our Website, ProGo!</h1>
        <br>
    </div>
    <div class="intro">
        <h2>Find your ideal project now!!</h2>
        <br>
    </div>

    <div class="description">
    <p>Welcome to ProGo, your go-to platform for hassle-free project collaboration and development! Explore diverse projects tailored to your skills and interests. Join forces with like-minded individuals, share ideas, and bring your projects to life with our seamless collaboration tools. Start collaborating today!</p>
</div>



    <script type="text/javascript">

    </script>
    <?php
    $con = mysqli_connect("localhost", "root");
    if (mysqli_connect_errno()) {
        echo "" . mysqli_connect_error();
    }
    mysqli_query($con, "create database if not exists Booking");
    if (mysqli_errno($con)) {
        echo "";
    }
    ?>
</body>

</html>