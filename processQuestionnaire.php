<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentRyde - Feedback Received</title>
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
                        <h3 class="mb-0 text-center">Thank You For Your Feedback!</h3>
                    </div>
                    <div class="card-body p-4">
                        
                        <?php
                        // class defenition
                        // represents a single feedback record
                        class Feedback {
                            // attributes (properties)
                            private $name;
                            private $email;
                            private $phone;
                            private $rating;
                            private $services;
                            private $vehicleType;
                            private $comments;
                            
                            // constructor, initializes object when created
                            function __construct($name, $email, $phone, $rating, $services, $vehicleType, $comments) {
                                $this->name = $name;
                                $this->email = $email;
                                $this->phone = $phone;
                                $this->rating = $rating;
                                $this->services = $services;
                                $this->vehicleType = $vehicleType;
                                $this->comments = $comments;
                            }
                            
                            // get methods, return private attributes
                            function getName() {
                                return $this->name;
                            }
                            
                            function getEmail() {
                                return $this->email;
                            }
                            
                            function getPhone() {
                                return $this->phone;
                            }
                            
                            function getRating() {
                                return $this->rating;
                            }
                            
                            function getServices() {
                                return $this->services;
                            }
                            
                            function getVehicleType() {
                                return $this->vehicleType;
                            }
                            
                            function getComments() {
                                return $this->comments;
                            }
                            
                            // set methods, modify private attributes
                            function setName($name) {
                                $this->name = $name;
                            }
                            
                            function setEmail($email) {
                                $this->email = $email;
                            }
                            
                            function setPhone($phone) {
                                $this->phone = $phone;
                            }
                            
                            function setRating($rating) {
                                $this->rating = $rating;
                            }
                            
                            // additional method - get rating as stars
                            function getRatingStars() {
                                $stars = "";
                                for ($i = 0; $i < $this->rating; $i++) {
                                    $stars .= "⭐";
                                }
                                return $stars;
                            }
                        }
                        
                        
                        // get form data and create objects
                        
                        // get current form submission data
                        $name = $_POST["fullName"];
                        $email = $_POST["email"];
                        $phone = $_POST["phone"];
                        $rating = $_POST["rating"];
                        $vehicleType = $_POST["vehicleType"];
                        $comments = $_POST["comments"];
                        
                        // handle services array (checkboxes)
                        $services = "";
                        if (isset($_POST["services"])) {
                            $services = implode(", ", $_POST["services"]);
                        } else {
                            $services = "None selected";
                        }
                        
                        // create new Feedback object from form data
                        $currentFeedback = new Feedback($name, $email, $phone, $rating, $services, $vehicleType, $comments);
                        
                        
                        // array of objects
                        // create array with sample feedback records + current submission
                        
                        
                        $feedbackArray = array();
                        
                        // add sample feedback records (simulating existing data)
                        $feedbackArray[] = new Feedback("Ahmed Ali", "ahmed@example.com", "+96812345678", 5, "Car Rental, Online Booking", "Sedan", "Excellent service!");
                        $feedbackArray[] = new Feedback("Sara Mohammed", "sara@gmail.com", "96898765432", 4, "Car Rental", "SUV", "Good experience overall");
                        $feedbackArray[] = new Feedback("Khalid Salem", "khalid@outlook.com", "+96823456789", 5, "List Vehicle, Customer Support", "Luxury", "Very professional team");
                        $feedbackArray[] = new Feedback("Fatima Hassan", "fatima@rentryde.com", "96887654321", 3, "Online Booking", "Sports Car", "Average service");
                        
                        // add the current submission to the array
                        $feedbackArray[] = $currentFeedback;
                        
                        // display success message
                        echo "<div class='alert alert-success'>";
                        echo "<h4>Your feedback has been recorded!</h4>";
                        echo "<p>Thank you, <strong>" . $currentFeedback->getName() . "</strong>, for taking the time to share your experience with us.</p>";
                        echo "</div>";
                        
                        
                        // function to display data in table format
                        // uses iteration and displays data in XHTML table
                        
                        
                        function displayFeedbackTable($feedbackArray) {
                            echo "<h5 class='mb-3 mt-4'>All Customer Feedback Records:</h5>";
                            
                            // start XHTML table
                            echo "<table class='table table-bordered table-hover'>";
                            echo "<thead class='table-primary'>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th>Email</th>";
                            echo "<th>Phone</th>";
                            echo "<th>Rating</th>";
                            echo "<th>Services Used</th>";
                            echo "<th>Vehicle Type</th>";
                            echo "<th>Comments</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            
                            // iterate through array using foreach
                            foreach ($feedbackArray as $feedback) {
                                echo "<tr>";
                                // use get methods to access object properties
                                echo "<td>" . $feedback->getName() . "</td>";
                                echo "<td>" . $feedback->getEmail() . "</td>";
                                echo "<td>" . $feedback->getPhone() . "</td>";
                                echo "<td>" . $feedback->getRatingStars() . " (" . $feedback->getRating() . "/5)</td>";
                                echo "<td>" . $feedback->getServices() . "</td>";
                                
                                // selection statement, check if vehicle type is selected
                                if ($feedback->getVehicleType() != "") {
                                    echo "<td>" . $feedback->getVehicleType() . "</td>";
                                } else {
                                    echo "<td><em>Not specified</em></td>";
                                }
                                
                                // display comments or default message
                                if ($feedback->getComments() != "") {
                                    echo "<td>" . $feedback->getComments() . "</td>";
                                } else {
                                    echo "<td><em>No comments</em></td>";
                                }
                                
                                echo "</tr>";
                            }
                            
                            echo "</tbody>";
                            echo "</table>";
                            
                            // display total count
                            $totalFeedbacks = count($feedbackArray);
                            echo "<div class='alert alert-info mt-3'>";
                            echo "<strong>Total Feedback Records:</strong> $totalFeedbacks";
                            echo "</div>";
                        }
                        
                        
                        // CALL THE FUNCTION TO DISPLAY THE TABLE
                        
                        displayFeedbackTable($feedbackArray);
                        
                        ?>
                        
                        <div class="text-center mt-4">
                            <a href="questionnaire.html" class="btn btn-primary">Submit Another Feedback</a>
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