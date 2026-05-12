var ecode_event_load = new Event( 'ecode_load' );

window.addEventListener( 'load',function( event ) {

	window.dispatchEvent( ecode_event_load );

},false );

/******************************************************************************/
/*****                     Functions get scroll page                      *****/
/******************************************************************************/
function scrollTop() {

   return filterResults (
       window.pageYOffset ? window.pageYOffset : 0,
       document.documentElement ? document.documentElement.scrollTop : 0,
       document.body ? document.body.scrollTop : 0
   );

}

function filterResults(n_win, n_docel, n_body) {

   var n_result = n_win ? n_win : 0;
   if (n_docel && (!n_result || (n_result > n_docel)))
       n_result = n_docel;
   return n_body && (!n_result || (n_result > n_body)) ? n_body : n_result;

}

function getOffsetTop( elem ) {

    var offsetTop = 0;

    do {

      if ( !isNaN( elem.offsetTop ) ) {

          offsetTop += elem.offsetTop;

      }

    } while ( elem = elem.offsetParent );

    return offsetTop;

}

/******************************************************************************/
/*****                          Polyfill scroll                           *****/
/******************************************************************************/
!function(){"use strict";function o(){var o=window,t=document;if(!("scrollBehavior"in t.documentElement.style&&!0!==o.__forceSmoothScrollPolyfill__)){var l,e=o.HTMLElement||o.Element,r=468,i={scroll:o.scroll||o.scrollTo,scrollBy:o.scrollBy,elementScroll:e.prototype.scroll||n,scrollIntoView:e.prototype.scrollIntoView},s=o.performance&&o.performance.now?o.performance.now.bind(o.performance):Date.now,c=(l=o.navigator.userAgent,new RegExp(["MSIE ","Trident/","Edge/"].join("|")).test(l)?1:0);o.scroll=o.scrollTo=function(){void 0!==arguments[0]&&(!0!==f(arguments[0])?h.call(o,t.body,void 0!==arguments[0].left?~~arguments[0].left:o.scrollX||o.pageXOffset,void 0!==arguments[0].top?~~arguments[0].top:o.scrollY||o.pageYOffset):i.scroll.call(o,void 0!==arguments[0].left?arguments[0].left:"object"!=typeof arguments[0]?arguments[0]:o.scrollX||o.pageXOffset,void 0!==arguments[0].top?arguments[0].top:void 0!==arguments[1]?arguments[1]:o.scrollY||o.pageYOffset))},o.scrollBy=function(){void 0!==arguments[0]&&(f(arguments[0])?i.scrollBy.call(o,void 0!==arguments[0].left?arguments[0].left:"object"!=typeof arguments[0]?arguments[0]:0,void 0!==arguments[0].top?arguments[0].top:void 0!==arguments[1]?arguments[1]:0):h.call(o,t.body,~~arguments[0].left+(o.scrollX||o.pageXOffset),~~arguments[0].top+(o.scrollY||o.pageYOffset)))},e.prototype.scroll=e.prototype.scrollTo=function(){if(void 0!==arguments[0])if(!0!==f(arguments[0])){var o=arguments[0].left,t=arguments[0].top;h.call(this,this,void 0===o?this.scrollLeft:~~o,void 0===t?this.scrollTop:~~t)}else{if("number"==typeof arguments[0]&&void 0===arguments[1])throw new SyntaxError("Value could not be converted");i.elementScroll.call(this,void 0!==arguments[0].left?~~arguments[0].left:"object"!=typeof arguments[0]?~~arguments[0]:this.scrollLeft,void 0!==arguments[0].top?~~arguments[0].top:void 0!==arguments[1]?~~arguments[1]:this.scrollTop)}},e.prototype.scrollBy=function(){void 0!==arguments[0]&&(!0!==f(arguments[0])?this.scroll({left:~~arguments[0].left+this.scrollLeft,top:~~arguments[0].top+this.scrollTop,behavior:arguments[0].behavior}):i.elementScroll.call(this,void 0!==arguments[0].left?~~arguments[0].left+this.scrollLeft:~~arguments[0]+this.scrollLeft,void 0!==arguments[0].top?~~arguments[0].top+this.scrollTop:~~arguments[1]+this.scrollTop))},e.prototype.scrollIntoView=function(){if(!0!==f(arguments[0])){var l=function(o){for(;o!==t.body&&!1===(e=p(l=o,"Y")&&a(l,"Y"),r=p(l,"X")&&a(l,"X"),e||r);)o=o.parentNode||o.host;var l,e,r;return o}(this),e=l.getBoundingClientRect(),r=this.getBoundingClientRect();l!==t.body?(h.call(this,l,l.scrollLeft+r.left-e.left,l.scrollTop+r.top-e.top),"fixed"!==o.getComputedStyle(l).position&&o.scrollBy({left:e.left,top:e.top,behavior:"smooth"})):o.scrollBy({left:r.left,top:r.top,behavior:"smooth"})}else i.scrollIntoView.call(this,void 0===arguments[0]||arguments[0])}}function n(o,t){this.scrollLeft=o,this.scrollTop=t}function f(o){if(null===o||"object"!=typeof o||void 0===o.behavior||"auto"===o.behavior||"instant"===o.behavior)return!0;if("object"==typeof o&&"smooth"===o.behavior)return!1;throw new TypeError("behavior member of ScrollOptions "+o.behavior+" is not a valid value for enumeration ScrollBehavior.")}function p(o,t){return"Y"===t?o.clientHeight+c<o.scrollHeight:"X"===t?o.clientWidth+c<o.scrollWidth:void 0}function a(t,l){var e=o.getComputedStyle(t,null)["overflow"+l];return"auto"===e||"scroll"===e}function d(t){var l,e,i,c,n=(s()-t.startTime)/r;c=n=n>1?1:n,l=.5*(1-Math.cos(Math.PI*c)),e=t.startX+(t.x-t.startX)*l,i=t.startY+(t.y-t.startY)*l,t.method.call(t.scrollable,e,i),e===t.x&&i===t.y||o.requestAnimationFrame(d.bind(o,t))}function h(l,e,r){var c,f,p,a,h=s();l===t.body?(c=o,f=o.scrollX||o.pageXOffset,p=o.scrollY||o.pageYOffset,a=i.scroll):(c=l,f=l.scrollLeft,p=l.scrollTop,a=n),d({scrollable:c,method:a,startTime:h,startX:f,startY:p,x:e,y:r})}}"object"==typeof exports&&"undefined"!=typeof module?module.exports={polyfill:o}:o()}();

