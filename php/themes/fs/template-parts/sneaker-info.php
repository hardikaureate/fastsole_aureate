<?php
/**
 * The template for displaying sneaker info.
 *
 * @package fastsole
 */
global $fastsole;
?>

<?php
$release_date = get_post_meta( get_the_ID(), '_sf_date', true );

if( $release_date == null ){
	$release_date = "TBC";
	
}
else{
	$release_date = date( 'D d M Y', $release_date );
}

$release_time = get_post_meta( get_the_ID(), '_sf_time', true );

$price = get_post_meta( get_the_ID(), '_sf_price', true );
$esc_price = esc_html( $price );

$sneaker_status = get_post_meta( get_the_ID(), '_sf_instock', true );

$style_code = get_post_meta( get_the_ID(), '_sf_style_code', true );
$esc_style_code = esc_html( $style_code );
?>


<div class="product-title">
	<h1 itemprop="name"><?php the_title(); ?></h1>
</div>
<div class="release-info">
	<h2>
		Release Date:&nbsp;
		
		<?php echo $release_date;?>
		
		&nbsp;
		<?php echo $release_time ? $release_time." GMT" :"TBC";?>
	</h2>
</div>
<div class="status-info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	
	<div class="product-price">
		<?php if($esc_price):?>
			
			<p> 


				<span itemprop="priceCurrency" content="GBP">£</span>
				<span itemprop="price" content="<?php echo $esc_price;?>"><?php echo $esc_price;?></span>

			</p>
			
		<?php else:
			echo "<p>TBC</p>";  endif; ?>
		</div>

		<div class="product-style-code">
			<?php if ( $esc_style_code ): ?>
				<p>Style Code: <span class="red" itemprop="mpn"><?php echo $esc_style_code;?></span></p>
				<?php else: ?>
					<p>Style Code: <span class="red">TBC</span></p>
				<?php endif; ?>
			</div>

			<div class="product-status">
				<?php if ( $sneaker_status == "instock" ): ?>
					<h3 class="green"><i class="fa fa-check" aria-hidden="true"></i>
						<link itemprop="availability" href="http://schema.org/InStock"/>Instock</h3>
					<?php endif; ?>
					<?php if ( $sneaker_status == "coming_soon" ): ?>
						<h3 class="orange"><i class="fa fa-check" aria-hidden="true"></i> Coming Soon</h3>
					<?php endif; ?>
					<?php if ( $sneaker_status == "raffle" ): ?>
						<h3 class="orange"><i class="fa fa-check" aria-hidden="true"></i> Raffle</h3>
					<?php endif; ?>
					<?php if ( $sneaker_status == "restock" ): ?>
						<h3 class="orange"><i class="fa fa-check" aria-hidden="true"></i> Restock</h3>
					<?php endif; ?>
					<?php if ( $sneaker_status == "delayed" ): ?>
						<h3 class="red"><i class="fa fa-times" aria-hidden="true"></i> Delayed</h3>
					<?php endif; ?>
					<?php if ( $sneaker_status == "sold_out" ): ?>
						<h3 class="red"><i class="fa fa-times" aria-hidden="true"></i> Sold Out</h3>
					<?php endif; ?>
				</div>
				
			</div>