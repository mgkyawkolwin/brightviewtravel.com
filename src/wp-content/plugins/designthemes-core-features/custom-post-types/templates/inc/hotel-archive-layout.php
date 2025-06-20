<?php
	//PERFORMING HOTELS POST LAYOUT...
	$page_layout = dt_theme_option('specialty', 'post-archives-layout');
	$page_layout = !empty($page_layout) ? $page_layout : 'content-full-width';
	
	$li_class = "column dt-sc-one-column";
	
	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$li_class = $li_class." with-sidebar";
	}
	
	global $wp_query;
	if(have_posts()): ?>
     <div class="dt-sc-hotels-container"><?php
		while(have_posts()): the_post();
			$hotel_meta = get_post_meta($post->ID ,'_hotel_settings', true); ?>
			<div class="<?php echo $li_class; ?>">
                <div class="hotel-item hotel-list-view">
                    <div class="hotel-thumb">
                    	<?php if(@array_key_exists("offer_value", $hotel_meta)): ?>
	                        <p class="hotel-offer"><span><?php echo @$hotel_meta['offer_value']; ?></span></p>
						<?php endif; ?>
                         <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
							if( has_post_thumbnail() ):
								$attr = array('title' => get_the_title()); the_post_thumbnail('hotel-thumb', $attr);
							endif; ?>
						 </a>
                    </div>
                    <div class="hotel-details">
                        <h2><a href="<?php the_permalink();?>"><?php the_title(); ?>, <sub><?php echo $hotel_meta['hotel_add'];?></sub></a></h2><?php
                        echo get_the_term_list($post->ID, 'hotel_entries', '<p class="hotel-type">', ' ', '</p>');
						//RATING CALCULATION...
						$arr_rate = dt_theme_comment_rating_count(get_the_ID());
						$all_avg = dt_theme_comment_rating_average(get_the_ID());

						echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'dt_themes').')</div>'; ?>

						<a href="<?php the_permalink(); ?>#hotel_map_<?php the_ID(); ?>" class="map-marker small"> <span class="red"></span><?php _e('View on Map', 'dt_themes'); ?></a>
                        <p>
                            <?php if(@array_key_exists("show-book-now", $hotel_meta)): ?>
	                            <a href="#booknow_wrapper" class="dt-sc-button theme-btn too-small btn-book"><?php _e('Book Now', 'iamd_text_domain'); ?></a>
							<?php endif; ?>
                            <a href="<?php the_permalink();?>" class="dt-sc-button too-small yellow"><?php _e('View Details', 'dt_themes'); ?></a>
						</p><?php
						
						if(get_post_meta(get_the_id() ,'starting_price', true)): ?>
                            <div class="hotel-thumb-meta">
                                <div class="hotel-price"><?php _e('Starts From', 'dt_themes'); ?> <span><?php echo dt_theme_option("smodule","currency").get_post_meta(get_the_id() ,'starting_price', true) ;?></span></div>
                                <?php if(@array_key_exists("specially_whome", $hotel_meta)): ?>
                                    <span class="hotel-option-type">
                                        <a href="<?php the_permalink();?>"><?php echo $hotel_meta['specially_whome']; ?></a>
                                    </span><?php
								endif; ?>
                            </div><?php
						endif; ?>
                    </div>
                </div>
	        </div><?php
		endwhile; ?>
     </div>
     <div style="display:none;">
         <div id="booknow_wrapper" class="booknow-container">
            <div id="ajax_message"> </div>
            <form name="frmbooknow" class="booknow-frm" action="<?php echo get_template_directory_uri(); ?>/framework/booknow.php" method="post">
                <p><input type="text" name="txtfname" required="required" placeholder="<?php _e('Name (required)', 'dt_themes'); ?>" /></p>
                <p><input type="email" name="txtemail" required="required" placeholder="<?php _e('Email (required)', 'dt_themes'); ?>" /></p>
                <p><input type="text" name="txtdate" required="required" placeholder="<?php _e('Date Arrival (required)', 'dt_themes'); ?>" /></p>
                <p><input type="text" name="txtsubject" placeholder="<?php _e('Subject', 'dt_themes'); ?>" /></p>
                <p><textarea name="txtmessage" rows="3" cols="32" placeholder="<?php _e('Message', 'dt_themes'); ?>"></textarea></p>
                <p><input type="submit" name="subsend" value="<?php _e('Send', 'dt_themes'); ?>" /></p>
                <input type="hidden" name="hidbookadminemail" value="<?php echo get_bloginfo('admin_email'); ?>" />
                <input type="hidden" name="hidbooksuccess" value="<?php _e('Thanks for Booking us, We will call back to you soon.', 'dt_themes'); ?>" />
                <input type="hidden" name="hidbookerror" value="<?php _e('Sorry your message not sent, Try again Later.', 'dt_themes'); ?>" />
            </form>
         </div>
	 </div><?php
	 //Check maximum no.of pages...
	 if($wp_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	 endif;
	 wp_reset_query($wp_query);
	 else: ?>
		<h2><?php _e('Nothing Found.', 'dt_themes'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'dt_themes'); ?></p><?php
	endif; ?>