<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Vehicle Listed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="bg-light">
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="images/RentRydeLogo.jpeg" alt="rentryde logo" width="50" height="40" class="me-2">
            <a class="navbar-brand fw-bold fs-4" href="index.html">
                Rent<span class="text-warning">Ryde</span>
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Vehicle Listed Successfully!</h3>
                    </div>
                    <div class="card-body p-4">
                        <?php
                        // database connection details
                        $servername = "127.0.0.1";
                        $username = "root";
                        $password = "secretpassword";
                        $dbname = "rentryde_db";
                        
                        // 1- create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        
                        // 2- check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        echo "<div class='alert alert-info'>Connected to database successfully!</div>";
                        // get form data from POST
                        $brand = $_POST["brand"];
                        $model = $_POST["model"];
                        $price = $_POST["price"];
                        $description = $_POST["description"];
                        
                        // create full vehicle name
                        $vehicleName = "$brand $model";
                        // find the next vehicle_id
                        $sql = "select max(vehicle_id) as max_id from vehicles";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $nextId = $row["max_id"] + 1;
                        
                        // 3- prepare SQL INSERT statement
                        $sql = "insert into vehicles (vehicle_id, vehicle_name, price_per_day, description) ";
                        $sql .= "values ($nextId, '$vehicleName', $price, '$description')";
                        
                        // 4- execute the INSERT query
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            echo "<div class='alert alert-success'>";
                            echo "<h4>Congratulations!</h4>";
                            echo "<p>Your vehicle '$vehicleName' has been listed successfully.</p>";
                            echo "</div>";
                        } else {
                            echo "<div class='alert alert-danger'>";
                            echo "Error: " . mysqli_error($conn);
                            echo "</div>";
                        }
                        
                        echo "<h5 class='mb-3 mt-4'>Your Vehicle Details:</h5>";
                        
                        // display submitted data in table
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr><th>Field</th><th>Value</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr><td><strong>Vehicle Name</strong></td><td>$vehicleName</td></tr>";
                        echo "<tr><td><strong>Price per Day</strong></td><td>$price OMR</td></tr>";
                        echo "<tr><td><strong>Description</strong></td><td>$description</td></tr>";
                        echo "</tbody>";
                        echo "</table>";
                        
                        // display all vehicles from database
                        echo "<h5 class='mb-3 mt-5'>All Available Vehicles:</h5>";
                        
                        // 3- prepare SQL SELECT statement
                        $sql = "select * from vehicles";
                        
                        // 4- execute the SELECT query
                        $result = mysqli_query($conn, $sql);
                        
                        // Check if there are results
                        if (mysqli_num_rows($result) > 0) {
                            // display data in XHTML table
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='table-primary'>";
                            echo "<tr>";
                            echo "<th>Vehicle ID</th>";
                            echo "<th>Vehicle Name</th>";
                            echo "<th>Price per Day (OMR)</th>";
                            echo "<th>Description</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                            // loop through each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["vehicle_id"] . "</td>";
                                echo "<td><strong>" . $row["vehicle_name"] . "</strong></td>";
                                echo "<td>" . $row["price_per_day"] . "</td>";
                                echo "<td>" . $row["description"] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p>No vehicles found in database.</p>";
                        }
                        
                        // 5- close connection
                        mysqli_close($conn);
                        ?>

                        <div class="text-center mt-4">
                            <a href="uploadVehicle.html" class="btn btn-primary">List Another Vehicle</a>
                            <a href="index.html" class="btn btn-secondary">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white pt-4 pb-3 mt-5">
        <div class="container">
            <div class="border-top border-secondary pt-3 text-center">
                <p class="mb-0 text-secondary">
                    &copy; 2025 RentRyde. All rights reserved.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
