<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package onlinemag
 */

/**
 * onlinemag_action_before_head hook
 * @since onlinemag 1.0.0
 *
 * @hooked onlinemag_set_global -  0
 * @hooked onlinemag_doctype -  10
 */
do_action( 'onlinemag_action_before_head' );?>



<head>

	<!-- START Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141785762-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-141785762-1');
	</script>
	<!-- END Global site tag (gtag.js) - Google Analytics -->
	<!-- START Ad Sense -->
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-6627084457734509",
		enable_page_level_ads: true
	});
	</script>
	<!-- END Ad Sense -->
	<!-- START Open Graph -->
	<meta property="og:type" content="website">
	<?php if (is_single()) { ?>
	<meta property="og:title" content="<?php the_title(); ?>">
	<meta property="og:description" content="<?php echo strip_tags( $post->post_excerpt ); ?>">
	<meta property="og:image" content="<?php
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id, 'full', true);
	$url_imagen = $thumb_url[0];
	echo $url_imagen; ?>">
	<meta property="og:url" content="<?php echo get_permalink(); ?>">
	<?php } else { ?>
	<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>">
	<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
	<meta property="og:image" content="">
	<meta property="og:url" content="<?php echo get_site_url(); ?>">
	<?php } ?>
	<meta property="og:image:width" content="828">
	<meta property="og:image:height" content="450">
	<meta property="og:site_name" content="Don Guty Code">
	<!-- END Open Graph -->
	<!-- START Facebook -->
	<meta property="fb:app_id" content="1301339599979418">
	<!-- END Facebook -->
	<!-- START Twitter -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@DonGutyCode">
	<meta name="twitter:creator" content="@DonGutyCode">
	<!-- END Twitter -->

	<?php
	/**
	 * onlinemag_action_before_wp_head hook
	 * @since onlinemag 1.0.0
	 *
	 * @hooked onlinemag_before_wp_head -  10
	 */
	do_action( 'onlinemag_action_before_wp_head' );

	wp_head();

	/**
	 * onlinemag_action_after_wp_head hook
	 * @since onlinemag 1.0.0
	 *
	 * @hooked null
	 */
	do_action( 'onlinemag_action_after_wp_head' );
	?>

</head>

<body <?php body_class(); ?>>

<?php
/**
 * onlinemag_action_before hook
 * @since onlinemag 1.0.0
 *
 * @hooked onlinemag_page_start - 15
 */
do_action( 'onlinemag_action_before' );

/**
 * onlinemag_action_before_header hook
 * @since onlinemag 1.0.0
 *
 * @hooked onlinemag_skip_to_content - 10
 */
do_action( 'onlinemag_action_before_header' );

/**
 * onlinemag_action_header hook
 * @since onlinemag 1.0.0
 *
 * @hooked onlinemag_after_header - 10
 */
do_action( 'onlinemag_action_header' );

/**
 * onlinemag_action_nav_page_start hook
 * @since onlinemag 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'onlinemag_action_nav_page_start' );

/**
 * onlinemag_action_on_header hook
 * @since onlinemag 1.0.0
 *
 * @hooked page start and navigations - 10
 */
do_action( 'onlinemag_action_on_header' );

/**
 * onlinemag_action_before_content hook
 * @since onlinemag 1.0.0
 *
 * @hooked null
 */
do_action( 'onlinemag_action_before_content' );
?>

