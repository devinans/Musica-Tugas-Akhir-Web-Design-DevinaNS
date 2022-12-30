<?php include 'header.php' ?>

<div class="container-fluid text-center">
    <?php
    $con=new mysqli("localhost", "root", "", "library");
    $st_bill=$con->prepare("select * from bill where bill_no=?");
    $st_bill->bind_param("i", $_GET["bno"]);
    $st_bill->execute();
    $rs_bill=$st_bill->get_result();
    $row_bill=$rs_bill->fetch_assoc();
    echo '<h4>Bill Number : '.$row_bill['bill_no'].'</h4>';
    echo '<h4>Bill Date : '.$row_bill['bill_date'].'</h4>';

    $st_det=$con->prepare("select name, price, itemqty from book
    inner join bill_detail on book.id=bill_detail.productid where bill_no=?");
    $st_det->bind_param("i", $_GET["bno"]);
    $st_det->execute();
    $rs_det=$st_det->get_result();
    echo '<table width=80% border=2>';
    echo '<tr>';
    echo '<th>Name</th>';
    echo '<th>Price</th>';
    echo '<th>Qty</th>';
    echo '<th>Sub Total</th>';
    echo '<tr>';
    $total=0;
    while($row_det=$rs_det->fetch_assoc())
    {
        echo '<tr>';
        echo '<td>'.$row_det['name'].'</td>';
        echo '<td>'.$row_det['price'].'</td>';
        echo '<td>'.$row_det['itemqty'].'</td>';
        echo '<td>'.$row_det['price']*$row_det['itemqty'].'</td>';
        echo '</tr>';
        $total=$total + ($row_det['price']*$row_det['itemqty']);
    }
    echo '</table>';
    echo '<h3>The total is Rp. '.$total.'</h3>';
    ?>

</div>

<?php include 'footer.php' ?>