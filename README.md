<p align="center">
	<a href="https://521dimensions.com/open-source/amplitudejs" target="_blank">
		<img src="https://521dimensions.com/img/open-source/amplitudejs/AmplitudeLogo-WithSlogan.svg" width="600" alt="AmplitudeJS Logo">
	</a>
</p>

Amplitude.js is a lightweight JavaScript library that allows you to control the design of your media controls in your webpage -- not the browser. No dependencies (jQuery not required). Amplitude.js is available under the [MIT License](https://raw.githubusercontent.com/521dimensions/amplitudejs/master/LICENSE).

This Version is modified by me, the Player add automatic all Audiofiles in a Playlist, to listen your Songs directly.

## Demo
<p align="center">
	<a href="https://521dimensions.com/open-source/amplitudejs" target="_blank">
		<img src="https://521dimensions.com/img/open-source/amplitudejs/AmplitudeDemo.jpg" alt="MIT License" width="600">
	</a><br />
	Click the image above to go to the demo site or <a href="https://3dns.eu/music/" target="_blank">click here</a>.
</p>

## Features
* Completely independent library (no jQuery required)
* 100% customizable design of all player elements
* Available by CDN or single command install: `npm install --save amplitudejs`
* Multiple playlist support on single page
* Song meta data display
* Mobile Device Optimized
* Without Database just PHP
* Soundcloud integration
* Live streaming support
* Call back functions for events
	* Play/Pause
	* Stop
	* Next Song
	* Previous Song
	* Shuffle

## Browsers support

| <img src="https://raw.githubusercontent.com/godban/browsers-support-badges/master/src/images/edge.png" alt="IE / Edge" width="16px" height="16px" /></br>IE / Edge | <img src="https://raw.githubusercontent.com/godban/browsers-support-badges/master/src/images/firefox.png" alt="Firefox" width="16px" height="16px" /></br>Firefox | <img src="https://raw.githubusercontent.com/godban/browsers-support-badges/master/src/images/chrome.png" alt="Chrome" width="16px" height="16px" /></br>Chrome |
<img src="https://raw.githubusercontent.com/godban/browsers-support-badges/master/src/images/safari.png" alt="Safari" width="16px" height="16px" /></br>Safari | <img src="https://raw.githubusercontent.com/godban/browsers-support-badges/master/src/images/opera.png" alt="Opera" width="16px" height="16px" /></br>Opera |
| --------- | --------- | --------- | --------- | --------- |
| IE11, Edge| 4.0+| 3.5+| 4.0+| 10.5+|

## Installation
- Copy all Source on your Webserver with PHP (tested with 7.1)
- Open "includes/config.php" and setup the URLs
- All Songs will automatic read from "library" directory 
- Optional: Reconfigure your vhost with the Example Rewrite Settings (NGINX Webserver) 

### Other Libraries used
[Materialize](http://materializecss.com/), a CSS Framework based on material design

[clipboard.js](https://github.com/zenorocha/clipboard.js)

[jquery.nicescroll](https://github.com/inuyaksa/jquery.nicescroll)