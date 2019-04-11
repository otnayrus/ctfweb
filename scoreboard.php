<?php
	//include auth.php file on all secure pages
	include("auth.php");
	require("db.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css">
<style type="text/css">
table { 
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: #eee; 
}
th { 
  background: #333; 
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid #ccc; 
  text-align: left; 
}
</style>
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
<h2>Scoreboard</h2>

<table style="width: 50%; margin: 0 auto;">
    	<tr>
    		<th style="width: 10%;">Rank</th> <th>Username</th> <th>Score</th>
  		</tr>

<?php
	$query = "SELECT * FROM `users` ORDER BY `u_score` DESC";
	$result = mysqli_query($con,$query);
if( !$result ){
	echo 'SQL Query Failed';
}else{
	$rank = 0;
	$last_score = false;
	$rows = 0;

  while( $row = mysqli_fetch_assoc($result) ){
    $rows++;
    if( $last_score!= $row['u_score'] ){
      $last_score = $row['u_score'];
      $rank = $rows;
    }
    echo "<tr><td style='align:center;'>".$rank."</td><td>".$row['username']."</td><td>".$row['u_score']."</td></tr>";
  }
}

?>
</table>

<br>
<footer class="footer">
</footer>
</body>
</html>