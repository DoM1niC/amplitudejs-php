
<?php
require "includes/autoload.php";
$head = "includes/head_player.php";
?>
<style>
#frame { 
height:100vh;
width:25vw;
}
</style>
<!DOCTYPE HTML>
<html lang="en">
<?php include $head; ?>
<body>
<div class="container">
<center><iframe id="frame" frameborder="0" scrolling="no" src="player.php?isLive=true&id=0"></iframe></center>
</div>
</div>
</body>
</html>