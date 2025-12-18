<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Booking Confirmation</title>
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
                        <h3 class="mb-0 text-center">Booking Confirmed!</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-success">
                            <h4>Your booking has been confirmed!</h4>
                            <p>We look forward to serving you. You will receive a confirmation email shortly.</p>
                        </div>

                        <h5 class="mb-3">Booking Details:</h5>

                        <?php
                        // get form data from POST
                        $pickDate = $_POST["pickDate"];
                        $returnDate = $_POST["returnDate"];
                        $location = $_POST["location"];
                        $car = $_POST["car"];
                        $notes = $_POST["notes"];

                        // calculate rental duration
                        $date1 = new DateTime($pickDate);
                        $date2 = new DateTime($returnDate);
                        $interval = $date1->diff($date2);
                        $days = $interval->days;

                        // display data in a well-formatted XHTML table
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr>";
                        echo "<th>Booking Information</th>";
                        echo "<th>Details</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        
                        echo "<tr>";
                        echo "<td><strong>Selected Vehicle</strong></td>";
                        echo "<td>$car</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Pick-up Date</strong></td>";
                        echo "<td>$pickDate</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Return Date</strong></td>";
                        echo "<td>$returnDate</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Rental Duration</strong></td>";
                        echo "<td>$days days</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Pick-up Location</strong></td>";
                        echo "<td>$location</td>";
                        echo "</tr>";
                        
                        if ($notes != "") {
                            echo "<tr>";
                            echo "<td><strong>Special Requests</strong></td>";
                            echo "<td>$notes</td>";
                            echo "</tr>";
                        }
                        
                        echo "</tbody>";
                        echo "</table>";
                        ?>

                        <div class="alert alert-info mt-4">
                            <strong>Next Steps:</strong>
                            <ul class="mb-0">
                                <li>Check your email for booking confirmation</li>
                                <li>Bring a valid driver's license on pickup day</li>
                                <li>Arrive 15 minutes early for vehicle inspection</li>
                            </ul>
                        </div>

                        <div class="text-center mt-4">
                            <a href="book.html" class="btn btn-primary">Make Another Booking</a>
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