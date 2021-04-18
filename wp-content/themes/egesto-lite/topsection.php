<?php
/**
 * The Custom background.
 *
 *
 * @package Egesto Lite
 */
?>

<div id="headerbg" class="animatedParent animateOnce">
  	<?php if ( has_header_image() ) { ?>
  		<div id="headerimage" class="animated fadeIn" style="background-image: url(<?php header_image(); ?>);"></div>
  	<?php } ?>
  		<div id="topcontent" class="animated fadeInUpShort delay-500">
    		<h2 class="site-description">
          					<?php bloginfo( 'description' ); ?>
        				</h2>
            
            <?php if ( has_nav_menu( 'front-menu' ) ) {
    				wp_nav_menu( 
						array( 
							'theme_location' => 'front-menu', 
							'container_id'   => 'frontmenu',
							'fallback_cb'	 => false
						)
					);
  					} ?>
  		</div>
        <div id="bottomgradient"></div>
</div>
