<!-- for go back to mainpage -->
<?php include 'headerMyPage.php' ?>
    <?php echo $_SESSION["user"]; ?>
    <div class="container-fluid text-center">
        <div class="row text-center">
        <?php
            $con = new mysqli("localhost", "root", "", "library");
            $st = $con->prepare("select * from book");
            $st->execute();
            $rs = $st->get_result();
            while($row=$rs->fetch_assoc())
            {
                echo '<div class="col-sm-1">
                <div class="thumbnail">
                <img src="admin/imgs/' . $row["image"] . '"
                width="400" height="300"/>
                <p><strong>' . $row["name"] . '</strong></p>
                <p>Rp. ' . $row["price"] . '</p>
                <a href="add_item.php?id='.$row["id"].'">Add</a>
                </div>
                </div>';
            }
    ?>
    <div class="col-sm-6">
            <table width="100%" border="1">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub Total</th>
                    <th>Remove</th>
                </tr>
    <?php
    $con = new mysqli("localhost", "root", "", "library");
    $st = $con->prepare("select book.id, qty, name, price from book
    inner join temp_order on book.id=temp_order.productid where email=?");
    $st->bind_param("s", $_SESSION["user"]);
    $st->execute();
    $rs = $st->get_result();
    $total = 0;
    while($row=$rs->fetch_assoc())
    {
        echo '<tr>';
        echo '<td>'.$row["name"].'</td>';
        echo '<td>'.$row["price"].'</td>';
        echo '<td>'.$row["qty"].'</td>';
        echo '<td>'.$row["price"]*$row["qty"].'</td>';
        echo '<td><a href="delete_item.php?id='.$row["id"].'">
        <span class="glyphicon glyphicon-trash"></span></a></td>';
        echo '</tr>';
        $total = $total + ($row["price"] * $row["qty"]);
    }
    ?>
            </table>
            <?php
            echo '<h3>The total is Rp. ' . $total . '</h3>';
            ?>
            <form action="add_order.php" method="post">
                <input type="submit" value="Order Now!" class="btn btn-danger" />
            </form>
        </div>

        </div>
    </div>
<?php include 'footer.php' ?>