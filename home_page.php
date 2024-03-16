<!DOCTYPE html>
<html>

<head>
    <title>Bus Booking System</title>
    <style>
        body {
            width: 100vw;
            height: 100vw;
            background: linear-gradient(139.06deg, #2b3693 1.86%, #0a0e30 56.22%);
            background: : no-repeat;
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
            margin-top: 30px;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <a href="home_page.php">HOME</a>
        <a href="routes.php">ROUTES</a>
        <a href="bus_booking.php">BOOK</a>
        <a href="bookings.php">BOOKINGS</a>
        <a href="help.php">HELP</a>
        <a href="profile.php">PROFILE</a>
    </div>
    <div class="content">
        <br>
        <h1>Welcome To Our Website, Blue Bus!</h1>
        <br>
    </div>
    <div class="intro">
        <h2>Navigate Your Journey with Ease: Book Your Bus Adventure Today!</h2>
    </div>

    <div class="description">
        <p>Welcome to Blue Bus, your premier destination for hassle-free bus bookings! With our user-friendly interface and extensive route network, planning your next journey has never been easier.</p>
        <p>Explore our wide range of routes, book your tickets with just a few clicks, and manage your bookings effortlessly through our intuitive platform.</p>
        <p>Whether you're a frequent traveler or planning a one-time trip, Blue Bus is here to make your travel experience seamless and enjoyable. Start your adventure with us today!</p>
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