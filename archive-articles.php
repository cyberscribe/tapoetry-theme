                    <div id="articles">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); 
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
                                    $alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);
                                    $url = $thumb['0'];
                                    if (strlen($url) == 0) {
                                        $url = '/wp-content/themes/rp-bootstrap/thumbnail.php?r='.rand(0,30);
                                    }
                        ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" class="hentry">

                            
                            <header>
                                
                                <h3 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" entry-title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3>

                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" class="alignleft rounded" width="150" height="150" />
                                <div class="thumbshader"></div>
                            </a>
                                
                                <p class="meta"><?php _e("Posted", "bonestheme"); ?> <abbr class="published updated" title="<?php echo the_time('Y-m-j\TH:i:s\Z'); ?>" updated="<?php the_date(); ?>" datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></abbr> <?php _e("by", "bonestheme"); ?> <span class="vcard author"><span class="fn"><?php the_author(); ?></span></span>.</p>
                            
                            </header> <!-- end article header -->
                        
                            <section class="post_content">
                            
                                <?php the_excerpt(); ?>
                        
                            </section> <!-- end article section -->
                            
                            <footer>
                                
                            </footer> <!-- end article footer -->
                        
                        </article> <!-- end article -->
                        
                        <?php endwhile; ?>	
					
								
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("No Posts Yet", "bonestheme"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, What you were looking for is not here.", "bonestheme"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
                    </div> <!-- end #articles -->
