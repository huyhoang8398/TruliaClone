<?php
/*
    session_start();
    if(isset($_SESSION['url'])){
        $preurl = $_SESSION['url'];

    }
    else{
        $preurl = "index.php";
    }
*/

    if(isset($_POST['loginButton'])){
        require 'dbHandler.inc.php';
        $uName = mysqli_real_escape_string($conn, $_POST['userName']);
        $uPwd = mysqli_real_escape_string($conn, $_POST['userPassword']);
        $errorEmpty = false;
        $errorNoUser = false;
        //Check for empty input
        if(empty($uName) || empty($uPwd)){
            echo '<span class="login_error">There are empty fields</span>';
            $errorEmpty = true;
            
        }
        else {
            //Prepare sql statement
            $sqlText = "SELECT user_id, user_pwd FROM users WHERE user_uid=?";
            $sqlStatement = mysqli_stmt_init($conn);
            if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                echo '<span class="login_error">Server error, please try again</span>';
            }
            else{
                mysqli_stmt_bind_param($sqlStatement, "s", $uName);
                mysqli_stmt_execute($sqlStatement);
                $result = mysqli_stmt_get_result($sqlStatement);

                //Check for exist or not username
                if($row = mysqli_fetch_assoc($result)){
                    //Check for password correct or not
                    $pwdCheck = password_verify($uPwd, $row['user_pwd']);
                    if($pwdCheck == false){
                        echo '<span class="login_error">Wrong user name or password</span>';
                        $errorNoUser = true;
                        
                    }
                    elseif($pwdCheck == true){
                        //session username = id not username
                        session_start();
                        $_SESSION['userID'] = $row['user_id'];
                        $loginSuccess = true;
                        
                    }
                }
                else {
                    echo '<span class="login_error">Wrong user name or password</span>';
                    $errorNoUser = true;
                    
                }


            }
        }
    }
    else {
        echo '<span class="login_error">button is not set</span>';
        exit();
    }
?>

<script>
    var loginSuccess = "<?php echo $loginSuccess; ?>";
    
    if(loginSuccess == true){
        $("#loginModal").modal('toggle');
        window.location.reload(true);
    }

    
</script>

