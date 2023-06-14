<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "pbd";

//Create Connection
$connection = new mysqli($servername, $username, $password, $database);

$id_booking = "";
$status = "";
$jumlah_hari = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {

    if ( !isset($_GET["id"]) ) {
        header("location: /pbd/index.php");
        exit;
    }

    $id_booking = $_GET["id"];

    //read the row
    $sql = "SELECT * FROM booking WHERE id_booking=$id_booking";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: /pbd/index.php");
        exit;
    }

    $status = $row["status"];
    $jumlah_hari = $row["jumlah_hari"];
}
else{
    //POST method
    $id_booking = $_POST["id"];
    $status = $_POST["status"];
    $jumlah_hari = $_POST["jumlah_hari"];

    do {
        if( empty($id_booking) || empty($status) || empty($jumlah_hari) ){
            $errorMessage = "Semua harus terisi";
            break;
        }

        $sql ="UPDATE booking " . 
        "SET status = '$status', jumlah_hari = '$jumlah_hari' " . 
        "WHERE id_booking = $id_booking";
 

        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

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
            <input type="hidden" name="id" value="<?php echo $id_booking; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status" value="<?php echo $status; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jumlah_hari</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jumlah_hari" value="<?php echo $jumlah_hari; ?>">
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