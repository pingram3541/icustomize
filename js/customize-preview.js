/* custom callbacks */
var $ = jQuery;

/* fix non url anchor tag clicks from causing a refresh */
if ( /\/customize\.php$/.test( window.location.pathname ) ) {
    wp.customize.bind( 'preview-ready', function() {
        var body = $( 'body' );
        body.off( 'click.preview' );
        body.on( 'click.preview', 'a[href]', function( event ) {
            var link = $( this );
            if ( /^(#|javascript:)/.test( link.attr( 'href' ) ) ) {
                return;
            }
            event.preventDefault();
            wp.customize.preview.send( 'scroll', 0 );
            wp.customize.preview.send( 'url', link.prop( 'href' ) );
        });
    } );
}

/* global wp, _iCustomizePreviewedQueriedObject */
( function( $, api ) {

	var self;

	self = {
		queriedPost: null
	};
	if ( 'undefined' !== typeof _iCustomizePreviewedQueriedObject ) {
		self.queriedPost = _iCustomizePreviewedQueriedObject;
	}

	/**
	 * Send the queried post object to the Customizer pane when ready.
	 */
	api.bind( 'preview-ready', function() {
		api.preview.bind( 'active', function() {
			api.preview.send( 'queried-post', self.queriedPost );
		} );
	} );

} )( jQuery, wp.customize );