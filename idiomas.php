<span>

	<?php
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'qtranslate-x/qtranslate.php' ) ) {
		echo qtranxf_generateLanguageSelectCode('text');
			  // otra opciones image / both
	}

	?>
</span>