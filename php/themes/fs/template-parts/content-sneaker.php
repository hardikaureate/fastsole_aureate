

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

?>
<!--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 margin-padding-0 testdata wow fadeInDown" data-wow-delay="0.3s">-->

<article <?php post_class();?> >
    <div class="single-sneaker jj">
            <div class="row col-md-12 margin-padding-0">
                    <?php if( ( $sneaker_status == "coming_soon" ) || ( $sneaker_status == "raffle" ) ) :?>
                    <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12 margin-padding-0">

                    <div class="sneaker-status">

                        <p>

                            <?php

                            if( $sneaker_status == "coming_soon" ){

                                echo '<span class="stockist_coming-soon"> Coming Soon</span>';

                            }

                            elseif( $sneaker_status == "raffle" ){

                                echo '<span class="stockist_raffle"> Raffle</span>';

                            }

                            ?>

                        </p>

                    </div>

            </div>

            <?php else: ?>



            <div class="col-md-12  margin-padding-0">

                <div class="sneaker-status align-centre">

                    <p>

                        <?php

                            if ( $sneaker_status == "instock" ) {

                                echo '<span class="stockist_in_stock">In Stock</span>';

                            }

                            elseif ( $sneaker_status == "restock" ) {

                                echo '<span class="stockist_in_stock"> Re Stock </span>';

                            }

                            elseif ( $sneaker_status == "delayed" ) {

                                echo '<span class="stockist_sold_out"> Delayed </span>';

                            }

                            elseif ( $sneaker_status == "sold_out" ) {

                                echo '<span class="stockist_sold_out"> Sold Out </span>';

                            }

                        ?>

                    </p>

                </div>

            </div>



            <?php endif; ?>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-padding-0 text-responsive">

                <div class="release-date">

                    <p><?php echo $release_date;?> <?php echo $release_time ? $release_time." GMT" :"TBC";?></p>

                </div>

            </div>

        </div>

	<?php if( has_post_thumbnail() ): ?>

	<div class="ih-item square colored effect6 bottom_to_top">

	    <a href="<?php the_permalink();?>">

	        <div class="img">

	        	<?php the_post_thumbnail('full', array('class' => 'lazyOwl img-responsive'));?>

	        </div>

	    </a>

	</div>

	<?php endif; ?>

	<div class="sneaker-info">

	    <div class="sneaker-title">

	        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>

	    </div>

	    <div class="sneaker-price">

	    	<p><?php echo $esc_price ? "&pound; ".$esc_price :"TBC";?></p> 

	    </div>

	</div>

     </div>
</article>
