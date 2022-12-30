<html>
<head>
    <title>Read All Data to MySQL</title>
</head>

<body>
    <?php
        $con = new mysqli("localhost", "root", "", "library");
        $st = $con->prepare("select * from book");
        $st->execute();
        $rs = $st->get_result();
        while($row = $rs->fetch_assoc())
        {
            echo $row["id"] . "<br>";
            echo $row["name"] . "<br>";
            echo $row["price"] . "<br>";
        }
    ?>
</body>
</html>