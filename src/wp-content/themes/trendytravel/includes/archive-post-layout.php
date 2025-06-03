<?php
	//PERFORMING BLOG POST LAYOUT...
	$page_layout = "";
	$post_layout = "";
	
	if(is_archive() || is_home()) {
		$page_layout = dt_theme_option('specialty', 'post-archives-layout');
		$page_layout = !empty($page_layout) ? $page_layout : 'with-left-sidebar';
		$post_layout = dt_theme_option('specialty', 'post-archives-post-layout');
		$post_layout = !empty($post_layout) ? $post_layout : 'one-column';
	}
	elseif(is_search()) {
		$page_layout = dt_theme_option('specialty', 'search-layout');
		$page_layout = !empty($page_layout) ? $page_layout : 'with-left-sidebar';
		$post_layout = dt_theme_option('specialty', 'search-post-layout');
		$post_layout = !empty($post_layout) ? $post_layout : 'one-column';
	}

	$article_class = "";
	$feature_image = "blog-full";
	$column = "";

	//POST LAYOUT CHECK...
	if($post_layout == "one-column") {
		$article_class = "column dt-sc-one-column";
	}
	elseif($post_layout == "one-half-column") {
		$article_class = "column dt-sc-one-half";
		$column = 2;
	}
	elseif($post_layout == "one-third-column" || $post_layout == "one-fourth-column") {
		$article_class = "column dt-sc-one-third";
		$column = 3;
	}

	//PAGE LAYOUT CHECK...
	if($page_layout != "content-full-width") {
		$article_class = $article_class." with-sidebar";
	}
	
	//PERFORMING QUERY...
	global $wp_query;	//FOR PAGINATION PURPOSE...	

	if(have_posts()): $i = 1;
	 echo '<div class="blog-isotope-wrapper">';
	 while(have_posts()): the_post();
	 
	 	$temp_class = "";
		
		if($i == 1) $temp_class = $article_class." first"; else $temp_class = $article_class;
		if($i == $column) $i = 1; else $i = $i + 1;
	 	  $format = get_post_format();
		  $format = !empty($format) ? $format : 'standard'; ?>
          
          <div class="<?php echo $temp_class; ?>">
              <article id="post-<?php the_ID(); ?>" <?php post_class('blog-entry'); ?>>
                  <div class="blog-entry-inner">
    
                      <div class="entry-thumb">
						  <?php if(is_sticky()): ?>
                              <div class="featured-post"><span><?php _e('Featured','iamd_text_domain'); ?></span></div>
                          <?php endif; ?>

                          <!-- POST FORMAT STARTS -->
                          <?php if( $format === "image" || empty($format) ): ?>
                                  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
                                  <?php if( has_post_thumbnail() ):
                                          $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr);
                                        else: ?>
                                          <img src="http://placehold.it/1170x800&text=Image" width="1170" height="800" alt="<?php the_title(); ?>" />
                                  <?php endif;?>
                                  	<div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                  </a>
                          <?php elseif( $format === "gallery" ):
                                  $post_meta = get_post_meta(get_the_id() ,'_dt_post_settings', true);
                                  if( @array_key_exists("items", $post_meta) ):
                                      echo "<ul class='entry-gallery-post-slider'>";
                                      foreach ( $post_meta['items'] as $item ) { echo "<li><img src='{$item}' alt='gal-img' /></li>";	}
                                      echo "</ul>";
									  echo '<div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>';
                                  endif;
                                elseif( $format === "video" ):
                                      $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
                                      if( @array_key_exists('oembed-url', $post_meta) || @array_key_exists('self-hosted-url', $post_meta) ):
                                          if( array_key_exists('oembed-url', $post_meta) ):
                                              echo "<div class='dt-video-wrap'>".wp_oembed_get($post_meta['oembed-url']).'</div>';
                                          elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                              echo "<div class='dt-video-wrap'>".apply_filters( 'the_content', $post_meta['self-hosted-url'] ).'</div>';
                                          endif;
                                      endif;
                                elseif( $format === "audio" ):
                                      $post_meta =  get_post_meta(get_the_id() ,'_dt_post_settings', true);
                                      if( @array_key_exists('oembed-url', $post_meta) || @array_key_exists('self-hosted-url', $post_meta) ):
                                          if( array_key_exists('oembed-url', $post_meta) ):
                                              echo wp_oembed_get($post_meta['oembed-url']);
                                          elseif( array_key_exists('self-hosted-url', $post_meta) ):
                                              echo apply_filters( 'the_content', $post_meta['self-hosted-url'] );
                                          endif;
                                      endif;
                                else: ?>
                                  <a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php
                                      if( has_post_thumbnail() ):
                                          $attr = array('title' => get_the_title()); the_post_thumbnail($feature_image, $attr);
                                      else:?>
                                          <img src="http://placehold.it/1170x800&text=Image" width="1170" height="800" alt="<?php the_title(); ?>" />
                                  <?php endif;?>
                                  	<div class="blog-image-overlay"><span class="image-overlay-inside"></span></div>
                                  </a>
                          <?php endif; ?>
                          <!-- POST FORMAT ENDS -->
                      </div>
                      <div class="entry-details">
                          <div class="entry-title">
                              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                          </div>
							 
             	             
                          <div class="entry-body">
	                          <?php the_excerpt(); ?>
                          </div>
						  <?php the_tags('<div class="tags"><span class="fa fa-tags"> </span> '.__('Posted In: ', 'iamd_text_domain'), '', '</div>');?>
                      </div>
                  </div>
              </article>
          </div><?php
	 endwhile;
	 echo '</div>';
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