/******************************************************************************/
/*****                       General scripts                        *****/
/******************************************************************************/
window.addEventListener( 'ecode_load', function ( event ) {

	if ( document.getElementsByClassName( 'ecode_false_link' ).length != 0 ) {

        add_events_ecode_false_link();

    }

	if ( document.getElementsByClassName( 'ecode_shortcode_video' ).length != 0 ) {

        add_events_ecode_shortcode_video();

    }

	if ( document.getElementsByClassName( 'ecode_sc_faq_title' ).length != 0 ) {

        add_events_ecode_shortcode_faq();

    }


	if ( document.getElementsByClassName( 'ecode_image_video' ).length != 0 ) {

		add_events_ecode_video();

    }

	if ( document.getElementsByClassName( 'ecode_sc_accordion_title' ).length != 0 ) {

		array_sc_accordion_title = document.getElementsByClassName( 'ecode_sc_accordion_title' );

		for ( let i = 0; i < array_sc_accordion_title.length; i++ ) {

			array_sc_accordion_title[i].onclick = function() {

				if ( this.classList.contains( 'ecode_sc_accordion_title_open' ) ) {

					this.classList.remove( 'ecode_sc_accordion_title_open' );
					this.nextElementSibling.classList.remove( 'ecode_sc_accordion_content_open' );
	
				} else {
	
					this.classList.add( 'ecode_sc_accordion_title_open' );
					this.nextElementSibling.classList.add( 'ecode_sc_accordion_content_open' );
	
				}	
	
			}

		}

	}

	if ( document.getElementsByClassName( 'ecode_sc_tabs' ).length != 0 ) {

		array_sc_tabs = document.getElementsByClassName( 'ecode_sc_tabs' );

		for ( let i = 0; i < array_sc_tabs.length; i++ ) {

			array_sc_title = array_sc_tabs[i].querySelectorAll( '.ecode_sc_tabs_title' );

			if ( array_sc_title.length != 0 ) {

				list_titles = '';

				for ( let j = 0; j < array_sc_title.length; j++ ) {

					array_sc_title[j].onclick = function() {

						if ( this.classList.contains( 'ecode_sc_tabs_title_open_mobile' ) ) {
		
							this.classList.remove( 'ecode_sc_tabs_title_open_mobile' );
							this.nextElementSibling.classList.remove( 'ecode_sc_tabs_content_open_mobile' );
			
						} else {
			
							this.classList.add( 'ecode_sc_tabs_title_open_mobile' );
							this.nextElementSibling.classList.add( 'ecode_sc_tabs_content_open_mobile' );
			
						}	
			
					}

					sc_title = j == 0 ? 'ecode_sc_tabs_titles_open' : '';

					array_sc_title[j].setAttribute( 'data-count', j );

					list_titles += '<p class="' + sc_title + '" data-count="' + j + '">' + array_sc_title[j].innerHTML + '</p>';
					
				}

				sc_tabs_titles = array_sc_tabs[i].getElementsByClassName( 'ecode_sc_tabs_titles' )[0];

				sc_tabs_titles.innerHTML = list_titles;

				array_sc_titles = sc_tabs_titles.querySelectorAll( 'p' );

				for ( let k = 0; k < array_sc_titles.length; k++ ) {

					array_sc_titles[k].onclick = function() {

						data_count = parseInt( this.getAttribute( 'data-count' ) );
						parent = this.closest( '.ecode_sc_tabs' );
						array_content = parent.querySelectorAll( '.ecode_sc_tabs_content' );
						array_titles = parent.querySelectorAll( '.ecode_sc_tabs_titles p' );

						for ( let m = 0; m < array_titles.length; m++ ) {
							
							array_titles[m].classList.remove( 'ecode_sc_tabs_titles_open' );
							
						}

						this.classList.add( 'ecode_sc_tabs_titles_open' );

						

						for (let l = 0; l < array_content.length; l++) {
							
							array_content[l].classList.remove( 'ecode_sc_tabs_content_open' );
							array_content[l].classList.add( 'ecode_sc_tabs_content_hide' );

						}

						array_content[data_count].classList.add( 'ecode_sc_tabs_content_open' );
						array_content[data_count].classList.remove( 'ecode_sc_tabs_content_hide' );

					}
					
				}

			}
			
		}

	}

	if ( document.querySelectorAll( '.ecode_shortcode_button a' ).length != 0 ) {

		const array_shortcode_button = document.querySelectorAll( '.ecode_shortcode_button a' );

		for ( let i = 0; i < array_shortcode_button.length; i++ ) {

			array_shortcode_button[i].onclick = function() {

				let page_section_parent = this.parentElement;
				let page_section_id = '';
				const text_button = this.innerHTML.replace( /(<([^>]+)>)/ig, '').trim();
				const url_button = this.getAttribute('href');

				while ( page_section_parent ) {

					if ( page_section_parent.id && page_section_parent.id.startsWith( 'page_section_' ) ) {

						page_section_id = page_section_parent.id;
						break;

					}

					page_section_parent = page_section_parent.parentElement;

				}

				const array_page_sections = document.querySelectorAll('[id^="page_section_"]');
				let array_page_sections_ids = [];

				for ( let j = 0; j < array_page_sections.length; j++) { array_page_sections_ids.push( array_page_sections[j].id ) }
				const position = array_page_sections_ids.indexOf( page_section_id ) + 1;

				if ( window.gtag ) {

					gtag( 'event', 'CTA', {
						'event_category': 'CTA',
						'block_position': position,
						'anchor_text': text_button,
						'anchor_url': url_button,
						'non_interaction': true
					});

				}

				if ( window.plausible ) {

					if ( text_button == 'Comprar' ) {

						plausible( 'CTA Comprar curso', { props: { button_text: text_button, button_anchor: url_button, block_position: position }} );

					} else {

						plausible( 'CTA', { props: { button_text: text_button, button_anchor: url_button, block_position: position }} );

					}

				}

			}
			
		}

	}

	if ( document.getElementsByClassName( 'ecode_sc_hide_content_dropdown' ).length != 0 ) {

		const array_dropdown_hide_content = document.getElementsByClassName( 'ecode_sc_hide_content_dropdown' );

		for ( let i = 0; i < array_dropdown_hide_content.length; i++ ) {

			array_dropdown_hide_content[i].onclick = function() {

				if ( this.previousElementSibling.classList.contains( 'ecode_sc_hide_content_content' ) ) {

					this.previousElementSibling.classList.remove( 'ecode_sc_hide_content_content' );

					this.remove();

				}

			}
			
		}

	}
	if ( document.getElementsByClassName( 'ecode_container_content' ).length != 0 ) {

		initialize_slider_shortcode_reviews_maisa();
		initialize_slider_shortcode_cards_maisa();
	}

	/******************************************************************************/
    /*****                            Ecode VS Bots                           *****/
    /******************************************************************************/
	ecoded_vs_bots();

}, false );

