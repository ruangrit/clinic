<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/4/15
 * Time: 12:01 AM
 */
?>
<div class="wrap">
	<h2><?php esc_html_e('One-click Install Demo Content',"medicool") ?></h2>
</div>
<div id="message" class="updated">
	<p>
		<?php esc_html_e("The Demo content is a replication of the Live Content. By importing it, you could get several sliders, sliders,
		pages, posts, theme options, widgets, sidebars and other settings.
		To be able to get them, make sure that you have installed and activated these plugins:  Contact form 7 , Option Tree and Visual Composer",'medicool') ?>
		<br>
		<span style="color:#f0ad4e">
			<?php esc_html_e("WARNING: By clicking Import Demo Content button, your current theme options, sliders and widgets will be replaced. It can also take a minute to complete. ","medicool") ?>
			<br><span style="color:red">
				<b><?php esc_html_e("Please back up your database before  it.","medicool") ?></b>
			</span>
	</p>
</div>
<br>
<a href="#" onclick="return false" data-url="<?php echo esc_url(admin_url('?bravo_do_import=1&package=light')) ?>" class="btn_bravo_do_import button button-primary"><?php esc_html_e('Import','medicool')?></a>
<div id="import_debug">
</div>