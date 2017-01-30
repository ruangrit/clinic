<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/28/15
 * Time: 10:33 PM
 */
if(!function_exists('bravo_get_sidebar_ids'))
{
    function bravo_get_sidebar_ids($for_optiontree=false)
    {
        global $wp_registered_sidebars;
        $r=array();
        $r[]=esc_html__('--Select--',"medicool");
        if(!empty($wp_registered_sidebars)){
            foreach($wp_registered_sidebars as $key=>$value)
            {

                if($for_optiontree){
                    $r[]=array(
                        'value'=>$value['id'],
                        'label'=>$value['name']
                    );
                }else{
                    $r[$value['id']]=$value['name'];
                }
            }

        }
        return $r;
    }
}
if(!function_exists('bravo_custom_field_types'))
{
    function bravo_custom_field_types()
    {
        $types= array(
            array(
                'value'=>'text',
                'label'=>esc_html__('Text',"medicool")
            ),
            array(
                'value'=>'textarea',
                'label'=>esc_html__('Textarea',"medicool")
            ),
            array(
                'value'=>'date',
                'label'=>esc_html__('Date',"medicool")
            ),
            array(
                'value'=>'color',
                'label'=>esc_html__('Colorpicker',"medicool")
            ),
            array(
                'value'=>'on-off',
                'label'=>esc_html__('On/Off',"medicool")
            ),
        );

        return $types;
    }
}
if ( ! function_exists( 'bravo_entry_meta' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags.
     *
     * @since Bravo Estate Framework 1.0
     */
    function bravo_entry_meta() {
       echo sprintf('<a href="%s" class="readmore" role="button">'.esc_html__('Read More',"medicool").'</a>',get_permalink());
        ?>

            <div class="article-meta-wrapper">
                <span class="article-meta"><?php esc_html_e('By',"medicool")?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php the_author_meta( 'display_name' ); ?>"><?php the_author_meta( 'display_name' ); ?></a></span>
                <span class="article-meta"><?php echo get_the_category_list(', ')?></span>
                <span class="article-meta"><?php
                    $view=bravo_get_post_view();
                    if($view>1){
                        printf(esc_html__('%d Views',"medicool"),$view);
                    }else{
                        printf(esc_html__('%d View',"medicool"),$view);
                    }

                    ?></span>
            </div>
        <?php

    }
endif;


if(!function_exists('bravo_categorized_blog'))
{

    /**
     * Determine whether blog/site has more than one category.
     *
     * @since Bravo Estate Framework 1.0
     *
     * @return bool True of there is more than one category, false otherwise.
     */
    function bravo_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'bravo_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'bravo_categories', $all_the_cool_cats );
        }

        if ( $all_the_cool_cats > 1 ) {
            // This blog has more than 1 category so bravo_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so bravo_categorized_blog should return false.
            return false;
        }
    }

}

