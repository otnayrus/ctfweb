
<?php
	//include auth.php file on all secure pages
	include("auth.php");
	include("db.php");
	include("submitproblem.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src='script/script.js'></script>
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
	if(isset($_GET['p_id'])) { // if f_id is set then get the file with the f_id from database
		$p_id = $_GET['p_id'];
		$query = "SELECT * FROM problems WHERE `p_id`=$p_id";
		$result = mysqli_query($con,$query) or die('Error, query failed');
		$row = mysqli_fetch_assoc($result);
		$file = $row['f_id'];
		$uname = $row['username'];
		$c_date = date("Y-m-d H:i:s");
		echo "<div id='editmaker'><div id='pmaker'><form method='POST' action='".editProblem($con)."' enctype='multipart/form-data'>
			<h2>Edit A Problem</h2>
			<input type='hidden' name='p_id' value=".$p_id.">
			<input type='hidden' name='f_id' value=".$file.">
			<p>Problem Name</p> <input type='text' name='pname' style='margin-left: 112px; width:350px;' value='".$row['pname']."' required><br>
			<p>Problem Category</p> <input type='text' name='category' style='margin-left: 90px; width:350px;' value='".$row['pcategory']."' required><br>
			<p>Problem Flag</p> <input type='text' name='flag' style='margin-left: 125px; width:350px;' value='".$row['flag']."' required><br>
			<p>Score</p> <input type='text' name='score' style='margin-left: 178px; width:350px;' value='".$row['score']."' required><br>
			<p>Description</p><br> <textarea name='desc'>".$row['description']."</textarea><br>
			File (optional) Max : 1MB <input type='file' name='userfile'>";
		if(!is_null($file)){
			echo "<a href='deleteproblem.php?f_id=".$row['f_id']."';>Delete Attachment&nbsp</a>";
		}
		echo "<br><br>
			<button type='submit' name='esubmit' class='button'>
				Submit
			</button>
		</form>
		</div></div>";
	}
?>


<br>
<footer class="footer">
</footer>
</body>
</html>