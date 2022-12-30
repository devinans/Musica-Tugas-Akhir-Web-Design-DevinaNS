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
            <h3>Add Data</h3>
        
        <form class="w3-container" action="create_product.php" method="post" enctype="multipart/form-data">
            <label class="w3-text-black">ID</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="id">
            
            <label class="w3-text-black">Name</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="name">
            
            <label class="w3-text-black">Price</label>
            <input class="w3-input w3-border w3-light-grey" type="text" name="price">
            
            <label class="w3-text-black">Image</label>
            <input class="w3-input w3-border w3-light-grey" type="file" name="image">
            
            <input class="w3-btn w3-blue-grey" type="submit" name="submit" value="Add">
        </form>
        <?php
            if(isset($_POST["submit"]))
            {
                $id = $_POST["id"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                $image = basename($_FILES["image"]["name"]);
                $image_dir = "imgs/" . $image;
                move_uploaded_file($_FILES["image"]["tmp_name"], $image_dir);
                
                $con = new mysqli("localhost", "root", "", "library");
                $st = $con->prepare("insert into book values(?,?,?,?)");
                $st->bind_param("isds", $id, $name, $price, $image);
                $st->execute();
                echo "<script>window.location='product.php';</script>";
            }
        ?>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>