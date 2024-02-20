<?php
session_start();

// Include database connection file
include('config.php');// You'll need to replace this with your actual database connection code

// Redirect to the login page if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location cslogin.html");
    exit;
}

// Fetch user information based on ID
$userID = $_SESSION['user_id'];
$vehicleID = $_SESSION['vehicle_id'];
$slotID = $_SESSION['slot_id'];

// Fetch user information from the database based on the user's ID
// Replace this with your actual database query
$query = "SELECT * FROM vehicles WHERE user_id = '$userID'";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$userData = mysqli_fetch_assoc($result);

$query = "SELECT * FROM services";
// Execute the query and fetch the user data
$result = mysqli_query($connection, $query);
$serviceData = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($connection);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>DIRT TECH</title>
    <link rel="icon" href="NEW SM LOGO.png" type="image/x-icon">
    <link rel="shortcut icon" href="NEW SM LOGO.png" type="image/x-icon">
  </head>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap");
body,
button {
  font-family: "Poopins", sans-serif;
  margin-top:20px;
  background-color:#fff;
  color:#fff;
}
:root {
  --offcanvas-width: 200px;
  --topNavbarHeight: 56px;
}
.sidebar-nav {
  width: var(--offcanvas-width);
  background-color: orangered;
}
.sidebar-link {
  display: flex;
  align-items: center;
}
.sidebar-link .right-icon {
  display: inline-flex;
}
.sidebar-link[aria-expanded="true"] .right-icon {
  transform: rotate(180deg);
}
@media (min-width: 992px) {
  body {
    overflow: auto !important;
  }
  main {
    margin-left: var(--offcanvas-width);
  }
  /* this is to remove the backdrop */
  .offcanvas-backdrop::before {
    display: none;
  }
  .sidebar-nav {
    -webkit-transform: none;
    transform: none;
    visibility: visible !important;
    height: calc(100% - var(--topNavbarHeight));
    top: var(--topNavbarHeight);
  }
}


.welcome{
    font-size: 15px;
    text-align: center;
    margin-top: 20px;
    margin-right: 15px;
}
.me-2{
  color: #fff;
  font-weight: normal;
  font-size: 13px;

}
.me-2:hover{
  background: orangered;
}
span{
  color: #fff;
  font-weight: bold;
  font-size: 20px;
}
img{
  width: 30px;
  border-radius: 50px;
  display: block;
  margin: auto;

}
li :hover{
  background: #072797;
}
.v-1{
  background-color: #072797;
  color: #fff;
}
.v-2{
  background-color: orangered;
}
.main {
  margin-left: 200px;
}
.form-group{
  color: black;
}
.dropdown-item:hover{
  background-color: orangered;
  color: #fff;
}
.my-4:hover{
  background-color: #fff;
}
.navbar{
  background-color: #072797;
}
.btn:hover{
  background-color: #072797;
}
.nav-links ul li:hover a {
  color: white;
}
.section{
  margin-left: 200px;
}
.text-box {
  padding: 6px 6px 6px 230px;
  background: orangered;
  border-radius: 10px;
  width: 50%;
  height: auto;
  position: absolute;
  top: 20%;
  left: 30%;
}
.text-box .btn {
  background-color: #072797;
  text-decoration: none;
  width: 58%;

}
.container-vinfo{
  margin-left: 20px
}
.v-3{
  font-weight: bold;
  font-size: xx-large;
}
.my-5{
  margin-left: -20px;
}
.ex-1 {
      color: red;
    }

