<?php
/**
 * The Header for our theme.
 *
 *
 * @package Egesto Lite
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=2.0, user-scalable=yes" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="container">
		<div id="header">
  			<div id="headerin">
    			<div id="headerline">

                    <div id="logo">
        				<?php the_custom_logo(); ?>
        				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        					<h1 class="site-title">
          						<?php bloginfo( 'name' ); ?>
        					</h1>
        				</a>
        				
      				</div>

	  				<?php if ( has_nav_menu( 'main-menu' ) ) {
    				wp_nav_menu( 
						array( 
							'theme_location' => 'main-menu', 
							'container_id'   => 'mainmenu',
							'menu_class' 	 => 'superfish sf-menu',
							'fallback_cb'	 => false
						)
					);
  					} ?>
    		</div>
  		</div>
        
        <?php if ( has_nav_menu( 'main-menu' ) ) {

					wp_nav_menu(
						array(
							'theme_location' => 'main-menu',
							'container_class'   => 'mmenu',
							'menu_class' 	 => 'navmenu',
							'fallback_cb'	 => false
					)
					);
  					} ?>

  		<?php if (is_front_page()) {
  			get_template_part( 'topsection' );
		} ?>
	</div>
