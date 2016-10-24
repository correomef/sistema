<?php

/**
 *  Preview Your WooCommerce Emails Live
 *  Heavily borrowed from drrobotnik:
 *  http://stackoverflow.com/a/27072101/2203639
 **/

function wordimpress_preview_woo_emails() {

	if ( is_admin() ) {
		$default_path = WC()->plugin_path() . '/templates/';

		$files   = scandir( $default_path . 'emails' );
		$exclude = array(
			'.',
			'..',
			/*'email-header.php',*/
			'email-footer.php',
			'email-styles.php',
			'email-order-items.php',
			'email-addresses.php',
			'plain'
		);
		$list    = array_diff( $files, $exclude );
		?>
		<div id="template-selector">
			<a href="https://wordimpress.com" target="_blank" class="logo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/woocommerce/emails/img/wordimpress-icon.png">

				<p>Impressive Plugins, Themes, and more tutorials like this one.<br /><strong>"Here's to Building the Web!"</strong>
				</p></a>

			<form method="get" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">
				<div class="template-row">
					<input id="setorder" type="hidden" name="order" value="">
					<input type="hidden" name="action" value="previewemail">
					<span class="choose-email">Choose your email template: </span>
					<select name="file" id="email-select">
						<?php
						foreach ( $list as $item ) { ?>
							<option value="<?php echo $item; ?>"><?php echo str_replace( '.php', '', $item ); ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="order-row">
					<span class="choose-order">Choose an order number: </span>
					<input id="order" type="number" value="102" placeholder="102" onChange="process1(this)">
				</div>
				<input type="submit" value="Go">
			</form>
		</div>
		<?php

		global $order;

		$order = new WC_Order( $_GET['order'] );

		// wc_get_template( 'emails/email-header.php', array( 'order' => $order, 'email_heading' => $email_heading ) );

		?>

		<?php

		/**
		 * Email Footer
		 *
		 * @author 		WooThemes
		 * @package 	WooCommerce/Templates/Emails
		 * @version     2.3.0
		 */
		if ( ! defined( 'ABSPATH' ) ) {
			exit; // Exit if accessed directly
		}

		global $opciones; // esta declarada en function.php


		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html>
		<head>
		<!-- If you delete this meta tag, the ground will open and swallow you. -->
		<meta name="viewport" content="width=device-width" />

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		        <title><?php echo get_bloginfo( 'name' ); ?></title>
				<style>
					@import url(http://fonts.googleapis.com/css?family=Lato:400,900);
					<?php
						/*  This is normally not needed because
						 *  WooCommerce inserts it into your templates
						 *  automatically. It's here so the styles
						 *  get applied to the preview correctly.
						 */

						wc_get_template( 'emails/email-styles.php');

						/* Custom styles can be added here
						  * NOTE: Don't add inline comments in your styles,
						  * they will break the template.
						  */
						$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
						if (strpos($url,'admin-ajax.php') !== false){ ?>

					#template_container {
						max-width: 640px;
					}
					#template-selector form,
					#template-selector a.logo,
					#template-selector .template-row,
					#template-selector .order-row {
						display: block;
						margin: 0.75em 0;
					}

					#template-selector {
						background: #333;
						color: white;
						text-align: center;
						padding: 0 2rem 1rem 2rem;
						font-family: 'Lato', sans-serif;
						font-weight: 400;
						border: 4px solid #5D5D5D;
						border-width: 0 0 4px 0;
					}

					#template-selector a.logo {
						display: inline-block;
						position: relative;
						top: 1.5em;
						margin: 1em 0 2em;
					}
					#template-selector a.logo img {
						max-height: 5em;
					}

					#template-selector a.logo p {
						display: none;
						float: left;
						position: absolute;
						width: 16em;
						top: 4.5em;
						padding: 2em;
						left: -8em;
						background: white;
						opacity: 0;
						border: 2px solid #777;
						border-radius: 4px;
						font-size: 0.9em;
						line-height: 1.8;
						transition: all 500ms ease-in-out;
					}

					#template-selector a.logo:hover p {
						display: block;
						opacity: 1;
					}

					#template-selector a.logo p:after, #template-selector a.logo p:before {
						bottom: 100%;
						left: 50%;
						border: solid transparent;
						content: " ";
						height: 0;
						width: 0;
						position: absolute;
						pointer-events: none;
					}

					#template-selector a.logo p:after {
						border-color: rgba(255, 255, 255, 0);
						border-bottom-color: #ffffff;
						border-width: 8px;
						margin-left: -8px;
					}

					#template-selector a.logo p:before {
						border-color: rgba(119, 119, 119, 0);
						border-bottom-color: #777;
						border-width: 9px;
						margin-left: -9px;
					}

					#template-selector a.logo:hover p {
						display: block;
					}

					#template-selector span {
						font-weight: 900;
						display: inline-block;
						margin: 0 1rem;
					}

					#template-selector select,
					#template-selector input {
						background: #e3e3e3;
						font-family: 'Lato', sans-serif;
						color: #333;
						padding: 0.5rem 1rem;
						border: 0px;
					}

					#template-selector #order,
					#template-selector .choose-order {
						display: none;
					}

					@media screen and (min-width: 1100px) {
						#template-selector .template-row,
						#template-selector .order-row {
								display: inline-block;
						}

						#template-selector form {
							display: inline-block;
							line-height: 3;
						}

						#template-selector a.logo p {
							width: 16em;
							top: 4.5em;
							left: 0.25em;
						}

						#template-selector a.logo p:after, #template-selector a.logo p:before {
							left: 10%;
						}
					}
					<?php } ?>
				</style>
			</head>
		    <body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
		    	<div id="wrapper">
		        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
		            	<tr>
		                	<td align="center" valign="top">
								<div id="template_header_image">

		                                <p style="margin-top:0;">
		                                    <img src="<?php echo $opciones['logo']?>" alt="<?php echo get_bloginfo( 'name', 'display' ) ?>" />
		                                </p>
								</div>
		                    	<table border="0" cellpadding="0" cellspacing="0" width="80%" id="template_container">
		                        	<tr>
		                            	<td align="center" valign="top">
		                                    <!-- Header -->
		                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_header">
		                                        <tr>
		                                            <td>
		                                            	<h1><?php echo $email_heading; ?></h1>
		                                            </td>
		                                        </tr>
		                                    </table>
		                                    <!-- End Header -->
		                                </td>
		                            </tr>
		                        	<tr>
		                            	<td align="center" valign="top">
		                                    <!-- Body -->
		                                	<table border="0" cellpadding="0" cellspacing="0" width="100%" id="template_body">
		                                    	<tr>
		                                            <td valign="top" id="body_content">
		                                                <!-- Content -->
		                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
		                                                    <tr>
		                                                        <td valign="top">
		                                                            <div id="body_content_inner">

		<?php


		do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text  );

		wc_get_template( 'emails/' . $_GET['file'], array( 'order' => $order ) );

		wc_get_template( 'emails/email-addresses.php', array( 'order' => $order ) );


		wc_get_template( 'emails/email-footer.php', array( 'order' => $order ) );
	}
}

add_action( 'wp_ajax_previewemail', 'wordimpress_preview_woo_emails' );

/*
 *    Extend WC_Email_Setting
 *    in order to add our own
 *    links to the preview
 */
add_filter( 'woocommerce_email_settings', 'add_preview_email_links' );

function add_preview_email_links( $settings ) {
	$updated_settings = array();
	foreach ( $settings as $section ) {
		// at the bottom of the General Options section

		if ( isset( $section['id'] ) && 'email_recipient_options' == $section['id'] &&

		     isset( $section['type'] ) && 'sectionend' == $section['type']
		) {
			$updated_settings[] = array(
				'title' => __( 'Preview Email Templates', 'previewemail' ),
				'type'  => 'title',
				'desc'  => __( '<a href="' . site_url() . '/wp-admin/admin-ajax.php?action=previewemail&file=customer-new-account.php" target="_blank">Click Here to preview all of your Email Templates with Orders</a>.', 'previewemail' ),
				'id'    => 'email_preview_links'
			);
		}
		$updated_settings[] = $section;

	}

	return $updated_settings;

}