/******************************************************************************/
/*****                           Ecode VS Bots                            *****/
/******************************************************************************/

function user_vs_bots() {

	const user_hidden_bot = document.querySelectorAll( 'input[type="hidden"][name="user_vs_bots"]' );

	if ( user_hidden_bot.length != 0 ) {

		for ( let i = 0; i < user_hidden_bot.length; i++ ) {

			const user_form = user_hidden_bot[i].closest( 'form' );

			if ( user_form ) {

				const user_form_fields = user_form.querySelectorAll( 'input, textarea, select' );

				if ( user_form_fields.length != 0 ) {

					for ( let j = 0; j < user_form_fields.length; j++ ) {

						user_form_fields[j].onfocus = function() {

							const user_field_parent = this.closest( 'form' );

							if ( user_field_parent ) {

								const user_field_hidden_bot = user_field_parent.querySelector( 'input[type="hidden"][name="user_vs_bots"]' );

								if ( user_field_hidden_bot ) { user_field_hidden_bot.value = 'user_1_bots_0'; }

							}

						}
						
					}

				}

			}
			
		}

	}

}

/******************************************************************************/
/*****                     Add events shortcode FAQ                       *****/
/******************************************************************************/

function add_events_ecode_shortcode_faq() {

	array_faq_titles = document.getElementsByClassName( 'ecode_sc_faq_title' );

	for ( let i = 0; i < array_faq_titles.length; i++ ) {

		const element = array_faq_titles[i];

		element.onclick = function() {

			const parent = this.closest( 'article' );

			if ( parent.classList.contains( 'ecode_sc_faq_open' ) ) {

				parent.classList.remove( 'ecode_sc_faq_open' );

			} else {

				parent.classList.add( 'ecode_sc_faq_open' );

			}

		}
		
	}

}

