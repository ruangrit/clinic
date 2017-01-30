<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 7/15/15
 * Time: 11:27 PM
 */
?>
<div class="media">
    <div  id="comment-<?php comment_ID(); ?>" <?php comment_class(['single-comment','comment-container']) ?>>
        <div class="media-left pull-left">
            <?php echo get_avatar($comment,80,'','',array('class'=>'media-object')) ?>
        </div>
        <div class="media-body">
            <div class="media-content">
                <h4 class="media-heading">
                    <?php printf(  '%s', sprintf( '%s', get_comment_author_link() ) ); ?>
                    <span><?php echo get_comment_time(get_option('date_format').' '.get_option('time_format')) ?></span>
                </h4>
                <div class="color-70"><?php comment_text($comment); ?></div>
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>
        </div>
    </div>
</div>