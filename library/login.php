<!-- for go back to mainpage -->
<?php include 'headerMyPage.php' ?>

<center>
    <form action="login.php" method="post">
        <input type="email" name="email" class="form-control" style="width: 35%;" placeholder="E-mail"/><br/>
        <input type="password" name="password" class="form-control" style="width: 35%;" placeholder="Password"/><br/>
        <input type="submit" name="sub" value="Login" class="btn btn-danger"/><br/>
    </form>
    </br></br>
    <a href="signup.php">Sign Up?</a>
</center>

<?php
    if(isset($_POST["sub"]))
    {
            $con = new mysqli("localhost", "root", "", "library");

            $st_check = $con->prepare("select * from users where email=? and password=?");
            $st_check->bind_param("ss", $_POST["email"], $_POST["password"]);
            $st_check->execute();
            $rs = $st_check->get_result();
            if($rs->num_rows==0)
                echo "<script>alert('Login fail');</script>";
            else
                $_SESSION["user"] = $_POST["email"]; 
                echo "<script>window.location='menu.php';</script>";
            }
?>

<?php include 'footer.php' ?>