if(!function_exists('bravo_get_wrap_class'))
{
    function bravo_get_wrap_class($class=NULL)
    {

        //Theme options config
        if(bravo_get_option('style_layout','wide')=='wide')
        {
            $all_class=array('container-fluid');

        }else{

            $all_class=array('container boxed');

        }


        if(is_string($class))
        {
            $all_class[]=$class;
        }

        if(is_array($class))
        {
            $all_class=array_merge($all_class,$class);
        }

        $all_class=apply_filters('bravo_wrap_class',$all_class);

        echo " class='".implode(' ',$all_class )."' ";
    }
}
if(!function_exists('bravo_comment_nav'))
{
    function bravo_comment_nav()
    {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', "medicool" ); ?></h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link(esc_html__( 'Older Comments', "medicool" ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link(esc_html__( 'Newer Comments', "medicool" ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
}

if(!function_exists('bravo_get_sidebar'))
{
    function bravo_get_sidebar()
    {
        $default=array(
            'position'=>'right',
            'id'      =>'blog-sidebar'
        );

        return apply_filters('bravo_get_sidebar',$default);
    }
}
if(!function_exists('bravo_breadcrumb'))
{
    function bravo_breadcrumb()
    {
        if (!is_home()) {
            echo "<ol class=\"breadcrumb\">";
            echo '<li><a href="';
            echo esc_url(home_url('/'));
            echo '">';
            echo esc_html__('Home',"medicool");
            echo "</a></li>  ";
            if(is_archive()){
            }elseif(is_single() or is_page())
            {
                echo "<li class='active'><a>".get_the_title()."</a></li>";
            }elseif(is_404()){
                echo "<li class='active'>".esc_html__('404 Page',"medicool")."</li>";
            }
            echo "</ul>";
        }else{
            echo "<ul class='breadcrumb'>";
            echo '<li><a href="';
            echo esc_url(home_url('/'));
            echo '">';
            echo esc_html__('Home',"medicool");
            echo "</a></li><li class='active'><a>".esc_html__('Blog',"medicool")."</a></li>  ";
            echo "</ol>";
        }
    }
}
if(!function_exists('bravo_cutnchar'))
{
    function bravo_cutnchar($str,$n)
    {
        if(strlen($str)<$n) return $str;
        $html	= substr($str,0,$n);
        $html	= substr($html,0,strrpos($html,' '));
        return $html.'...';
    }
}

if(!function_exists('bravo_comment_list'))
{
    function bravo_comment_list($comment, $args, $depth)
    {
        echo BravoTemplate::load_view('comment-list',null,array('comment'=>$comment,'args'=>$args,'depth'=>$depth));
    }
}
if(!function_exists('bravo_get_order_list'))
{
    function bravo_get_order_list($current=false,$extra=array(),$return='array')
    {
        $default=array(
            'none'=>esc_html__('None',"medicool"),
            'ID'=>esc_html__('Post ID',"medicool"),
            'author'=>esc_html__('Author',"medicool"),
            'title'=>esc_html__('Post Title',"medicool"),
            'name'=>esc_html__('Post Name',"medicool"),
            'date'=>esc_html__('Post Date',"medicool"),
            'modified'=>esc_html__('Last Modified Date',"medicool"),
            'parent'=>esc_html__('Post Parent',"medicool"),
            'rand'=>esc_html__('Random',"medicool"),
            'comment_count'=>esc_html__('Comment Count',"medicool"),
        );

        if(!empty($extra) and is_array($extra))
        {
            $default=array_merge($default,$extra);
        }

        if($return=="array")
        {
            return $default;
        }elseif($return=='option')
        {
            $html='';
            if(!empty($default)){
                foreach($default as $key=>$value){
                    $selected=selected($key,$current,false);
                    $html.="<option {$selected} value='{$key}'>{$value}</option>";
                }
            }
            return $html;
        }



    }
}


if(!function_exists('bravo_vc_get_order_list'))
{
    function bravo_vc_get_order_list($current=false,$extra=array())
    {
        $list=bravo_get_order_list($current,$extra);
        $r=array();
        $r[esc_html__('--Select--',"medicool")]='';

        if(!empty($list) and is_array($list))
        {
            foreach($list as $key=>$value)
            {
                $r[$value]=$key;
            }
        }

        return $r;

    }
}

if(!function_exists('bravo_get_header_template'))
{
    function bravo_get_header_template()
    {

        $layout_field=array(
            'bravo_header_style'    =>'',
            'transparent_header'    =>''
        );

        foreach($layout_field as $key=>$value){
            $layout_field[$key]=bravo_get_option($key);
        }


        if(is_singular() and get_post_meta(get_the_ID(),'custom_header_style',true)=='on')
        {
            foreach($layout_field as $key=>$value){
                $layout_field[$key]=get_post_meta(get_the_ID(),$key,true);
            }
        }

        $layout=$layout_field['bravo_header_style'];

        $template=BravoTemplate::load_view('header/header',$layout,$layout_field);

        //Sub header
        $sub_pos=bravo_get_option('top_header_position','above');
        if(is_singular() and get_post_meta(get_the_ID(),'use_custom_top_header',true)=='on' and $sub_pos_meta=get_post_meta(get_the_ID(),'top_header_position',true)){
            $sub_pos=$sub_pos_meta;
        }

        $sub_pos=apply_filters('bravo_top_header_position',$sub_pos);

        $sub_template=bravo_get_sub_header_template();
        if($sub_pos=='above'){
            $template=$sub_template.$template;
        }else{
            $template.=$sub_template;
        }

        return apply_filters('bravo_get_header_template',$template);
    }
}

if(!function_exists('bravo_get_sub_header_template'))
{
    function bravo_get_sub_header_template()
    {
        $rs = false;

        $sub_header = bravo_get_option('top_header_enable', 'off');
        if (is_singular() and get_post_meta(get_the_ID(), 'use_custom_top_header', true) == 'on')
        {
            $sub_header='on';
        }

        $data=array(
            'top_header_left_style'         =>'',
            'top_header_right_style'        =>'',
            'top_header_bg'                 =>'',
            'top_header_border'             =>'off',
            'top_header_content_border'     =>'off',
            'top_header_dropdown_position'  =>'',
            'top_header_color'              =>'',
            'header_bg'                     =>'',
            'menu_bg'                       =>''
        );
        foreach($data as $key=>$value){
            $data[$key]=bravo_get_option($key,$value);

            if(is_singular() and get_post_meta(get_the_ID(),'use_custom_top_header',true)=='on')
            {
                $data[$key]=get_post_meta(get_the_ID(),$key,true);
            }
        }

        if($data['top_header_dropdown_position'])
        {
            BravoAssets::add_css('
                #header-top .dropdown-menu{
                    top:'.balanceTags($data['top_header_dropdown_position']).'
                }
            ');
        }
        if($data['top_header_color'])
        {
            BravoAssets::add_css('
                .header-links >li> a, .bravo_top_link_tag,#header-top .header-search-btn,#header-top .search-form input,
                #header-top .search-container,
                #header-top .search-close-btn,
                .top_menu_dropdown a
                {
                    color:'.balanceTags($data['top_header_color']).'
                }

                #header-top .search-form input{
                    border-left-color:'.balanceTags($data['top_header_color']).'
                }
                #header-top .search-form:after{
                    background-color:'.balanceTags($data['top_header_color']).'
                }
                #header-top .search-form input::-webkit-input-placeholder {
                   color: '.balanceTags($data['top_header_color']).';
                }

                #header-top .search-form input:-moz-placeholder { /* Firefox 18- */
                   color: '.balanceTags($data['top_header_color']).';
                }

                #header-top .search-form input::-moz-placeholder {  /* Firefox 19+ */
                   color: '.balanceTags($data['top_header_color']).';
                }

                #header-top .search-form input:-ms-input-placeholder {
                   color: '.balanceTags($data['top_header_color']).';
                }

            ');
        }
        if($data['top_header_bg']){
            BravoAssets::add_css('
                #header-top,#header-top .search-form{
                    '.BravoAssets::array_to_css($data['top_header_bg']).'
                }

            ');
        }

        if($data['header_bg']){
            BravoAssets::add_css('
            #header
            {
                '.BravoAssets::array_to_css($data['header_bg']).'
            }
            ');
        }
        if($data['menu_bg']){
            BravoAssets::add_css('
            #main-nav,div#sticky-header
            {
                '.BravoAssets::array_to_css($data['menu_bg']).'
            }

            ');
        }

        if($sub_header=='on')
        {
            $sub_template=BravoTemplate::load_view('header/sub-header',null,array('sub_header_data'=>$data));

            $rs= $sub_template;

        }

        return apply_filters('bravo_get_sub_header_template',$rs);
    }
}

