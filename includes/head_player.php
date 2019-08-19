	<head>
	<style>
	<?php if (!isset($_GET['trans'])) { ?>
.background {
  background-image: -webkit-linear-gradient(316deg, #3BD2AE 0%, #36BAC2 100%);
  background-image: linear-gradient(-226deg, #00A0FF 0%, #3AB7FF 100%);
}
	<?php } else { ?>
.background {
background:none transparent;
}
	<?php } ?>
</style>
    		<title><?=$SiteName?><?php if ($cur_dir2) { echo(' - ' . $cur_dir2); }?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=0.7, user-scalable=no">
		<meta name="author" content="3DNS inc.">
	
		<link rel="stylesheet" type="text/css" href="<?=$URL?>/assets/css/foundation.min.css"/>
    	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css"/>
		<link rel="stylesheet" type="text/css" href="<?=$URL?>/assets/css/app.css"/>

   		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    		<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.1/clipboard.min.js"></script>
			<script type="text/javascript" src="<?=$URL?>/assets/js/foundation.min.js"></script>
			<script type="text/javascript" src="<?=$URL?>/assets/js/amplitude.min.js"></script>
  			<script type="text/javascript" src="<?=$URL?>/assets/js/functions.js"></script>

	</head>