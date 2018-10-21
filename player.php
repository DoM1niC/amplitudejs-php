<?php
require "includes/autoload.php";

$head = "includes/head_player.php";
$folder = $_GET["folder"];
$id = $_GET["id"];
$AudioDir = $folderLocation . $folder;
$cur_dir = basename(dirname(__FILE__));
$cur_dir2 = basename($folder);
$CurrentURL = "http://$URLRewrite$folder/";
foreach(glob($AudioDir .  "/"."*") as $file);
$musicStuff = glob($AudioDir . "/" . '*.{[mM][pP]3,[wW][aA][vV],[fF][lL][aA][cC]}', GLOB_BRACE);
if (!$musicStuff) { 
include $head;
echo('<body id="top" class="blue"><center><div class="col s6"><br><br><br><br><a class="btn-large red">Keine Lieder in diesem ordner gefunden!</a></center></div>');
header('Refresh:3; url=' . $URL);
exit(); 
}
?>
<!DOCTYPE html>
<html>
<?php include $head; ?>
	<body>
		<div class="grid-x" id="blue-playlist-container">
			<div class="large-10 medium-12 small-11 large-centered medium-centered small-centered cell" id="amplitude-player">
				<div class="grid-x">
				  <div class="large-6 medium-6 small-12 cell" id="amplitude-left">
				    <img amplitude-song-info="cover_art_url" amplitude-main-song-info="true"/>
				    <div id="player-left-bottom">
				      <div id="time-container">
				        <span class="current-time">
				          <span class="amplitude-current-minutes" amplitude-main-current-minutes="true"></span>:<span class="amplitude-current-seconds" amplitude-main-current-seconds="true"></span>
				        </span>
				        <div id="progress-container">
				          <input type="range" class="amplitude-song-slider" amplitude-main-song-slider="true"/>
				          <progress id="song-played-progress" class="amplitude-song-played-progress" amplitude-main-song-played-progress="true"></progress>
				          <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
				        </div>
				        <span class="duration">
				          <span class="amplitude-duration-minutes" amplitude-main-duration-minutes="true"></span>:<span class="amplitude-duration-seconds" amplitude-main-duration-seconds="true"></span>
				        </span>
				      </div>

				      <div id="control-container">
				        <div id="repeat-container">
				          <div class="amplitude-repeat" id="repeat"></div>
				          <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
				        </div>

				        <div id="central-control-container">
				          <div id="central-controls">
				            <div class="amplitude-prev" id="previous"></div>
				            <div class="amplitude-play-pause" amplitude-main-play-pause="true" id="play-pause"></div>
				            <div class="amplitude-next" id="next"></div>
				          </div>
				        </div>

				        <div id="volume-container">
				          <div class="volume-controls">
				            <div class="amplitude-mute amplitude-not-muted"></div>
				            <input type="range" class="amplitude-volume-slider"/>
				            <div class="ms-range-fix"></div>
				          </div>
				          <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle-right"></div>
				        </div>
				      </div>



				      <div id="meta-container">
				        <span amplitude-song-info="name" amplitude-main-song-info="true" class="song-name"></span>

				        <div class="song-artist-album">
				          <span amplitude-song-info="artist" amplitude-main-song-info="true"></span>
				          <span amplitude-song-info="album" amplitude-main-song-info="true"></span>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="large-6 medium-6 small-12 cell" id="amplitude-right">
    	<?php
		$i = 0;
		$counts = array();

		foreach($musicStuff as $music) { 

		$Titel = explode("/", $music);
		$Titel = $Titel[sizeof($Titel)-1];

		$search = array('.mp3', '.wav', '.flac');
		$replace = array('', '', '');
		$str = str_replace($search, $replace, $Titel);
		$parts = explode('-', $str);
		$Title = substr($parts[1], 0);

 
    	if (!isset($counts[$item['number']])) {
        	$counts[$item['number']] = 0;
    		} else {
	}

		$number = $counts[$music['number']]++;
	?>
				    <div class="song amplitude-song-container amplitude-play-pause" amplitude-song-index="<?php if ($number) { echo $number; } else { echo "0";} ?>">
				      <div class="song-now-playing-icon-container">
				        <div class="play-button-container">
				        </div>
				        <img class="now-playing" src="<?=$URL?>/assets/img/now-playing.svg"/>
				      </div>
				      <div class="song-meta-data">
				        <span class="song-title"><?= $Title ?></span>
				        <span class="song-artist"><?= $parts[0] ?></span>
				      </div>
				      <span class="song-duration">
					<?php if ($number) { echo $number; } else { echo "0";} ?></span>
				      <a href="<?=$URL?>/<?= $music ?>" download class="download-link" >
				        <img class="download" src="<?=$URL?>/assets/img/download-solid.svg"/>
				        <img class="download-white" src="<?=$URL?>/assets/img/download.svg"/>
				      </a>
				      <a data-clipboard-action="copy" data-clipboard-text="<?php if ($number) { echo $URLRewrite . $folder . "/" . $number; } else { echo "/0";} ?>" onclick="Materialize.toast('Link zum Track kopiert!', 4000)" class="copy download-link">
				        <img class="share" src="<?=$URL?>/assets/img/share-solid.svg"/>
				        <img class="share-white" src="<?=$URL?>/assets/img/share.svg"/>
				      </a>
				    </div>
		<?php } ?>

				  </div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		Amplitude.init({
      "bindings": {
        37: 'prev',
        39: 'next',
        32: 'play_pause'
      },
	
			"songs": [
	<?php

	foreach($musicStuff as $music) {
		$Titel = explode("/", $music);
		$Titel = $Titel[sizeof($Titel)-1];

		$search = array('.mp3', '.wav', '.flac', '');
		$replace = array('', '', '');
		$search2 = array('%', '#');
		$replace2 = array('%25', '%23');
		$str = str_replace($search, $replace, $Titel);
		$TrackURL = str_replace($search2, $replace2, $music);
		$parts = explode('-', $str);
		$CoverName = substr($parts[1], 1);
		$CoverFile = './cover/' . $CoverName . '.jpg';
	if (file_exists($CoverFile)) {
		$coverArt = $URL . "/" . $CoverFile;
	} else {
		$coverArt = $URL . "/assets/img/logo.jpg";
	}
	?> 
				{
					"name": "<?= $parts[1] ?>",
					"artist": "<?= $parts[0] ?>",
					"url": "<?=$URL?>/<?= $TrackURL ?>",
					"cover_art_url": "<?= $coverArt ?>",
				},
			<?php } ?>

			],
		"default_album_art": "<?= $coverArt ?>",
		"soundcloud_use_art": false,
		"soundclound_client": "",
		"autoplay": false,
		<?php if (isset($id)) { ?>
		"start_song": "<?= $id ?>"
		<?php } else {?>
		"start_song": "0"
		<?php }?>
		});

	</script>
    <script>
    new ClipboardJS('.copy');
    </script>
	</body>
</html>