if(!function_exists('bravo_get_menu_by_theme_location'))
{
    function bravo_get_menu_by_theme_location($location){
        $locations = get_nav_menu_locations();

        if (isset($locations[$location])) {
            $menu_id = $locations[$location];
            return $menu_id;
        }
    }
}
if(!function_exists('bravo_get_header_sidebar'))
{
    function bravo_get_header_sidebar()
    {
        $header=bravo_get_option('header_sidebar_id','header-sidebar');

        if(is_singular())
        {
            if($meta=get_post_meta(get_the_ID(),'header_sidebar_id',true))
            {
                $header=$meta;
            }
        }
        return $header;
    }
}

if(!function_exists('bravo_get_list_taxonomy_id'))
{
    function bravo_get_list_taxonomy_id($tax = 'category', $array = array())
    {

        $taxonomies = get_terms($tax, $array);

        $r = array();

        $r[esc_html__('All Categories', "medicool")] = 0;


        if (!is_wp_error($taxonomies)) {

            foreach ($taxonomies as $key => $value) {
                # code...
                $r[$value->name] = $value->term_id;
            }
        }

        return $r;
    }
}
    if(!function_exists('bravo_get_list_menu')){
        function bravo_get_list_menu(){
            $r = array();
            $allMenu = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

            $r[0]['value']='';
            $r[0]['label']=esc_html__("-- Select --","medicool");
            if (!empty($allMenu)) {
                foreach ($allMenu as $key => $value) {
                    $r[$key+1]['label'] = $value->name;
                    $r[$key+1]['value'] = $value->term_id;
                }
            }
            return $r;
        }
    }