/******************************************************************************/
/*****                       Add events false link                        *****/
/******************************************************************************/
function add_events_ecode_false_link() {

	array_ecode_false_link = document.getElementsByClassName( 'ecode_false_link' );

	for ( var i = 0; i < array_ecode_false_link.length; i++ ) {

		array_ecode_false_link[i].onclick = function() {

			parent = this.parentElement;

			data_link = this.getAttribute( 'data-link' );
			data_parent = this.getAttribute( 'data-parent' );
			data_close = this.getAttribute( 'data-close' );

			if ( data_close && data_close != '' ) {

				const element_close = this.closest( data_close );

				if ( element_close && element_close.querySelector( data_link + ' a' ) ) {

					element_close.querySelector( data_link + ' a' ).click();

				}

			} else {

				if ( data_parent == '0' ) {

					if ( data_link == 'h3' && this.querySelectorAll( 'h3 a' ).length != 0 ) {
	
						this.querySelectorAll( 'h3 a' )[0].click();
		
					}
	
					if ( data_link == 'p' && parent.querySelectorAll( 'p a' ).length != 0 ) {
	
						parent.querySelectorAll( 'p a' )[0].click();
		
					}
	
				} else {
	
					if ( data_link == 'h2' && parent.querySelectorAll( 'h2 a' ).length != 0 ) {
	
						parent.querySelectorAll( 'h2 a' )[0].click();
	
					}
	
					if ( data_link == 'h2_parent' && parent.parentElement.querySelectorAll( 'h2 a' ).length != 0 ) {
	
						parent.parentElement.querySelectorAll( 'h2 a' )[0].click();
	
					}
	
					if ( data_link == 'h3' && parent.querySelectorAll( 'h3 a' ).length != 0 ) {
	
						parent.querySelectorAll( 'h3 a' )[0].click();
	
					}
	
					if ( data_link == 'h3_parent' && parent.parentElement.querySelectorAll( 'h3 a' ).length != 0 ) {
	
						parent.parentElement.querySelectorAll( 'h3 a' )[0].click();
	
					}
	
					if ( data_link == 'p' && parent.parentElement.querySelectorAll( 'p a' ).length != 0 ) {
	
						parent.parentElement.querySelectorAll( 'p a' )[0].click();
	
					}
	
				}

			}

		}

	}

}

