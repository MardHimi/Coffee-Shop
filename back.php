<!-- მონაცემების ფაილში ჩაწერა -->
<?php
    if(isset($_POST['submit'])){
    $name = $_POST['Name'];
    $surname = $_POST['Surname'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $text = $name . " -> " . $surname . " -> " . $email . " -> " . $password . "\n";
    $fp = fopen('user.txt', 'a+');
        if(fwrite($fp, $text)){
            echo 'registered successfully';
        	}
        	fclose($fp);
        }
?>


<!-- select -->
<?php
$con =  new mysql_("localhost","root","","users");
if($mysql_->connect_errno){
	printf("connect error ", $mysql_->connect_errno)}

$query = "SELECT * from user";
if ($result = $mysql_->query($query)) {
	while ($row=$result->fetch_assoc()) {
		echo $row["Name"];
		echo $row["Surname"]
		echo $row["Email"]
		echo $row["Password"]
	}
}
$con->close();
?>

<!-- insert -->
<?php
$con =  mysqli_connect("localhost","root","","users");
	if (isset($_GET['submit'])) {
		if(($_GET['Name']!="") && ($_GET['Surname'])!="") && ($_GET['Email']!="") && ($_GET['Password']!=""))		
			if (!$con){
				die("EROOOR");
			}
		$Name=$_GET['Name'];
        $Surname=$_GET['Surname'];
        $Email=$_GET['Email'];
        $Password=$_GET['Password'];
        $sql= "INSERT INTO user(Name,Surname,Email,Password) VALUES('".$Name."','".$Surname."','".$Email."','".$Password."')";
			if(mysqli_query($con,$sql)){
       	    	echo "inserted";
       	      	header("refresh:1;url=cls.php");
            } 
            else {
				echo "not inserted";
			}
?>


<!-- update -->
<?php
		$sql = "SELECT * from user";
		$result = mysqli_query($con, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			echo "<tr><td>".$row['id']."</td><td>".
			$row['Name']."</td><td>".$row['Name'].
			"</td><td><a href='delete.php?delid=".$id."'>delete</a></td><td><a href='update.php?upid=".$id."'>edit</a></td></tr>";
		}
		echo "</table>";		
	?>

<!-- delete -->
<?php

$id= $_GET['delete'];
$con =  mysqli_connect("localhost","root","","users");
$sql = "DELETE FROM user WHERE id=$id";
$result= mysqli_query($con,$sql);

if($result){
	echo "deleted";
	header("refresh:2;url=cls.php");
}
else{
	echo "not deleted";
}
?>