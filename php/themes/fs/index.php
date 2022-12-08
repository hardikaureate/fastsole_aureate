<?php
/**
 * The main index template file.
 *
 * @package fastsole
 */
get_header();

global $fastsole;
?>
<?php  if( have_posts() ) :?>
	<div class="container">
		<?php get_template_part('template-parts/breadcrumb'); ?>
		<div class="row margin-padding-0">
			
			<?php if( (is_category( ) ) || (is_home( ) ) || ( is_tag( ) ) ) :?>
			<div class="index-heading fadeInDown wow" data-wow-delay="0.5s">
				<h2>

					<?php 
						if( is_category() ){
							_e( 'Recent News From ', 'solefashion' ) . single_cat_title("", true) ;
						}elseif( is_tag() ){
							_e( 'Recent News From ', 'solefashion' ) . single_tag_title(); 	
						}elseif( is_home() ){
							_e( 'Sneaker News', 'solefashion' );
						}
					?>
				</h2>
				<div class="border-red"></div>
			</div>

		<?php endif; ?>
		
		<!-- <div class="release-header" style="margin-top: 30px;">
			<h1>Sneaker News</h1>
		</div>
		<div class="border-gray"></div> -->

		<?php while( have_posts() ): the_post();?>
			<?php get_template_part( 'template-parts/content' ) ;?>
		<?php endwhile; ?>

	</div>
</div>

<div class="container pagination-container wow fadeInDown" data-wow-delay="0.5s">
	<div class="row">
		<div class="col-md-12">
			<?php fastsole_pagination();?>
		</div>
	</div>
</div>

<?php if( (is_category( ) ) || ( is_tag( ) ) ) :?>
<?php get_template_part( 'template-parts/popular', 'news' ); ?>
<?php  endif;?>
<?php else: ?>
	<?php get_template_part( 'template-parts/content','none' ); ?>
<?php endif; ?>


<?php if( (!is_category( ) ) && ( !is_tag( ) ) ) :?>
<?php if ( !empty( $fastsole['news-archive-text'] ) ) :?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="archive-text-wrapper news-text-wrapper">


					<div class="archive-text armore news-text-more">

						<?php echo $fastsole['news-archive-text'];?>

					</div>


				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>