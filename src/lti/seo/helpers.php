<?php

/**
 * Lti + i8n = ltint
 *
 * @param $text
 * @param string $domain
 *
 * @return string|void
 */
function ltint( $text, $domain = 'lti-seo' ) {
	return __( $text, $domain );
}

function ltiopt( $value ) {
	$admin = \Lti\Seo\LTI_SEO::get_instance()->get_admin();

	return $admin->get_settings()->value( $value );
}

function ltichk( $value ) {
	$val = ltiopt( $value );
	if ( $val == true ) {
		return 'checked="checked"';
	} else {
		return null;
	}
}