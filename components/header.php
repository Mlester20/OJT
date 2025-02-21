<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <!-- Logo on the left with image before the text -->
      <a class="navbar-brand text-sm d-flex align-items-center" href="./dashboard.php">
        <!-- Image placed before the text -->
        <img src="../images/logo.png" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
        Planning, Management of Information and Services, Gender and Development
      </a>
      
      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <!-- Nav items aligned to the right -->
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php"><i class="fas fa-home me-1"></i> Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-hammer me-1"></i>Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="dropdown-item-hover">

            <li class="dropdown-item-hover">
              <a class="dropdown-item" href="mis.php">
                <i class="fas fa-users me-2"></i>MIS
              </a>
              <ul class="dropdown-submenu">
                <li class="dropdown-item-hover">
                  <a href="#">Administrative</a>
                  <ul class="dropdown-submenu sub-left">
                    <li><a href="awards.php">Awards & Recognition</a></li>
                    <li><a href="#">Finance</a></li>
                    <li><a href="#">Procurement</a></li>
                  </ul>
                </li>
                <li><a href="#">IT Support</a></li>
                <li><a href="#">Security</a></li>
              </ul>
            </li>


              <li><a class="dropdown-item" href="#"><i class="fas fa-building me-2"></i>Planning</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-user-tie me-2"></i>Gender and Development</a></li>
              <li><a class="dropdown-item" href="#"><i class="fas fa-id-badge me-2"></i>ISO QMS</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i>
                <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest'; ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="./profile.php">
                  <i class="fas fa-user me-2"></i> Profile
                </a></li>
                <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav>