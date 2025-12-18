<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Registration Successful</title>
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
                        <h3 class="mb-0 text-center">Registration Successful!</h3>
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
                        $user = $_POST["username"];
                        $email = $_POST["email"];
                        $pass = $_POST["password"];
                        $phone = $_POST["phone"];
                        
                        // 3- prepare SQL INSERT statement
                        $sql = "insert into users (username, email, password, phone) ";
                        $sql .= "values ('$user', '$email', '$pass', '$phone')";
                        
                        // 4- execute the INSERT query
                        $result = mysqli_query($conn, $sql);
                        
                        if ($result) {
                            echo "<div class='alert alert-success'>";
                            echo "<h4>Welcome $user!</h4>";
                            echo "<p>Your account has been created successfully.</p>";
                            echo "</div>";
                        } else {
                            echo "<div class='alert alert-danger'>";
                            echo "Error: " . mysqli_error($conn);
                            echo "</div>";
                        }
                        
                        echo "<h5 class='mb-3 mt-4'>Your Registration Details:</h5>";
                        
                        // display submitted data in table
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr><th>Field</th><th>Value</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        echo "<tr><td><strong>Username</strong></td><td>$user</td></tr>";
                        echo "<tr><td><strong>Email</strong></td><td>$email</td></tr>";
                        echo "<tr><td><strong>Phone</strong></td><td>$phone</td></tr>";
                        echo "</tbody>";
                        echo "</table>";
                        
                        // display all registered users from database
                        echo "<h5 class='mb-3 mt-5'>All Registered Users:</h5>";
                        
                        // 3- prepare SQL SELECT statement
                        $sql = "select * from users";
                        
                        // 4- execute the SELECT query
                        $result = mysqli_query($conn, $sql);
                        
                        // check if there are results
                        if (mysqli_num_rows($result) > 0) {
                            // display data in XHTML table
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='table-primary'>";
                            echo "<tr>";
                            echo "<th>User ID</th>";
                            echo "<th>Username</th>";
                            echo "<th>Email</th>";
                            echo "<th>Phone</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                            // loop through each row
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["user_id"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phone"] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody>";
                            echo "</table>";
                        } else {
                            echo "<p>No users found in database.</p>";
                        }
                        
                        // 5- close connection
                        mysqli_close($conn);
                        ?>

                        <div class="text-center mt-4">
                            <a href="signIn.html" class="btn btn-primary">Register Another User</a>
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