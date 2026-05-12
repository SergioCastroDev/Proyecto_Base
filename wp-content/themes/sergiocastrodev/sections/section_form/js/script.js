document.addEventListener("DOMContentLoaded", () => {
    user_vs_bots();
});


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