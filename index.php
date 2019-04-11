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
<link href="https://fonts.googleapis.com/css?family=Inconsolata" rel="stylesheet">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src='script/script.js'></script>
</head>
<body>

<nav role='navigation'>
  <ul>
  	<li><a href="profile.php"><?php echo $_SESSION['username']; ?></a></li>
    <li><a href="index.php">Problems</a>
      <ul>
        <li id="jump"><a href="#">Browse problems</a></li>
        <li id="makeproblem"><a href="#">Create a problem</a></li>
      </ul>
    </li>
    <li><a href="scoreboard.php">Scoreboard</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>
</nav>  
<br style="line-height: 100px;">


<?php
	echo "<div id='hiddenmaker'><div id='pmaker'><form method='POST' action='".setProblem($con)."' enctype='multipart/form-data'>
		<h2>Create A Problem</h2>
		<p>Problem Name</p> <input type='text' name='pname' style='margin-left: 112px; width:350px;' placeholder='Problem Title' required><br>
		<p>Problem Category</p> <input type='text' name='category' style='margin-left: 90px; width:350px;' placeholder='Category' required><br>
		<p>Problem Flag</p> <input type='text' name='flag' style='margin-left: 125px; width:350px;' placeholder='Flag' required><br>
		<p>Score</p> <input type='text' name='score' style='margin-left: 178px; width:350px;' placeholder='Score' required><br>
		<p>Description</p><br> <textarea name='desc'></textarea><br>
		File (optional) Max : 1MB <input type='file' name='userfile'><br><br>
		<button type='submit' name='psubmit' class='button'>
			Submit
		</button>
	</form>
	</div></div>";
	echo "<h2 id='p1'>Problems</h2><div class='container-p'>";
	getProblems($con);
	echo "</div>";
?>
<br>

<footer class="footer">
</footer>
</body>
<script type="text/javascript">
	$("#makeproblem").click(function(){
	$("#hiddenmaker")
	  .css('opacity', 0)
	  .slideDown('slow')
	  .animate(
	    { opacity: 1 },
	    { queue: false, duration: 'slow' }
	  );
	});

	$(document).ready(function(){
	    $(".ptitle").click(function(){
	        $(this).next().slideToggle("slow");
	    });
	});

	$("#jump").click(function() {
    $('html, body').animate({
        scrollTop: $("#p1").offset().top -200
    }, 1000);
});
</script>
</html>