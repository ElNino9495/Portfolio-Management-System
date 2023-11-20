<?php
#echo("hello<br>");
$username="root";
$servername="localhost";
$password="";
$dbname = "Portfolio_Management";
$conn= mysqli_connect($servername,$username,$password,$dbname);
//echo("connected");
if($conn->connect_error){
  echo("Connection Failed");
}
#echo("Success connection<br>");
// $sql = "SELECT * FROM user_details";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//       echo "id: " . $row["user_id"]. " - Name: " . $row["name"]. "<br>";
//     }
// }
// else {
//     echo "0 results";
//   }

// $sql = "INSERT INTO user_details (user_id, dob,name, password, pan, email)
// VALUES
// ('AQC123456703', '2003-06-30','John Josw', 'password1', 'AQC1234567', 'john11@example.com'),
// ('TBC123456703', '2003-06-30','Johny sine', 'password1', 'TBC1234567', 'johns@example.com')";

// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }

// $conn->close();
// $conn->close();

?>