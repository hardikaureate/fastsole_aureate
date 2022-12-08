<?php

/**

 * The template for displaying the footer.

 *

 * @package fastsole

 */

global $fastsole;

?>
<div class="sign-up-section wow fadeInDown" data-wow-delay="0.25s">
	<div class="container">
		<div class="row">
			<div class="col-md-12 sign-up">
				<h2>SIGN UP BELOW FOR EARLY UPDATES</h2>
				<p>Subscribe us to stay updated about new releases  </p>
				<div class="sign-up-input">
					<form action="https://fastsole.us14.list-manage.com/subscribe/post?u=06f3dde38a5eb2f741a1aa8e1&amp;id=76684f5715" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder=" Enter your email " required>
						<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_06f3dde38a5eb2f741a1aa8e1_76684f5715" tabindex="-1" value=""></div>
						<div class="sign-up-icon">

							<button class="btn btn-default"  name="subscribe" id="mc-embedded-subscribe" type="submit">SIGN UP</button>
						</div>
					</form>
				</div>
			</div>

		</div>

	</div>

</div>

<div class="footer-top wow fadeInDown" data-wow-delay="0.25s">

	<div class="container footer-contant">

		<div class="row">

			<div class="footer-menu">

				<div class="col-md-7 col-sm-12 col-xs-12">

					<?php get_sidebar('footer-widget'); ?>

				</div>

				<div class="col-md-5 col-sm-12 col-xs-12">

					<div class="footer-logo">

						<a href="<?php echo esc_url( home_url( '/' ) );?>">
							<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['footer-logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"> -->
							<img src="<?php echo get_template_directory_uri();?>/img/footer-logo.png" alt="Fastsole">
						</a>

					</div>

					<?php if( !empty( $fastsole['footer-text'] ) ):?>

						<div class="footer-text">

							<p> <?php echo $fastsole['footer-text']; ?></p>

						</div>

					<?php endif;?>

					<div class="footer-social-icons">

						<ul>

							<?php if( !empty( $fastsole['twitter-link'] ) ):?>

								<li class="sns-twitter"><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['facebook-link'] ) ):?>

								<li class="sns-facebook"><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>"  target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['instagram-link'] ) ):?>

								<li class="sns-instagram"><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>"  target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['google-plus-link'] ) ):?>

								<li class="sns-google-plus"><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>"  target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['pintarest-link'] ) ):?>

								<li class="sns-pinterest"><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>"  target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

							<?php endif;?>

						</ul>

					</div>

				</div>

			</div>

			<div class="footer-menu" style="display: none;">

				<div class="col-xs-12">

					<div class="row">
						<?php get_sidebar('footer-widget'); ?>
					</div>

				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">

					<div class="footer-logo">

						<a href="<?php echo esc_url( home_url( '/' ) );?>">
							<!-- <img src="<?php if(!empty($fastsole['footer-logo'] )){echo $fastsole['footer-logo']['url'];}?>" class="img-responsive" alt="<?php bloginfo( 'name' ); ?>"> -->
							<img src="<?php echo get_template_directory_uri();?>/img/footer-logo.png" alt="Fastsole">
						</a>

					</div>

					<?php if( !empty( $fastsole['footer-text'] ) ):?>

						<div class="footer-text">

							<p> <?php echo $fastsole['footer-text']; ?></p>

						</div>

					<?php endif;?>

					<div class="footer-social-icons">

						<ul>

							<?php if( !empty( $fastsole['twitter-link'] ) ):?>

								<li class="sns-twitter"><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['facebook-link'] ) ):?>

								<li class="sns-facebook"><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>"  target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['instagram-link'] ) ):?>

								<li class="sns-instagram"><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>"  target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['google-plus-link'] ) ):?>

								<li class="sns-google-plus"><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>"  target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

							<?php endif;?>

							<?php if( !empty( $fastsole['pintarest-link'] ) ):?>

								<li class="sns-pinterest"><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>"  target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

							<?php endif;?>

						</ul>

					</div>

				</div>



			</div>

		</div>

	</div>

</div>