</style>
  <body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="smweb.html"
          ><img src="NEW SM LOGO.png" alt=""></a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <li class="">
                <a href="csnotification.php" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-bell"></i></i></span>
                </a>
              </li>
              
              <a
                class="nav-link dropdown-toggle ms-2"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="bi bi-person-fill"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Visual</a></li>
                <li>
                  <a class="dropdown-item" href="cslogin.html">Log out</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <li class="my-4"><hr class="dropdown-divider bg-primary" /></li>
    <!-- top navigation bar -->
    <!-- offcanvas -->
    <div
      class="offcanvas offcanvas-start sidebar-nav"
      tabindex="-1"
      id="sidebar"
      
    
      <div class="offcanvas-body p-0">
        <nav class="">
          <ul class="navbar-nav">
            
            
              <div class=" welcome fw-bold px-3 mb-3">
              <h5 class="text-center">Welcome back <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>!</h5>
              </div>
              <div class="ms-3"id="dateTime"></div>
            </li>
            <li>
                <li class="">
                    <a href="csdashboard.php" class="nav-link px-3">
                      <span class="me-2"><i class="fas fa-user"></i></i></span>
                      <span class="start">PROFILE</span>
                    </a>
                </li>
                
            <li>
              <a href="cscars1.php" class="nav-link px-3">
                <span class="me-2"><i class="fas fa-car"></i></i></span>
                <span>MY CARS</span>
              </a>
            </li>
            <li class="v-1">
                  <a
                    class="nav-link px-3 sidebar-link"
                    data-bs-toggle="collapse"
                    href="#layouts">
                    <span class="me-2"><i class="fas fa-calendar"></i></i></span>
                    <span>BOOKINGS</span>
                    <span class="ms-auto">
                      <span class="right-icon">
                        <i class="bi bi-chevron-down"></i>
                      </span>
                    </span>
                  </a>
                </li>
              <div class="collapse" id="layouts">
                    <ul class="navbar-nav ps-3">
                      <li class="v-1">
                        <a href="setappoinment.php" class="nav-link px-3">
                        <span class="me-2"
                            >Set Appointment</span>
                        </a>
                    </li>  
                    <li class="v-1">
                        <a href="checkingcar.php" class="nav-link px-3">
                        <span class="me-2"
                            >Checking car condition</span>
                        </a>
                    </li>
                    <li class="v-1">
                        <a href="#" class="nav-link px-3">
                        <span class="me-2"
                          >Request Slot</span>
                        </a>
                    </li>
                    <li class="v-1 v-2">
                      <a href="csprocess3.php" class="nav-link px-3">
                      <span class="me-2"
                        >Select Service</span>
                      </a>
                   </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Register your car</span>
                    </a>
                  </li>
                    <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking Summary</span>
                  </a>
                  </li>
                  <li class="v-1">
                    <a href="#" class="nav-link px-3">
                    <span class="me-2"
                      >Booking History</span>
                    </a>
                  </li>
                    </ul>
              </div>
            </li>
            <li> 
                <a
                  class="nav-link px-3 sidebar-link"
                  data-bs-toggle="collapse"
                  href="#layouts2">
                  <span class="me-2"><i class="fas fa-money-bill"></i>
                  </i></i></span>
                  <span>PAYMENTS</span>
                  <span class="ms-auto">
                    <span class="right-icon">
                      <i class="bi bi-chevron-down"></i>
                    </span>
                  </span>
                </a>
                <div class="collapse" id="layouts2">
                  <ul class="navbar-nav ps-3">
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Payment options</span>
                      </a>
                    </li>
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Car wash invoice</span>
                      </a>
                    </li>
                    <li class="v-1">
                      <a href="#" class="nav-link px-3">
                        <span class="me-2"
                        >Payment History</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            <li>
            <li>
                <a href="csreward.html" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-medal"></i>
                  </i></span>
                  <span>REWARDS</span>
                </a>
            </li>
            <li>
                <a href="cslogin.html" class="nav-link px-3">
                  <span class="me-2"><i class="fas fa-sign-out-alt"></i>
                  </i></span>
                  <span>LOG OUT</span>
                </a>
            </li>
            
          </ul>
        </nav>
      </div>
    </div>
    <!-- main content -->
    <main>
      <div class="container-vinfo text-dark">
        <h2 class="mb-2 offset-md-4">Select Services</h2>
        <p class="col-md-4 offset-md-4">select carwash service for</p>
        <?php
          if ($result) {
              // Check if there are any vehicles for the user
              if (mysqli_num_rows($result) > 0) {
                  echo '<h2 class="mb-2"></h2>';
                  echo '<div class="form-group mt-4 col-md-4 offset-md-3">';
                  echo '<label for="platenumber">Plate Number</label>';
                  echo '<select class="form-select" id="platenumber" name="platenumber" onchange="updateDisplay()" disabled>';
                  echo '<option value="' . $userData['platenumber'] . '" selected>' . $userData['platenumber'] . '</option>';


                  // Store the fetched data in an array
                  $vehiclesData = array();
                  while ($row = mysqli_fetch_assoc($result)) {
                      $vehiclesData[] = $row;
                      echo '<option value="' . $row['platenumber'] . '">' . $row['platenumber'] . '</option>';
                  }

                  echo '</select>';
                  echo '</div>';
                  // Rest of your HTML code...
              } else {
                  echo '<p>No vehicles found, Register your cars first in MY CARS section.</p>';
              }
          } else {
              // Handle the case where the query fails
              echo '<p>Error: ' . mysqli_error($connection) . '</p>';
          }
        ?>



    <div class="my-5 container-vinfo text-dark">
    <h2 class="ms-5 mb-5" id="countdown">Your slot number will expire in 00:10</h2>

    <h2 class="ex-1 ms-5 mb-5" id="expiredMessage" style="display: none;">Your slot number has been expired, please request another slot number.</h2>

    <script>
  // Set the initial countdown value in seconds
  let countdown = 10;

  // Function to update the countdown and display the message
  function updateCountdown() {
    // Get the element with the id "countdown"
    const countdownElement = document.getElementById('countdown');
    // Get the element with the id "expiredMessage"
    const expiredMessageElement = document.getElementById('expiredMessage');

    if (countdown >= 0) {
      // Format the countdown value as "mm:ss"
      const minutes = Math.floor(countdown / 60);
      const seconds = countdown % 60;
      const formattedTime = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

      // Update the countdown text in the HTML
      countdownElement.innerText = `Your slot number will expire in ${formattedTime}`;

      // Change color to red when countdown reaches zero
      if (countdown === 0) {
        countdownElement.classList.add('expired');
        // Hide the countdown element
        countdownElement.style.display = 'none';
        // Show the expired message
        expiredMessageElement.style.display = 'block';

        // Display alert when countdown reaches zero
        alert("Your slot number has been expired, please request another slot.");
        
        // Redirect to csrequest_slot.php after the user clicks OK in the alert
        window.location.href = 'csrequest_slot1.php';
      }

      countdown--;

      // Update the countdown every second (1000 milliseconds)
      setTimeout(updateCountdown, 1000);
    } else {
      // This part will not be reached as we are keeping the countdown visible even after reaching zero.
    }
  }

  // Start the countdown when the script runs
  updateCountdown();
