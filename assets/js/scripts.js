;(function($) {

    $( '#cbxcf-form form' ).on( 'submit', function( e) {
        e.preventDefault();

        var data = $(this).serialize();

        $.post( cbxcfObj.ajaxurl, data, function( response ) {
            
            if ( response.success ) {
                $( '#feedback' ).addClass( 'success' );
                $( '#feedback' ).html( response.data.message + ' Count( ' + response.data.cbxcf_count + ' )' );
            } else {
                $( '#feedback' ).addClass( 'error' );
                $( '#feedback' ).html( response.data.message );
            }

            setTimeout( function(){

                $( '#feedback' ).html('');

                if( $( '#feedback' ).hasClass( 'success' ) ) {
                    $( '#feedback' ).removeClass( 'success' );
                }
                
                if( $( '#feedback' ).hasClass( 'error' ) ) {
                    $( '#feedback' ).removeClass( 'error' );
                }

            }, 1000 );

            $( '#cbxcf-form form' ).trigger("reset");
        })
        .fail( function() {
            $( '#feedback' ).addClass( 'error' );
            $( '#feedback' ).html( cbxcfObj.error );

            setTimeout( function(){

                $( '#feedback' ).html('');
                
                if( $( '#feedback' ).hasClass( 'error' ) ) {
                    $( '#feedback' ).removeClass( 'error' );
                }

            }, 1000 );

        } )

    });

})(jQuery);
