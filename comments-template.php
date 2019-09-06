<?php
/**
 * Replace the default comment template with an amp-iframe to the comment loader.
 * The comment loader is hosted as a GitHub page and loads up the appropriate Disqus comment thread within an iframe.
 *
 * @see https://github.com/disqus/disqus-install-examples/tree/master/google-amp
 */

$shortname = sanitize_title( get_option( 'disqus_forum_url' ) );
if ( empty( $shortname ) ) {
	return;
}

$page_url = urlencode( get_permalink() );
$identifier = urlencode( Disqus_Public::dsq_identifier_for_post( get_post() ) );
$src = 'https://automattic.github.io/newspack-disqus-amp/comment-loader.html?shortname=' . $shortname . '&url=' . $page_url . '&identifier=' . $identifier;
?>
<amp-iframe width="500" height="300"
	layout="responsive"
	sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms"
	resizable
	frameborder="0"
	src="<?php echo esc_attr( esc_url( $src ) ); ?>"
>
	<div overflow tabindex=0 role=button aria-label="<?php echo esc_attr__( 'Comments' ); ?>"></div>
</amp-iframe>
<?php
