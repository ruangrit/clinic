<?php
	/**
	 * The template for displaying comments
	 *
	 * The area of the page that contains both current comments
	 * and the comment form.
	 *
	 * @package WordPress
	 * @subpackage Twenty_Fifteen
	 * @since Twenty Fifteen 1.0
	 */

	/*
	 * If the current post is protected by a password and
	 * the visitor has not yet entered the password we will
	 * return early without loading the comments.
	 */
	if ( post_password_required() ) {
		return;
	}

?>
	<div class="post-comments">
		<?php if ( have_comments() ) : ?>
			<div class="sect-header">
				<h3>
					<?php comments_number( esc_html__( 'No comment', "medicool" ),
						esc_html__( 'Comment: 1', "medicool" ), esc_html__( 'Comments : %', "medicool" ) ) ?>

				</h3>
			</div>

			<?php bravo_comment_nav(); ?>


			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 127,
				'callback'    => 'bravo_comment_list'
			) );
			?>

			<?php bravo_comment_nav(); ?>

		<?php endif; // have_comments() ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
				?>
				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', "medicool" ); ?></p>
			<?php endif; ?>
		<div class="comment-form">
			<?php
				$comment_field = '';
				if ( is_user_logged_in() ) {
					$comment_field = '<div class="inner-addon left-addon form-group">
                                                            <i class="fa fa-comment"></i>
                                                            <textarea id="comment" name="comment" class="form-control" rows="8" placeholder="' . esc_html__( 'Comment', "medicool" ) . '"></textarea>
                                                        </div>';
				} ?>
			<?php
			$commenter=wp_parse_args($commenter,array(
				'comment_author_email'=>'',
				'comment_author_website'=>'',
				'comment_author'=>''
			));
				$comment_form = array(
					'fields'         => array(

						'author'  => '<div class="row">
												<div class="col-sm-6 form-group">
														<div class="inner-addon left-addon">
															<i class="fa fa-user"></i>
															<input id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true"  class="form-control" placeholder="' . esc_html__( 'Name', "medicool" ) . '" />
							                     		</div>
							                    </div>',


						'email'   => '<div class="col-sm-6 form-group">
											<div class="inner-addon left-addon">
											 <i class="fa fa-envelope"></i>
												<input  placeholder="' . esc_html__( 'Email', "medicool" ) . '"  class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />
											</div>
							          	</div>',


						'message' => '<div class="col-sm-12 form-group">
												<div class="inner-addon left-addon">
												 <i class="fa fa-comment"></i>
                                               		 <textarea class="form-control" id="comment" name="comment" cols="40" rows="5" placeholder="' . esc_html__( 'Message', "medicool" ) . '"></textarea>
                                        		</div>
                                        </div>
                                     </div>',
					),
					'comment_field'  => $comment_field,
					'class_submit'   => 'submit-small',
					'title_reply'    => ''.esc_html__( 'Leave a comment', "medicool" ).'',
					'title_reply_to' => esc_html__( 'Leave a COMMENT to %s', "medicool" ),
					'label_submit' => esc_html__( 'Submit Comment', "medicool" ),
				);

				comment_form( $comment_form ); ?>
		</div>

	</div>
