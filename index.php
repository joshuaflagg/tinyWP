<?php
get_header();

while ( have_posts() ) : the_post(); ?>
	<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
<?php endwhile;

get_footer();