/******************************************************************************/
/*****                     Add events shortcode video                     *****/
/******************************************************************************/

function add_events_ecode_shortcode_video() {

	array_ecode_shortcode_video = document.getElementsByClassName( 'ecode_shortcode_video' );

	for ( var i = 0; i < array_ecode_shortcode_video.length; i++ ) {

		array_ecode_shortcode_video[i].addEventListener( 'click', ecode_video_html );

	}

}

function add_events_ecode_video() {

	array_ecode_image_video = document.getElementsByClassName( 'ecode_image_video' );

	for ( var i = 0; i < array_ecode_image_video.length; i++ ) {

		array_ecode_image_video[i].addEventListener( 'click', ecode_video_html );

	}

}

function ecode_video_html() {

	container_video = this;
	const video_id = container_video.getAttribute( 'data-id-video' );
	const video_type = container_video.getAttribute( 'data-type-video' );
	const video_controls = container_video.getAttribute( 'data-controls' );

	// Tracking data
	let page_section_parent = container_video.parentElement;
	let page_section_id = '';

	while ( page_section_parent ) {

		if ( page_section_parent.id && page_section_parent.id.startsWith( 'page_section_' ) ) {

			page_section_id = page_section_parent.id;
			break;

		}

		page_section_parent = page_section_parent.parentElement;

	}

	const array_page_sections = document.querySelectorAll('[id^="page_section_"]');
	let array_page_sections_ids = [];

	for ( let j = 0; j < array_page_sections.length; j++) { array_page_sections_ids.push( array_page_sections[j].id ) }
	const position = array_page_sections_ids.indexOf( page_section_id ) + 1;

	if ( window.gtag ) {

		gtag( 'event', 'video', {
			'event_category': 'video',
			'block_position': position,
			'video_id': video_id,
			'video_player': video_type,
			'non_interaction': true
		});

	}

	if ( window.plausible ) {

		plausible( 'Video', { props: { video_type: video_type, video_id: video_id, block_position: position }});

	}

	// Print iframe
	url_video = '';

	if ( video_type == 'vimeo' ) {

		url_video += 'https://player.vimeo.com/video/' + video_id;
		url_video += '?autoplay=1&muted=1';

		if ( video_controls == '0' ) {

			url_video += '&loop=1';
			url_video += '&title=0';
			url_video += '&byline=0';
			url_video += '&portrait=0';
			url_video += '&controls=0';
			url_video += '&transparent=0';

		}

	} else if ( video_type == 'youtube' ) {

		url_video += 'https://www.youtube.com/embed/' + video_id;
		url_video += '?autoplay=1&mute=1';

		if ( video_controls == '0' ) {

			url_video += '&controls=0';
			url_video += '&modestbranding=1';
			url_video += '&rel=0';
			url_video += '&iv_load_policy=3';
			url_video += '&fs=0';
			url_video += '&disablekb=1';
			url_video += '&loop=1';
			url_video += '&playlist=' + video_id;

		}

	} else if ( video_type == 'default' ) {

		url_video += video_id;
		url_video += '?autoplay=1&mute=1';

	}

	iframe = document.createElement( 'IFRAME' );

	iframe.setAttribute( 'src', url_video );
	iframe.setAttribute( 'frameborder', '0' );
	iframe.setAttribute( 'allow', 'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' );
	iframe.setAttribute( 'allowfullscreen', 'allowfullscreen' );
	// iframe.setAttribute( 'scrolling', 'no' );
	iframe.style.width = '600px';
	iframe.style.height = '400px';

	container_video.innerHTML = '';

	container_video.appendChild( iframe );

}

