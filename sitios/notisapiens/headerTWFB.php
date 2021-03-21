
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
<meta property="og:image" content="https://www.notisapiens.com/wp-content/uploads/2019/10/FACEBOOK_panelNotisapiens.png">
<meta property="og:url" content="<?php echo get_site_url(); ?>">
<?php } ?>
<meta property="og:image:width" content="828">
<meta property="og:image:height" content="450">
<meta property="og:site_name" content="Noti Sapiens">
<meta property="fb:app_id" content="2286251718369954" />
<!-- END Open Graph -->
<!-- START Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@NotiSapiens">
<meta name="twitter:creator" content="@NotiSapiens">
<!-- END Twitter -->