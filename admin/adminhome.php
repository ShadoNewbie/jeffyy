<?php
include("../userRegister/authentication.php");
include ("../admin/adminHeader.php");
session_start();
if(!isset($_SESSION["userType"]))
{
    header("location:../userRegister/loginCheck.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        nav {
            background-color: #444;
            color: white;
            text-align: center;
            padding: 10px;
        }

        nav a {
            text-decoration: none;
            color: white;
            margin: 0 20px;
            font-size: 18px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .admin-content {
            /* Add your admin content styling here */
        }
    </style>

</head>
<body>
<body>
    <?php echo isset($_SESSION["userType"]) ? $_SESSION["userType"] : ""; ?>
    <header>
        <h1>Admin Dashboard</h1>
    </header>
    <nav>
        <a href="inventory.php">Inventory</a>
        <a href="pos.php">POS</a>
        <a href="#">Products</a>
        <a href="filter-by-date.php">History</a>
        <a href="logout.php">Logout</a>
    </nav>
    
    
</body>
</html>