/******************************************************************************/
/*****                          Check visible                            *****/
/******************************************************************************/
function ecode_check_visible( element ) {

    var rect =  element.getBoundingClientRect();

    var view_height = Math.max( document.documentElement.clientHeight, window.innerHeight );

    return !( rect.bottom < 0 || rect.top - view_height >= -400 );

}

/******************************************************************************/
/*****                        Horizantal scroll                           *****/
/******************************************************************************/

function ecode_horizontal_scroll( element ) {

	let isDown = false;
	let startX;
	let scrollLeft;

	element.addEventListener( 'mousedown', ( e ) => {

		isDown = true;

		startX = e.pageX - element.offsetLeft;

		scrollLeft = element.scrollLeft;

	});

	element.addEventListener( 'mouseleave', () => {

		isDown = false;

	});

	element.addEventListener( 'mouseup', () => {

		isDown = false;

	});

	element.addEventListener( 'mousemove', ( e ) => {

		if ( !isDown ) return;

		e.preventDefault();

		const x = e.pageX - element.offsetLeft;

		const walk = ( x - startX ); //scroll-fast

		element.scrollLeft = scrollLeft - walk;

	});

}

/******************************************************************************/
/*****                               CWV                                  *****/
/******************************************************************************/
// // Función para enviar eventos de Core Web Vitals a GA4
// function send_web_vitals_event( name, value, id ) {

// 	value_parse = +parseFloat(value).toFixed( 2 );

// 	// console.log('name: ' + name);
// 	// console.log('value: ' + value_parse);
// 	// console.log('id: ' + id);
// 	// console.log(' ');

// 	if ( window.gtag ) {

// 		gtag('event', name, {
// 			'value': value_parse,
// 			'event_category': 'Web Vitals',
// 			'event_label': id,
// 			'non_interaction': true,
// 		});

// 	}

// }

// // Observar y registrar métricas de Core Web Vitals
// ( function observe_web_vitals() {

// 	// TTFB
// 	const ttfb = performance.timing.responseStart - performance.timing.navigationStart;
// 	send_web_vitals_event( 'TTFB', ttfb, 'TTFB' );

// 	// FCP
// 	new PerformanceObserver( ( entryList ) => {

// 		for ( const entry of entryList.getEntriesByName( 'first-contentful-paint' ) ) {