<div class="footer-bottom">

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				<p>

					<?php esc_html_e(  'Copyright', 'fastsole' ); ?>&nbsp;<a href="<?php echo esc_url( home_url( '/' ) );?>"><?php bloginfo( 'name' ); ?></a> <?php echo date('Y'); ?>&nbsp; &#124; &nbsp; <?php esc_html_e(  'All Rights Reserved', 'fastsole' ); ?> &nbsp; &#124; &nbsp;<?php esc_html_e(  'Company Reg No. 10812528', 'fastsole' ); ?><?php

					if( !empty( $fastsole['footer-page-link'] ) ):?>


						<?php $args = array( 'post_type'=>'page','page_id'=> $fastsole['footer-page-link'],'post_status' =>'publish','posts_per_page' => 1,);


						$query = new WP_Query( $args );


						if( $query->have_posts()): while( $query->have_posts() ): $query->the_post();?>

							&nbsp; &#124; &nbsp;

							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

						<?php endwhile; wp_reset_postdata(); endif; ?>

					<?php endif;?>

				</p>

			</div>

		</div>

	</div>
	<div class="totop"><i class="fa fa-angle-up"></i></div>
</div>

<div class="mobile_social_icons">
	<ul>

		<?php if( !empty( $fastsole['twitter-link'] ) ):?>

			<li class="sns-twitter"><a href="<?php echo esc_url( $fastsole['twitter-link'] ); ?>"  target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

		<?php endif;?>

		<?php if( !empty( $fastsole['facebook-link'] ) ):?>

			<li class="sns-facebook"><a href="<?php echo esc_url( $fastsole['facebook-link'] ); ?>"  target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

		<?php endif;?>

		<?php if( !empty( $fastsole['instagram-link'] ) ):?>

			<li class="sns-instagram"><a href="<?php echo esc_url( $fastsole['instagram-link'] ); ?>"  target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

		<?php endif;?>

		<?php if( !empty( $fastsole['google-plus-link'] ) ):?>

			<li class="sns-google-plus"><a href="<?php echo esc_url( $fastsole['google-plus-link'] ); ?>"  target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

		<?php endif;?>

		<?php if( !empty( $fastsole['pintarest-link'] ) ):?>

			<li class="sns-pinterest"><a href="<?php echo esc_url( $fastsole['pintarest-link'] ); ?>"  target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>

		<?php endif;?>

	</ul>
</div>

</div>

<?php wp_footer(); ?>
<script>


	/*function myFunction() {
		var element = document.getElementById("wpas-tax_status");
		document.getElementById("wpas-tax_colour").classList.remove("collaspe");
		document.getElementById("wpas-tax_department").classList.remove("collaspe");
		document.getElementById("wpas-meta__sf_price").classList.remove("collaspe");
		document.getElementById("wpas-tax_status").classList.toggle("collaspe");

	}
	function myFunction1() {
		var element = document.getElementById("wpas-tax_department");
		document.getElementById("wpas-tax_department").classList.toggle("collaspe");
		document.getElementById("wpas-tax_colour").classList.remove("collaspe");
		document.getElementById("wpas-tax_status").classList.remove("collaspe");
		document.getElementById("wpas-meta__sf_price").classList.remove("collaspe");
	}
	function myFunction2() {
		var element = document.getElementById("wpas-tax_colour");
		document.getElementById("wpas-tax_colour").classList.toggle("collaspe");
		document.getElementById("wpas-tax_department").classList.remove("collaspe");
		document.getElementById("wpas-tax_status").classList.remove("collaspe");
		document.getElementById("wpas-meta__sf_price").classList.remove("collaspe");
	}
	function myFunction3() {
		var element = document.getElementById("wpas-meta__sf_price");
		document.getElementById("wpas-meta__sf_price").classList.toggle("collaspe");
		document.getElementById("wpas-tax_department").classList.remove("collaspe");
		document.getElementById("wpas-tax_status").classList.remove("collaspe");
		document.getElementById("wpas-tax_colour").classList.remove("collaspe");
	}*/

	/*custom sorting ajax*/

	/*=============================filtering==========================================*/
	/*=============================filtering==========================================*/
	/*=============================filtering==========================================*/

	function filterProducts(){
		var filter = $('#filter');

	//alert(filter);

	$.ajax({
		url:filter.attr('action'),

		data:filter.serialize(), // form data

		type:filter.attr('method'), // POST

		dataType : 'json',

		beforeSend:function(){

			if ($(window).width() >= 992){
				jQuery("#wait2").css("display", "block");

			}else {
				jQuery("#wait2d").css("display", "block");
			}

			//jQuery("#wait2").fadeIn(4000);
			//setTimeout(complete, 2000);
		},
		success:function(data){


			misha_loadmore_params.current_page = 1;


			misha_loadmore_params.posts = data.posts;


			misha_loadmore_params.max_page = data.max_page;

			filter.find('button').text('Apply filter'); // changing the button label back
			$('#response').html(data.content); // insert data

			if ( data.max_page < 2 ) {
				filter.find('button').text('Apply filter');
			} /*else {
				filter.find('button').text('Apply filter hide');
			}*/
		},
		complete:function () {
			jQuery("#wait2").fadeOut(1000);
			jQuery("#wait2d").fadeOut(1000);



		}
	});
	return false;
}

