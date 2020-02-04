<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <a class="navbar-brand" href="#">Welcome <?php echo $objResult["Name"]; ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarntcplan" aria-controls="navbarntcplan" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarntcplan">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="main.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="report.php">Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addtrip.php">Add Trip</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addcustomer.php">Add Customer</a>
      </li>
    </ul>
    <a href="change_password.php" class="form-inline my-2 my-lg-0 btn btn-info">
        Change Password
    </a>
    <a href="logout.php" class="form-inline my-2 my-lg-0 btn btn-danger">
        Log Out
    </a>
  </div>
</nav>
<br>
<br>