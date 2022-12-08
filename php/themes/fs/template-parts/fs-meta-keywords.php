<?php

/**

 * The meta keywords file.

 *

 * @package Fastsole

 */

global $fastsole;

if( is_post_type_archive( 'sneaker' )  &&   !empty( $fastsole['sneaker-meta-keywords'] ) ) :?>
      	<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['sneaker-meta-keywords'] ) ;  ?>" />
      	<meta property="og:description" content="Check here latest sneaker release dates from brands like Jordan, Nike, adidas & more. Upcoming Shoe Releases in UK and Europe.">

      	<?php endif; ?>

      	<?php  if( is_tax( 'department', 'adidas' )  &&   !empty( $fastsole['adidas-archive-meta-keywords'] ) ) :?>
      	<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['adidas-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'nike' )  &&   !empty( $fastsole['nike-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['nike-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'nike-jordan' )  &&   !empty( $fastsole['nike-jordan-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['nike-jordan-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'air-max' )  &&   !empty( $fastsole['air-max-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['air-max-archive-meta-keywords'] ) ;  ?>" />


      	<?php elseif( is_tax( 'department', 'air-vapormax' )  &&   !empty( $fastsole['air-vapormax-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['air-vapormax-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'eqt' )  &&   !empty( $fastsole['eqt-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['eqt-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'yeezy' )  &&   !empty( $fastsole['yeezy-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['yeezy-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'nmd' )  &&   !empty( $fastsole['nmd-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['nmd-archive-meta-keywords'] ) ;  ?>" />


		<?php elseif( is_tax( 'department', 'ultra-boost' )  &&   !empty( $fastsole['ultra-boost-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['ultra-boost-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'ultra-boost' )  &&   !empty( $fastsole['ultra-boost-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['ultra-boost-archive-meta-keywords'] ) ;  ?>" />

		<?php elseif( is_tax( 'department', 'puma' )  &&   !empty( $fastsole['puma-archive-meta-keywords'] ) ) : ?>
		<meta name="keywords" content= "<?php echo sanitize_text_field( $fastsole['puma-archive-meta-keywords'] ) ;  ?>" />

      	<?php endif; ?>