</script>


    <h2 class="mb-2">Available Services</h2>
    <div class="v-2 container mx-auto mt-5">
    <form action="csselectedservice.php" method="post">
      <input type="hidden" name="user_id" value="<?php echo $userData['user_id']; ?>">
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php
            if ($result) {
                foreach ($result as $row) {
                    echo '<div class="col">';
                    echo '<div class="card mb-3">';
                    echo '<div class="card-header v-1 text-light">';
                    echo '<h5 class="card-title">' . (isset($row['service_name']) ? $row['service_name'] : 'service_name') . '</h5>';
                    echo '</div>';
                    echo '<div class="card-body">';
                    echo '<p class="card-text"><strong>Services:</strong> ' . (isset($row['services']) ? $row['services'] : 'N/A') . '</p>';
                    echo '<p class="card-text"><strong>Total Price:</strong> ' . (isset($row['price']) ? $row['price'] : 'N/A') . '</p>';
                    echo '<p class="card-text"><strong>Total Duration:</strong> ' . (isset($row['duration']) ? $row['duration'] : 'N/A') . '</p>';
                    echo '<p class="card-text"><strong>Price per services:</strong> ' . (isset($row['priceperservice']) ? $row['priceperservice'] : 'priceperservice') . '</p>';
                    echo '<p class="card-text"><strong>Duration per services:</strong> ' . (isset($row['durationperservice']) ? $row['durationperservice'] : 'durationperservice') . '</p>';
                    echo '<label class="btn btn-primary">';
                    echo '<input type="checkbox" name="selected_services[]" value="' . (isset($row['service_id']) ? $row['service_id'] : '') . '"> Select Service';
                    echo '</label>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-danger">Error: ' . mysqli_error($connection) . '</p>';
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </form>
</div>

</div>
        

        
                <script>
                  // Convert the PHP array to a JavaScript array
                  var vehiclesData = <?php echo json_encode($vehiclesData); ?>;

                  // Function to update the displayed information based on the selected option
                  function updateDisplay() {
                      // Get the selected value from the dropdown
                      var selectedPlateNumber = document.getElementById("platenumber").value;

                      // Find the matching vehicle in the JavaScript array
                      var selectedVehicle = vehiclesData.find(function (vehicle) {
                          return vehicle.platenumber === selectedPlateNumber;
                      });

                      // Update the displayed information
                      document.getElementById("label").value = selectedVehicle.label;
                      document.getElementById("model").value = selectedVehicle.model;
                      document.getElementById("chassisnumber").value = selectedVehicle.chassisnumber;
                      document.getElementById("enginenumber").value = selectedVehicle.enginenumber;
                      document.getElementById("color").value = selectedVehicle.color;
                      // Update other fields similarly
                  }
                </script>
      
        

      <script>
          document.getElementById('date').addEventListener('change', function () {
              var selectedDate = new Date(this.value);
              var slotNumber = selectedDate.getHours(); // Use any logic to determine the slot number
              document.getElementById('slotnumber').value = slotNumber;
          });
      </script>
      
      <script>
        function updateDateTime() {
            // Get the current date and time
            var currentDateTime = new Date();

            // Format the date and time
            var date = currentDateTime.toDateString();
            var time = currentDateTime.toLocaleTimeString();

            // Display the formatted date and time
            document.getElementById('dateTime').innerHTML = '<p>Date: ' + date + '</p><p>Time: ' + time + '</p>';
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initial call to display date and time immediately
        updateDateTime();
    </script>
        
      
      
    </main>
    </script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="./js/jquery-3.5.1.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap5.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
