<?php
/**
 * searchform
 *
 * @package Takeoff
 */
?>

<form role="search" class="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
    <div class="form-inline row">
    	<div class="form-group">
            <input type="text" title="Search" id="searchform_field" value="<?php echo get_search_query(); ?>" placeholder="Search..." name="s" class="form-control">
        </div>
        <button class="btn btn-default" type="submit">Search</button>
    </div>
</form>
