<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <!-- Logo on the left with image before the text -->
        <a class="navbar-brand text-sm d-flex align-items-center" href="home.php">
            <!-- Image placed before the text -->
            <img src="../images/logo.png" alt="User Image" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
            <span class="full-text">Planning, Management of Information and Services, Gender and Development</span>
            <span class="mobile-text">Pmisgad</span>
        </a>
        
        <!-- Toggler for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Nav items aligned to the right -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home.php"><i class="fas fa-home me-1"></i> Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-folder me-1"></i>Files
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="complied_data.php"><i class="fas fa-folder me-2"></i>Complied Data</a></li> 
                        <li><a class="dropdown-item" href="upload_file.php"><i class="fas fa-folder me-2"></i>Uploaded File</a></li> 
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-hammer me-1"></i>Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item-hover">
                            <a class="dropdown-item" href="">
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
                                        <li><a href="administrative_faculty.php"><i class="fas fa-chalkboard-teacher"></i> Faculty Profile</a></li>
                                        <li><a href="trainings.php"><i class="fas fa-users-cog"></i> Trainings and Conferences</a></li>
                                        <li><a href="administrative_linkages.php"><i class="fas fa-handshake"></i> Administrative Linkages</a></li>
                                        <li><a href="innovations.php"><i class="fas fa-lightbulb"></i> Administrative Service Innovations</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-book-open"></i> Research</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="research.php"><i class="fas fa-book"></i>Research Center</a></li>
                                        <li><a href="research_linkages.php"><i class="fas fa-book"></i>Research Likages</a></li>
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
                                        <li><a href="instruction_enrollment.php"><i class="fas fa-scroll"></i>Enrollment</a></li>
                                        <li><a href="instruction_graduates.php"><i class="fas fa-graduation-cap"></i>Graduates</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-book-open"></i> Extension</a>
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

                 <!-- dropdown for Planning -->
                    <li class="dropdown-item-hover">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-tasks me-2"></i>Planning
                        </a>
                        <ul class="dropdown-submenu">
                                <li class="dropdown-item-hover">
                                    <a href="#"><i class="fas fa-cogs"></i> Action & Budget Plan</a>
                                    <ul class="dropdown-submenu sub-left">
                                        <li><a href="#"><i class="fas fa-trophy"></i>Instruction</a></li>
                                        <li><a href="#"><i class="fas fa-wheelchair"></i>R&D</a></li>
                                        <li><a href="#"><i class="fas fa-graduation-cap"></i>Extension and Training</a></li>
                                        <li><a href="management_resource.php"><i class="fas fa-users"></i>MANAGEMENT OF RESOURCES</a></li>
                                        <li><a href="rgm.php"><i class="fas fa-building"></i>RGM</a></li>
                                        <li><a href="internalization.php"><i class="fas fa-shopping-cart"></i>Internalization</a></li>
                                    </ul>
                                </li>
                        </ul>
                    </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-1"></i>
                        <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Guest'; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="profile.php">
                            <i class="fas fa-user me-2"></i> Profile
                        </a></li>
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
    .navbar-nav .nav-link:hover {
        background-color: #f8f9fa;
        color: #0056b3;
        border-radius: 5px;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #e9ecef;
        color: #0056b3;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-item-hover:hover {
        background-color: #e9ecef;
        color: #0056b3;
    }

    /* New responsive styles */
    .mobile-text {
        display: none;
    }

    @media (max-width: 768px) {
        .full-text {
            display: none;
        }
        .mobile-text {
            display: inline;
            font-weight: bold;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-collapse {
            background: black;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            max-height: 300px;
            overflow-y: auto;
        }
    }

    /* Custom styles for the navbar-toggler */
    .navbar-toggler {
        border: none;
        background: transparent;
    }

    .navbar-toggler .fas {
        transition: transform 0.3s ease;
    }

    .navbar-toggler.collapsed .fas {
        transform: rotate(90deg);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toggler = document.querySelector('.navbar-toggler');
        toggler.addEventListener('click', function() {
            this.classList.toggle('collapsed');
        });
    });
</script>