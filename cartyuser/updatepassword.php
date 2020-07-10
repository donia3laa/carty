<?php ob_start(); session_start(); include "headerbefore.php"; ?>
<div class = "container">
    <br><br>
    <h4 class="text-center h1reg">Update your Password</h4>
    <?php

   
    if(isset($_POST['actsub2'])){
        



        if ($_POST['actnewpass'] === $_POST['actrenewpass']) {
            //    echo("MATCHED");
            $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; //Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
            if(preg_match($reg,$_POST['actnewpass'])){

                if($_SESSION['activationcode']==$_POST['actcode']){
        
                    include "customer.php";
                    $cust = new customer();
                    $cust->setPassword(sha1($_POST['actnewpass']));
                    $cust->setId($_GET['usid']);
                    
                    $result = $cust->update();
                    // echo($log);
                    if($result==="ok"){
                        echo('<div class="alert alert-success text-center" role="alert">Password has been updated</div>');
                        // header('Refresh:5; url:login.php');
                        header("Refresh:5; url=login.php");
        
                    }
                    else{
                        echo('<div class="alert alert-danger text-center" role="alert">WRONG PASSWORD</div>');
                        echo($row);
                    }
                }else{
                    echo('<div class="alert alert-danger text-center" role="alert">WRONG ACTIVATION CODE</div>');
                }   

            }
            else{
                echo('<div class="alert alert-danger text-center" role="alert">PASSWORD IS WEAK</div>');
            }
        }
        else{
            echo('<div class="alert alert-danger text-center" role="alert">PASSWORD NOT MATCHED</div>');
            
        }
    
}
    ?>
    <br>
    <div style="width: 60%" class="m-auto">
        <form method="POST">
                <div class="form-group">
                <label for="email_modal">Please enter your activation key to match your account.</label>
                    <input id="email_modal" type="text" placeholder="Activation code " class="form-control" name="actcode">
                </div>
                <div class="form-group">
                    <input id="password_modal" type="password" placeholder="New password" class="form-control" name="actnewpass">
                </div>
                <div class="form-group">
                    <input id="password_modal" type="password" placeholder="Retype New password" class="form-control" name="actrenewpass">
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-success" name="actsub2">Update password</button>
                </p>
                
        </form>
    </div>
    <br><br><br>
</div>

<?php include "footer.php"; ?>