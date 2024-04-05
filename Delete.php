 <?php
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "int4087";
  $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

  // Check the database connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
    if(isset($_GET['customer_id']))
    {
        $customer_id = $_GET['customer_id'];
        $sql = "DELETE FROM `customer` WHERE customer_id= $customer_id";
        $result = mysqli_query($conn, $sql);

        if($result) 
            { 
                header("location:crud_index.php");
            } else
            {
                echo "Deleted promble";
            }
    }
?>