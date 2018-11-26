<?php
    session_start();
    $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
?>
 

<?php
    require 'header.php';
?>

    <?php
        require 'navbar.php';
    ?>

    <!-- END NAVBAR -->

    <section class="main-container">
        <div class="main-wrapper">
            <h2>Signup</h2>

            <?php
                if(isset($_GET['error'])) {
                    if($_GET['error'] == 'emptyField'){
                        echo '<p class="signupError"> There are empty fields </p>';
                    }
                    elseif($_GET['error'] == 'invalidEmail'){
                        echo '<p class="signupError"> Invalid email </p>';
                    }
                    elseif($_GET['error'] == 'passwordCheck'){
                        echo '<p class="signupError">repeat password don\'t match</p>';
                    }
                    elseif($_GET['error'] == 'connectionError'){
                        echo '<p class="signupError">Server error, please try again</p>';
                    }
                    elseif($_GET['error'] == 'userTaken'){
                        echo '<p class="signupError">username or email taken</p>';
                    }
                    elseif($_GET['error'] == 'invalidusername'){
                        echo '<p class="signupError">Invalid username</p>';
                    }
                }
                elseif (isset($_GET['signup']) && $_GET['signup'] == 'success'){
                    echo '<p class="signupSuccess"> Sign up success </p>';

                }
            ?>

            <form class="signup-form" action="includes/signup.inc.php" method="POST">
                <input type="text" name="mail" placeholder="E-mail" value="<?php echo isset($_GET['mail']) ? $_GET['mail'] : '' ?>">
                <input type="text" name="username" placeholder="Username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>">
                <input type="password" name="pwd" placeholder="Password">
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">
                <button type="submit" name = "signup-submit">Sign up</button>
            </form>
        </div>

    </section>


<?php
    require 'footer.php';
?>