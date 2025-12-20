<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Update Vehicle</title>
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
                    <div class="card-header bg-warning text-dark">
                        <h3 class="mb-0 text-center">Update Vehicle Information</h3>
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
                        ?>

                        <!-- UPDATE FORM -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            
                            <!-- select Vehicle -->
                            <div class="mb-3">
                                <label for="vehicleId" class="form-label fw-bold">Select Vehicle to Update</label>
                                <select class="form-select form-select-lg" id="vehicleId" name="vehicleId" required>
                                    <option value="" selected disabled>Choose a vehicle...</option>
                                    
                                    <?php
                                    // get all vehicles from database to populate dropdown
                                    $sql = "select vehicle_id, vehicle_name from vehicles";
                                    $result = mysqli_query($conn, $sql);
                                    
                                    // check if there are vehicles
                                    if (mysqli_num_rows($result) > 0) {
                                        // loop through and create options
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $vid = $row["vehicle_id"];
                                            $vname = $row["vehicle_name"];
                                            echo "<option value='$vid'>ID: $vid - $vname</option>";
                                        }
                                    }
                                    ?>
                                    
                                </select>
                            </div>

                            <!-- New Price -->
                            <div class="mb-3">
                                <label for="newPrice" class="form-label fw-bold">New Price per Day (OMR)</label>
                                <input type="number" class="form-control form-control-lg" id="newPrice" 
                                       name="newPrice" placeholder="e.g., 35" required>
                                <small class="text-muted">Enter the updated daily rental price</small>
                            </div>

                            <!-- New Description -->
                            <div class="mb-4">
                                <label for="newDescription" class="form-label fw-bold">New Description</label>
                                <textarea class="form-control" id="newDescription" name="newDescription" 
                                          rows="3" placeholder="Updated vehicle description..." required></textarea>
                                <small class="text-muted">Provide updated details about the vehicle</small>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-warning btn-lg">
                                    Update Vehicle
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- PROCESS UPDATE -->
                        <?php
                        // check if form was submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            // get form data
                            $vehicleId = $_POST["vehicleId"];
                            $newPrice = $_POST["newPrice"];
                            $newDescription = $_POST["newDescription"];
                            
                            // first, get vehicle details before updating (to show what changed)
                            $sql = "select * from vehicles where vehicle_id = $vehicleId";
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                $oldVehicle = mysqli_fetch_assoc($result);
                                $vname = $oldVehicle["vehicle_name"];
                                $oldPrice = $oldVehicle["price_per_day"];
                                $oldDesc = $oldVehicle["description"];
                                
                                // 3- Prepare SQL UPDATE statement
                                $sql = "update vehicles set price_per_day = $newPrice, ";
                                $sql .= "description = '$newDescription' ";
                                $sql .= "where vehicle_id = $vehicleId";
                                
                                echo "<div class='alert alert-info'>";
                                echo "<strong>SQL Query:</strong> $sql";
                                echo "</div>";
                                
                                // 4- Execute the UPDATE query
                                $result = mysqli_query($conn, $sql);
                                
                                if ($result) {
                                    echo "<div class='alert alert-success'>";
                                    echo "<h5>Vehicle Updated Successfully!</h5>";
                                    echo "<p>The vehicle <strong>'$vname'</strong> (ID: $vehicleId) has been updated.</p>";
                                    echo "</div>";
                                    
                                    // Show before and after comparison
                                    echo "<h5 class='mb-3'>Changes Made:</h5>";
                                    echo "<table class='table table-bordered'>";
                                    echo "<thead class='table-primary'>";
                                    echo "<tr><th>Field</th><th>Old Value</th><th>New Value</th></tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    
                                    echo "<tr>";
                                    echo "<td><strong>Price per Day</strong></td>";
                                    echo "<td>$oldPrice OMR</td>";
                                    echo "<td class='table-success'>$newPrice OMR</td>";
                                    echo "</tr>";
                                    
                                    echo "<tr>";
                                    echo "<td><strong>Description</strong></td>";
                                    echo "<td>$oldDesc</td>";
                                    echo "<td class='table-success'>$newDescription</td>";
                                    echo "</tr>";
                                    
                                    echo "</tbody>";
                                    echo "</table>";
                                    
                                } else {
                                    echo "<div class='alert alert-danger'>";
                                    echo "Error updating vehicle: " . mysqli_error($conn);
                                    echo "</div>";
                                }
                            }
                        }
                        ?>

                        <!-- DISPLAY ALL VEHICLES -->
                        <h5 class='mb-3 mt-4'>All Vehicles in Database:</h5>
                        
                        <?php
                        // Display all vehicles
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
                        
                        // 5- Close connection
                        mysqli_close($conn);
                        ?>

                        <div class="text-center mt-4">
                            <a href="updateVehicle.php" class="btn btn-warning">Update Another Vehicle</a>
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
