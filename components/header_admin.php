<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <!-- Logo on the left -->
      <a class="navbar-brand" href="#">PMISGAD</a>
      
      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Nav items aligned to the right -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <!-- Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Manage Offices
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./office_name.php" style="">Add Office</a></li>
              <li><a class="dropdown-item" href="./manage_office.php">View All Office</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Settings
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="./profile.php" style="">Profile</a></li>
              <li><a class="dropdown-item" href="logout.php" onclick= "return('Are you sure you want to logout?')">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>