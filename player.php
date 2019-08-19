<?php
require "includes/autoload.php";
// include getID3() library (can be in a different directory if full path is specified)
require_once('getID3/getid3/getid3.php');

// Initialize getID3 engine
$getID3 = new getID3;

$head = "includes/head_player.php";
$folder = $_GET["folder"];
$id = $_GET["id"];
$background = $_GET["trans"];

$i = 0;
$counts = array();

if(isset($_GET['isLive'])) {
$isLive = $_GET["isLive"];
}
if(isset($_GET['url'])) {
$LiveURL = $_GET["url"];
}
if(isset($_GET['search'])) {
$search = $_GET["search"];
} 
if(isset($_GET['globalsearch'])) {
$GlobalSearch = $_GET["globalsearch"];
} 
if(!isset($URLRewrite)) {
$URLRewrite = $URL;
}

$AudioDir = $folderLocation . $folder;
$cur_dir = basename(dirname(__FILE__));
$CurrentURL = "http://$URLRewrite$folder/";
if ($search) {
	$cur_dir2 = basename("Suche." . $search);
	$globVar = "$AudioDir/*$search*.{[mM][pP]3,[wW][aA][vV],[fF][lL][aA][cC]}";
} elseif ($GlobalSearch) {
	$GlobalPath = realpath("$AudioDir/").'/{**/*,*}';
	$globVar = "$GlobalPath/*.{[mM][pP]3,[wW][aA][vV],[fF][lL][aA][cC]}";
} else { 
	$cur_dir2 = basename($folder);
	$globVar = "$AudioDir/*.{[mM][pP]3,[wW][aA][vV],[fF][lL][aA][cC]}";
}
foreach(glob("$AudioDir/*.{[mM][pP]3,[wW][aA][vV],[fF][lL][aA][cC]}") as $file);
$musicStuff = glob($globVar, GLOB_BRACE);
if (!$FolderCheck == TRUE) { 
} elseif (!$musicStuff) { 
include $head;
echo('<body id="top" class="blue"><center><div class="col s6"><br><br><br><br><a class="btn-large red">Keine Lieder in diesem Ordner gefunden!</a></center></div>');
header('Refresh:3; url=' . $URLRewrite . '/');
exit(); 
}

if(isset($_GET['track'])) {
$getTrack = $_GET["track"];
foreach($musicStuff as $music) { 
	if (!isset($counts[$item['number']])) {
		$counts[$item['number']] = 0;
}
	$number = $counts[$music['number']]++;
		$musicBasenamed  = basename($music);
		if (!$number) { 
			$number = 0;
		}

	if($getTrack == $number) {
	header("Content-disposition: attachment; filename=$musicBasenamed");
	header('Content-type: audio/mpeg');
    header("Pragma: no-cache");  
	header("Expires: 0");  
	header('Content-Transfer-Encoding: binary');
	header("Accept-Ranges: bytes");
	header('Content-Length: '.filesize($music));
	ob_end_flush();
	@readfile($music);
	exit;
}
}
}


