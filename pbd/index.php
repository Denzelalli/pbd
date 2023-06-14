<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List Booking</h2>
        <a class="btn btn-primary" href="/pbd/create.php " role="button">New Booking</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Status</th>
                    <th>Hari</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "pbd";

                //Create Connection
                $connection = new mysqli($servername, $username, $password, $database);

                //Check Connection
                if ($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error);
                }

                // reas all row from databse
                $sql = "SELECT * FROM booking";
                $result = $connection->query($sql);

                if(!$result) {
                    die("Invalid query: " . $connection->error);
                }

                // read data each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id_booking]</td>
                        <td>$row[status]</td>
                        <td>$row[jumlah_hari]</td>
                        <td>
                            <a class='btn btn-primary btn-sm'href='/pbd/edit.php?id=$row[id_booking]'>Edit</a>
                            <a class='btn btn-danger btn-sm'href='/pbd/delete.php?id=$row[id_booking]'>Delete</a>
                    </td>
                </tr>
                    ";
                }
                ?>
                <!-- <tr>
                    <td>1</td>
                    <td>booked</td>
                    <td>10</td>
                    <td>
                        <a class='btn btn-primary btn-sm'href="/pbd/edit.php">Edit</a>
                        <a class='btn btn-primary btn-sm'href="/pbd/delete.php">Delete</a>
                    </td>
                </tr> -->
            </tbody>
        </table>

    </div>
</body>
</html>