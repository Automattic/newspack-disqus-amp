<?php

$shortname = sanitize_title( get_option( 'disqus_forum_url' ) );
if ( empty( $shortname ) ) {
	return;
}

$page_url = get_permalink(); // @todo urlencode and decode on the other end.

?>
<amp-iframe width="500" height="300"
	layout="responsive"
	sandbox="allow-scripts allow-same-origin allow-modals allow-popups allow-forms"
	resizable
	frameborder="0"
	src="https://automattic.github.io/newspack-disqus-amp/comment-loader.html?shortname=<?php echo $shortname; ?>&url=<?php echo $page_url; ?>"
>
	<div overflow tabindex=0 role=button aria-label="<?php echo __( 'Comments' ); ?>"></div>
</amp-iframe>
<?php
