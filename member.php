<div class='container'>
<?php
	// vd($_SESSION);
	if(empty($_SESSION)){
		echo "<script>location.href='memberlogin.html'</script>";
	} else{
		echo '<a class="btn" href="memberlogout.php">Logout</a>';
	} 
?>
</div>