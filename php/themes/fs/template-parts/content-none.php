  <?php
/**
 * Template for displaying content none.
 *
 * @package solefashion
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class();?> >
<div class=" col-lg-12 col-md-12 col-sm-12 news padding-left-0 release-header clearfix" style="padding-bottom: 20px;">
<h1><?php esc_html_e( 'Nothing Found', 'fastsole' ); ?></h1>
    <div class="border-red"></div>
    <?php if ( is_search() ) : ?>
	<div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 news padding-left-0 nothing-found-wrapper">
      <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fastsole' ); ?></p>
              <?php get_search_form(); ?>
	</div>
      <?php else : ?>

      <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.Perhaps searching can help.', 'fastsole' ); ?></p>
        <?php get_search_form(); ?>

      <?php endif; ?>
</div>
</article>

