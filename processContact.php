<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Contact Received</title>
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
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0 text-center">Contact Information Received</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-success">
                            <h4>Thank you for contacting us!</h4>
                            <p>We have received your message and will get back to you soon.</p>
                        </div>

                        <h5 class="mb-3">Your Submitted Information:</h5>

                        <?php
                        // get form data from POST
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $message = $_POST["message"];
                        $rating = $_POST["rating"];

                        // display data in a well-formatted XHTML table
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead class='table-dark'>";
                        echo "<tr>";
                        echo "<th>Field</th>";
                        echo "<th>Value</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        
                        echo "<tr>";
                        echo "<td><strong>Name</strong></td>";
                        echo "<td>$name</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Email</strong></td>";
                        echo "<td>$email</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Message</strong></td>";
                        echo "<td>$message</td>";
                        echo "</tr>";
                        
                        echo "<tr>";
                        echo "<td><strong>Rating</strong></td>";
                        echo "<td>$rating / 5</td>";
                        echo "</tr>";
                        
                        echo "</tbody>";
                        echo "</table>";
                        ?>

                        <div class="text-center mt-4">
                            <a href="contactUs.html" class="btn btn-primary">Send Another Message</a>
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