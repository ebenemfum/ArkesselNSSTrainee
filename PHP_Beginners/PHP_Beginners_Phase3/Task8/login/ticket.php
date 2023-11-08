<?php
session_start(); // Add this line to start the session

if (!isset($_SESSION["user"]) || $_SESSION["user"] !== "yes") {
   header("Location: login.php");
   exit();
}

require_once("database.php"); // Replace "connection.php" with the actual path to your connection file

// Query to retrieve customer count
$sql = "SELECT COUNT(*) as customer_count FROM Customers"; // Replace with your actual table name
$result = mysqli_query($conn, $sql);

// Query to retrieve event count
$sql1 = "SELECT COUNT(*) as event_count FROM Events"; // Replace with your actual table name
$result1 = mysqli_query($conn, $sql1);

// Query to retrieve ticket count
$sql2 = "SELECT COUNT(*) as ticket_count FROM Tickets"; // Replace with your actual table name
$result2 = mysqli_query($conn, $sql2);

// Query to retrieve event details
$sql3 = "SELECT e.EventName, e.EventDate, e.Venue, e.OrganizerID, o.OrganizerName FROM Events e JOIN Organizer o ON e.OrganizerID = o.OrganizerID;"; // Replace with your actual table name
$result3 = mysqli_query($conn, $sql3);

$sql4 = "SELECT t.TicketID, t.EventID, t.CustomerID, t.TicketType, t.Price, t.PurchaseDate, e.EventName, e.Venue, e.EventDate, o.OrganizerName, CONCAT(c.FirstName, ' ', c.LastName) AS CustomerName, c.Email AS CustomerEmail, c.Phone AS CustomerPhone FROM Tickets t JOIN Events e ON t.EventID = e.EventID JOIN Organizer o ON e.OrganizerID = o.OrganizerID JOIN Customers c ON t.CustomerID = c.CustomerID";
$result4 = mysqli_query($conn, $sql4);



// Check if the queries were successful
if (!$result || !$result1 || !$result2 || !$result3) {
    die("Error executing the query: " . mysqli_error($conn));
}

// Fetch the customer count from the result
$row = mysqli_fetch_assoc($result);
$customerCount = $row['customer_count'];

// Fetch the event count from the result
$row1 = mysqli_fetch_assoc($result1);
$eventCount = $row1['event_count'];

// Fetch the ticket count from the result
$row2 = mysqli_fetch_assoc($result2);
$ticketCount = $row2['ticket_count'];
?>


<!-- Rest of your HTML content -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../login/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../login/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
  TickPro
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../login/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../login/assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../login/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href=# class="simple-text logo-mini">
          TP
        </a>
        <a href=# class="simple-text logo-normal">
          TicketPro
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="">
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="customer.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Customers</p>
            </a>
          </li>
          <li>
            <a href="events.php">
              <i class="now-ui-icons ui-1_calendar-60"></i>
              <p>Events</p>
            </a>
          </li>
          <li class="active">
            <a href="ticket.php">
              <i class="now-ui-icons shopping_tag-content"></i>
              <p>Tickets</p>
            </a>
          
          <li class="active-pro">
            <a href="logout.php">
              <i class="now-ui-icons objects_key-25"></i>
              <p>Log Out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Monthly Ticket Sales</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-lg">
        <canvas id="bigDashboardChart"></canvas>
      </div> 
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Customers</h4>
              </div>
              <div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead class="text-primary">
                <th>
                    Ticket ID
                </th>
                <th>
                    Price
                </th>
                <th>
                    Event Name
                </th>
                <th>
                    Organizer
                </th>
                <th>
                    Purchase Date
                </th>
                <th>
                    Customer Name
                </th>
                <th>
                    Action
                </th>
            </thead>
            <tbody>
                <?php
                // Loop through the database results and generate table rows
                while ($row = mysqli_fetch_assoc($result4)) {
                    echo "<tr>";
                    echo "<td>" . $row['TicketID'] . "</td>";
                    echo "<td>" . $row['Price'] . "</td>";
                    echo "<td>" . $row['EventName'] . "</td>";
                    echo "<td>" . $row['OrganizerName'] . "</td>";
                    echo "<td>" . $row['PurchaseDate'] . "</td>";
                    echo "<td>" . $row['CustomerName'] . "</td>";
                    echo '<td><a href="edit.php?id=' . $row4['id'] . '">Edit</a></td>'; // Replace 'edit.php' with the actual edit page URL and 'id' with the unique identifier for each row
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
            </div>
          </div>
          
        </div>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="http://presentation.creative-tim.com">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../login/assets/js/core/jquery.min.js"></script>
  <script src="../login/assets/js/core/popper.min.js"></script>
  <script src="../login/assets/js/core/bootstrap.min.js"></script>
  <script src="../login/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../login/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../login/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../login/assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../login/assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>