if (isset($_POST["action"])) {
	$action = strtolower($_POST["action"]);

	if ($action == "zip") {
	$tmp_file = "tmp/$cur_dir2.zip";
	if (!file_exists($tmp_file) or $search) {
	$zip = new ZipArchive();
	$res = $zip->open($tmp_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);
if ($res === TRUE) {
	$zip->setCompressionIndex(0, ZipArchive::CM_STORE);
    foreach($musicStuff as $file) {
        $zip->addFile($file, basename($file));
    }
	$zip->close();
}
}
if (file_exists($tmp_file)) {
	header("Content-disposition: attachment; filename=$cur_dir2.zip");
	header('Content-type: application/zip');
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Pragma: public");
	header("Expires: 0");
	header('Cache-Control: public');
	header("Content-Transfer-Encoding: binary");
	ob_end_flush();
	@readfile($tmp_file);
	exit;
	}
}
}
?>
<!DOCTYPE html>
<html>
<?php include $head; ?>
<body class="background">
		<div class="grid-x" id="blue-playlist-container">
			<div class="large-10 medium-12 small-11 large-centered medium-centered small-centered cell" id="amplitude-player">
				<div class="grid-x">
				  <div class="large-6 medium-6 small-12 cell" id="amplitude-left">
				    <img width="100%" data-amplitude-song-info="cover_art_url"/>
				    <div id="player-left-bottom">
				<?php if ($isLive == FALSE) { ?>
				      <div id="time-container">
				        <span class="current-time">
				          <span class="amplitude-current-minutes" ></span>:<span class="amplitude-current-seconds"></span>
				        </span>
				        <div id="progress-container">
						<?php if ($Waveforms == TRUE) { ?>
						<div class="amplitude-wave-form"></div>
						<?php } ?>
						<div>
							<input type="range" class="amplitude-song-slider"/>
				          <progress id="song-played-progress" class="amplitude-song-played-progress"></progress>
				          <progress id="song-buffered-progress" class="amplitude-buffered-progress" value="0"></progress>
						</div>
						</div>
				        <span class="duration">
				          <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
				        </span>
				      </div>
						<?php } ?>

				      <div id="control-container">
				        <div id="repeat-container">
				<?php if ($isLive == FALSE) { ?>
				          <div class="amplitude-repeat" id="repeat"></div>
				          <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle"></div>
						<?php } ?>
				        </div>
				        <div id="central-control-container">
				          <div id="central-controls">
				<?php if ($isLive == FALSE) { ?>
				            <div class="amplitude-prev" id="previous"></div>
				            <div class="amplitude-play-pause" id="play-pause"></div>
				            <div class="amplitude-next" id="next"></div>
						<?php } else { ?>
				            <div style="margin-left: 30px" class="amplitude-play-pause" amplitude-main-play-pause="true" id="play-pause"></div>
						<?php } ?>
				          </div>
				        </div>

				        <div id="volume-container">
				          <div class="volume-controls">
				            <div class="amplitude-mute amplitude-not-muted"></div>
				            <input type="range" class="amplitude-volume-slider"/>
				            <div class="ms-range-fix"></div>
				          </div>
				<?php if ($isLive == FALSE) { ?>
				          <div class="amplitude-shuffle amplitude-shuffle-off" id="shuffle-right"></div>
						<?php } ?>
				        </div>
				      </div>

				      <div id="meta-container">
				<?php if ($isLive == FALSE) { ?>
				        <span data-amplitude-song-info="name" class="song-name"></span>
						<?php } else { ?>
				        <span id="Title" class="song-name"></span>
						<?php } ?>
				        <div class="song-artist-album">
				<?php if ($isLive == FALSE) { ?>
				          <span data-amplitude-song-info="artist"></span>
						<?php } else { ?>
				          <span id="Listener">0</span>
						<?php } ?>
				          <span data-amplitude-song-info="album"></span>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="large-6 medium-6 small-12 cell" id="amplitude-right">
				  <?php if ($SearchBar == TRUE) { ?>
				  <div class="input-field col s12 m12">
				  <form id="search_form" onsubmit="return false">
				  <input type="text" value="<?= $search ?>" id="search" placeholder="Suche...">
				  </div>
				  </form>
				  <?php } ?>
    	<?php
	if ($isLive == FALSE) { 

		foreach($musicStuff as $music) { 
		$Titel = explode("/", $music);
		$Titel = $Titel[sizeof($Titel)-1];

		$search = array('.mp3', '.wav', '.flac');
		$replace = array('', '', '');
		$str = str_replace($search, $replace, $Titel);
		$parts = explode(' - ', $str, 2);
		$Title = substr($parts[1], 0);
 
    	if (!isset($counts[$item['number']])) {
        	$counts[$item['number']] = 0;
	}
		$number = $counts[$music['number']]++;
		if (!$number) { 
			$number = 0;
		}
	?>
				    <div id="track" class="song amplitude-song-container amplitude-play-pause" data-amplitude-song-index="<?= $number ?>">
				      <div class="song-now-playing-icon-container">
				        <div class="play-button-container">
				        </div>
				        <img class="now-playing" src="<?=$URL?>/assets/img/now-playing.svg"/>
				      </div>
				      <div id="song-meta-data" class="song-meta-data">
				        <span class="song-title"><?= $Title ?></span>
				        <span class="song-artist"><?= $parts[0] ?></span>
				      </div>
				      <span class="song-duration">
					<?php if ($number) { echo $number; } else { echo "0";} ?></span>
				<?php if ($DownloadButton == TRUE) { ?>
					<form method="post">
				      <a href="?track=<?= $number ?>" download class="download-link" >
				        <img class="download" src="<?=$URL?>/assets/img/download-solid.svg"/>
				        <img class="download-white" src="<?=$URL?>/assets/img/download.svg"/>
				      </a>
					  </form>
		<?php } ?>
				<?php if ($ShareButton == TRUE) { ?>
				      <a data-clipboard-action="copy" data-clipboard-text="<?php if ($number) { echo $URLRewrite . $folder . "/" . $number; } else { echo "/0";} ?>" onclick="Materialize.toast('Link zum Track kopiert!', 4000)" class="copy download-link">
				        <img class="share" src="<?=$URL?>/assets/img/share-solid.svg"/>
				        <img class="share-white" src="<?=$URL?>/assets/img/share.svg"/>
				      </a>
		<?php } ?>
				    </div>
		<?php } ?>
		<?php } ?>
		<?php if ($ZipPlaylist == TRUE) { ?>
					<form method="post">
						<br><center><button class="btn blue" type="submit" name="action" value="zip"><i class="far fa-file-archive"></i> Playlist als ZIP downloaden</button></center>
						<br>
					</form>
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
	  waveforms: {
      sample_rate: 3000
      },
	
			"songs": [
	<?php
if ($isLive == FALSE) {
	$counts = array();
	foreach($musicStuff as $music) {
		
		$Titel = explode("/", $music);
		$Titel = $Titel[sizeof($Titel)-1];

		$search4Titel = array('.mp3', '.wav', '.flac');
		$replace4Titel = array('', '', '');
		$search4Track = array('%', '#',' ');
		$replace4Track = array('%25', '%23','%20');
		$Titel = str_replace($search4Titel, $replace4Titel, $Titel);
		$Track = str_replace($search4Track, $replace4Track, $music);
		$parts = explode(' - ', $Titel, 2);
		$tags = $getID3->analyze($music);
		if ($parts[1]) {
			$CoverName = $parts[1];
		} else {
			$CoverName = $parts[0];
		}
		$searchCoverName = array('%', '#',' ');
		$replaceCoverName = array('', '','');
		$CoverName = str_replace($searchCoverName, $replaceCoverName, $CoverName);
		$CoverFile = './cover/' . $CoverName . '.jpg';

	if (file_exists($CoverFile)) {
		$coverArt = $URL . "/" . $CoverFile;
	} else {
		if (isset($tags['comments']['picture']['0']['data'])) {
			$image = $tags['comments']['picture']['0']['data'];
			if(file_put_contents($CoverFile, $image)) {
			}
		}
		$coverArt = $URL . "/assets/img/logo.jpg";
	}
	if (!isset($counts[$item['number']])) {
		$counts[$item['number']] = 0;
	}
	$number = $counts[$music['number']]++;
	if (!$number) { 
		$number = 0;
	}
	?> 
				{
					"name": "<?= $parts[1] ?>",
					"artist": "<?= $parts[0] ?>",
					"url": "?track=<?= $number ?>",
					"cover_art_url": "<?= $coverArt ?>",
				},
			<?php } ?>

			],
		"default_album_art": "<?= $coverArt ?>",
    	"soundcloud_client": "",
   	 	"soundcloud_use_art": false,
		debug: false,
		"autoplay": false,
		<?php if ($id) { ?>
		"start_song": "<?= $id ?>"
		<?php } else {?>
		"start_song": "0"
		<?php } 

		} else { 
		$coverArt = $URL . "/assets/img/logo.jpg";

?>
				{
					"url": "<?= $LiveURL ?>",
					"cover_art_url": "<?= $coverArt ?>",
					"live": true,
				},
],
		"default_album_art": "<?= $coverArt ?>",
		"autoplay": true,
		"start_song": "0"
			<?php } ?>
		});

	</script>
    <script>
