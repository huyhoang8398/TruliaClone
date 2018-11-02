<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="logo" style="width:65px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Buy<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Rent<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Mortgage</a>
                        <a class="dropdown-item" href="#">Local Info</a>
                        <a class="dropdown-item" href="#">Additional Resources</a>
                    </div>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            <!-- AN DEP TRAI HERE-->
            <?php
                if(isset($_SESSION['userID'])) {
                    echo '<form action="includes/logout.inc.php" method="POST">
                    <button name="logoutButton" type="submit" class="btn btn-primary">Logout</button>
                </form>';
                }
                else{
                    echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>';
                }

            ?>
            
            <a href ="signup.php"><button type="button" class="btn btn-primary">Sign up</button></a>
            
            <div class="modal fade" id="loginModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form id="loginForm" action="includes/login.inc.php" method="POST">
                                <div class="usernameContainer">
                                    <label for="username_input" class="col-form-label">Username</label>
                                    <input id="inputUsername" type="text" name="userName" placeholder="Username" id="username_input">
                                </div>
                                <div class="passwordContainer">
                                    <label for="password_input" class="col-form-label">Password</label>
                                    <input id="inputPassword" type="password" name="userPassword" placeholder="Password" id="password_input">
                                </div>  
                                <button type="submit" name="loginButton" id="loginButton">Login</button>
                                <p id="form_message"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Indication show log in or not -->
            <div class="container">
                <?php
                    if(isset($_SESSION['userID'])) {
                        echo '<p class="login_status">You are logged in</p>';
                    }
                    else{
                        echo '<p class="login_status">you are not logged in</p>';
                    }
                
                ?>
            </div>
        </div>
        <!-- AN DEP TRAI HERE-->
    </nav>