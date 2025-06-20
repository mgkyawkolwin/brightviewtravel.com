<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php 
	return;
}
?>
<!-- START EDITING HERE. -->

<?php if(have_comments()): ?>
	
	<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
    	<div class="pagination">
            <ul class="commentNav">
                <li><?php previous_comments_link(); ?></li>
                <li><?php next_comments_link(); ?></li>
            </ul>
		</div>
	<?php endif; ?>
    
    <div class="commententries" id="comments">
		<h3><?php comments_number(__('No Comments', 'iamd_text_domain'), __('Comment (1)', 'iamd_text_domain'), __('Comments (%)', 'iamd_text_domain')); ?></h3>
        <ul class="commentlist">
            <?php wp_list_comments('avatar_size=85&type=comment&callback=dt_theme_custom_comments&style=ul'); ?>
        </ul>
	</div><?php
	else:
		if('open' == $post->comment_status): ?>
            <h3><?php _e('No Comments', 'iamd_text_domain'); ?></h3><?php
		endif;
	endif;
	
	//PERFORMING COMMENT FORM...
	if('open' == $post->comment_status):
		$args = array(
			'comment_field' => '<p class="dt-sc-one-half column"><textarea id="comment" name="comment" placeholder="Message"></textarea></p>',
			'fields' => array(
					'author' => '<div class="dt-sc-one-half column first"><p><input id="author" name="author" type="text" required="" placeholder="Name (required)" /></p>',
					'email' => '<p><input id="email" name="email" type="text" required="" placeholder="Email (required)" /></p>',
					'url' => '<p><input id="url" name="url" type="text" placeholder="Website" /></p></div>',),
			'comment_notes_before' => '',
			'label_submit' => __('Submit Comment', 'iamd_text_domain'),
			'comment_notes_after' => '',
			'title_reply' => __('Leave a Reply', 'iamd_text_domain'),
			'cancel_reply_link' => 'cancel reply'
		);
		comment_form($args);
	endif; ?>