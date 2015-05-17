		<br style="clear: both;" />	
            <footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix">
		          <hr />
		          <div id="widget-footer" class="clearfix row-fluid">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>
					
					<nav class="clearfix">
						<?php bones_footer_links(); // Adjust using Menus in Wordpress Admin ?>
					</nav>

					<p class="attribution">
                        &copy; 2013-<?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                    </p>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>
        <style type="text/css">#infinite-footer{display:none;}</style>

        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1 id="myModalLabel">Live Now</h1>
              </div>
              <div class="modal-body">
                    <img src="/wp-admin/images/spinner.gif" alt="Loading..." />
              </div>
              <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
              </div>
        </div> 

        <script type="text/javascript">
                function checkLiveNow() {
                    $.ajax({
                        url: '/readings/liveNow/'
                    }).done( function( result ) {
                        if (result && result != false && result.length > 0 && result != 'false') {
                            $('#myModal').modal({'remote':'/readings/liveNow/'})
                        } else {
                            window.setTimeout( checkLiveNow, 10000 );
                        }
                    });
                }
                $( document ).ready(function() {
                    checkLiveNow();
                });
        </script>

	</body>
</html>
