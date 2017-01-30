<?php
if(empty($main_color)){
	$main_color=bravo_get_option('main_color','#01bab0');
	$bg_rgb = bravo_hex2rgb($main_color);
	$bg_rgb = implode(' , ',$bg_rgb);
}else{
	$bg_rgb = "__rgba__";
}
?>
.widget a:hover{
color: <?php echo esc_attr($main_color) ?>;
}
.section-gallery.v1 .controls a {
color: <?php echo esc_attr($main_color) ?>;
}
.navbar-main .nav.menu-main > li > a:hover, .navbar-main .nav.menu-main > li > a:focus, .navbar-main .nav.menu-main > li > a:active {
color:<?php echo esc_attr($main_color) ?>;
}
.navbar-toggle .icon-bar {
background-color: <?php echo esc_attr($main_color) ?>;
}
.info-toggle li a:hover, .info-toggle li a:focus {
color: <?php echo esc_attr($main_color) ?>;
}

.info-toggle .dropdown-menu {
background: <?php echo esc_attr($main_color) ?>;
}

.section-footer .link-twitter .set-twitter {
background-color: <?php echo esc_attr($main_color) ?>;
}
.section-footer .link-twitter p a:hover {
color: <?php echo esc_attr($main_color) ?>;
}
.lists a:hover {
color: <?php echo esc_attr($main_color) ?>;
}

.medical-button {
background-color: <?php echo esc_attr($main_color) ?>;
}
.item-box .item-box-body .tt05 a:hover {
color: <?php echo esc_attr($main_color) ?>;
}

.group-list-department li a:hover {
background-color: <?php echo esc_attr($main_color) ?>;
}

.client-say li:nth-child(2n) .testimonial-ctn {
border-color: <?php echo esc_attr($main_color) ?>;
}

input[type="submit"], button[type="submit"], .button {
background-color: <?php echo esc_attr($main_color) ?>;
color: #ffffff;
}

.gallery-list .image-block::before {
background-color: rgba(<?php echo esc_attr($bg_rgb) ?>, 0.75);
}
.section-gallery.v1 #owl-demo .item .overlay {
background: rgba(<?php echo esc_attr($bg_rgb) ?>, 0.75)
}

.categories .category-nav li a:hover {
color: <?php echo esc_attr($main_color) ?>;
}

.section-gallery.v2 #owl-demo .item .overlay {

border: 2px solid rgba(<?php echo esc_attr($bg_rgb) ?>, 0.85);

}
.section-gallery.v2 #owl-demo .item .overlay .inner {
background: rgba(<?php echo esc_attr($bg_rgb) ?>, 0.85);
}

.sticky .item-box-body,
.sticky .no_post_thumb,
.tag-sticky-2 .item-box-body,
.tag-sticky-2 .no_post_thumb
{
	border-color: <?php echo esc_attr($main_color) ?>;
}


a:hover,
.main-navigation ul li a:hover,
.main-navigation ul li.current-menu-item> a,
.text-highlight,
/* Fix loi social icon o menu*/
 /*#menu .menu-bottom a, */
.section-page a, .section-page-dark a,
.blog-layout1 .blog-content a, .blog-layout2 .blog-content a, .blog-layout3 .blog-content a, .blog-layout-big .blog-content a, .blog-layout-single .blog-content a,
.post-small:hover .post-small-content,
.blog-layout-big .blog-content h4 a:hover,
.filter-list-alt li a:hover,
.main-navigation ul li.active > a, .main-navigation ul li.active > a:focus, .main-navigation ul li.current-menu-item > a,
.main-navigation ul li.current-menu-item > a:focus,
#all .list-catgs a:hover
{
    color:<?php echo esc_attr($main_color) ?>;
}


#all .button, #all .button-big, #all .button-border-light, #all .button-void,
.bravo-services-tabs.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:hover,
.bravo-services-tabs.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a:focus,
.profile-short:hover .profile-short-job,
.main-navigation ul li.current-menu-item> a:after,
.main-navigation ul li a:hover:after,
input[type=submit],
.owl-carousel.top-small-arrows > .owl-controls .owl-next:hover, .owl-carousel.top-small-arrows > .owl-controls .owl-prev:hover,
html.csstransforms3d .pace .pace-progress,
.main-navigation ul li a:after,
#all .list-catgs a:after,
.page-numbers .current,
#all .button-long:hover
{
    background-color:<?php echo esc_attr($main_color) ?>;
}

.post-small .post-small-img:after,
.master-slider .ms-thumb-list.ms-dir-h .ms-thumb-frame.ms-thumb-frame-selected:after{
	border-color:<?php echo esc_attr($main_color) ?>;
}
#all .button-border:hover, #all .button-border-dark:hover, #all .button-border-light:hover, #all .button-simple:hover
{
	background-color: <?php echo esc_attr($main_color) ?>;
	border-color: <?php echo esc_attr($main_color) ?>;
}

.post.standard-blog-item.sticky{
	border:1px solid  <?php echo esc_attr($main_color) ?>;
}
