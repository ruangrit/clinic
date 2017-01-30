<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/20/16
 * Time: 11:26 PM
 */
?>
<form id="form-search" method="get" action="<?php echo esc_url(home_url('/')) ?>">
	<input type="text" value="<?php echo get_query_var('s')?>" name="s" placeholder="<?php esc_html_e('Search...',"medicool")?>">
	<div class="submit-container">
		<input type="submit" value="<?php esc_html_e('Send',"medicool")?>">
	</div>
</form>
