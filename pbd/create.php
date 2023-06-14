<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pbd";

//Create Connection
$connection = new mysqli($servername, $username, $password, $database);


$status = "";
$jumlah_hari = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST["status"];
    $jumlah_hari = $_POST["jumlah_hari"];

    do {
        if( empty($status) || empty($jumlah_hari) ){
            $errorMessage = "Semua harus terisi";
            break;
        }

        // add new client to database
        $sql = "INSERT INTO booking (status,jumlah_hari)" . 
                "VALUES ('$status', '$jumlah_hari')";
        $result = $connection->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $status = "";
        $jumlah_hari = "";

        $successMessage = "Data berhasil ditambahkan";

        header("location: /pbd/index.php");
        exit;



    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Booking</h2>
        <?php
        if ( !empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }


        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status" value="<?php echo $status;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jumlah_hari</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jumlah_hari" value="<?php echo $jumlah_hari;?>">
                </div>
            </div>
            <?php
            if ( !empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }

            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/pbd/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>