<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Egesto Lite
 */
?>

<div id="footer">
  <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
  <div id="footerinner">
    <div id="footerwidgets">
      <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div>
  </div>
  <?php endif ?>
  <div id="copyinfo">
    <?php if ( has_nav_menu( 'social' ) ) {
					wp_nav_menu(
						array(
							'theme_location'  => 'social',
							'container'       => 'div',
							'container_id'    => 'menu-social',
							'container_class' => 'menu',
							'menu_id'         => 'menu-social-items',
							'menu_class'      => 'menu-items',
							'depth'           => 1,
							'link_before'     => '<span class="screen-reader-text">',
							'link_after'      => '</span>',
							'fallback_cb'     => '',
						)
					);
	} ?>
    &copy; <?php echo date_i18n(__('Y','egesto-lite')); ?>
    <?php bloginfo('name'); ?>
    . <a href="<?php echo esc_url( esc_html__( 'http://wordpress.org/', 'egesto-lite' ) ); ?>"> <?php printf( esc_html__( 'Powered by %s.', 'egesto-lite' ), 'WordPress' ); ?> </a> <?php printf( esc_html__( 'Theme by %1$s.', 'egesto-lite' ), '<a href="http://www.vivathemes.com/" rel="designer">Viva Themes</a>' ); ?>  </div>
</div>
</div>
<?php wp_footer(); ?>
</body></html>