$(document).ready(function(){
	    new ClipboardJS('.copy');
		$('#search').keypress(function(e){
        if(e.which == 13){
  var searchitem = document.getElementById("search");
  var url = "?search=" + searchitem.value;
  window.open(url,"_self"); 
}
  });
<?php 
if(!preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|iphone|ipad|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) { ?>
   $("#amplitude-right").niceScroll({styler:"fb",cursorcolor:"#00A0FF", cursorwidth: '6', cursorborderradius: '10px', hwacceleration: true, spacebarenabled:false,  cursorborder: ''});
<?php } ?>
});
    </script>

<?php if ($isLive == TRUE) { ?>
<script type="text/javascript">
$(document).ready(function() {
 setTimeout(refreshTitle, 1000);
 setTimeout(refreshListener, 1000);
});

function refreshTitle() {
 $.ajax({ url: "<?=$URL?>/loads/getTrack.php" }).done(function (data) {
  $("#Title").html(data);
 }).always(function () {
  setTimeout(refreshTitle, 4 * 1000);
 });
}
function refreshListener() {
 $.ajax({ url: "<?=$URL?>/loads/getListener.php" }).done(function (data) {
  $("#Listener").html('Hörer: ' + data);
 }).always(function () {
  setTimeout(refreshListener, 4 * 1000);
 });
}
</script>
	<?php } ?>
	</body>
</html>
<?php exit; ?>

