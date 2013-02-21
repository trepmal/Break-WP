<?php
/**
 * @package stripay
 * @since stripay 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'stripay' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<p class="postedon"><?php stripay_posted_on(); ?></p>
			
			<?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
			<p class="comments"><span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'stripay' ), __( '1 Comment', 'stripay' ), __( '% Comments', 'stripay' ) ); ?></span></p>
			<?php endif; ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">...</span>', 'stripay' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'stripay' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<p>
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
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
		<?php endif; // End if 'post' == get_post_type() ?>


		<?php edit_post_link( __( 'Edit', 'stripay' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->