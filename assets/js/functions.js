/*
	Initializes the player
*/
$(document).ready(function(){

	/*
		Initializes foundation for responsive design.
	*/
	$(document).foundation();

	/*
		Equalizes the player heights for left and right side of the player
	*/
	adjustPlayerHeights();

	/*
		When the window resizes, ensure the left and right side of the player
		are equal.
	*/
	$(window).on('resize', function(){
		adjustPlayerHeights();
	});

	/*
		When the bandcamp link is pressed, stop all propagation so AmplitudeJS doesn't
		play the song.
	*/
	$('.download-link').on('click', function( e ){
		e.stopPropagation();
	});

	/*
		Ensure that on mouseover, CSS styles don't get messed up for active songs.
	*/
	jQuery('.song').on('mouseover', function(){
		jQuery(this).css('background-color', '#00A0FF');
		jQuery(this).find('.song-meta-data .song-title').css('color', '#FFFFFF');
		jQuery(this).find('.song-meta-data .song-artist').css('color', '#FFFFFF');

		if( !jQuery(this).hasClass('amplitude-active-song-container') ){
			jQuery(this).find('.play-button-container').css('display', 'block');
		}

		jQuery(this).find('img.download').css('display', 'none');
		jQuery(this).find('img.download-white').css('display', 'block');
		jQuery(this).find('img.share').css('display', 'none');
		jQuery(this).find('img.share-white').css('display', 'block');
		jQuery(this).find('.song-duration').css('color', '#FFFFFF');
	});

	/*
		Ensure that on mouseout, CSS styles don't get messed up for active songs.
	*/
	jQuery('.song').on('mouseout', function(){
		jQuery(this).css('background-color', '#FFFFFF');
		jQuery(this).find('.song-meta-data .song-title').css('color', '#272726');
		jQuery(this).find('.song-meta-data .song-artist').css('color', '#607D8B');
		jQuery(this).find('.play-button-container').css('display', 'none');
		jQuery(this).find('img.download').css('display', 'block');
		jQuery(this).find('img.download-white').css('display', 'none');
		jQuery(this).find('img.share').css('display', 'block');
		jQuery(this).find('img.share-white').css('display', 'none');
		jQuery(this).find('.song-duration').css('color', '#607D8B');
	});

	/*
		Show and hide the play button container on the song when the song is clicked.
	*/
	jQuery('.song').on('click', function(){
		jQuery(this).find('.play-button-container').css('display', 'none');
	});
   $('.parallax').parallax();
   $('.scrollspy').scrollSpy();
   $('.collapsible').collapsible();
   $('.modal').modal();
   $('select').material_select();
   $('ul.tabs').tabs();
   $('#loader').addClass("hide-loader");
   $("#amplitude-right").niceScroll({styler:"fb",cursorcolor:"#00A0FF", cursorwidth: '6', cursorborderradius: '10px', hwacceleration: true, spacebarenabled:false,  cursorborder: ''});
   //$("body").niceScroll({styler:"fb",cursorcolor:"#00A0FF", cursorwidth: '6', cursorborderradius: '10px', background: '#404040', hwacceleration: true, spacebarenabled:false,  cursorborder: ''});  
});   
/*
	Adjusts the height of the left and right side of the players to be the same.
*/
function adjustPlayerHeights(){
	if( Foundation.MediaQuery.atLeast('medium') ) {
		var left = $('div#amplitude-left').width();
		var bottom = $('div#player-left-bottom').outerHeight();
		$('#amplitude-right').css('height', ( left + bottom )+'px');
	}else{
		$('#amplitude-right').css('height', 'initial');
	}
}
