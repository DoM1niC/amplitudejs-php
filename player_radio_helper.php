
<?php
require "includes/autoload.php";
$head = "includes/head_player.php";
?>
<style>
#frame { 
height:68vh;
width:25vw;
}
</style>
<!DOCTYPE HTML>
<html lang="en">
<?php include $head; ?>
<body class="blue">
<div class="container">
<center><iframe id="frame" frameborder="0" allowtransparency="true" scrolling="no" src="player.php?isLive=true&id=0&trans=true"></iframe></center>
</div>
</body>
</html>