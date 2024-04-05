<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <title>User Edit</title>
  </head>
  <body>
    <div class="container">
        <h2>List of Clients</h2>
        <input type="submit" value="Change to Search User" onclick="location.href='livesearch_User_index.php'">
        <input type="submit" value="Change to Search Product" onclick="location.href='livesearch_index.php'">
        <input type="submit" value="logout" onclick="location.href='active/destroy.php'">
        <br>
        <table class ="table">
            <thead>
                <tr>
                    <th>customer_id</th>
                    <th>customer_name</th>
                    <th>customer_email</th>
                    <th>customer_password</th>
                    <th>customer_address</th>
                    <th>Action<th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "int4087";
                $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM customer";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) 
                {
                    echo"
                    <tr>
                        <td>$row[customer_id]</td>
                        <td>$row[customer_name]</td>
                        <td>$row[customer_email]</td>
                        <td>$row[customer_password]</td>
                        <td>$row[customer_address]</td>
                        <td>
                            <button class= 'btn btn-primary'><a href='Edit.php?customer_id=$row[customer_id]' class ='text-light'>Edit</a>
                            <button class= 'btn btn-danger'><a href='Delete.php?customer_id=$row[customer_id]' class ='text-light'>Delete</a>
                        </td>
                    </tr>
                        ";
                }

                ?>

            </tbody>
        </table>
    </div>
  </body>
</html>