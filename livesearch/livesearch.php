<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "int4087";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
if(isset($_POST["input"])){

    $input = $_POST["input"];

    $query = "SELECT * FROM product WHERE product_id LIKE '{$input}%' 
    OR product_type LIKE '{$input}%'
    OR product_name LIKE '{$input}%'
    OR product_description LIKE '{$input}%'
    OR product_price LIKE '{$input}%'
    OR product_picture LIKE '{$input}%'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {?>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <th>product_id</th>
                <th>product_type</th>
                <th>product_name</th>
                <th>product_description</th>
                <th>product_price</th>
                <th>product_picture</th>
            </thead>

            <tbody>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    $product_id = $row["product_id"];
                    $product_type = $row["product_type"];
                    $product_name = $row["product_name"];
                    $product_description = $row["product_description"];
                    $product_price = $row["product_price"];
                    $product_picture = $row["product_picture"];
                ?>

                <tr>
                    <td><?php echo $product_id; ?></td>
                    <td><?php echo $product_type; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $product_description; ?></td>
                    <td><?php echo $product_price; ?></td>
                    <td><?php echo $product_picture; ?></td>

                </tr>

                <?php
                }

                ?>
            </tbody>
        </table>
        <?php
    }
    else
    {  
        echo "<h6 class='text-danger text-center mt-3'>No data found<h6>";
    }
}

?>