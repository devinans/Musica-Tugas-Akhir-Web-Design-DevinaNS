<?php include 'header.php' ?>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Logo</a>
        </div>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <?php include 'menu.php' ?>
        <div class="col-sm-8 text-left">
            <h1>Product Management</h1>
            <h3>Update Data</h3>

        <?php
        if(isset($_GET["submit"]))
        {
            $id = $_GET["id"];

            $con = new mysqli("localhost", "root", "", "library");
            $st = $con->prepare("select * from book where id='$id'");
            $st->execute();
            $rs = $st->get_result();
            $row = $rs->fetch_assoc();
        }
        ?>

        <form class="w3-container" action="update_product.php" method="post" enctype="multipart/form-data">
            <label class="w3-text-black">ID</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="id" >
            
            <label class="w3-text-black">Name</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="name" >
            
            <label class="w3-text-black">Price</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="price" >
            
            <label class="w3-text-black">Image</label>
            <input class="w3-input w3-border w3-light-grey" type="file" name="image">
            
            <input class="w3-btn w3-blue-grey" type="submit" name="submit" value="Update">
        </form>
        <?php
            if(isset($_POST["submit"]))
            {
                $id = $_POST["id"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                
                $con = new mysqli("localhost", "root", "", "library");
                $st = $con->prepare("update book set id=?, name=?, price=? where id='$id'");
                $st->bind_param("isd", $id, $name, $price);
                $st->execute();
            echo "<script>window.location='product.php';</script>";
            }
        ?>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>