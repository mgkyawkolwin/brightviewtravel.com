<?php
	//PERFORMING PLACES POST LAYOUT...
	$meta_set = get_post_meta($post->ID, '_tpl_default_settings', true);
	$page_layout = !empty($meta_set['layout']) ? $meta_set['layout'] : 'content-full-width';
	$post_layout = !empty($meta_set['places-post-layout']) ? $meta_set['places-post-layout'] : 'one-half-column';
		
	$li_class = "";
	$column = $args = "";
	
	//POST LAYOUT CHECK...
	if($post_layout == "one-half-column") {
		$li_class = "dt-sc-one-half column";
		$column = 2;
	}
	elseif($post_layout == "one-third-column") {
		$li_class = "dt-sc-one-third column";
		$column = 3;
	}
	elseif($post_layout == "one-fourth-column") {
		$li_class = "dt-sc-one-fourth column";
		$column = 4;
	}
	
	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$li_class = $li_class." with-sidebar";
	}
	
	//POST VALUES....
	$limit = $meta_set['places-post-per-page'];
	$search_text = !empty($_REQUEST['search_text']) ? $_REQUEST['search_text'] : '';
	
	//PERFORMING QUERY...
	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }
	
	//PERFORMING QUERY...
	if(isset($_REQUEST['search_text'])):
		$args = array('post_type' => 'dt_places', 'paged' => $paged , 'posts_per_page' => $limit, 'meta_query' => array(array('key' => '_place_settings', 'value' => $search_text, 'compare' => 'LIKE')));
		$wp_query = new WP_Query($args);
		if($wp_query->found_posts == 0):
			$args = array('post_type' => 'dt_places', 'paged' => $paged , 'posts_per_page' => $limit, 's' => $search_text);
		endif;
	else:
		$args = array('post_type' => 'dt_places', 'paged' => $paged , 'posts_per_page' => $limit);
	endif;
																						
	$wp_query = new WP_Query($args);
	if($wp_query->have_posts()):  $i = 1; ?>
    
      <div class="dt-sc-hr-invisible"></div>
      <div class="search-container" id="entry-search">
          <form name="frmsearch" action="<?php the_permalink(); ?>" method="get">
              <p><input type="text" name="search_text" value="<?php echo $search_text; ?>" placeholder="<?php _e('Search by name, address etc...', 'iamd_text_domain'); ?>" /></p>
              <input type="submit" value="<?php _e('Find Places', 'iamd_text_domain'); ?>">
          </form>
      </div>
      <div class="dt-sc-hr-invisible"></div>
      
      <h2 class="section-title entry-title"><?php _e('Places in : ', 'iamd_text_domain'); echo $search_text; ?></h2><?php
	  $maxpages = ($wp_query->max_num_pages != 0) ?  $wp_query->max_num_pages : 1;
      echo '<p class="entry-result-count">'.__('Showing Results ', 'iamd_text_domain').$wp_query->query_vars['paged'].__(' of ', 'iamd_text_domain').$maxpages.'</p>'; ?>
	  
      <div class="dt-sc-places-container"><?php
		while($wp_query->have_posts()): $wp_query->the_post();
		
		 	$temp_class = "";
			if($i == 1) $temp_class = $li_class." first"; else $temp_class = $li_class;
			if($i == $column) $i = 1; else $i = $i + 1;
			
			$place_meta = get_post_meta(get_the_id() ,'_place_settings', true); ?>
            
	        <div class="<?php echo $temp_class; ?>">
				<div id="post-<?php the_ID(); ?>" <?php post_class('place-item'); ?>>
                    <div class="place-thumb"><?php
						if( has_post_thumbnail() ): ?>
							<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
								$attr = array('title' => get_the_title()); the_post_thumbnail('place-thumb', $attr); ?>
                                <div class="image-overlay"><span class="image-overlay-inside"></span></div>
							</a><?php
						endif; ?>
                    </div>
                    <div class="place-detail-wrapper">
                        <div class="place-title">
                            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php echo @$place_meta['place_add'];?></p>
                        </div>
                        <div class="place-content">
                            <a class="map-marker" href="<?php the_permalink(); ?>#place_map_<?php the_ID(); ?>"> <span class="red"></span><?php _e('View on Map', 'iamd_text_domain'); ?></a>
                            <a class="dt-sc-button too-small" href="<?php the_permalink(); ?>"><?php _e('View details', 'iamd_text_domain'); ?></a>
                        </div>
                    </div>
                </div>
            </div><?php
		endwhile; ?>
      </div><?php
	  if($wp_query->max_num_pages > 1): ?>
		<div class="pagination blog-pagination">
			<?php if(function_exists("dt_theme_pagination")) echo dt_theme_pagination("", $wp_query->max_num_pages, $wp_query); ?>
		</div><?php
	  endif;
	  wp_reset_query($wp_query);
	  else: ?>
		<h2><?php _e('Nothing Found.', 'iamd_text_domain'); ?></h2>
		<p><?php _e('Apologies, but no results were found for the requested archive.', 'iamd_text_domain'); ?></p><?php
	 endif; ?>