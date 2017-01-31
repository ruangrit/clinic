<?php
/**
 * Created by PhpStorm.
 * User: me664
 * Date: 2/25/15
 * Time: 9:20 PM
 */
?>

<?php $page_footer = bravo_get_option('footer_template');
if(!empty($page_footer)){
	echo BravoTemplate::get_vc_pagecontent($page_footer);
}
?>
				</div> <!-- end content-article -->
    		</div> <!-- end content-mainn -->
		</div> <!-- end wrapper-->
		<!--
		<footer id="page-footer">
			<div class="">
				<div class="container">
					<div class="row footer">
						<div class="hidden-xs hidden-sm col-md-3 ">
							<?php if(bravo_get_url_logo()){?>
								<img alt="<?php esc_html_e('Logo','medicool')?>" class="img-responsive" src="<?php echo  bravo_get_url_logo();?>" />
							<?php } ?>
						</div>
						<div class="col-md-6">
							<div class="copyright">
								<?php
								echo bravo_get_option('footer_copyright');
								?>
							</div>
						</div>
						<div class="col-md-3">
							<div class="social-links">
								<?php
								$social =  bravo_get_option('footer_social');
								if(!empty($social)){
									foreach($social as $k=>$v){
										$class = BravoAssets::build_css('border-color:'.esc_attr($v['color']).' !important ; color:'.esc_url($v['color']).' !important ; opacity: 0.8;');
										$class .= " ".BravoAssets::build_css('opacity: 1;',":hover");
										?>
										<div class="icon">
											<a class="social-link-facebook <?php  echo esc_attr($class)?>" target="_blank" href="#"><i class="fa <?php  echo esc_attr($class)?> <?php echo esc_attr($v['icon']) ?>"></i></a>
										</div>
								<?php
									}
								}
								?>

							</div>
						</div>

					</div>
				</div>
			</div>
		</footer>
		-->
	<?php wp_footer();?>
	</body>
</html>