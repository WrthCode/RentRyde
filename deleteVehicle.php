<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Delete Vehicle</title>
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
                    <div class="card-header bg-danger text-white">
                        <h3 class="mb-0 text-center">Delete Vehicle</h3>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php
                        // Database connection details
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
                        ?>

                        <!-- DELETE FORM -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="mb-4">
                                <label for="vehicleId" class="form-label fw-bold">Select Vehicle to Delete</label>
                                <select class="form-select form-select-lg" id="vehicleId" name="vehicleId" required>
                                    <option value="" selected disabled>Choose a vehicle...</option>
                                    
                                    <?php
                                    // Get all vehicles from database to populate dropdown
                                    $sql = "select vehicle_id, vehicle_name, price_per_day from vehicles";
                                    $result = mysqli_query($conn, $sql);
                                    
                                    // Check if there are vehicles
                                    if (mysqli_num_rows($result) > 0) {
                                        // Loop through and create options
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $vid = $row["vehicle_id"];
                                            $vname = $row["vehicle_name"];
                                            $vprice = $row["price_per_day"];
                                            echo "<option value='$vid'>ID: $vid - $vname (OMR $vprice/day)</option>";
                                        }
                                    }
                                    ?>
                                    
                                </select>
                                <small class="text-danger">Warning: This action cannot be undone!</small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-danger btn-lg">
                                    Delete Vehicle
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- PROCESS DELETE -->
                        <?php
                        // check if form was submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            // get vehicle ID from form
                            $vehicleId = $_POST["vehicleId"];
                            
                            // first, get vehicle details before deleting (to show what was deleted)
                            $sql = "select * from vehicles where vehicle_id = $vehicleId";
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                $vehicle = mysqli_fetch_assoc($result);
                                $vname = $vehicle["vehicle_name"];
                                
                                // 3- prepare SQL DELETE statement
                                $sql = "delete from vehicles where vehicle_id = $vehicleId";
                                
                                echo "<div class='alert alert-info'>";
                                echo "<strong>SQL Query:</strong> $sql";
                                echo "</div>";
                                
                                // 4- execute the DELETE query
                                $result = mysqli_query($conn, $sql);
                                
                                if ($result) {
                                    echo "<div class='alert alert-success'>";
                                    echo "<h5>Vehicle Deleted Successfully!</h5>";
                                    echo "<p>The vehicle <strong>'$vname'</strong> (ID: $vehicleId) has been removed from the database.</p>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='alert alert-danger'>";
                                    echo "Error deleting vehicle: " . mysqli_error($conn);
                                    echo "</div>";
                                }
                            }
                        }
                        ?>

                        <!-- DISPLAY ALL REMAINING VEHICLES -->
                        <h5 class='mb-3 mt-4'>Current Vehicles in Database:</h5>
                        
                        <?php
                        // display all vehicles after deletion
                        $sql = "select * from vehicles order by vehicle_id";
                        $result = mysqli_query($conn, $sql);
                        
                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class='table-responsive'>";
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='table-dark'>";
                            echo "<tr>";
                            echo "<th>Vehicle ID</th>";
                            echo "<th>Vehicle Name</th>";
                            echo "<th>Price per Day (OMR)</th>";
                            echo "<th>Description</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
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
                            echo "</div>";
                            
                            $count = mysqli_num_rows($result);
                            echo "<div class='alert alert-info'>";
                            echo "Total vehicles in database: <strong>$count</strong>";
                            echo "</div>";
                            
                        } else {
                            echo "<div class='alert alert-warning'>";
                            echo "No vehicles found in database.";
                            echo "</div>";
                        }
                        
                        // 5- close connection
                        mysqli_close($conn);
                        ?>

                        <div class="text-center mt-4">
                            <a href="deleteVehicle.php" class="btn btn-warning">Delete Another Vehicle</a>
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
