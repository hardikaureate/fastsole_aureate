<?php
/**
 * The stockist template file.
 *
 * It is used to display stockists single sneaker page.
 *
 * @package fastsole
 */
global $fastsole;
?>

<div class="stockist">
	<h2>You can buy from here</h2>
	<div class="border-red margin-bottom-15"></div>
	<div class="stockist-items">
		<?php $entries = get_post_meta( get_the_ID(), '_sf_affilate_group', true ); 
		foreach ( (array) $entries as $key => $entry ):

			$affilate_post_id = $entry['affilate_title'];

			$launch_date = $entry['launch_date'] ;
			if( $launch_date == null ){
				$launch_date = "TBC";
			}
			else{
				$launch_date = date( 'D d M Y', $launch_date );
			}
			$launch_time = $entry['launch_time'];
			$launch_status = $entry['launch_status'];

			if ( !empty( $entry['affilate_link'] ) ) {

				$meta_key = "_afflink_{$affilate_post_id}";
				$aff_link = get_post_meta( get_the_ID(), $meta_key,true );

			}else{

				$aff_link = get_post_meta( $affilate_post_id, '_sf_default_link', true );

			}

			?>



		<div class="stockist-item">
			<div class="stockist-image">
			   <a href="<?php echo $aff_link;?>" rel="nofollow" target="_blank" >
				  <?php echo get_the_post_thumbnail($affilate_post_id, 'post-thumb', array( 'class' => "img-responsive", ) ) ?>
			   </a>
			</div>
			<div class="stockist-release">
			   

				<?php if( $launch_status == "coming_soon"  ) : ?>
					 <span class="stockist_coming_soon">Coming Soon</span>

					 <?php elseif( $launch_status == "tbc"  ): ?>
					 <span class="stockist_coming_soon">TBC</span>

					 <?php elseif( $launch_status == "instock" ): ?>
						 <span class="stockist_in_stock">In Stock</span>

					 <?php elseif( $launch_status == "restock" ): ?>
						 <span class="stockist_in_stock">Re Stock</span>

					 <?php elseif( $launch_status == "delayed" ): ?>
						 <span class="stockist_in_stock">Reseller</span>

					 <?php elseif( $launch_status == "sold_out" ): ?>
						 <span class="stockist_sold_out">Sold Out</span>
				
					 <?php elseif( $launch_status == "raffle"  ): ?>
						   <span class="stockist_coming_soon">Raffle</span>
	   
				  <?php endif; ?>

				   <?php if( $launch_status == "coming_soon" || $launch_status == "restock" || $launch_status == "raffle"): ?>
   
					 <?php echo '<div class="release_date">'.$launch_date .'</div>';?> 
					  <?php 
					  if ( $launch_time ) {
						  echo '<div class="release_date">'.$launch_time.' GMT</div>';
					  }
					  else{
						  echo '<div class="release_date">TBC</div>';
					  }
					   
					  ?>
				<?php endif; ?>
			</div>
		   


			<?php if( $launch_status == "instock" || $launch_status == "restock" || $launch_status == "delayed" ): ?>
			 <div class="stockist-button bye-now">
			   <a href="<?php echo $aff_link;?>" rel="nofollow" target="_blank">Buy Now</a>
			</div>
			<?php elseif($launch_status == "sold_out"): ?>
			   <div class="stockist-button sold-out">
			   <a href="<?php echo $aff_link;?>" rel="nofollow" target="_blank">Visit Website</a>
			  </div>
			<?php else: ?>
			   <div class="stockist-button visit-website">
			   <a href="<?php echo $aff_link;?>" rel="nofollow" target="_blank">Visit Website</a>
			  </div>
			<?php endif; ?>

		</div>


	<?php endforeach;?>                     

	</div> 
</div> 