<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!-- Logo on the left with image before the text -->
        <a class="navbar-brand text-sm d-flex align-items-center" href="./dashboard.php">
            <!-- Image placed before the text -->
            <img src="../images/logo.png" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
            <span class="full-title">PMISGAD</span>
            <span class="short-title">PMISGAD</span>
        </a>
        
        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span><i class="fas fa-bars"></i></span>
        </button>
        
        <!-- Nav items aligned to the right -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="fas fa-home me-1"></i> Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownFiles" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-folder me-1"></i>Files
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownFiles">
                        <li><a class="dropdown-item" href="view_all.php"><i class="fas fa-folder me-2"></i>Archives</a></li>
                        <li><a class="dropdown-item" href="complied_data.php"><i class="fas fa-folder me-2"></i>Complied Data</a></li>
                        <li><a class="dropdown-item" href="upload.php"><i class="fas fa-folder me-2"></i>Uploaded File</a></li> 
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        </ul> 
                    </ul> 
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownEntries" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-folder-open me-1"></i>Entries
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownEntries">
                        <li><a class="dropdown-item" href="manage_users.php"><i class="fas fa-users me-2"></i> Users</a></li>
                        <li><a class="dropdown-item" href="manage_office.php"><i class="fas fa-building me-2"></i> Manage Offices</a></li>
                        <li><a class="dropdown-item" href="salut.php"><i class="fas fa-user-tie me-2"></i> Salutation</a></li> 
                        <li><a class="dropdown-item" href="designation.php"><i class="fas fa-id-badge me-2"></i> Designation</a></li>
                        <li><a class="dropdown-item" href="rank.php"><i class="fas fa-id-badge me-2"></i> Rank</a></li> 
                    </ul> 
                </li>

                <!-- notifications -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i> Notifications <span id="notifCount" class="badge bg-danger"></span>
                    </a>
                    <ul class="dropdown-menu" id="notifList"></ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownServices" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-hammer me-1"></i>Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownServices">
                        <li class="dropdown-item-hover">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-users me-2"></i>MIS
                            </a>
                            <ul class="dropdown-submenu">
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-cogs"></i> Administrative</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="awards.php"><i class="fas fa-trophy"></i> Awards & Recognition</a></li>
                                        <li><a href="employees.php"><i class="fas fa-wheelchair"></i> Employees with Special Needs</a></li>
                                        <li><a href="scholarship_grant.php"><i class="fas fa-graduation-cap"></i> Scholarship Grant</a></li>
                                        <li><a href="non_academic_staff.php"><i class="fas fa-users"></i> Non-Academic Staff</a></li>
                                        <li><a href="infrastructure.php"><i class="fas fa-building"></i> Infrastructure</a></li>
                                        <li><a href="purchase.php"><i class="fas fa-shopping-cart"></i> Major Purchases</a></li>
                                        <li><a href="list_officials.php"><i class="fas fa-user-tie"></i> List of Officials</a></li>
                                        <li><a href="#"><i class="fas fa-coins"></i> Income Generating Enterprises</a></li>
                                        <li><a href="#"><i class="fas fa-chalkboard-teacher"></i> Faculty Profile</a></li>
                                        <li><a href="trainings.php"><i class="fas fa-users-cog"></i> Trainings and Conferences</a></li>
                                        <li><a href="administrative_linkages.php"><i class="fas fa-handshake"></i> Administrative Services Linkages</a></li>
                                        <li><a href="administrative_innovations.php"><i class="fas fa-lightbulb"></i> Administrative Service Innovations</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-book-open"></i> Research</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="research.php"><i class="fas fa-book"></i>Research Center</a></li>
                                        <li><a href="research_linkages.php"><i class="fas fa-book"></i>Research Linkages</a></li>
                                        <li><a href="research_funding.php"><i class="fas fa-book"></i> Research Funding</a></li>
                                        <li><a href="#"><i class="fas fa-users"></i> On-going Research</a></li>
                                        <li><a href="#"><i class="fas fa-building"></i> Researchers Presented</a></li>
                                        <li><a href="#"><i class="fas fa-shopping-cart"></i> Researchers Published</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> Instruction</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="national_certificate.php"><i class="fas fa-book"></i>National Certificate of Performance</a></li>
                                        <li><a href="academic_services_innovation.php"><i class="fas fa-book"></i>Academic and Related Services Innovations</a></li>
                                        <li><a href="instruction_number_students_disability.php"><i class="fas fa-wheelchair"></i>Number of Students with Disability</a></li>
                                        <li><a href="instruction_academic_status.php"><i class="fas fa-scroll"></i>Academic Status</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> Extension</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="extension_linkages.php"><i class="fas fa-book"></i>Extension Linkages</a></li>
                                        <li><a href="extension_awards.php"><i class="fas fa-book"></i>Extension Awards and Recognition</a></li>
                                        <li><a href="extension_training_services_innovations.php"><i class="fas fa-book"></i>Extension and Training Service Innovations</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul> 
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest'; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUser">
                        <li><a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user me-2"></i> Profile
                        </a></li>
                        <li><a class="dropdown-item" href="activity_log.php"><i class="fas fa-cog me-2"></i>Activity Log</a></li>
                        <button id="darkModeToggle" class="btn me-3">
                            🌙 <span id="darkModeText">Dark Theme</span>
                        </button>
                        <li><a class="dropdown-item" href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a></li>
                        
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .dark-mode {
        background-color: #121212;
        color: white;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: white;
    }
    .short-title {
        display: none;
    }

    @media (max-width: 768px) {
        .full-title {
            display: none;
        }
        .short-title {
            display: inline;
        }
    }

    .navbar-toggler-icon {
        background: none;
        border: none;
    }

    .navbar-toggler-icon .fas {
        font-size: 1.5rem;
        color: #000;
    }
</style>