<?php
include 'connect.php';
?>




<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(); // Exit to prevent further execution of the page
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
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
    <div class="container">
        <h2 class="page-title">Dashboard Overview</h2>
        <div class="admin-content">
            <!-- Add your admin content here -->
            <p>Welcome to the Inventory dashboard. You can manage Inventory, PoS, and settings here.</p>
        </div>
    </div>
    
    <div class="container my-5">
        <h2>List of Items</h2>
        <a class="btn btn-primary" href="/capstone/create.php" role="button">New Item</a>
        <br>
        <!-- SEARCH BUTTON ----->
        
        <form method="post">
            <input type="text" placeholder="Search data" name="search">
            <button class="btn btn-dark btn-sm" name="submit">Search</button>
        </form>
        <div class="container my-5">
            <table class="table">
                <?php
                if(isset($_POST['submit'])){
                    $search=$_POST['search'];
                    
                    $sql = "SELECT * FROM `users` WHERE id='$search'";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        
                    }
                    
                }
                ?>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "inventory";

                    // Create connection
                    $connection = new mysqli($servername, $username, $password, $database);

                    // Check connection
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    // Read all rows from the database table
                    $sql = "SELECT id, name, email, phone, address, created_at FROM clients";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                        // Use htmlspecialchars to escape user data
                        $id = htmlspecialchars($row['id']);
                        $name = htmlspecialchars($row['name']);
                        $email = htmlspecialchars($row['email']);
                        $phone = htmlspecialchars($row['phone']);
                        $address = htmlspecialchars($row['address']);
                        $created_at = htmlspecialchars($row['created_at']);

                        echo "
                        <tr>
                            <td>$id</td>
                            <td>$name</td>
                            <td>$email</td>
                            <td>$phone</td>
                            <td>$address</td>
                            <td>$created_at</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/capstone/edit.php?id=$id'>Edit</a> 
                                <a class='btn btn-danger btn-sm' href='/capstone/delete.php?id=$id'>Delete</a>                  
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
</body>

</html>
