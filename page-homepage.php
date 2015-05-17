<?php
/*
Template Name: Transatlantic Poetry
*/
remove_filter( 'the_content', 'sharing_display', 19 );
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">

				<div id="main" class="span12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					
						<header>

							<?php 
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-home' );
							?>
						
							<div class="hero-unit transatlantic-banner" style="background: url('http://www.transatlanticpoetry.com/files/2014/03/atlantic-1024-300.jpg');" >

								<?php the_content(); ?>
							
							</div>

						</header> <!-- end article header -->

					</article> <!-- end article -->
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->

                <?php 
                $youtube = get_post_meta($post->ID, 'youtube', TRUE);
                $live = get_post_meta($post->ID, 'live', TRUE);
                $qna = get_post_meta($post->ID, 'qna', TRUE);
                $next_reading = get_post_meta($post->ID, 'next_reading', TRUE);
                $next_reading_url = get_post_meta($post->ID, 'next_reading_url', TRUE);
		if (function_exists('mvc_model')) {
			$reading_model = mvc_model('Reading');
            		$reading_obj = $reading_model->find_one(array('conditions' => array(
                                    		'Reading.date >=' => date('Y-m-d')
                            		)));
			if (is_object($reading_obj)) { //an upcoming reading exists
				$next_reading = $reading_obj->date.' '.$reading_obj->time;
				$next_reading_url = $reading_obj->url;
				if ($reading_obj->date == date('Y-m-d')) { //the reading is today
					$youtube = $reading_obj->video_url;
				}
				//the reading is currently happening
				if (time() > strtotime($next_reading) && strtotime($next_reading) > (time() + 3600)) {
					$qna = $next_reading_url;
					$live = '1';
				}
			}
		}
                ?>
                <?php if(strlen($next_reading) > 0 && strlen($live) == 0): 
                        date_default_timezone_set('Europe/London');
                        $time = (strtotime($next_reading) - time());
                ?>
                <a name="countdown-timer"></a>
                <div class="span12 clearfix" style="margin-left: 0;" id="countdown-clock-wrapper">
                    <h3>Next Broadcast</h3>
                    <div id="countdown-clock" class="span8 offset2"></div>
                </div>
                <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/flipclock.css">
                <style type="text/css">.flip-clock-wrapper ul li {line-height: normal;}</style>
                <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/flipclock/libs/prefixfree.min.js"></script>
                <script src="<?php echo get_stylesheet_directory_uri(); ?>/js/flipclock/flipclock.min.js"></script>
                <script>
                if(jQuery(window).width() < 680) {
                    jQuery('#countdown-clock-wrapper').hide();
                } else {
                    var time = <?php echo $time; ?>;
                    var clock = jQuery('#countdown-clock').FlipClock( time, {
                                clockFace: 'DailyCounter',
                                countdown: true
                    });
                }
                </script>
                <?php endif; ?>
                <?php if (strlen($youtube) > 0): ?>
                <a name="video"></a>
				    <div id="video" class="span12 clearfix" role="video">
                        <div class="video-banner roundblack">
                            <?php if (strlen($live) > 0): ?>
                                <div class="live">&#9679; LIVE</div>
                            <?php endif; ?>
                            <?php echo do_shortcode('[youtube='.$youtube.']'); ?>
                        </div>
                        <?php if (strlen($qna) > 0): ?>
                            <div class="pagination-centered">
                                <div class="btn-group">
                                    <a href="<?php echo $qna; ?>" target="_blank" class="btn btn-inverse">
                                        Click here to ask a question in the LIVE Q&amp;A
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(strlen($tweet) > 0): ?>
                            <div class="pagination-centered">
                                <div class="btn-group">
                                    <a href="https://twitter.com/intent/tweet?button_hashtag=tapoetry" class="btn btn-inverse" data-size="large"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twitter.png"> Tweet #tapoetry</a><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                    <?php 
                    /* for display of upcoming event banners */
                    $p = get_page_by_path('upcoming-readings');
                    ?>
                    <?php if($p->post_status == 'publish'): ?>
                        <div id="event-banners" class="span12 clearfix">
                        <h2>Upcoming Events</h2> 
                        <?php 
                        echo apply_filters('the_content', $p->post_content);
                        edit_post_link('Edit '.$p->post_title, '<p>', '</p>',$p->ID);
                        ?>
                        </div>
                    <?php endif; ?>
    
<section class="row-fluid post_content">
        <div class="span8">
                <h2>Latest News</h2> 
                <?php wp_reset_query(); ?>
                <?php query_posts( array('posts_per_page' => 10) ); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); 
                                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                                $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                                $url = $thumb['0'];
                    ?>
                    <?php if($wp_query->current_post > 0): ?>
                        <hr />
                    <?php endif; ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						
						<header>
							
							<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="alignleft rounded" width="150" height="150" />
                        </a>
							
						</header> <!-- end article header -->
					
						<section class="post_content">
						
							<?php the_excerpt(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
    
					
					<?php endwhile; ?>	
                    <p><a href="/news">All News</a></p>
                    <?php endif; ?>

					
        </div>
	<?php get_sidebar('main'); ?>
    </section>

        <br style="clear: both;" />
                    <?php 
                    /* get links in the tapoetry category 
                    * for display of upcoming event banners */
                    $bookmarks = get_bookmarks( array( 'category_name' => 'Transatlantic Poetry',
                                          'hide_invisible'       => 0,
                                          'orderby'       => 'rating',
                                          'order'         => 'ASC' ) );
                    $bookmarks_count = sizeof($bookmarks);
                    ?>
                    <a href="/readings/">Past Events</a>

<?php get_footer(); ?>
