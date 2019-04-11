
<?php
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
</head>
<body>

<nav role='navigation'>
  <ul>
  	<li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
    <li><a href="index.php">Problems</a>
      <ul>
        <li><a href="index.php">Browse problems</a></li>
        <li id="makeproblem"><a href="index.php">Create a problem</a></li>
      </ul>
    </li>
    <li><a href="scoreboard.php">Scoreboard</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</nav>  
<br style="line-height: 100px;">

<?php
	//tampilkan gambar jika ada
	$picquery = "SELECT * FROM `users` WHERE `username`='".$_SESSION['username']."'";
	$result = mysqli_query($con,$picquery);
	$row = mysqli_fetch_assoc($result);
	if(!is_null($row['pplink'])){
		echo "<img src=uploads/".$row['pplink'].">";
	}
?>

<form action="uploadtostorage.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="hidden" value="<?php echo $_SESSION['username'] ?>" name="username">
    <input type="submit" value="Upload Image" name="submit">

</form>

<h2>Submitted Problems</h2>
<?php
	$uname = $_SESSION['username'];
	$queryp = "SELECT * FROM problems WHERE `username`='$uname'";
	$resultp = mysqli_query($con,$queryp);
	while($row = mysqli_fetch_assoc($resultp)){
		echo "<div class='problemlist'>";
		echo "<a href='editproblem.php?p_id=".$row['p_id']."';>Edit&nbsp</a>|&nbsp";
		echo "<a href='deleteproblem.php?p_id=".$row['p_id']."';>Delete&nbsp</a>";
		echo "<div class='ptitle'><p style='text-align:left;'>".$row['pname']."&nbsp-&nbsp".$row['username'];
		echo "<span style='float:right;'>".$row['pcategory']."&nbsp-&nbsp".$row['score']."<br></span></p></div></div>";
	}
?>

<h2>Submissions</h2>
<?php
	
	$query = "SELECT * FROM submission WHERE `username`='$uname'";
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result)){
		if($row['iscorrect']) echo "<div class='answered'>";
		else echo "<div class='problemlist'>";
		echo "<div class='ptitle'><p style='text-align:left;'>";
		if($row['iscorrect']) echo "Answer Submitted Problem No. ".$row['p_id']." with verdict TRUE<br>";
		else echo "Answer Submitted Problem No. ".$row['p_id']." with verdict FALSE<br>"; 
		echo "<span style='float:right;'><br></span></p></div></div>";
		
	}
?>


<br>
<footer class="footer">
  
</footer>
</body>
</html>