document.addEventListener("DOMContentLoaded", function () {

	if ( document.getElementsByClassName( 'sergio_clients_slider' ).length != 0 ) {

		array_sliders_clients = document.getElementsByClassName( 'sergio_clients_slider' );

		for ( var i = 0; i < array_sliders_clients.length; i++ ) {

			initialize_flickity_slider_clients( array_sliders_clients[i] );

		}

	}

}, false );

function initialize_flickity_slider_clients( container_clients ) {

	const slider_clients = new Splide( container_clients, {
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

	slider_clients.mount( window.splide.Extensions );

}
