<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Search Vehicles</title>
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
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-center">Search Vehicles</h3>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- SEARCH FORM -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="row g-3 mb-4">
                                <!-- search by name -->
                                <div class="col-md-6">
                                    <label for="searchName" class="form-label fw-bold">Search by Vehicle Name</label>
                                    <input type="text" class="form-control" id="searchName" name="searchName" 
                                           placeholder="e.g., Toyota, Nissan">
                                    <small class="text-muted">Leave empty to show all vehicles</small>
                                </div>
                                
                                <!-- Search by Price Range -->
                                <div class="col-md-6">
                                    <label for="maxPrice" class="form-label fw-bold">Maximum Price (OMR)</label>
                                    <input type="number" class="form-control" id="maxPrice" name="maxPrice" 
                                           placeholder="e.g., 50">
                                    <small class="text-muted">Leave empty for no limit</small>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                    Search Vehicles
                                </button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- DISPLAY RESULTS -->
                        <?php
                        // check if form was submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            
                            // Database connection details
                            $servername = "127.0.0.1";
                            $username = "root";
                            $password = "secretpassword";
                            $dbname = "rentryde_db";
                            
                            // 1- Create connection
                            $conn = mysqli_connect($servername, $username, $password, $dbname);
                            
                            // 2- Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }
                            
                            // get search criteria from form
                            $searchName = $_POST["searchName"];
                            $maxPrice = $_POST["maxPrice"];
                            
                            // 3- build SQL SELECT statement based on search criteria
                            $sql = "select * from vehicles where 1=1";
                            
                            // add name filter if provided
                            if ($searchName != "") {
                                $sql .= " and vehicle_name like '%$searchName%'";
                            }
                            
                            // add price filter if provided
                            if ($maxPrice != "") {
                                $sql .= " and price_per_day <= $maxPrice";
                            }
                            
                            // order results by price
                            $sql .= " order by price_per_day";
                            
                            echo "<h5 class='mb-3'>Search Results:</h5>";
                            echo "<div class='alert alert-info'>";
                            echo "<strong>SQL Query:</strong> $sql";
                            echo "</div>";
                            
                            // 4- execute the query
                            $result = mysqli_query($conn, $sql);
                            
                            // check if there are results
                            if (mysqli_num_rows($result) > 0) {
                                
                                // display count
                                $count = mysqli_num_rows($result);
                                echo "<div class='alert alert-success'>";
                                echo "Found <strong>$count</strong> vehicle(s) matching your criteria.";
                                echo "</div>";
                                
                                // display results in XHTML table
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
                                
                                // Loop through results
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
                                
                            } else {
                                // No results found
                                echo "<div class='alert alert-warning'>";
                                echo "<strong>No vehicles found</strong> matching your search criteria.";
                                echo "</div>";
                            }
                            
                            // 5- Close connection
                            mysqli_close($conn);
                        } else {
                            // Form not submitted yet - show instruction
                            echo "<div class='alert alert-info'>";
                            echo "<h5>How to use:</h5>";
                            echo "<ul class='mb-0'>";
                            echo "<li>Enter a vehicle name to search (e.g., 'Toyota', 'Nissan')</li>";
                            echo "<li>Set a maximum price to filter by budget</li>";
                            echo "<li>Leave both empty to see all vehicles</li>";
                            echo "<li>Click 'Search Vehicles' to see results</li>";
                            echo "</ul>";
                            echo "</div>";
                        }
                        ?>

                        <div class="text-center mt-4">
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
