<?php
// Name der Seite
$SiteName = "Amplitude.js-PHP";

// Volle URL
$URL = "http://myWebsite.de";

// URL gekürzt siehe Rewrite NGINX / Apache
//$URLRewrite = "http://myWebsite.de/player";

// Pfad zur Musik (am besten relativen Pfad verwenden!)
$folderLocation = "./library";

// Download an/aus
$DownloadButton = True; 

// Sharing an/aus
$ShareButton = True;

// Warnung / Weiterleitung: Wenn keine Musik gefunden
$FolderCheck = True;  

// RadioStream
$isLive = false; 
$LiveURL = "https://myRadioStream.de"; // IceCast2 Stream Endpoint
$LiveStats = "https://myRadioStream.de:8000"; // IceCast2 Server URL
//$LiveName = "sdasd"; // Ersetzt den Title Namen mit einen Eigenen z.B. wenn man keine Stats hat vom Stream