<?php
$host="localhost"; // Host name 
$username="pharmape_dbadmin"; // Mysql username 
$password="FDzFXlaHz5!3"; // Mysql password 
$db_name="pharmape_perfdb"; // Database name 
$tbl_name="user"; // Table name 

// Connect to server and select databse.
$conn = mysqli_connect($host, $username, $password, $db_name);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if (isset($_POST['label'])) {
   $label = $_POST['label'];
   execute($label);
}
function execute($label)
{
   global $conn;
   switch ($label) {
    case "getMonthlyTargetOfAllSalesTypeOfClient":
         $client = $_POST['client'];
         $client = mysqli_real_escape_string($conn,$client);
         $month=date("m");
         $year = date("Y");
         $selectTargetList = "SELECT st.name,t.sales_target from target t inner join sales_type st on t.sales_type_id = st.id where user_id=100001 and MONTH(date) = $month AND YEAR(date) = $year";
         $targetListSelectResult=mysqli_query($conn,$selectTargetList);
         if ($targetListSelectResult) {
               while ($targetObj = mysqli_fetch_object($targetListSelectResult)) {
                  $data[] = $targetObj;
               }    
               echo json_encode($data);
         }else{
               $data='"Error" : "Target list is Empty"';
               echo json_encode($data);
         }
         mysqli_close($conn);
        break;
    case "blue":
        echo "Your favorite color is blue!";
        break;
    case "green":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}
}
?>