// 			send_web_vitals_event( 'FCP', entry.startTime, 'FCP' );

// 		}

// 	}).observe({ type: 'paint', buffered: true });

// 	// LCP
// 	new PerformanceObserver((entryList) => {

// 		const lastEntry = entryList.getEntries()[entryList.getEntries().length - 1];

// 		if ( lastEntry && lastEntry.element ) {

// 			label = lastEntry.element.tagName +  ( ( lastEntry.id && lastEntry.id != '' ) ? '#' + lastEntry.id : '' );

// 			send_web_vitals_event( 'LCP', lastEntry.renderTime || lastEntry.loadTime, label );

// 		}

// 	}).observe({ type: 'largest-contentful-paint', buffered: true });

// 	// CLS
// 	let clsValue = 0;

// 	new PerformanceObserver( ( entryList ) => {

// 		for ( const entry of entryList.getEntries() ) {

// 			if ( !entry.hadRecentInput)  { clsValue += entry.value; }

// 		}

// 		send_web_vitals_event( 'CLS', clsValue, 'CLS' );

// 	}).observe({ type: 'layout-shift', buffered: true });

// 	// FID
// 	new PerformanceObserver( ( entryList ) => {

// 		for ( const entry of entryList.getEntries()) {

// 			send_web_vitals_event( 'FID', entry.processingStart - entry.startTime, entry.id );

// 		}

// 	}).observe({ type: 'first-input', buffered: true });

// 	// INP (sin estándar)
// 	//   let largestInputDelayValue = 0;
// 	//   new PerformanceObserver((entryList) => {
// 	//     for (const entry of entryList.getEntries()) {
// 	//       const inputDelay = entry.processingStart - entry.startTime;
// 	//       if (inputDelay > largestInputDelayValue) {
// 	//         largestInputDelayValue = inputDelay;
// 	//         send_web_vitals_event('INP', largestInputDelayValue, 'INP');
// 	//       }
// 	//     }
// 	//   }).observe({ type: 'first-input', buffered: true });

// })();

/******************************************************************************/
/*****                          SLIDER REVIEWS MAISA                      *****/
/******************************************************************************/

//Funcion para inicializar el slider de reviews en maisa
let ecoded_shortcode_maisa_list_reviews = []
function initialize_slider_shortcode_reviews_maisa() {

	let array_sliders = document.querySelectorAll( '.ecode_container_content .ecoded_maisa_sc_reviews .ecoded_slider' );

	if ( array_sliders.length != 0 ) {

		for ( let i = 0; i < array_sliders.length; i++ ) {

			ecoded_shortcode_maisa_list_reviews[i] = new Splide( array_sliders[i],{
				type: 'loop',
				perMove: 1,
				pagination: true,
				arrows: false,
				clones: 3,
				focus: 'center',
			});

			ecoded_shortcode_maisa_list_reviews[i].mount();
			
		}

	}

}

/******************************************************************************/
/*****                        SLIDER TARJETAS MAISA                       *****/
/******************************************************************************/

//Funcion para inicializar el slider de reviews en maisa
let ecoded_shortcode_maisa_slider_cards = []
function initialize_slider_shortcode_cards_maisa() {

	let array_sliders = document.querySelectorAll( '.ecode_container_content .ecoded_maisa_sc_slidercards .ecoded_slider' );

	if ( array_sliders.length != 0 ) {

		for ( let i = 0; i < array_sliders.length; i++ ) {

			ecoded_shortcode_maisa_slider_cards[i] = new Splide( array_sliders[i],{
                arrows: false,
                pagination: false,
                type: 'slide',
                autoWidth: true,
                padding: { left: '20px', right: '20px' },
                perMove: 1,
                focus: 'left',
                mediaQuery: 'min',
                trimSpace: false,
                drag: true,
                rewind: true,
			});

			ecoded_shortcode_maisa_slider_cards[i].mount()

		}

	}

}