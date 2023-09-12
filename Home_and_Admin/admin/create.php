<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $errorMessage = "All the fields are required";
    } else {
        // Add new item to the database
        $sql = "INSERT INTO clients (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
        } else {
            $name = "";
            $email = "";
            $phone = "";
            $address = "";
            $successMessage = "Client added correctly";
            header("location: /capstone/inventory.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2>New Item</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
           </div>
           ";
        }
        ?>
        <!-- Form should wrap the entire content you want to submit -->
        <form method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
               ";
            }
            ?>

            <div class="form-group row">
                <div class="offset-sm-3 col-sm-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3">
                    <a class="btn btn-outline-primary" href="/capstone/inventory.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Include Bootstrap JS at the end of the body -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