if(!function_exists('bravo_convert_icon'))
{
    function bravo_convert_icon($icon)
    {

        $r = ' bravo-icon '.esc_html($icon);
        return $r;
    }
}
if(!function_exists('bravo_is_https'))
{

    function bravo_is_https()
    {
        if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
            // no SSL request
            return false;
        }
        return true;
    }
}
if(!function_exists('bravo_menu_pos')){
    function  bravo_menu_pos(){
        $meta_menu_pos  = get_post_meta(get_the_ID(),'menu_pos',true);
        if(!empty($meta_menu_pos)){
            return $meta_menu_pos;
        }else{
            $meta_menu_pos  = bravo_get_option('header_menu_position','');
            if(!empty($meta_menu_pos)){
                return $meta_menu_pos;
            }
        }
    }
}
if(!function_exists('bravo_vc_post_dropdown')){
    function  bravo_vc_post_dropdown($arg=array()){

        $return=array();
        $return[esc_html__('-- Select --',"medicool")]=false;

        $query=get_posts($arg);
        if(!empty($query)){
            foreach($query as $post){
                $return[(string)$post->post_title]=$post->ID;
            }
        }


        return $return;
    }
}
    if(!function_exists('bravo_paginate_links')){
        function bravo_paginate_links( $args = '' ,$key='paged') {
            global $wp_query, $wp_rewrite;

            // Setting up default values based on the current URL.
            $pagenum_link = html_entity_decode( get_pagenum_link() );
            $url_parts    = explode( '?', $pagenum_link );

            // Get max pages and current page out of the current query, if available.
            $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
            $current = get_query_var( $key ) ? intval( get_query_var( $key ) ) : 1;
            $current = !empty($_GET[$key]) ? intval( $_GET[$key] ) : $current;

            // Append the format placeholder to the base URL.
            $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

            // URL base depends on permalink settings.
            $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
            $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

            $defaults = array(
                'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
                'format' => $format, // ?page=%#% : %#% is replaced by the page number
                'total' => $total,
                'current' => $current,
                'show_all' => false,
                'prev_next' => true,
                'prev_text' =>esc_html__('&laquo; Previous',"medicool"),
                'next_text' =>esc_html__('Next &raquo;',"medicool"),
                'end_size' => 1,
                'mid_size' => 2,
                'type' => 'plain',
                'add_args' => array(), // array of query args to add
                'add_fragment' => '',
                'before_page_number' => '',
                'after_page_number' => ''
            );

            $args = wp_parse_args( $args, $defaults );

            if ( ! is_array( $args['add_args'] ) ) {
                $args['add_args'] = array();
            }

            // Merge additional query vars found in the original URL into 'add_args' array.
            if ( isset( $url_parts[1] ) ) {
                // Find the format argument.
                $format = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
                $format_query = isset( $format[1] ) ? $format[1] : '';
                wp_parse_str( $format_query, $format_args );

                // Find the query args of the requested URL.
                wp_parse_str( $url_parts[1], $url_query_args );

                // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
                foreach ( $format_args as $format_arg => $format_arg_value ) {
                    unset( $url_query_args[ $format_arg ] );
                }

                $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
            }

            // Who knows what else people pass in $args
            $total = (int) $args['total'];
            if ( $total < 2 ) {
                return;
            }
            $current  = (int) $args['current'];
            $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
            if ( $end_size < 1 ) {
                $end_size = 1;
            }
            $mid_size = (int) $args['mid_size'];
            if ( $mid_size < 0 ) {
                $mid_size = 2;
            }
            $add_args = $args['add_args'];
            $r = '';
            $page_links = array();
            $dots = false;

            if ( $args['prev_next'] && $current && 1 < $current ) :
                $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $current - 1, $link );
                if ( $add_args )
                    $link = add_query_arg( $add_args, $link );
                $link .= $args['add_fragment'];

                /**
                 * Filter the paginated links for the given archive pages.
                 *
                 * @since 3.0.0
                 *
                 * @param string $link The paginated link URL.
                 */
                $page_links[] = '<li><a class="prev page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . esc_attr($args['prev_text']) . '</a></li>';
            endif;
            for ( $n = 1; $n <= $total; $n++ ) :
                if ( $n == $current ) :
                    $page_links[] = "<li><span class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</span></li>";
                    $dots = true;
                else :
                    if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                        $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                        $link = str_replace( '%#%', $n, $link );
                        if ( $add_args )
                            $link = add_query_arg( $add_args, $link );
                        $link .= $args['add_fragment'];

                        /** This filter is documented in wp-includes/general-template.php */
                        $page_links[] = "<li><a class='page-numbers' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . "</a></li>";
                        $dots = true;
                    elseif ( $dots && ! $args['show_all'] ) :
                        $page_links[] = '<li><span class="page-numbers dots">' .esc_html__( '&hellip;',"medicool" ) . '</span></li>';
                        $dots = false;
                    endif;
                endif;
            endfor;
            if ( $args['prev_next'] && $current && ( $current < $total || -1 == $total ) ) :
                $link = str_replace( '%_%', $args['format'], $args['base'] );
                $link = str_replace( '%#%', $current + 1, $link );
                if ( $add_args )
                    $link = add_query_arg( $add_args, $link );
                $link .= $args['add_fragment'];

                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = '<li><a class="next page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . esc_attr($args['next_text']) . '</a></li>';
            endif;
            switch ( $args['type'] ) {
                case 'array' :
                    return $page_links;

                case 'list' :
                    $r .= "<ul class='page-numbers'>\n\t<li>";
                    $r .= join("</li>\n\t<li>", $page_links);
                    $r .= "</li>\n</ul>\n";
                    break;

                default :
                    $r = join("\n", $page_links);

                    $r = '<div class="text-center spacing-bottom">
                                <ul class="pagination pagination-lg">
                                    '.join("\n", $page_links).'

                                </ul>
                            </div>';
                    break;
            }
            return $r;
        }

    }

if(!function_exists('bravo_get_wrapper_version')) {
    function bravo_get_wrapper_version( )
    {
        $ver = bravo_get_option('body_wrapper');

        $ver_meta = get_post_meta(get_the_ID(),'body_wrapper',true);
        if(!empty($ver_meta)){
            $ver = $ver_meta;
        }
        printf($ver);
    }
}
if(!function_exists('bravo_get_url_logo')) {
    function bravo_get_url_logo( )
    {
        $logo = bravo_get_option('logo');
        $check = get_post_meta(get_the_ID(),'st_custom_logo',true);
        if($check == "on"){
            $logo_meta = get_post_meta(get_the_ID(),'logo',true);
            $logo = $logo_meta;
        }
        return $logo;
    }
}
if(!function_exists('bravo_hex2rgb')) {
    function bravo_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);

        if(strlen($hex) == 3) {
            $r = hexdec(substr($hex,0,1).substr($hex,0,1));
            $g = hexdec(substr($hex,1,1).substr($hex,1,1));
            $b = hexdec(substr($hex,2,1).substr($hex,2,1));
        } else {
            $r = hexdec(substr($hex,0,2));
            $g = hexdec(substr($hex,2,2));
            $b = hexdec(substr($hex,4,2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }
}
