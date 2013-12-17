<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2>Barometer Feedback Settings</h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<!-- main content -->
			<div id="post-body-content">
				
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<h3><span>Instructions</span></h3>
						<div class="inside">
							<ol>
								<li>
									Get a unique load string from <a href="http://getbarometer.com" alt="Get Barometer">getbarometer.com</a> <br>
								</li>
								<li>
									<strong>Add your Barometer Load String</strong> Over there --> 
								</li>
							</ol>						
								
						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../images/barometer-setup.gif' ; ?>" width="100%" alt="Fancy instructions">
			</div> <!-- post-body-content -->


			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					
					<div class="postbox">
					
						<h3><span>Enter Barometer String</span></h3>
						<?php if (isset ( __$POST)): ?>
							
						<?php endif ?>
						<div class="inside">
							<form action="options-general.php?barometer-feedback.php" method="post">
		 						<input name="barometer_string" id="" type="text" value="" /> 
		 						<input class="button-primary" type="submit" name="Submit" value="<?php _e( 'Add' ); ?>" /> 							
		 					</form>
						</div> <!-- .inside -->
						
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
			
		</div> <!-- #post-body .metabox-holder .columns-2 -->
		
		<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->
