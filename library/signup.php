<!-- for go back to mainpage -->
<?php include 'headerMyPage.php' ?>

<center>
<form action="signup.php" method="post">
        <input type="email" name="email" class="form-control" style="width: 35%;" placeholder="E-mail" required/><br/>
        <input type="password" name="password" class="form-control" style="width: 35%;" placeholder="Password" required/><br/>
        <input type="password" name="confirm" class="form-control" style="width: 35%;" placeholder="Confirm" required/><br/>
        <input type="text" name="name" class="form-control" style="width: 35%;" placeholder="Name" required/><br/>
        <input type="text" name="number" class="form-control" style="width: 35%;" placeholder="Phone Number" required/><br/>
        <input type="text" name="address" class="form-control" style="width: 35%;" placeholder="Address" required/><br/>
        <input type="submit" name="sub" value="Sign Up" class="btn btn-danger"/><br/>
    </form>
</center>

<?php
    if(isset($_POST["sub"]))
    {
        if($_POST["password"]==$_POST["confirm"]){
            $con = new mysqli("localhost", "root", "", "library");

            $st_check = $con->prepare("select * from users where email=?");
            $st_check->bind_param("s", $_POST["email"]);
            $st_check->execute();
            $rs = $st_check->get_result();
            if($rs->num_rows>0)
                echo "<script>alert('E-mail already used');</script>";
            else {
                $st=$con->prepare("insert into users(email, password, name, number, address)
                values(?,?,?,?,?)");
                $st->bind_param("sssss", $_POST["email"], $_POST["password"], $_POST["name"],
                $_POST["number"], $_POST["address"]);
                $st->execute();
                $_SESSION["user"] = $_POST["email"]; 
                echo "<script>window.location='menu.php';</script>";
            }
        } 
        else
            echo "<script>alert('Password Not Match');</script>";
    }
?>

<?php include 'footer.php' ?>