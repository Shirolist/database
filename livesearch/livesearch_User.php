<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "int4087";
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if(isset($_POST["input"])){

    $input = $_POST["input"];

    $query = "SELECT * FROM customer WHERE customer_id LIKE '{$input}%' 
    OR customer_name LIKE '{$input}%'
    OR customer_email LIKE '{$input}%'
    OR customer_password LIKE '{$input}%'
    OR customer_address LIKE '{$input}%'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0)
    {?>
        <table class="table table-bordered table-striped mt-4">
            <thead>
                <th>customer_id</th>
                <th>customer_name</th>
                <th>customer_email</th>
                <th>customer_password</th>
                <th>customer_address</th>
            </thead>

            <tbody>
                <?php
                while($row = mysqli_fetch_array($result))
                {
                    $customer_id= $row["customer_id"];
                    $customer_name = $row["customer_name"];
                    $customer_email = $row["customer_email"];
                    $customer_password = $row["customer_password"];
                    $customer_address = $row["customer_address"];
                ?>

                <tr>
                    <td><?php echo $customer_id; ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_password; ?></td>
                    <td><?php echo $customer_address; ?></td>

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