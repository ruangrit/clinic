<?php
	/**
	 * Template Name: Blank Page
	 * Created by PhpStorm.
	 * User: me664
	 * Date: 2/28/15
	 * Time: 10:48 PM
	 */

	get_header();
	while ( have_posts() ) {
		the_post();
		the_content();
	}
	get_footer();