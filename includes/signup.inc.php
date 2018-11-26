<?php
// TO DO ADD ERROR HANDLER FOR SECURE PASSWORD AND USERNAME = ADMIN

if (isset($_POST['signup-submit'])) {
    require 'dbHandler.inc.php';

    
    $email = mysqli_real_escape_string($conn, $_POST['mail']) ;
    $username = mysqli_real_escape_string($conn, $_POST['username']) ;
    $password = mysqli_real_escape_string($conn, $_POST['pwd']) ;
    $passwordRepeat = mysqli_real_escape_string($conn, $_POST['pwd-repeat']) ;




    //ERROR handlers
    //Check for empty fields
    if(empty($email) || empty($username) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyField&username=".$username."&mail=".$email);
        exit();
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidEmail&username=".$username);
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }
    elseif ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordCheck&username=".$username."");
        exit();
    }
    else {
        //Check for duplicate username in db
        $sqlText ="SELECT user_id FROM users WHERE user_uid =?";
        $sqlStatement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($sqlStatement, $sqlText)) {
            header("Location: ../signup.php?error=connectionError");
            exit();

        }
        else{
            mysqli_stmt_bind_param($sqlStatement, "s", $username);
            mysqli_stmt_execute($sqlStatement);
            mysqli_stmt_store_result($sqlStatement);
            $resultCheck = mysqli_stmt_num_rows($sqlStatement);

            if($resultCheck >=1) {
                header("Location: ../signup.php?error=userTaken");
                exit();
            }
            else {
                //Check for duplicate email in db
                $sqlText ="SELECT user_id FROM users WHERE user_email =?";
                $sqlStatement = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($sqlStatement, $sqlText)) {
                    header("Location: ../signup.php?error=connectionError");
                    exit();
        
                }
                else{
                    mysqli_stmt_bind_param($sqlStatement, "s", $email);
                    mysqli_stmt_execute($sqlStatement);
                    mysqli_stmt_store_result($sqlStatement);
                    $resultCheck = mysqli_stmt_num_rows($sqlStatement);

                    if($resultCheck >=1) {
                        header("Location: ../signup.php?error=userTaken");
                        exit();
                    }
                    else{
                        $sqlText = "INSERT INTO users (user_email, user_uid, user_pwd) VALUES (?, ?, ?)";
                        $sqlStatement = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($sqlStatement, $sqlText)) {
                            header("Location: ../signup.php?error=connectionError");
                            exit();

                        }
                        else {
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($sqlStatement, "sss", $email, $username, $hashedPwd);
                            mysqli_stmt_execute($sqlStatement);
                            header("Location: ../signup.php?signup=success");
                            exit();
                        }

                    }

                }
                
            }
        }
    }
    
    mysqli_stmt_close($sqlStatement);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
    exit();
}






