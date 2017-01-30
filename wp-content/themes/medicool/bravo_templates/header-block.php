<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 6/9/15
 * Time: 9:01 PM
 */
switch($type){
    case "block-title":
        echo '<div  class="block-title le-block '.esc_attr($extraclass).'">
                            '.balanceTags($content).'
                        </div>';
        break;
    case "block-logo":
        echo '<div  class="le-block block-logo '.esc_attr($extraclass).'">
                           <div class="logo content">'.balanceTags($content).'</div>
                        </div>';
        break;
    case "start-date":
        echo '<div  class="le-block start-date block-widget '.esc_attr($extraclass).'">
                           <div class="content">'.balanceTags($content).'</div>
                        </div>';
        break;
    case "block-quote":
        echo '<div  class="le-block block-quote '.esc_attr($extraclass).'">
                           <blockquote>'.balanceTags($content).'</blockquote>
                        </div>';
        break;
    case "block-image":
        if(!$image) break;
        $image_src_obj=wp_get_attachment_image_src($image,'full');
        echo '<div  class="le-block block-image '.esc_attr($extraclass).'">
                           <div class="content bg-image" data-bg-image="'.esc_url($image_src_obj[0]).'" ></div>
                        </div>';
        break;
    case "block-contact":
        echo '<div  class="le-block block-widget block-1x1 block-contact '.esc_attr($extraclass).'">
                           <div class="content">'.balanceTags($content).'</div>
                        </div>';
        break;


}