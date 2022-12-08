<?php
/**
 * The search form template file.
 *
 * @package fastsole
 */
?>

<form class="navbar-form clearfix" role="search" action="<?php echo esc_url( home_url( '/' ) );?>" method="get">
	<div class="input-group search">
	    <input type="text" class="form-control" placeholder="Search" name="s" id="s">
	    <div class="input-group-btn">
	        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
	    </div>
	</div>
</form>