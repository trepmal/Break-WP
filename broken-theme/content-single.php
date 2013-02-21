<?php
/**
 * @package stripay
 * @since stripay 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entrymeta">
			<?php stripay_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'stripay' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
		<p>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'stripay' ) );
				if ( $categories_list && stripay_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( ' %1$s', 'stripay' ), $categories_list ); ?>
			</span>
			<span class="sep"> | </span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'stripay' ) );
				if ( $tags_list ) :
			?>
			<span class="tag-links">
				<?php printf( __( '%1$s', 'stripay' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>

		<?php edit_post_link( __( 'Edit', 'stripay' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	</footer><!-- #entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->