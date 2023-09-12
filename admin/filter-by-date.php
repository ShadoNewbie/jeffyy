<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
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
<body class="bg-light">
    <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : ""; ?>
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

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Records</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="GET">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="from_date">From Date</label>
                                            <input type="date" name="from_date" id="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : ''; ?>" class="form-control" placeholder="From Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="to_date">To Date</label>
                                            <input type="date" name="to_date" id="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : ''; ?>" class="form-control" placeholder="To Date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label form="">Check</label><br>
                                            <button type="submit" class="btn btn-primary">Filter User</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h6>User List</h6>
                            <hr>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                        if (strtotime($_GET['from_date']) < strtotime($_GET['to_date'])) {
                                            $from_date = $_GET['from_date'];
                                            $to_date = $_GET['to_date'];

                                            $con = mysqli_connect("localhost", "root", "", "inventory");

                                            $query = "SELECT * FROM users WHERE created_at BETWEEN '$from_date' AND '$to_date' ";
                                            $query_run = mysqli_query($con, $query);

                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $row) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['category']; ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                    </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4"><h5>No record found</h5></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4"><h5>From Date is greater than To Date. Please change and filter again.</h5></td>
                                        </tr>
                                        <?php 
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
