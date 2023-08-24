<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><?php echo SITE_NAME; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(empty($session)){ ?>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?php echo SITE_URL; ?>">Register</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="employees.php?status=active">Employee's List</a>
                </li>
                <?php if(!empty($session) && $sroleId!=3){ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php?status=active">User's List</a>
                    </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(!empty($session)){ ?>
                            <li><a class="dropdown-item" href="profile">My Profile</a></li>
                            <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="<?php echo !empty($session)?'logout.php':'login.php'; ?>"><?php echo !empty($session)?'LogOut':'Login'; ?></a></li>
                        <?php if(empty($session)){ ?>
                            <li><a class="dropdown-item" href="forgot-password.php">Forgot Password</a></li>
                        <?php } ?>
                        <!--<li><hr class="dropdown-divider"></li>-->
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Form's Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                        <li>
                            <a class="dropdown-item" href="query">
                                <?php echo !empty($session) && $sroleId == 1?'Query Form':'Query List'; ?></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="daily_updates">
                                <?php echo !empty($session) && $sroleId == 1?'Daily Update Form':'Daily Update\'s List'; ?></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="daily_workSheet">
                                <?php echo !empty($session) && $sroleId == 1?'Daily Work Sheet':'Daily Work Sheet'; ?></a>
                        </li>
                        <!--<li><hr class="dropdown-divider"></li>-->
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>