jQuery(function($){
	$('.btn-search-trigger').click(function(){

		$('.search-form-wrapper').addClass('open');
	});
	$('.btn-search-close').click(function(){
		console.log('clicked');
		$('.search-form-wrapper').removeClass('open');
	});
	$(window).on('load resize', function(){

		if(window.innerWidth >= 990){
			$('#filter').change(function(){
				filterProducts();
			});
		}else{
			$('#apply-filters').click(function(){
				filterProducts();
				setTimeout(function(){
					$('.single-sneaker').sameHeight();
				}, 1000);
			});
		}
	});

});


/*===================================loadmorejs==============================*/
/*===================================loadmorejs==============================*/
/*===================================loadmorejs==============================*/



function UpdateStatus(){
	var var1= document.getElementById("btnn");
	var $loader = jQuery("#loader");

	var button = jQuery(this),
	data = {
		'action': 'loadmore',
		'query': misha_loadmore_params.posts,
		'page' : misha_loadmore_params.current_page
	};

	jQuery.ajax({

		url : misha_loadmore_params.ajaxurl,
		data : data,
		type : 'POST',
		beforeSend : function(){

			jQuery("#wait").css("display", "block");

		},
		success : function( data ){
			if( data ) {

				jQuery('.morepost').before(data);

				misha_loadmore_params.current_page++;

				if ( misha_loadmore_params.current_page == misha_loadmore_params.max_page ){

					jQuery('#btnn').hide();

				}

			} else {

				jQuery('#btnn').hide();
			}
		},
		complete:function () {
			jQuery("#wait").fadeOut(1000);

		}
	});

	return false;
}


/*===================================collapsejs==============================*/
/*===================================collapsejs==============================*/
/*===================================collapsejs==============================*/

jQuery(function($){
	if (matchMedia) {
		var mq = window.matchMedia("(max-width: 992px)");
		mq.addListener(WidthChange);
		WidthChange(mq);
	}

	function WidthChange(mq) {
		if (mq.matches) {
				//$(".kk").attr("data-toggle","collapse");
				$(".collapse").removeClass("in");
				$(".collapsed").removeClass("kk");

			}else{
				//$(".kk").attr("data-toggle","");
				$(".collapse").addClass('in');
				$(".collapsed").addClass('kk');

			}
		}
		$('a[data-toggle="collapse"]').click(function(e){

			if ($(window).width() >= 992){
				//alert("hello");
				e.stopPropagation();
				return false;
			}
		});

	});

</script>


<script>
	/*===================================Include Date Range Picker==============================*/
	/*===================================Include Date Range Picker==============================*/
	/*===================================Include Date Range Picker==============================*/


	$(function() {
		var start = moment().subtract(29, 'days');
		var end = moment();

		function cb(start, end) {
			$('#daterangecheckid').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('#daterangecheckid2').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		}


		$('#daterangecheckid, #daterangecheckid2').daterangepicker({
			autoUpdateInput: false,
			autoApply:true,
			alwaysShowCalendars: true,
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, cb);


		$('#daterangecheckid, #daterangecheckid2').on('hide.daterangepicker', function(ev, picker) {
			if(ev.target.value.length > 0){
				$('#filter').trigger('change');
			}

		});


		var abc = $('#daterangecheckid').data('daterangepicker');


		$('#daterangeclear').on('click', function(ev, picker) {

			$('#daterangecheckid').val('');

			abc.setStartDate(start);
			abc.setEndDate(end);

			$('#filter').trigger('change');

		});


	});

</script>


</body>

</html>
