<?php get_header(); ?>
			
			<div id="content" class="clearfix row-fluid">
			
				<div id="main" class="span12 clearfix" role="main">
				
					<div class="page-header">
					<?php if (is_category()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts Categorized:", "bonestheme"); ?></span> <?php single_cat_title(); ?>
						</h1>
                    <?php } elseif (is_tax('poets')) { ?>
                        <?php   $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                                $names = explode(' ',$term->name);
                                $last = array_pop($names);
                                $first = implode(' ',$names);
                        ?>
                        <?php if($term->description): ?>
                            <div class="hero-unit">
                                <?php echo $term->description; ?>
                            </div>
                        <?php else: ?>
                            <span class="vcard" itemprop="description" itemscope="" itemtype="http://schema.org/Person">
                                <h1 class="archive_title h2">
                                    Posts About 
                                    <span class="full-name fn" itemprop="name">
                                        <span class="given-name" itemprop="givenName"><?php echo $first; ?></span>
                                        <span class="family-name" itemprop="familyName"><?php echo $last; ?></span>
                                    </span>
                                    (<span class="job-title" itemprop="jobTitle">Poet</span>)
                                </h1>
                            </span>
                        <?php endif; ?>
					<?php } elseif (is_tag()) { ?> 
						<h1 class="archive_title h2">
							<span><?php _e("Posts Tagged:", "bonestheme"); ?></span> <?php single_tag_title(); ?>
						</h1>
					<?php } elseif (is_author()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Posts By:", "bonestheme"); ?></span> <?php get_the_author_meta('display_name'); ?>
						</h1>
					<?php } elseif (is_day()) { ?>
						<h1 class="archive_title h2">
							<span><?php _e("Daily Archives:", "bonestheme"); ?></span> <?php the_time('l, F j, Y'); ?>
						</h1>
					<?php } elseif (is_month()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Monthly Archives:", "bonestheme"); ?>:</span> <?php the_time('F Y'); ?>
					    </h1>
					<?php } elseif (is_year()) { ?>
					    <h1 class="archive_title h2">
					    	<span><?php _e("Yearly Archives:", "bonestheme"); ?>:</span> <?php the_time('Y'); ?>
					    </h1>
					<?php } ?>
					</div>
                    
                    <?php include('archive-articles.php'); ?>

                    <noscript>
                        <?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
                            
                            <?php page_navi(); // use the page navi function ?>

                        <?php } else { // if it is disabled, display regular wp prev & next links ?>
                            <nav class="wp-prev-next">
                                <ul class="clearfix">
                                    <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "bonestheme")) ?></li>
                                    <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "bonestheme")) ?></li>
                                </ul>
                            </nav>
                        <?php } ?>
                    </noscript>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
