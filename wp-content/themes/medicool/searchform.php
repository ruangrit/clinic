<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 4/25/15
 * Time: 3:32 PM
 */
?>
<div class="block-search">
    <form action="<?php echo esc_url(home_url('/')) ?>" method="GET" class="input-append">
        <input type="text" value="<?php echo BravoInput::request('s') ?>" placeholder="<?php esc_html_e("Type &amp; Hit Enter...","medicool") ?>" class="form-control" name="s"  title="<?php _e("Type &amp; Hit Enter...","medicool") ?>">
        <button class="btn" type="submit"><i aria-hidden="true" class="fa fa-search"></i></button>
    </form>
</div>