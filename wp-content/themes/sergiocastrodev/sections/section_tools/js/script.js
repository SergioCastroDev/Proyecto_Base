document.addEventListener("DOMContentLoaded", function () {

	if ( document.getElementsByClassName( 'sergio_tools_slider' ).length != 0 ) {

		array_sliders_tools = document.getElementsByClassName( 'sergio_tools_slider' );

		for ( var i = 0; i < array_sliders_tools.length; i++ ) {

			initialize_flickity_slider_tools( array_sliders_tools[i] );

		}

	}

}, false );

function initialize_flickity_slider_tools( container_tools ) {

	const slider_tools = new Splide( container_tools, {
		arrows: true,
		pagination: false,
		drag: 'true',
		type: 'loop',
		autoWidth: true,
		clones: 40,
		autoScroll: {
			speed: 1,
		},
	});

	slider_tools.mount( window.splide.Extensions );

}
