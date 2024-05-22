<?php 
/**
 *
 * Core Functions
 * 
 * @author Codevz
 * @link http://codevz.com/
 * 
 * Text Domain: xtra
 */
if ( ! class_exists( 'Codevz' ) ) {
	class Codevz {

		// Defines
		public static $meta_id = 'codevz_page_meta', $options_id = 'codevz_theme_options', $elm_id = 0, $dir, $uri, $suri, $post, $transient, $is_rtl, $array_pages, $is_customize, $excerpt;

		public function __construct() {

			// Defines
			self::$dir = trailingslashit( get_template_directory() );
			self::$uri = get_template_directory_uri();
			self::$suri = trailingslashit( get_stylesheet_directory() );
			self::$post = &$GLOBALS['post'];
			self::$is_rtl = ( is_rtl() || self::option( 'rtl' ) );
			self::$transient = 'codevz_transient_x10_';
			self::$is_customize = is_customize_preview();
			self::$array_pages = array();
			if ( is_admin() || self::$is_customize ) {
				self::$array_pages = array( '' => esc_html__( 'Select Page', 'xtra' ) );
				$pages = (array) get_posts( 'post_type="page"&numberposts=-1' );
				foreach ( $pages as $page ) {
					if ( isset( $page->post_title ) ) {
						self::$array_pages[ $page->post_title ] = $page->post_title;
					}
				}
			}

			// Required files
			require_once self::$dir . 'includes/tgm.php';
			require_once self::$dir . 'includes/options.php';

			// Show notice for memory limit
			if ( (int) ini_get( 'memory_limit' ) < 128 ) {
				add_action( 'admin_notices', function() { ?>
					<div class="notice notice-error">
						<p><?php echo wp_kses_post( 'Your server <strong>PHP Memroy Limit</strong> is not enough, Please increase it to <strong>128M</strong>', 'xtra' ); ?><br /><?php echo wp_kses_post( 'Contact with your server technical support and ask them for increasing <strong>PHP Memroy Limit</strong>.', 'xtra' ); ?></p>
					</div>
				<?php });
			}

			// Plugins activation
			add_action( 'tgmpa_register', function() {
				tgmpa( array(
					array(
						'name'               => esc_html__( 'WPBakery Page Builder', 'xtra' ),
						'slug'               => 'js_composer',
						'source'             => 'http://xtratheme.com/0209482677_16/js_composer.zip',
						'required'           => true,
						'force_activation'   => false
					),
					array(
						'name'               => esc_html__( 'Codevz Plus', 'xtra' ),
						'slug'               => 'codevz-plus',
						'source'             => 'http://xtratheme.com/0209482677_16/codevz-plus.zip',
						'version' 			 => '1.4.5',
						'required'           => true,
						'force_activation'   => false
					),
					array(
						'name'               => esc_html__( 'Revolution Slider', 'xtra' ),
						'slug'               => 'revslider',
						'source'             => 'http://xtratheme.com/0209482677_16/revslider.zip',
						'required'           => true,
						'force_activation'   => false
					),
					array(
						'name'               => esc_html__( 'Contact form 7', 'xtra' ),
						'slug' 				=> 'contact-form-7',
						'required' 			=> false,
					),
					array(
						'name'               => esc_html__( 'Woocommerce', 'xtra' ),
						'slug' 				=> 'woocommerce',
						'required' 			=> false,
					),
				), array(
					'id' 					=> 'tgmpa',
					'default_path' 			=> '', 
					'menu' 					=> 'tgmpa-install-plugins',
					'parent_slug' 			=> 'themes.php',
					'capability' 			=> 'edit_theme_options',
					'has_notices' 			=> true,
					'dismissable' 			=> true,
					'dismiss_msg' 			=> '',
					'is_automatic'	 		=> false, 
					'message' 				=> ''
				));
			});

			// Actions
			add_action( 'after_setup_theme', array( __CLASS__, 'codevz_setup' ) );
			add_action( 'widgets_init', array( __CLASS__, 'codevz_register_sidebars' ) );
			add_action( 'wp_enqueue_scripts', array( __CLASS__, 'codevz_enqueue' ), 11 );
			add_action( 'wp_ajax_codevz_ajax_search', array( __CLASS__, 'codevz_ajax_search' ) );
			add_action( 'wp_ajax_nopriv_codevz_ajax_search', array( __CLASS__, 'codevz_ajax_search' ) );
			add_action( 'wp_ajax_codevz_selective_refresh', array( __CLASS__, 'codevz_row_inner' ) );
			add_action( 'wp_ajax_nopriv_codevz_selective_refresh', array( __CLASS__, 'codevz_row_inner' ) );
			add_action( 'nav_menu_css_class', array( __CLASS__, 'codevz_nav_class' ), 10, 2 );
			add_action( 'pre_get_posts', array( __CLASS__, 'codevz_pre_get_posts_action' ), 99 );
			add_action( 'wp_head', function() {
				if ( is_singular() && pings_open() ) {
					printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
				}
			});

			// Filters
			add_filter( 'in_widget_form', array( __CLASS__, 'codevz_in_widget_form' ), 10, 3 );
			add_filter( 'widget_update_callback', array( __CLASS__, 'codevz_widget_update_callback' ), 10, 3 );
			add_filter( 'widget_display_callback', array( __CLASS__, 'codevz_widget_display_callback' ), 10, 3 );
			add_filter( 'excerpt_length', function() {
				return self::option( 'post_excerpt', 20 );
			}, 999 );
			add_filter( 'excerpt_more', function( $more ) {
				if ( self::option( 'post_excerpt', 20 ) != '-1' ) {
					$title = esc_html( self::option( 'readmore' ) );
					$icon = esc_attr( self::option( 'readmore_icon' ) );
					$icon = $icon ? '<i class="' . $icon . '"></i>' : '';

					// Variables escaped above
					return ( $title || $icon ) ? ' ... <a class="cz_readmore' . ( $title ? '' : ' cz_readmore_no_title' ) . ( $icon ? '' : ' cz_readmore_no_icon' ) . '" href="' . esc_url( get_the_permalink( self::$post->ID ) ) . '">' . $icon . '<span>' . $title . '</span></a>' : '';
				}
			});
			
			// WooCommerce
			if ( function_exists( 'is_woocommerce' ) ) {
				add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'codevz_woo_cart' ) );
				add_filter( 'loop_shop_columns', function() { return self::option( 'woo_col', 4 ); });
				add_filter( 'woocommerce_product_query', function( $q ) {
					$q->set( 'posts_per_page', self::option( 'woo_items_per_page', 8 ) );
				});
				add_filter( 'woocommerce_show_page_title', function() { return false; });
				add_filter( 'woocommerce_output_related_products_args',  function( $i ) {
					$i['posts_per_page'] = $i['columns'] = self::option( 'woo_related_col', 3 );
					return $i;
				});
			}
		}

		/**
		 *
		 * Get meta box for any page
		 * 
		 * @return array|string|null
		 *
		 */
		public static function meta( $id = 0, $key = 0, $sub = 0 ) {
			$id = $id ? $id : ( isset( self::$post->ID ) ? self::$post->ID : 0 );
			$key = $key ? $key : self::$meta_id;
			$meta = (array) get_post_meta( $id, $key, true );

			if ( $sub ) {
				return isset( $meta[ $sub ] ) ? $meta[ $sub ] : 0;
			} else {
				return $id ? $meta : '';
			}
		}

		/**
		 *
		 * Get option from customize page
		 * 
		 * @return array|string|null
		 *
		 */
		public static function option( $key = '', $default = '', $no_cache = '' ) {
			$all = (array) get_option( self::$options_id );
			return $key ? ( empty( $all[ $key ] ) ? $default : $all[ $key ] ) : $all;
		}

		/**
		 *
		 * After setup theme
		 * 
		 * @return object
		 *
		 */
		public static function codevz_setup() {

			// Menus
			register_nav_menus(array(
				'primary' 	=> esc_html__( 'Primary', 'xtra' ), 
				'one-page' 	=> esc_html__( 'One Page', 'xtra' ), 
				'secondary' => esc_html__( 'Secondary', 'xtra' ), 
				'footer'  	=> esc_html__( 'Footer', 'xtra' ),
				'mobile'  	=> esc_html__( 'Mobile', 'xtra' ),
				'custom-1' 	=> esc_html__( 'Custom 1', 'xtra' ), 
				'custom-2' 	=> esc_html__( 'Custom 2', 'xtra' ), 
				'custom-3' 	=> esc_html__( 'Custom 3', 'xtra' )
			));

			// Theme Supports
			add_theme_support( 'title-tag' );
			add_theme_support( 'html5' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );

			// Images
			add_image_size( 'codevz_360_320', 360, 320, true ); 	// Medium
			add_image_size( 'codevz_600_600', 600, 600, true ); 	// Grid Square
			add_image_size( 'codevz_1200_500', 1200, 500, true ); 	// Blog Full
			add_image_size( 'codevz_600_1000', 600, 1000, true ); 	// Horizontal Rectangle
			add_image_size( 'codevz_600_9999', 600, 9999 ); 		// Masonry

			// Content Width
			if ( ! isset( $content_width ) ) {
				$content_width = (int) self::option( 'site_width', 1170 );
			}

			// Languages
			load_theme_textdomain( 'xtra', self::$dir . 'languages' );
		}

		/**
		 *
		 * Front-end assets
		 * 
		 * @return string
		 *
		 */
		public static function codevz_enqueue() {
			if ( ! isset( $_POST['vc_inline'] ) ) {

				// JS
				wp_enqueue_script( 'codevz-custom', self::$uri . '/js/custom.js', array( 'jquery' ), '', true );
				if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
					wp_enqueue_script( 'comment-reply' );
				}
				if ( isset( $_GET['ajax'] ) || self::option( 'ajax' ) ) {
					wp_enqueue_script( 'codevz-ajax', self::$uri . '/js/ajax.js', array( 'jquery' ), '', true );
				}

				// Custom JS
				$js = self::option( 'js' );
				if ( $js ) {
					wp_add_inline_script( 'codevz-custom', 'jQuery(document).ready(function($) {' . esc_js( $js ) . '});' );
				}

				// CSS
				wp_enqueue_style( 'codevz-style', get_stylesheet_uri() );
				wp_enqueue_style( 'font-awesome', self::$uri . '/icons/font-awesome.min.css', array(), '4.7', 'all' );

			}
		}

		/**
		 *
		 * Register theme sidebars
		 * 
		 * @return object
		 *
		 */
		public static function codevz_register_sidebars() {
			$sidebars = array( 'primary', 'secondary', 'footer-1', 'footer-2', 'footer-3', 'footer-4', 'footer-5', 'footer-6', 'offcanvas_area' );
			foreach ( (array) self::option( 'sidebars' ) as $i ) {
				if ( ! empty( $i['id'] ) ) {
					$sidebars[] = sanitize_title_with_dashes( strtolower( $i['id'] ) );
				}
			}

			foreach ( $sidebars as $id ) {
				$class = self::contains( $id, 'footer' ) ? 'footer_widget' : 'widget';
				register_sidebar( array( 
					'name'			=> esc_html( ucwords( str_replace( '-', ' ', $id ) ) ),
					'id'			=> $id,
					'before_widget'	=> '<div id="%1$s" class="' . esc_attr( $class ) . ' clr %2$s">',
					'after_widget'	=> '</div>',
					'before_title'	=> '<h4>',
					'after_title'	=> '</h4>'
				) );
			}
		}

		/**
		 *
		 * Add sticky checkbox for each widget 
		 * 
		 * @return string
		 *
		 */
		public static function codevz_in_widget_form( $widget, $return, $instance ) {
	        $hide_on_tablet = isset( $instance['hide_on_tablet'] ) ? $instance['hide_on_tablet'] : '';
	        $hide_on_mobile = isset( $instance['hide_on_mobile'] ) ? $instance['hide_on_mobile'] : '';
	        $center_on_mobile = isset( $instance['center_on_mobile'] ) ? $instance['center_on_mobile'] : '';

	        ?>
	            <p>
	                <input class="checkbox" type="checkbox" id="<?php echo esc_attr( $widget->get_field_id( 'hide_on_tablet' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'hide_on_tablet' ) ); ?>" <?php checked( true , $hide_on_tablet); ?> />
	                <label for="<?php echo esc_attr( $widget->get_field_id( 'hide_on_tablet' ) ); ?>">
	                    <?php esc_html_e( 'Hide on Tablet ?', 'xtra' ); ?>
	                </label>
	            </p>
	            <p>
	                <input class="checkbox" type="checkbox" id="<?php echo esc_attr( $widget->get_field_id( 'hide_on_mobile' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'hide_on_mobile' ) ); ?>" <?php checked( true , $hide_on_mobile); ?> />
	                <label for="<?php echo esc_attr( $widget->get_field_id( 'hide_on_mobile' ) ); ?>">
	                    <?php esc_html_e( 'Hide on Mobile ?', 'xtra' ); ?>
	                </label>
	            </p>
	            <p>
	                <input class="checkbox" type="checkbox" id="<?php echo esc_attr( $widget->get_field_id( 'center_on_mobile' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'center_on_mobile' ) ); ?>" <?php checked( true , $center_on_mobile); ?> />
	                <label for="<?php echo esc_attr( $widget->get_field_id( 'center_on_mobile' ) ); ?>">
	                    <?php esc_html_e( 'Center align on Mobile ?', 'xtra' ); ?>
	                </label>
	            </p>
	        <?php
		}

		public static function codevz_widget_update_callback( $instance, $new_instance ) {
			$new_instance['hide_on_tablet'] = empty( $new_instance['hide_on_tablet'] ) ? 0 : 1;
			$new_instance['hide_on_mobile'] = empty( $new_instance['hide_on_mobile'] ) ? 0 : 1;
			$new_instance['center_on_mobile'] = empty( $new_instance['center_on_mobile'] ) ? 0 : 1;

			return $new_instance;
		}

		public static function codevz_widget_display_callback( $instance, $widget_class, $args ) {

			$new_class = 'class="';
			$new_class .= empty( $instance['hide_on_tablet'] ) ? '' : 'hide_on_tablet ';
			$new_class .= empty( $instance['hide_on_mobile'] ) ? '' : 'hide_on_mobile ';
			$new_class .= empty( $instance['center_on_mobile'] ) ? '' : 'center_on_mobile ';
		    
			if ( empty( $instance['hide_on_tablet'] ) || empty( $instance['hide_on_mobile'] ) || empty( $instance['center_on_mobile'] ) ) {
				$args['before_widget'] = str_replace('class="', $new_class, $args['before_widget']);
				$widget_class->widget( $args, $instance );
				return false;
			} else {
				return $instance;	
			}
		}

		/**
		 *
		 * Set settings for post types
		 * 
		 * @return array
		 *
		 */
		public static function codevz_pre_get_posts_action( $q ) {
			if ( is_admin() || empty( $q ) ) {
				return $q;
			}

			$q->query[ 'post_type' ] = isset( $q->query[ 'post_type' ] ) ? $q->query[ 'post_type' ] : 'post';

			if ( ! is_admin() && $q->query[ 'post_type' ] === 'post' && $q->is_main_query() ) {
				$q->set( 'posts_per_page', self::option( 'posts_per_page', get_option( 'posts_per_page' ) ) );
			}

			// Fix Woocommerce review's when disqus plugin is activated
			if ( $q->query[ 'post_type' ] === 'product' ) { 
				remove_filter('comments_template', 'dsq_comments_template');
			}

			// Set new settings for post types
			$cpt = (array) get_option( 'codevz_post_types' );
			$cpt[] = 'portfolio';
			foreach ( $cpt as $name ) {
				$ppp = self::option( 'posts_per_page_' . $name );
				$is_cpt = ( is_post_type_archive( $name ) && $q->query[ 'post_type' ] === $name );
				$is_tax = ( is_tax( $name . '_cat' ) && isset( $q->query[ $name . '_cat' ] ) );

				if ( $ppp && ! is_admin() && ( $is_cpt || $is_tax ) ) {
					$q->set( 'posts_per_page', $ppp );
				}
			}

			// Search
			$search = self::option( 'search_cpt' );
			if ( $q->is_main_query() && $q->is_search() && $search ) {
				$q->set( 'post_type', explode( ',', str_replace( ' ', '', $search ) ) );
			}

			return $q;
		}

		/**
		 *
		 * Get current post type name
		 * 
		 * @return string
		 *
		 */
		public static function get_post_type( $id = '' ) {

			if ( is_search() || is_tag() || is_404() ) {
				$cpt = '';
			} else if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
				$cpt = 'bbpress';
			} else if ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_woocommerce() ) ) {
				$cpt = 'product';
			} else if ( function_exists( 'is_buddypress' ) && is_buddypress() ) {
				$cpt = 'buddypress';
			} else if ( get_post_type( $id ) || is_singular() ) {
				$cpt = get_post_type( $id );
			} else if ( is_tax() ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				if ( get_taxonomy( $term->taxonomy ) ) {
					$cpt = get_taxonomy( $term->taxonomy )->object_type[0];
				}
			} else if ( is_post_type_archive() ) {
				$cpt = get_post_type_object( get_query_var( 'post_type' ) )->name;
			} else {
				$cpt = 'post';
			}

			return $cpt;
		}

		/**
		 *
		 * Get post type in admin area
		 * 
		 * @return string
		 *
		 */
		public static function get_post_type_admin() {
			global $post, $typenow, $current_screen;

			if ( $post && $post->post_type ) {
				return $post->post_type;
			} else if ( $typenow ) {
				return $typenow;
			} else if ( $current_screen && $current_screen->post_type ) {
				return $current_screen->post_type;
			} else if ( isset( $_REQUEST['post_type'] ) ) {
				return sanitize_key( $_REQUEST['post_type'] );
			} else if ( isset( $_REQUEST['post'] ) ) {
				return get_post_type( $_REQUEST['post'] );
			}

			return null;
		}

		/**
		 *
		 * Get shortcode from page ID + Generate styles
		 * 
		 * @var post ID
		 * @return string
		 *
		 */
		public static function get_page_as_element( $id = '', $query = 0 ) {

			// Escape
			$id = esc_html( $id );
			$query = esc_html( $query );

			// Check
			if ( ! $id ) {
				return;
			}

			// Check if its number
			if ( ! is_numeric( $id ) ) {
				$page = get_page_by_title( $id, 'object', 'page' );
				if ( isset( $page->ID ) && ! is_page( $page->ID ) ) {
					$id = $page->ID;
				} else {
					return;
				}
			}

			// If post not exist
			if ( ! get_post_status( $id ) ) {
				return;
			}

			// Get post content by ID
			$o = get_post_field( 'post_content', $id );
			if ( $query ) {
				$o = str_replace( 'query=""', 'query="1"', $o );
			}
			
			// Get post meta
			$s = get_post_meta( $id, '_wpb_shortcodes_custom_css', 1 ) . get_post_meta( $id, 'cz_sc_styles', 1 ) . get_post_meta( $id, 'cz_sc_styles_mobile', 1 ) . get_post_meta( $id, 'cz_sc_styles_tablet', 1 );

			// Output
			if ( ! is_page( $id ) ) {
				$o = "<div data-cz-style='" . esc_attr( $s ) . "'>" . do_shortcode( $o ) . "</div>";
			} else {
				return;
			}

			return $o;
		}

		/**
		 *
		 * Get required data attributes for body
		 * 
		 * @return string
		 *
		 */
		public static function intro_attrs() {
			$i = ' data-ajax="' . admin_url( 'admin-ajax.php' ) . '"';

			// Theme Colors for live and switcher
			$i .= ' data-primary-color="' . esc_attr( self::option( 'site_color', '#4e71fe' ) ) . '"';
			$i .= ' data-primary-old-color="' . esc_attr( get_option( 'codevz_primary_color', self::option( 'site_color', '#4e71fe' ) ) ) . '"';
			$i .= ' data-secondary-color="' . esc_attr( self::option( 'site_color_sec', 0 ) ) . '"';
			$i .= ' data-secondary-old-color="' . esc_attr( get_option( 'codevz_secondary_color', 0 ) ) . '"';

			// Live customize responsive
			if ( self::$is_customize ) {
				$i .= ' data-tablet="' . esc_attr( self::option( 'responsive_breakpoint_2', '960px' ) ) . '"';
				$i .= ' data-mobile="' . esc_attr( self::option( 'responsive_breakpoint_3', '420px' ) ) . '"';
			}

			// NiceScroll
			$nice = self::option( 'nicescroll_opt' );
			if ( self::option( 'nicescroll' ) && is_array( $nice ) ) {
				$nice = $nice[0];
				$nice['zindex'] = '999';
				$nice['cursorborder'] = '0px';
				$i .= ' data-nice=\'' . json_encode( $nice, JSON_HEX_QUOT ) . '\'';
			}

			return $i;
		}

		/**
		 *
		 * WP Menu classes
		 * 
		 * @return string
		 *
		 */
		public static function codevz_nav_class( $classes, $item ) {

			$in_array = in_array( 'current_page_parent', $classes );
			$classes[] = 'cz';

			if ( in_array( 'current-menu-item', $classes ) || ( $in_array && ( is_singular( 'post' ) || is_tag() || is_category() || is_author() ) ) ) {
				$classes[] = 'current_menu';
			}

			if ( have_posts() ) { 
				$c = get_post_type_object( get_post_type( self::$post->ID ) );
				if ( ! empty( $c ) ) {
					$ms = strtolower( trim( $item->url ) );
					$ms = str_replace( home_url( '/' ), '', $ms );
					if ( ( self::contains( $ms, $c->rewrite['slug'] ) && $in_array ) || self::contains( $ms, $c->has_archive ) || self::contains( $ms, '/' . strtolower( $c->label ) ) ) {
						$classes[] = 'current_menu';
					}
				}
			}

			return $classes;
		}

		/**
		 *
		 * Get next|prev posts for single post page
		 * 
		 * @return string
		 *
		 */
		public static function next_prev_item() {
			$cpt = self::get_post_type();
			$tax = ( $cpt === 'post' ) ? 'category' : $cpt . '_cat';
			$prevPost = get_previous_post( true, '', $tax ) ? get_previous_post( true, '', $tax ) : get_previous_post();
			$nextPost = get_next_post( true, '', $tax ) ? get_next_post( true, '', $tax ) : get_next_post();

			// get_the_post_thumbnail_url( $id );
			ob_start();
			if ( $prevPost || $nextPost ) { ?>
				<ul class="next_prev clr">
					<?php if( $prevPost ) { ?>
						<li class="previous">
							<?php $prevthumbnail = get_the_post_thumbnail( $prevPost->ID, 'thumbnail' ); ?>
							<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i><h4><small>' . esc_html( self::option( 'prev_post' ) ) . '</small>%title</h4>' ); ?>
						</li>
					<?php } if( $nextPost ) { ?>
						<li class="next">
							<?php $nextthumbnail = get_the_post_thumbnail( $nextPost->ID, 'thumbnail' ); ?>
							<?php next_post_link( '%link', '<h4><small>' . esc_html( self::option( 'next_post' ) ) . '</small>%title</h4><i class="fa fa-angle-right"></i>' ); ?>
						</li>
					<?php } ?>
				</ul>
			<?php 
			}

			return ob_get_clean();
		}

		/**
		 *
		 * Enqueue google font
		 * 
		 * @return string|null
		 * 
		 */
		public static function enqueue_font( $f = '' ) {
			if ( ! $f ) {
				return;
			} else {
				$f = self::contains( $f, ';' ) ? self::get_string_between( $f, 'font-family:', ';' ) : $f;
				$f = str_replace( '=', ':', $f );
			}

			$defaults = array(
				'Arial' 			=> 'Arial',
				'Arial Black' 		=> 'Arial Black',
				'Comic Sans MS' 	=> 'Comic Sans MS',
				'Impact' 			=> 'Impact',
				'Lucida Sans Unicode' => 'Lucida Sans Unicode',
				'Tahoma' 			=> 'Tahoma',
				'Trebuchet MS' 		=> 'Trebuchet MS',
				'Verdana' 			=> 'Verdana',
				'Courier New' 		=> 'Courier New',
				'Lucida Console' 	=> 'Lucida Console',
				'Georgia, serif' 	=> 'Georgia, serif',
				'Palatino Linotype' => 'Palatino Linotype',
				'Times New Roman' 	=> 'Times New Roman'
			);

			$f = self::contains( $f, ':' ) ? $f : $f . ':100,200,300,400,500,600,700,800,900';
			$f = explode( ':', $f );
			$p = empty( $f[1] ) ? '' : ':' . $f[1];
			
			if ( ! empty( $f[0] ) && ! isset( $defaults[ $f[0] ] ) ) {
				wp_enqueue_style( 'google-font-' . sanitize_title_with_dashes( $f[0] ), '//fonts.googleapis.com/css?family=' . str_replace( ' ', '+', $f[0] ) . $p );
			}
		}

		/**
		 *
		 * SK Style + load font
		 * 
		 * @return string
		 *
		 */
		public static function sk_inline_style( $sk = '' ) {
			$sk = str_replace( 'CDVZ', '', $sk );
			if ( self::contains( $sk, 'font-family' ) ) {
				self::enqueue_font( $sk );

				// Extract font + params && Fix font for CSS
				$font = $o_font = self::get_string_between( $sk, 'font-family:', ';' );
				$font = str_replace( '=', ':', $font );
				
				if ( self::contains( $font, ':' ) ) {
					$font = explode( ':', $font );
					if ( ! empty( $font[0] ) ) {
						$sk = str_replace( $o_font, "'" . $font[0] . "'", $sk );
					}
				} else {
					$sk = str_replace( $font, "'" . $font . "'", $sk );
				}
			}

			return $sk;
		}

		/**
		 *
		 * Generate social icons
		 * 
		 * @return string
		 *
		 */
		public static function social( $out = '' ) {
			$social = self::option( 'social' );
			if ( is_array( $social ) ) {
				$tooltip = self::option( 'social_tooltip' );
				$tooltip = $tooltip ? ' ' . $tooltip : '';
				$social_inline_title = self::option( 'social_inline_title' ) ? ' cz_social_inline_title' : '';
				$out .= '<div class="cz_social ' . esc_attr( self::option( 'social_color_mode' ) . ' ' . self::option( 'social_hover_fx' ) . $social_inline_title . $tooltip ) . '">';
				foreach ( $social as $soci ) {
					$social_link_class = 'cz-' . str_replace( array( 'fa ', 'fa-', '-square', '-official', '-circle' ), '', esc_attr( $soci['icon'] ) );
					$out .= '<a class="' . esc_attr( $social_link_class ) . '" href="' . esc_url( $soci['link'] ) . '" ' . ( $tooltip ? 'data-' : '' ) . 'title="' . esc_attr( $soci['title'] ) . '" target="_blank"><i class="' . esc_attr( $soci['icon'] ) . '"></i><span>' . esc_html( $soci['title'] ) . '</span></a>';
				}
				$out .= '</div>';
			} else {
				$out .= esc_html__( 'Social icons from Options > Header > Social icons', 'xtra' );
			}

			return $out;
		}

		/**
		 *
		 * Get element for row builder 
		 * 
		 * @return string
		 *
		 */
		public static function get_row_element( $i, $m = array() ) {
			//if ( ! isset( $i['element'] ) || ( isset( $i['show_for_logged_in_users'] ) && ! is_user_logged_in() ) ) {
			if ( ! isset( $i['element'] ) ) {
				return;
			}

			// Element margin
			$margin = '';
			if ( ! empty( $i['margin'] ) ) {
				foreach ( $i['margin'] as $key => $val ) {
					$margin .= $val ? 'margin-' . esc_attr( $key ) . ': ' . esc_attr( $val ) . ';' : '';
				}
			}

			// Classes of element
			$elm_class = empty( $i['vertical'] ) ? '' : ' cz_vertical_elm';
			$elm_class .= empty( $i['elm_on_sticky'] ) ? '' : ' ' . $i['elm_on_sticky'];
			$elm_class .= empty( $i['hide_on_mobile'] ) ? '' : ' hide_on_mobile';
			$elm_class .= empty( $i['hide_on_tablet'] ) ? '' : ' hide_on_tablet';
			$elm_class .= empty( $i['elm_center'] ) ? '' : ' cz_elm_center';

			// Start element
			$elm = $i['element'];
			$elm_unique = esc_attr( $elm . '_' . $m['id'] );
			$data_settings = self::$is_customize ? " data-settings='" . json_encode( $i, JSON_HEX_APOS ) . "'" : '';
			echo '<div class="cz_elm ' . esc_attr( $elm_unique . $m['depth'] . ' inner_' . $elm_unique . $m['inner_depth'] . $elm_class ) . '" style="' . esc_attr( $margin ) . '"' . wp_kses_post( $data_settings ) . '>';

			// Check element
			if ( $elm === 'logo' || $elm === 'logo_2' ) {

				$logo = self::option( $elm );

				if ( $logo ) {
					echo '<div class="logo_is_img ' . esc_attr( $elm ) . '"><a href="' . esc_url( home_url( '/' ) ) . '"><img src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" width="200" height="200"' . ( empty( $i['logo_width'] ) ? '' : ' style="width: ' . esc_attr( $i['logo_width'] ) . '"' ) . '></a>';
				} else {
					echo '<div class="logo_is_text ' . esc_attr( $elm ) . '"><a href="' . esc_url( home_url( '/' ) ) . '"><h1>' . esc_html( get_bloginfo( 'name' ) ) . '</h1></a>';
				}

				$logo_tooltip = self::option( 'logo_hover_tooltip' );
				if ( $logo_tooltip && $m['id'] !== 'header_4' && $m['id'] !== 'header_5' ) {
					echo '<div class="logo_hover_tooltip">' . self::get_page_as_element( esc_html( $logo_tooltip ) ) . '</div>';
				}
				
				echo '</div>';

			} else if ( $elm === 'menu' ) {

				$type = empty( $i['menu_type'] ) ? 'cz_menu_default' : $i['menu_type'];
				if ( $type === 'offcanvas_menu_left' ) {
					$type = 'offcanvas_menu inview_left';
				} else if ( $type === 'offcanvas_menu_right' ) {
					$type = 'offcanvas_menu inview_right';
				}

				$menu_title = isset( $i['menu_title'] ) ? $i['menu_title'] : '';
				$menu_icon = empty( $i['menu_icon'] ) ? 'fa fa-bars' : $i['menu_icon'];
				$icon_style = empty( $i['sk_menu_icon'] ) ? '' : $i['sk_menu_icon'];
				$menu_icon_class = $menu_title ? ' icon_plus_text' : '';

				// Add icon and mobile menu
				if ( $type && $type !== 'offcanvas_menu' && $type !== 'cz_menu_default' ) {
					echo '<i class="' . esc_attr( $menu_icon . ' icon_' . $type . $menu_icon_class ) . '" style="' . esc_attr( $icon_style ) . '">' . esc_html( $menu_title ) . '</i>';
				}
				echo '<i class="' . esc_attr( $menu_icon . ' hide icon_mobile_' . $type . $menu_icon_class ) . '" style="' . esc_attr( $icon_style ) . '">' . esc_html( $menu_title ) . '</i>';

				// Default
				if ( empty( $i['menu_location'] ) ) {
					$i['menu_location'] = 'primary';
				}

				// Check for meta box and set one page instead primary
				if ( $i['menu_location'] === 'primary' && self::meta( 0, 0, 'one_page' ) ) {
					$i['menu_location'] = 'one-page';
				}

				// Menu
				$nav = array(
					'theme_location' 	=> esc_attr( $i['menu_location'] ),
					'cz_row_id' 		=> esc_attr( $m['id'] ),
					'container' 		=> false,
					'fallback_cb' 		=> '',
					'items_wrap' 		=> '<ul id="' . esc_attr( $elm_unique ) . '" class="sf-menu clr ' . esc_attr( $type ) . '" data-indicator="' . esc_attr( self::get_string_between( self::option( '_css_menu_indicator_a_' . $m['id'] ), '_class_indicator:', ';' ) ) . '" data-indicator2="' . esc_attr( self::get_string_between( self::option( '_css_menu_ul_indicator_a_' . $m['id'] ), '_class_indicator:', ';' ) ) . '">%3$s</ul>'
				);
				if ( class_exists( 'Codevz_Walker_nav' ) ) {
					$nav['walker'] = new Codevz_Walker_nav();
				}
				wp_nav_menu( $nav );

			} else if ( $elm === 'social' ) {

				// Escaped in social()
				echo Codevz::social();

			} else if ( $elm === 'image' && isset( $i['image'] ) ) {

				$link = empty( $i['image_link'] ) ? '' : $i['image_link'];
				$width = empty( $i['image_width'] ) ? 'auto' : $i['image_width'];
				if ( $link ) {
					echo '<a class="elm_h_image" href="' . esc_url( $link ) . '"><img src="' . esc_url( $i['image'] ) . '" alt="image" width="' . esc_attr( $width ) . '" height="200" /></a>';
				} else {
					echo '<img src="' . esc_url( $i['image'] ) . '" alt="#" width="' . esc_attr( $width ) . '" height="200" />';
				}

			} else if ( $elm === 'icon' ) {

				$link = isset( $i['it_link'] ) ? $i['it_link'] : '';

				$text_style = empty( $i['sk_it'] ) ? '' : self::sk_inline_style( $i['sk_it'] );
				$icon_style = empty( $i['sk_it_icon'] ) ? '' : $i['sk_it_icon'];

				if ( $link ) {
					echo '<a class="elm_icon_text" href="' . esc_url( $link ) . '">';
				} else {
					echo '<div class="elm_icon_text">';
				}

				if ( ! empty( $i['it_icon'] ) ) {
					echo '<i class="' . esc_attr( $i['it_icon'] ) . '" style="' . esc_attr( $icon_style ) . '"></i>';
				}

				if ( ! empty( $i['it_text'] ) ) {
					echo '<span class="' . esc_attr( empty( $i['it_icon'] ) ? '' : 'ml10' ) . '" style="' . esc_attr( $text_style ) . '">' . do_shortcode( wp_kses_post( str_replace( '%year%', current_time( 'Y' ), $i['it_text'] ) ) ) . '</span>';
				} else {
					echo '<span></span>';
				}
				
				if ( $link ) {
					echo '</a>';
				} else {
					echo '</div>';
				}

			} else if ( $elm === 'search' ) {

				$icon_style = empty( $i['sk_search_icon'] ) ? '' : $i['sk_search_icon'];
				$icon_in_style = empty( $i['sk_search_icon_in'] ) ? '' : $i['sk_search_icon_in'];
				$input_style = empty( $i['sk_search_input'] ) ? '' : $i['sk_search_input'];
				$outer_style = empty( $i['sk_search_con'] ) ? '' : $i['sk_search_con'];
				$ajax_style = empty( $i['sk_search_ajax'] ) ? '' : $i['sk_search_ajax'];
				$icon = empty( $i['search_icon'] ) ? 'fa fa-search' : $i['search_icon'];
				$ajax = empty( $i['ajax_search'] ) ? '' : ' cz_ajax_search';

				$form_style = empty( $i['search_form_width'] ) ? '' : 'width: ' . esc_attr( $i['search_form_width'] );

				$i['search_type'] = empty( $i['search_type'] ) ? 'form' : $i['search_type'];
				$i['search_placeholder'] = empty( $i['search_placeholder'] ) ? '' : $i['search_placeholder'];

				echo '<div class="search_with_icon search_style_' . esc_attr( $i['search_type'] . $ajax ) . '">';
				echo self::contains( esc_attr( $i['search_type'] ), 'form' ) ? '' : '<i class="' . esc_attr( $icon ) . '" style="' . esc_attr( $icon_style ) . '"></i>';

				echo '<div class="outer_search" style="' . esc_attr( $outer_style ) . '"><div class="search" style="' . esc_attr( $form_style ) . '">'; ?>
					<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" autocomplete="off">
						<?php 
							if ( $i['search_type'] === 'icon_full' ) {
								echo '<span' . ( empty( $i['sk_search_title'] ) ? '' : ' style="' . esc_attr( self::sk_inline_style( $i['sk_search_title'] ) ) . '"' ) . '>' . esc_html( $i['search_placeholder'] ) . '</span>';
								$i['search_placeholder'] = '';
							}
						?>
						<input name="nonce" type="hidden" value="<?php echo wp_create_nonce('ajax_search_nonce'); ?>" />
						<input name="cpt" type="hidden" value="<?php echo empty( $i['search_cpt'] ) ? '' : esc_attr( $i['search_cpt'] ); ?>" />
						<input class="ajax_search_input" name="s" type="text" placeholder="<?php echo esc_attr( $i['search_placeholder'] ); ?>" style="<?php echo esc_attr( $input_style ); ?>">
						<button type="submit"><i class="fa fa-search" style="<?php echo esc_attr( $icon_in_style ); ?>"></i></button>
					</form>
					<div class="ajax_search_results" style="<?php echo esc_attr( $ajax_style ); ?>"></div>
				</div><?php
				echo '</div></div>';

			} else if ( $elm === 'widgets' ) {

				$con_style = empty( $i['sk_offcanvas'] ) ? '' : $i['sk_offcanvas'];
				$icon_style = empty( $i['sk_offcanvas_icon'] ) ? '' : $i['sk_offcanvas_icon'];
				$icon = empty( $i['offcanvas_icon'] ) ? 'fa fa-bars' : $i['offcanvas_icon'];

				echo '<div class="offcanvas_container"><i class="' . esc_attr( $icon ) . '" style="' . esc_attr( $icon_style ) . '"></i><div class="offcanvas_area offcanvas_original ' . ( empty( $i['inview_position_widget'] ) ? 'inview_left' : esc_attr( $i['inview_position_widget'] ) ) . '" style="' . esc_attr( $con_style ) . '">';
				if ( is_active_sidebar( 'offcanvas_area' ) ) {
					dynamic_sidebar( 'offcanvas_area' );  
				}
				echo '</div></div>';

			} else if ( $elm === 'hf_elm' ) {

				$con_style = empty( $i['sk_hf_elm'] ) ? '' : $i['sk_hf_elm'];
				$icon_style = empty( $i['sk_hf_elm_icon'] ) ? '' : $i['sk_hf_elm_icon'];
				$icon = empty( $i['hf_elm_icon'] ) ? 'fa fa-bars' : $i['hf_elm_icon'];

				echo '<i class="hf_elm_icon ' . esc_attr( $icon ) . '" style="' . esc_attr( $icon_style ) . '"></i><div class="hf_elm_area" style="' . esc_attr( $con_style ) . '"><div class="row clr">' . ( empty( $i['hf_elm_page'] ) ? '' : self::get_page_as_element( esc_html( $i['hf_elm_page'] ) ) ) . '</div></div>';

			} else if ( $elm === 'shop_cart' ) {

				if ( function_exists( 'is_woocommerce' ) ) {
					$icon_style = empty( $i['sk_shop_icon'] ) ? '' : $i['sk_shop_icon'];
					$icon = empty( $i['shopcart_icon'] ) ? 'fa fa-shopping-basket' : $i['shopcart_icon'];

					$woo_style = empty( $i['sk_shop_count'] ) ? '' : '.cz_cart_count, .cart_1 .cz_cart_count{' . esc_attr( $i['sk_shop_count'] ) . '}';
					$woo_style .= empty( $i['sk_shop_content'] ) ? '' : '.cz_cart_items{' . esc_attr( $i['sk_shop_content'] ) . '}';

					echo '<div class="elms_shop_cart ' . ( empty( $i['shopcart_type'] ) ? '' : esc_attr( $i['shopcart_type'] ) ) . '" data-cz-style="' . esc_attr( $woo_style ) . '">';
					echo '<a class="shop_icon noborder" href="' . esc_url( wc_get_cart_url() ) . '">';
					echo '<i class="' . esc_attr( $icon ) . '" style="' . esc_attr( $icon_style ) . '"></i>';
					echo '</a><div class="cz_cart"></div>';
					echo '</div>';
				} else {
					echo esc_html__( 'Woocommerce not installed', 'xtra' );
				}

			} else if ( $elm === 'line' && isset( $i['line_type'] ) ) {

				$line = empty( $i['sk_line'] ) ? '' : $i['sk_line'];
				echo '<div class="' . esc_attr( $i['line_type'] ) . '" style="' . esc_attr( $line ) . '">&nbsp;</div>';

			} else if ( $elm === 'button' ) {

				$elm_uniqid = 'cz_btn_' . rand( 11111, 99999 );
				$btn_css = empty( $i['sk_btn'] ) ? '' : $i['sk_btn'];
				$btn_hover = empty( $i['sk_btn_hover'] ) ? '' : '.' . esc_attr( $elm_uniqid ) . ':hover{' . str_replace( ';', ' !important;', $i['sk_btn_hover'] ) . '}';
				echo '<a class="cz_header_button ' . esc_attr( $elm_uniqid ) . '" href="' . ( empty( $i['btn_link'] ) ? '' : esc_url( $i['btn_link'] ) ) . '" style="' . esc_attr( $btn_css ) . '" data-cz-style="' . esc_attr( $btn_hover ) . '">' . esc_html( empty( $i['btn_title'] ) ? 'Button' : $i['btn_title'] ) . '</a>';

			} else if ( $elm === 'custom' && isset( $i['custom'] ) ) {

				echo do_shortcode( esc_html( $i['custom'] ) );

			} else if ( $elm === 'wpml' ) {

				if ( function_exists('icl_get_languages') ) {
					$wpml = icl_get_languages( 'skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str' );
					if ( is_array( $wpml ) ) {
						$bg = empty( $i['wpml_background'] ) ? '' : 'background: ' . esc_attr( $i['wpml_background'] ) . '';
						echo '<div class="cz_language_switcher"><div style="' . esc_attr( $bg ) . '">';
						foreach ( $wpml as $lang => $vals ) {
							if ( ! empty( $vals ) ) {

								$class = $vals['active'] ? 'cz_current_language' : '';
								if ( empty( $i['wpml_title'] ) ) {
									$title = $vals['translated_name'];
								} else if ( $i['wpml_title'] !== 'no_title' ) {
									$title = ucwords( $vals[ $i['wpml_title'] ] );
								} else {
									$title = '';
								}
								$color = ( empty( $i['wpml_color'] ) || $class ) ? '' : 'color: ' . esc_attr( $i['wpml_color'] );

								if ( !empty( $i['wpml_flag'] ) ) {
									echo '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $vals['url'] ) . '" style="' . esc_attr( $color ) . '"><img src="' . esc_url( $vals['country_flag_url'] ) . '" alt="#" width="200" height="200" class="' . esc_attr( $title ? 'mr8' : '' ) . '" />' . esc_html( $title ) . '</a>';
								} else {
									echo '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $vals['url'] ) . '" style="' . esc_attr( $color ) . '">' . esc_html( $title ) . '</a>';
								}

							}
						}
						echo '</div></div>';
					}
				} else {
					echo esc_html__( 'WPML plugin not installed', 'xtra' );
				}

			} else if ( $elm === 'custom_element' && ! empty( $i['header_elements'] ) ) {

				// Custom page as element
				echo self::get_page_as_element( esc_html( $i['header_elements'] ) );

			} else if ( $elm === 'avatar' ) {

				$sk_avatar = empty( $i['sk_avatar'] ) ? '' : $i['sk_avatar'];
				$link = empty( $i['avatar_link'] ) ? '' : $i['avatar_link'];
				$size = empty( $i['avatar_size'] ) ? '' : $i['avatar_size'];

				echo '<a class="cz_user_gravatar" href="' . esc_url( $link ) . '" style="' . esc_attr( $sk_avatar ) . '">';
				if ( is_user_logged_in() ) {
					global $current_user;
					echo get_avatar( esc_html( $current_user->user_email ), esc_attr( $size ) );
				} else {
					echo get_avatar( 'xxx@xxx.xxx', esc_attr( $size ) );
				}
				echo '</a>';
			}

			// Close element
			echo '</div>';
		}

		/**
		 *
		 * Get WooCommerce cart in header
		 * 
		 * @return string
		 *
		 */
		public static function codevz_woo_cart( $fragments ) {
			$wc = WC();
			$count = sprintf( _n( '%d', '%d', $wc->cart->cart_contents_count, 'xtra' ), $wc->cart->cart_contents_count );
			$total = $wc->cart->get_cart_total();

			ob_start(); ?>
				<div class="cz_cart">
					<?php if ( $count > 0 ) { ?>
					<span class="cz_cart_count"><?php echo esc_html( $count ); ?> <span> - <?php echo esc_html( $total ); ?></span></span>
					<?php } ?>
					<div class="cz_cart_items"><div>
				        <?php if ( $wc->cart->cart_contents_count == 0 ) { ?>
					    	<div class="cart_list">
					    		<div class="item_small">No products in the cart.</div>
					    	</div>
					    <?php $fragments['.cz_cart'] = ob_get_clean(); return $fragments; } else { ?>
				        	<div class="cart_list">
				        		<?php foreach( $wc->cart->cart_contents as $cart_item_key => $cart_item ) { $id = $cart_item['product_id']; ?>
						            <div class="item_small">
						                <a href="<?php echo esc_url( get_permalink( $id ) ); ?>">
						                	<?php $thumbnail_id = $cart_item['variation_id'] ? $cart_item['variation_id'] : $id; ?>
						                	<?php echo get_the_post_thumbnail( $thumbnail_id, 'thumbnail' ); ?>
						                </a>
						                <div class="cart_list_product_title">
						                    <h3><a href="<?php echo esc_url( get_permalink( $id ) ); ?>"><?php echo esc_html( get_the_title( $id ) ); ?></a></h3>
						                    <div class="cart_list_product_quantity"><?php echo wp_kses_post( $cart_item['quantity'] ); ?> x <?php echo wp_kses_post( $wc->cart->get_product_subtotal( $cart_item['data'], 1 ) ); ?> </div>
						                    <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="remove" data-product_id="<?php echo esc_attr( $id ); ?>"><i class="fa fa-trash"></i></a>
						                </div>
						            </div>
				        		<?php } ?>
				        	</div>
					        
					        <div class="cz_cart_buttons clr">
								<a href="<?php echo esc_url( get_permalink(get_option('woocommerce_cart_page_id')) ); ?>"><?php esc_html_e( 'Cart', 'xtra' ); ?>, <span><?php echo wp_kses_post( $wc->cart->get_cart_total() ); ?></span></a>
								<a href="<?php echo esc_url( get_permalink(get_option('woocommerce_checkout_page_id')) ); ?>"><?php esc_html_e( 'Checkout', 'xtra' ); ?></a>
					        </div>
				        <?php } ?>
					</div></div>
				</div>
			<?php 

			$fragments['.cz_cart'] = ob_get_clean();

			return $fragments;
		}

		/**
		 *
		 * Generate inner row elements positions
		 * 
		 * @return string
		 *
		 */
		public static function codevz_row_inner( $id = 0, $pos = 0, $out = '' ) {
			if ( isset( $_POST['id'] ) && isset( $_POST['pos'] ) ) {
				$ajax = 1;
				$id = $_POST['id'];
				$pos = $_POST['pos'];
			}

			$elms = self::option( $id . $pos );
			if ( $elms ) {
				$shape = self::get_string_between( self::option( '_css_' . $id . $pos ), '_class_shape:', ';' );
				$shape = $shape ? ' ' . $shape : '';
				$center = self::contains( $pos, 'center' );

				echo '<div class="elms' . esc_attr( $pos . ' ' . $id . $pos . ' ' . $shape ) . '">';
				if ( $center ) {
					echo '<div>';
				}
				$inner_id = 0;
				foreach ( (array) $elms as $v ) {
					if ( empty( $v['element'] ) ) {
						continue;
					}
					$more = array();
					$more['id'] = $id;
					$more['depth'] = $pos . '_' . self::$elm_id++;
					$more['inner_depth'] = $pos . '_' . $inner_id++;

					// Variables are array()
					self::get_row_element( $v, $more );
				}
				if ( $center ) {
					echo '</div>';
				}
				echo '</div>';
			}

			if ( isset( $ajax ) ) {
				die();
			}
		}

		/**
		 *
		 * Generate header|footer|side row elements
		 * 
		 * @return string
		 *
		 */
		public static function row( $args ) {

			ob_start();
			foreach ( $args['nums'] as $num ) {
				$id = esc_attr( $args['id'] );

				// Check if sticky header is not custom
				if ( $num === '5' && ! self::option( 'sticky_header' ) ) {
					continue;
				}

				// Page as row
				if ( self::option( 'row_type_' . $id . $num ) ) {
					if ( $id = self::option( 'page_as_row_' . $id . $num ) ) {
						echo '<div class="row clr page_as_row_' . esc_attr( $id ) . '">' . self::get_page_as_element( esc_html( $id ) ) . '</div>';
					}
				}

				// Columns
				$left = self::option( $id . $num . $args['left'] );
				$right = self::option( $id . $num . $args['right'] );
				$center = self::option( $id . $num . $args['center'] );

				// Row Shape
				$shape = self::get_string_between( self::option( '_css_row_' . $id . $num ), '_class_shape:', ';' );
				$shape = $shape ? ' ' . $shape : '';

				// Menu FX
				$menufx = self::get_string_between( self::option( '_css_menu_a_hover_before_' . $id . $num ), '_class_menu_fx:', ';' );
				$menufx = $menufx ? ' ' . $menufx : '';

				// Check sticky header
				$sticky = self::option( 'sticky_header' );
				$sticky = ( self::contains( $sticky, $num ) && $id !== 'footer_' ) ? ' header_is_sticky' : '';
				$sticky .= ( $sticky && self::option( 'smart_sticky' ) ) ? ' smart_sticky' : '';
				$sticky .= ( self::option( 'mobile_sticky' ) && $id . $num === 'header_4' ) ? ' ' . self::option( 'mobile_sticky' ) : '';

				// Before mobile header
				if ( $num === '4' && self::option( 'b_mobile_header' ) ) {
					echo '<div class="row clr cz_before_mobile_header">' . self::get_page_as_element( self::option( 'b_mobile_header' ) ) . '</div>';
				}

				// Start
				if ( $left || $center || $right ) {
					echo '<div class="' . esc_attr( $id . $num . ( $center ? ' have_center' : '' ) . $shape . $sticky . $menufx ) . '">';
					if ( $args['row'] ) {
						echo '<div class="row elms_row"><div class="clr">';
					}

					self::codevz_row_inner( $id . $num, $args['left'] );
					self::codevz_row_inner( $id . $num, $args['center'] );
					self::codevz_row_inner( $id . $num, $args['right'] );

					if ( $args['row'] ) {
						echo '</div></div>';
					}
					echo '</div>';
				}

				// After mobile header
				if ( $num === '4' && self::option( 'a_mobile_header' ) ) {
					echo '<div class="row clr cz_after_mobile_header">' . self::get_page_as_element( self::option( 'a_mobile_header' ) ) . '</div>';
				}
			}
			echo ob_get_clean();
		}

		/**
		 *
		 * Generate page
		 * 
		 * @return string
		 *
		 */
		public static function generate_page( $page = '' ) {
			get_header();

			// Settings
			$cpt = self::get_post_type();
			$is_search = is_search();
			if ( $is_search ) {
				$option_cpt = '_search';
			} else {
				$option_cpt = ( $cpt === 'post' || $cpt === 'page' || empty( $cpt ) ) ? '' : '_' . $cpt;
			}
			$title = self::option( 'page_title' . $option_cpt );
			$title = ( ! $title || $title === '1' ) ? self::option( 'page_title' ) : $title;
			$layout = self::option( 'layout' . $option_cpt );
			$layout = ( ! $layout || $layout === '1' ) ? self::option( 'layout' ) : $layout;
			$primary = self::option( 'primary' . $option_cpt, 'primary' );
			$secondary = self::option( 'secondary' . $option_cpt, 'secondary' );
			$blank = ( $layout === 'bpnp' ) ? 1 : 0;
			$is_404 = ( is_404() || $page === '404' );
			$current_id = $is_404 ? self::option( '404' ) : ( isset( self::$post->ID ) ? self::$post->ID : 0 );
			if ( is_singular() || $cpt === 'page' || $is_404 ) {
				$meta = self::meta( $current_id );
				if ( isset( $meta['layout'] ) && $meta['layout'] !== '1' ) {
					$layout = $meta['layout'];
					$primary = $meta['primary'];
					$secondary = $meta['secondary'];
					$blank = ( $meta['layout'] === 'none' || $meta['layout'] === 'bpnp' ) ? 1 : 0;
					$title = ( $meta['page_title'] === 'd' ) ? $title : $meta['page_title'];
				}
			}
			$queried_object = get_queried_object();

			// Start page content
			$bpnp = ( $layout === 'bpnp' ) ? ' cz_bpnp' : '';
			$bpnp .= empty( $meta['page_content_margin'] ) ? '' : ' ' . $meta['page_content_margin'];
			echo '<div id="page_content" class="page_content' . esc_attr( $bpnp ) . '"><div class="row clr">';

			// Before content
			if ( $is_404 ) {
				echo '<section class="s12 clr">';
			} else if ( $layout === 'both-side' ) {
				echo '<aside class="col s3 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside><section class="col s6">';
			} else if ( $layout === 'both-side2' ) {
				echo '<aside class="col s3 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside><section class="col s7">';
			} else if ( $layout === 'both-right' ) {
				echo '<section class="col s6">';
			} else if ( $layout === 'both-right2' ) {
				echo '<section class="col s7">';
			} else if ( $layout === 'right' ) {
				echo '<section class="col s8">';
			} else if ( $layout === 'right-s' ) {
				echo '<section class="col s9">';
			} else if ( $layout === 'both-left' ) {
				echo '<section class="col s6 col_not_first righter">';
			} else if ( $layout === 'both-left2' ) {
				echo '<section class="col s7 col_not_first righter">';
			} else if ( $layout === 'left' ) {
				echo '<section class="col s8 col_not_first righter">';
			} else if ( $layout === 'left-s' ) {
				echo '<section class="col s9 col_not_first righter">';
			} else {
				echo '<section class="s12 clr">';
			}

			$single_classes = is_single() ? ' ' . implode( ' ', get_post_class( 'single_con' ) ) : '';
			echo '<div class="' . esc_attr( ( $blank ? 'cz_is_blank' : 'content' ) . $single_classes ) . ' clr">';

			if ( $is_404 ) {
				if ( $current_id ) {
					echo self::get_page_as_element( $current_id );
				} else {
					echo '<h2 style="text-align:center;font-size:160px">404<small style="font-size: 32px">' . esc_html__( 'Page not found!', 'xtra' ) . '</small></h2>';
					echo '<form class="search_404" method="get" action="' . esc_url(home_url('/')) . '">
                        <input id="inputhead" name="s" type="text" value="" placeholder="' . esc_attr__( 'Type Something ...','xtra' ) . '">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>';
					echo '<a class="button" href="' . esc_url( home_url( '/' ) ) . '" style="margin: 80px auto 0;display:table">' . esc_html__( 'Back to Homepage', 'xtra' ) . '</a>';
				}
			} else if ( $page === 'page' || $page === 'single' ) {
				if ( have_posts() ) {
					$single_meta_cpt = ( $cpt === 'page' || empty( $cpt ) ) ? 'post' : $cpt;
					$single_meta = (array) self::option( 'meta_data_' . $single_meta_cpt );
					$single_meta = array_flip( $single_meta );

					while ( have_posts() ) {
						the_post();
						if ( ! $blank && ( $title === '1' || $title === '2' || $title === '8' ) ) {
							// Escaped inside page_title()
							self::page_title( 'h3', '', ( is_single() && empty( $queried_object->taxonomy ) && isset( $single_meta['mbot'] ) ) );
						}

						if ( $page === 'single' && has_post_thumbnail() && isset( $single_meta['image'] ) ) {
							echo '<div class="cz_single_fi">';
							the_post_thumbnail( 'full' );
							echo '</div><br />';
						}

						echo '<div class="cz_post_content">';
						the_content();
						echo '</div>';

						echo '<div class="clr"></div>';

						wp_link_pages( array(
							'before'=>'<div class="pagination mt20 clr">', 
							'after'=>'</div>', 
							'link_after'=>'</b>', 
							'link_before'=>'<b>'
						));
					}

					if ( $page === 'single' && empty( $queried_object->taxonomy ) ) {

						if ( isset( $single_meta['date'] ) || isset( $single_meta['author'] ) ) {
							$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

							echo '<span class="cz_post_meta mt50">';
							echo isset( $single_meta['author'] ) ? '<a class="cz_post_author_avatar" href="' . esc_url( $author_url ) . '">' . get_avatar( get_the_author_meta( 'ID' ), 40 ) . '</a>' : '';
							echo '<span class="cz_post_inner_meta">';
							echo isset( $single_meta['author'] ) ? '<a class="cz_post_author_name" href="' . esc_url( $author_url ) . '">' . ucwords( get_the_author() ) . '</a>' : '';
							echo isset( $single_meta['date'] ) ? '<span class="cz_post_date">' . esc_html( get_the_time( get_option( 'date_format' ) ) ) . '</span>' : '';
							echo '</span></span>';
						}

						echo '<div class="clr mt40"></div>';

						if ( isset( $single_meta['cats'] ) ) {
							echo '<p class="cz_post_cat mr20">';
							// Escaped inside post_category()
							echo self::post_category();
							echo '</p>';
						}

						if ( isset( $single_meta['tags'] ) ) {
							// Escaped inside the_tags()
							echo self::the_tags();
						}
						
						echo '<div class="clr"></div>';

						if ( isset( $single_meta['next_prev'] ) && self::next_prev_item() ) {
							echo '</div><div class="content cz_next_prev_posts clr">' . self::next_prev_item(); // Escaped inside next_prev_item()
						}

						if ( isset( $single_meta['author_box'] ) && self::author_box() ) {
							echo '</div><div class="content cz_author_box clr">';
							echo '<h4>' . esc_html( ucfirst( get_the_author_meta('display_name') ) ) . '<small class="righter cz_view_author_posts"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html__( 'View all posts', 'xtra' ) . ' <i class="fa fa-angle-double-right ml4"></i></a></small></h4>';
							// Escaped inside author_box()
							echo self::author_box();
						}

						$related_ppp = self::option( 'related_' . $single_meta_cpt . '_ppp' );
						if ( $related_ppp && $related_ppp != '0' && $cpt !== 'page' && $cpt !== 'product' && $cpt !== 'dwqa-question' ) {
							// Escaped data inside related()
							echo self::related(array(
								'posts_per_page' 	=> esc_attr( $related_ppp ),
								'related_columns' 	=> esc_attr( self::option( 'related_' . $single_meta_cpt . '_col', 's4' ) ),
								'section_title' 	=> esc_html( self::option( 'related_posts_' . $single_meta_cpt, esc_html__( 'Related Posts ...', 'xtra' ) ) )
							));
						}
					}
				}
			} else if ( $page === 'woocommerce' ) {
				woocommerce_content();
			} else if ( have_posts() ) {

				if ( $title === '2' || $title === '8' ) {
					// Escaped data inside page_title()
					self::page_title();
				}

				if ( is_author() && self::author_box() ) {
					echo '<h3>' . esc_html( ucfirst( get_the_author_meta('display_name') ) ) . '<small class="righter cz_view_author_posts"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">View all posts <i class="fa fa-angle-double-right ml4"></i></a></small></h3>';
					// Escaped data inside author_box()
					echo self::author_box();
					echo '</div><div class="content clr">';
				}

				$cpt = $cpt ? $cpt : 'post';
				$template = self::option( 'template_' . $cpt );

				if ( $template && self::option( 'template_style' ) !== 'x' ) {
					echo self::get_page_as_element( esc_html( $template ), 1 );
				} else {

					// Posts
					echo '<div class="cz_posts_container"><div class="clr' . ( ( $cpt === 'post' ) ? ' mb30' : '' ) . '">';
					$i = 1;
					if ( $cpt === 'post' ) {
						$post_class = '';
						$post_template = esc_html( self::option( 'template_style' ) );
						$image_size = 'codevz_360_320';
						$plcw = '360';
						if ( $post_template == '2' ) {
							$post_class = ' cz_default_loop_right';
						} else if ( $post_template == '3' ) {
							$post_class = ' cz_default_loop_full';
							$image_size = 'codevz_1200_500';
							$plcw = '1200';
						} else if ( $post_template == '4' ) {
							$post_class = ' cz_default_loop_grid col s6';
						} else if ( $post_template == '5' ) {
							$post_class = ' cz_default_loop_grid col s4';
						}

						while ( have_posts() ) {
							the_post();
							$link = get_the_permalink();
							$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );

							echo '<article class="' . esc_attr( implode( ' ', get_post_class( 'cz_default_loop clr' . $post_class ) ) ) . '"><div class="clr">';
							if ( has_post_thumbnail() ) {
								echo '<a class="cz_post_image" href="' . esc_url( $link ) . '">';
								the_post_thumbnail( $image_size );
								echo '</a>';
							} else {
								echo '<a class="cz_post_image" href="' . esc_url( $link ) . '">';
								echo '<img src="data:image/svg+xml,%3Csvg%20xmlns%3D&#39;http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg&#39;%20width=&#39;' . $plcw . '&#39;%20height=&#39;50&#39;%20viewBox%3D&#39;0%200%20' . $plcw . '%2050&#39;%2F%3E" alt="placeholder" />';
								echo '</a>';
							}
							echo '<a class="cz_post_title" href="' . esc_url( $link ) . '"><h3>' . get_the_title() . '</h3></a>';
							$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
							echo '<span class="cz_post_meta mt10 mb10">';
							echo '<a class="cz_post_author_avatar" href="' . esc_url( $author_url ) . '">' . get_avatar( get_the_author_meta( 'ID' ), 40 ) . '</a>';
							echo '<span class="cz_post_inner_meta">';
							echo '<a class="cz_post_author_name" href="' . esc_url( $author_url ) . '">' . esc_html( ucwords( get_the_author() ) ) . '</a>';
							echo '<span class="cz_post_date">' . esc_html( get_the_time( get_option( 'date_format' ) ) ) . '</span>';
							echo '</span></span><div class="cz_post_excerpt">' . ( ( self::option( 'post_excerpt', 20 ) != '-1' ) ? get_the_excerpt() : do_shortcode( get_the_content() ) ) . '</div>';
							echo '</div></article>';
							if ( $i % ( ( $post_template === '4' ) ? 2 : ( ( $post_template === '5' ) ? 3 : 99 ) ) === 0 ) {
								echo '</div><div class="clr mb30">';
							}
							$i++;
						}
					} else { // Other posts types
						$col = self::option( 'cols_' . $cpt, 's4' );
						while ( have_posts() ) {
							the_post();
							$link = get_the_permalink();
							echo '<article class="' . esc_attr( implode( ' ', get_post_class( 'cz_default_grid col clr ' . $col ) ) ) . '"><div class="clr">';
							if ( has_post_thumbnail() ) {
								echo '<a class="cz_default_grid_a" href="' . esc_url( $link ) . '">';
								the_post_thumbnail( 'codevz_600_600' );
								echo '<h3>' . get_the_title() . '<small>' . self::post_category( 0, 1 ) . '</small></h3></a>';
							} else {
								echo '<a class="cz_post_title" href="' . esc_url( $link ) . '"><h3>' . get_the_title() . '<small>' . self::post_category( 0, 1 ) . '</small></h3></a>';
							}
							echo '</div></article>';
							if ( $i % ( ( $col === 's4' ) ? 3 : ( ( $col === 's3' ) ? 4 : 2 ) ) === 0 ) {
								echo '</div><div class="clr">';
							}
							$i++;
						}
					}
					echo '</div></div>'; // row

					// Pagination
					echo '<div class="clr tac">';
					the_posts_pagination(array(
						'prev_text'          => self::$is_rtl ? '<i class="fa fa-angle-double-right mr4"></i>' : '<i class="fa fa-angle-double-left mr4"></i>',
						'next_text'          => self::$is_rtl ? '<i class="fa fa-angle-double-left ml4"></i>' : '<i class="fa fa-angle-double-right ml4"></i>',
						'before_page_number' => ''
					));
					echo '</div>';
				}
			} else {
				echo '<h3>' . esc_html( self::option( 'not_found', esc_html__( 'Not found!', 'xtra' ) ) ) . '</h3>';
			}

			echo '</div>'; // content

			// Comments
			if ( is_singular() && comments_open() && empty( $queried_object->taxonomy ) ) {
				echo '<div id="comments" class="content clr">';
				comments_template();
				echo '</div>';
			} else if ( is_single() && empty( $queried_object->taxonomy ) ) {
				echo '<p class="cz_nocomment mb10" style="opacity:.6"><i>' . esc_html__( 'Comments are disabled.', 'xtra' ) . '</i></p>';
			}

			echo '</section>';

			// After content
			if ( $is_404 ) {
				echo '<section class="s12 clr">';
			} else if ( $layout === 'right' ) {
				echo '<aside class="col s4 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'right-s' ) {
				echo '<aside class="col s3 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'left' ) {
				echo '<aside class="col s4 col_first sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'left-s' ) {
				echo '<aside class="col s3 col_first sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-side' ) {
				echo '<aside class="col s3 righter sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-side2' ) {
				echo '<aside class="col s2 righter sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-right' ) {
				echo '<aside class="col s3 sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside><aside class="col s3 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-right2' ) {
				echo '<aside class="col s2 sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside><aside class="col s3 sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-left' ) {
				echo '<aside class="col s3 col_first sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside><aside class="col s3 sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside>';
			} else if ( $layout === 'both-left2' ) {
				echo '<aside class="col s3 col_first sidebar_' . esc_attr( $primary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $primary ) ) {
					dynamic_sidebar( $primary );  
				}
				echo '</div></aside><aside class="col s2 sidebar_' . esc_attr( $secondary ) . '"><div class="sidebar_inner">';
				if ( is_active_sidebar( $secondary ) ) {
					dynamic_sidebar( $secondary );  
				}
				echo '</div></aside>';
			}

			echo '</div></div>'; // row, page_content
			get_footer();
		}

		/**
		 *
		 * Get post type's categories
		 * 
		 * @return string
		 *
		 */
		public static function post_category( $l = 1, $s = 0 ) {

			$out = array();
			$cpt = self::get_post_type();
			$tax = ( $cpt === 'post' ) ? 'category' : $cpt . '_cat';

			$terms = (array) get_the_terms( self::$post->ID, $tax );
			foreach ( $terms as $term ) {
				if ( isset( $term->term_id ) ) {
					$out[] = $l ? '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>' : esc_html( $term->name );
				}
			}

			$out = implode( $s ? ', ' : '', $out );
			$pre = $l ? '<a href="#"><i class="fa fa-folder-open"></i></a>' : '<i class="fa fa-folder-open mr10"></i>';

			return $out ? $pre . $out : '';
		}

		/**
		 *
		 * Get post type's tags
		 * 
		 * @return string
		 *
		 */
		public static function the_tags() {
			$out = '';
			$tax = get_object_taxonomies( self::$post->post_type, 'objects' );

			foreach ( $tax as $tax_slug => $taks ) {
				$terms = get_the_terms( self::$post->ID, $tax_slug );

			    if ( ! empty( $terms ) && self::contains( $taks->label, 'Tags' ) ) {
			        $out .= '<p class="tagcloud"><a href="#"><i class="fa fa-tags"></i></a>';
			        foreach ( $terms as $term ) {
			            $out .= '<a href="' . esc_url( get_term_link( $term->slug, $tax_slug ) ) . '">' . esc_html( $term->name ) . '</a>';
			        }
			        $out .= "</p>";
			    }
			}

			return $out;
		}

		/**
		 *
		 * Get related posts for single post page
		 * 
		 * @return string
		 *
		 */
		public static function related( $args = array() ) {

			$id = self::$post->ID;
			$cpt = get_post_type( $id );
			$meta = self::meta();

			$args = wp_parse_args( $args, array(
				'extra_class'	=> '',
				'by'			=> 'cats',
				'post_type'		=> $cpt,
				'post__not_in'	=> array( $id ),
				'posts_per_page'=> 3,
				'related_columns'=> 's4'
			) );

			if ( $args['by'] === 'cats' ) {
				if ( $cpt === 'post' ) {
					$args['category__in'] = wp_get_post_categories( $id, array( 'fields'=>'ids' ) );
				} else {
					$taxonomy = $cpt . '_cat';
					$get_cats = get_the_terms( $id, $taxonomy );
					$get_cats = $get_cats ? $get_cats : '';
					if ( $get_cats ) {
						$tax = array('relation' => 'OR');
						foreach ( $get_cats as $key ) {
							if ( is_object( $key ) ) {
								$tax[] = array(
									'taxonomy' => $taxonomy,
									'terms' => $key->term_id
								);
							}
						}
						$args['tax_query'] = $tax;
					}
				}
			} else if ( $args['by'] === 'tags' ) {
				$args['tag__in'] = wp_get_post_tags( $id, array( 'fields'=>'ids' ) );
			} else if ( $args['by'] === 'rand' ) {
				$args['orderby'] = 'rand';
			}

			/* Tax query */
			$taxes = array( '_cats', '_tags' );
			$tax_query = array();
			foreach ( $taxes as $tax ) {
				if ( isset( $args[ $tax ] ) ) {
					$tax_array = explode( ',', $args[ $tax ] );
					if ( $tax === '_cats' ) {
						$tax = 'category';
					} else if ( $tax === '_tags' ) {
						$tax = 'post_tags';
					}
					foreach ( $tax_array as $cat ) {
						if ( ! empty( $cat ) ) {
							$tax_query[] = array( 'taxonomy' => $tax, 'field' => 'slug', 'terms' => $cat );
						}
					}
				}
			}
			$args['tax_query'] = empty( $tax_query ) ? null : wp_parse_args( $tax_query, array( 'relation' => 'OR' ) );

			$query = new WP_Query( $args );

			ob_start();
			echo '<div class="clr">';
			if ( $query->have_posts() ): 
				$i = 1;
				$col = ( $args['related_columns'] === 's6' ) ? 2 : ( ( $args['related_columns'] === 's4' ) ? 3 : 4 );
				while ( $query->have_posts() ) : $query->the_post();
				$cats = ( ! $cpt || $cpt === '' || $cpt === 'post' ) ? 'category' : $cpt . '_cat';	
			?>
				<article id="post-<?php the_ID(); ?>" class="cz_related_post col <?php echo esc_attr( $args['related_columns'] ); ?>"><div>
					<?php if ( has_post_thumbnail() ) { ?><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_post_thumbnail( 'codevz_360_320' ); ?></a><?php } ?>
					<a class="cz_post_title mt10 block" href="<?php echo esc_url( get_the_permalink() ); ?>">
						<h3><?php the_title(); ?></h3>
					</a>
					<?php echo get_the_term_list( get_the_id(), $cats, '<small class="cz_related_post_date mt10"><i class="fa fa-folder-open mr10"></i>', ', ', '</small>' ); ?>
				</div></article>
			<?php 
				if ( $i % $col === 0 ) {
					echo '</div><div class="clr">';
				}

				$i++;
				endwhile;
			endif;
			echo '</div>';
			wp_reset_postdata();

			$related = ob_get_clean();

			if ( $related ) {
				return '</div><div class="content cz_related_posts clr"><h4>' . esc_html( $args['section_title'] ) . '</h4>' . $related;
			}
		}

		/**
		 *
		 * Get string between two string
		 * 
		 * @return string
		 * 
		 */
		public static function get_string_between( $c = '', $s, $e, $m = 0 ) {
			if ( $c ) {
				if ( $m ) {
					preg_match_all( '~' . preg_quote( $s, '~' ) . '(.*?)' . preg_quote( $e, '~' ) . '~s', $c, $matches );
					return $matches[0];
				}

				$r = explode( $s, $c );
				if ( isset( $r[1] ) ) {
					$r = explode( $e, $r[1] );
					return $r[0];
				}
			}

			return;
		}

		/**
		 *
		 * Check if string contains specific value(s)
		 * 
		 * @return string
		 *
		 */
		public static function contains( $v = '', $a = array() ) {
			if ( $v ) {
				foreach ( (array) $a as $k ) {
					if ( $k && strpos( $v, $k ) !== false ) {
						return 1;
						break;
					}
				}
			}
			
			return null;
		}
		
		/**
		 *
		 * Get current page title
		 * 
		 * @return string
		 *
		 */
		public static function page_title( $tag = 'h3', $class = '', $meta = 0 ) {

			$is_woocommerce = ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_woocommerce() ) );

			if ( is_404() ) {
				$i = '404';
			} else if ( is_search() ) {
				$i = self::option( 'search_title_prefix', esc_html__( 'Search result for:', 'xtra' ) ) . ' ' . get_search_query();
			} else if ( is_archive() && ! $is_woocommerce ) {
				$i = get_the_archive_title();
			} else if ( is_single() ) {
				$i = single_post_title( '', false );
				$i = $i ? $i : get_the_title();
			} else if ( is_home() ) {
				$i = get_option( 'page_for_posts' ) ? get_the_title( get_option( 'page_for_posts' ) ) : esc_html__( 'Blog', 'xtra' );
			} else {
				$i = get_the_title();
			}

			$small = '';
			if ( $meta ) {
				$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$small .= '<span class="cz_top_meta">';
				$small .= '<span class="cz_top_meta_i mr10"><i class="fa fa-edit mr4"></i>Posted by <a class="cz_post_author_name" href="' . esc_url( $author_url ) . '">' . ucwords( get_the_author() ) . '</a></span>';
				$small .= '<span class="cz_top_meta_i"><i class="fa fa-clock-o mr4"></i>on <span class="cz_post_date">' . esc_html( get_the_time( get_option( 'date_format' ) ) ) . '</span></span>';
				$small .= '</span>';
			}

			echo '<' . esc_attr( $tag ) . ' class="section_title ' . esc_attr( $class ) . '">' . wp_kses_post( $i . $small ) . '</' . esc_attr( $tag ) . '>';
			if ( is_category() && category_description() ) {
				echo category_description();
			}

			if ( is_tag() && tag_description() ) {
				echo tag_description();
			}

			if ( is_tax() && term_description( get_query_var('term_id'), get_query_var( 'taxonomy' ) ) ) {
				echo term_description( get_query_var('term_id'), get_query_var( 'taxonomy' ) );
			}
		}

		/**
		 *
		 * Get author box
		 * 
		 * @return string
		 *
		 */
		public static function author_box() {
			return get_the_author_meta( 'description' ) ? '<div class="cz_author_box clr"><div class="lefter mr20 mt10">' . get_avatar( get_the_author_meta( 'user_email' ), '100' ) . '</div><p>' . get_the_author_meta('description') . '</p></div>' : '';
		}

		/**
		 *
		 * Ajax search process
		 * 
		 * @return string
		 *
		 */
		public static function codevz_ajax_search() {
			if ( ! isset( $_GET['nonce'] ) || ! wp_verify_nonce( $_GET['nonce'], 'ajax_search_nonce' ) ) {
				//die( '<b class="ajax_search_error">' . esc_html__( 'Server error, Try again ...', 'xtra' ) . '</b>' );
			}

			$l = 4;
			$s = sanitize_text_field( $_GET['s'] );
			$c = empty( $_GET['cpt'] ) ? array( 'any' ) : explode( ',', str_replace( ' ', '', $_GET['cpt'] ) );
			
			$q = new WP_Query( array(
				'post_type' 	 => $c,
				's'              => $s,
				'posts_per_page' => $l,
				'orderby'		 => 'type',
				'fields'         => 'ids'
			));

			ob_start();
			if ( $q->have_posts() ) {
				while ( $q->have_posts() ) {
					$q->the_post();
					$cpt = self::get_post_type();
					if ( $cpt === 'page' || $cpt === 'dwqa-answer' ) {
						continue;
					}

					echo '<div id="post-' . esc_attr( get_the_id() ) . '" class="item_small">';
					if ( has_post_thumbnail() ) {
						echo '<a class="theme_img_hover" href="' . esc_url( get_the_permalink() ) . '"><img src="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ) . '" width="80" height="80" /></a>';
					}
					echo apply_filters( 'cz_ajax_search_instead_img', '' );
					echo '<div class="item-details">';
					echo '<h3><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a></h3>';
					echo apply_filters( 'cz_ajax_search_meta', '<span class="cz_search_item_cpt mr4"><i class="fa fa-folder-o mr4"></i>' . ucwords( ( $cpt === 'dwqa-question' ) ? esc_html__( 'Questions', 'xtra' ) : $cpt ) . '</span><span><i class="fa fa-clock-o mr4"></i>' . esc_html( get_the_date() ) . '</span>' );
					echo '</div></div>';
				}
			} else {
				echo '<b class="ajax_search_error">' . esc_html( self::option( 'not_found', esc_html__( 'Not found!', 'xtra' ) ) ) . '</b>';
			}

			if ( $q->post_count >= $l ) {
				unset( $_GET['action'] );
				unset( $_GET['nonce'] );
				echo '<a class="va_results" href="' . esc_url( home_url( '/' ) ) . '?s=' . esc_attr( $s ) . '">' . esc_html__( 'View all results', 'xtra' ) . '</div>';
			}

			echo ob_get_clean();
			wp_reset_postdata();
			die();
		}

		/**
		 *
		 * Get breadcrumbs
		 * 
		 * @return string
		 *
		 */
		public static function breadcrumbs( $is_right = '' ) {
			$out = array();
			$bc = (array) self::breadcrumbs_array();
			$count = count( $bc );
			$i = 1;
			foreach ( $bc as $ancestor ) {
				if ( $i === $count ) {
					$out[] = '<b itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="inactive_l"><a class="cz_br_current" href="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" onclick="return false;" itemprop="url"><span itemprop="title">' . wp_kses_post( $ancestor['title'] ) . '</span></a></b>';
				} else {
					$out[] = '<b itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . esc_url( $ancestor['link'] ) . '" itemprop="url"><span itemprop="title">' . wp_kses_post( $ancestor['title'] ) . '</span></a></b>';
				}
				$i++;
			}

			echo '<div class="breadcrumbs clr' . esc_attr( $is_right ) . '">';
			echo wp_kses_post( implode( ' <i class="' . esc_attr( self::option( 'breadcrumbs_separator', 'fa fa-long-arrow-right' ) ) . ' cz_breadcrumbs_separator"></i> ', $out ) );
			echo '</div>';
		}

		public static function breadcrumbs_array() {
			global $post;
		 
			$home_icon = self::option( 'breadcrumbs_home_icon' ) ? '<i class="' . esc_attr( self::option( 'breadcrumbs_home_icon', 'fa fa-home' ) ) . ' cz_breadcrumbs_home"></i>' : '';

			$bc = array();
			$bc[] = array( 'title' => ( $home_icon ? $home_icon : get_bloginfo( 'name' ) ), 'link' => esc_url( home_url( '/' ) ) );
			$bc = self::add_posts_page_array( $bc );
			if ( is_404() ) {
				$bc[] = array( 'title' => '404', 'link' => false );
			} else if ( is_search() ) {
				$bc[] = array( 'title' => get_search_query(), 'link' => false );
			} else if ( is_tax() ) {
				$taxonomy = get_query_var( 'taxonomy' );
				$term = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
				if ( get_taxonomy( $term->taxonomy ) ) {
					$ptn = get_taxonomy( $term->taxonomy )->object_type[0];
					$bc[] = array( 'title' => ucwords($ptn), 'link' => get_post_type_archive_link( $ptn ) );
				}
				$bc[] = array( 'title' => sprintf( '%s', $term->name ), 'link' => get_term_link( $term->term_id, $term->slug ) );
			} else if ( is_attachment() ) {
				if ( $post->post_parent ) {
					$parent_post = get_post( $post->post_parent );
					if ( $parent_post ) {
						$singular_bread_crumb_arr = self::singular_breadcrumbs_array( $parent_post );
						$bc = array_merge( $bc, $singular_bread_crumb_arr );
					}
				}
				if ( isset( $parent_post->post_title ) ) {
					$bc[] = array( 'title' => $parent_post->post_title, 'link' => get_permalink( $parent_post->ID ) );
				}
				$bc[] = array( 'title' => sprintf( '%s', $post->post_title ), 'link' => get_permalink( $post->ID ) );
			} else if ( ( is_singular() || is_single() ) && ! is_front_page() ) {
				$singular_bread_crumb_arr = self::singular_breadcrumbs_array( $post );
				$bc = array_merge( $bc, $singular_bread_crumb_arr );
				$bc[] = array( 'title' => $post->post_title, 'link' => get_permalink( $post->ID ) );
			} else if ( is_category() ) {
				global $cat;

				$category = get_category( $cat );
				if ( $category->parent != 0 ) {
					$ancestors = array_reverse( get_ancestors( $category->term_id, 'category' ) );
					foreach ( $ancestors as $ancestor_id ) {
						$ancestor = get_category( $ancestor_id );
						$bc[] = array( 'title' => $ancestor->name, 'link' => get_category_link( $ancestor->term_id ) );
					}
				}
				$bc[] = array( 'title' => sprintf( '%s', $category->name ), 'link' => get_category_link( $cat ) );
			} else if ( is_tag() ) {
				global $tag_id;
				$tag = get_tag( $tag_id );
				$bc[] = array( 'title' => sprintf( '%s', $tag->name ), 'link' => get_tag_link( $tag_id ) );
			} else if ( is_author() ) {
				$author = get_query_var( 'author' );
				$bc[] = array( 'title' => sprintf( '%s', get_the_author_meta( 'display_name', get_query_var( 'author' ) ) ), 'link' => get_author_posts_url( $author ) );
			} else if ( is_day() ) {
				$m = get_query_var( 'm' );
				if ( $m ) {
					$year = substr( $m, 0, 4 );
					$month = substr( $m, 4, 2 );
					$day = substr( $m, 6, 2 );
				} else {
					$year = get_query_var( 'year' );
					$month = get_query_var( 'monthnum' );
					$day = get_query_var( 'day' );
				}
				$month_title = self::get_month_title( $month );
				$bc[] = array( 'title' => sprintf( '%s', $year ), 'link' => get_year_link( $year ) );
				$bc[] = array( 'title' => sprintf( '%s', $month_title ), 'link' => get_month_link( $year, $month ) );
				$bc[] = array( 'title' => sprintf( '%s', $day ), 'link' => get_day_link( $year, $month, $day ) );
			} else if ( is_month() ) {
				$m = get_query_var( 'm' );
				if ( $m ) {
					$year = substr( $m, 0, 4 );
					$month = substr( $m, 4, 2 );
				} else {
					$year = get_query_var( 'year' );
					$month = get_query_var( 'monthnum' );
				}
				$month_title = self::get_month_title( $month );
				$bc[] = array( 'title' => sprintf( '%s', $year ), 'link' => get_year_link( $year ) );
				$bc[] = array( 'title' => sprintf( '%s', $month_title ), 'link' => get_month_link( $year, $month ) );
			} else if ( is_year() ) {
				$m = get_query_var( 'm' );
				if ( $m ) {
					$year = substr( $m, 0, 4 );
				} else {
					$year = get_query_var( 'year' );
				}
				$bc[] = array( 'title' => sprintf( '%s', $year ), 'link' => get_year_link( $year ) );
			} else if ( is_post_type_archive() ) {
				$post_type = get_post_type_object( get_query_var( 'post_type' ) );
				$bc[] = array( 'title' => sprintf( '%s', $post_type->label ), 'link' => get_post_type_archive_link( $post_type->name ) );
			}

			// array()
			return $bc;
		}

		public static function singular_breadcrumbs_array( $post ) {
			$bc = array();
			$post_type = get_post_type_object( $post->post_type );

			if ( $post_type && $post_type->has_archive ) {
				$bc[] = array( 'title' => sprintf( '%s', $post_type->label ), 'link' => get_post_type_archive_link( $post_type->name ) );
			}

			if ( is_post_type_hierarchical( $post_type->name ) ) {
				$ancestors = array_reverse( get_post_ancestors( $post ) );
				if ( count( $ancestors ) ) {
					$ancestor_posts = get_posts( 'post_type=' . $post_type->name . '&include=' . implode( ',', $ancestors ) );
					foreach( (array) $ancestors as $ancestor ) {
						foreach ( (array) $ancestor_posts as $ancestor_post ) {
							if ( $ancestor === $ancestor_post->ID ) {
								$bc[] = array( 'title' => $ancestor_post->post_title, 'link' => get_permalink( $ancestor_post->ID ) );
							}
						}
					}
				}
			} else {
				$post_type_taxonomies = get_object_taxonomies( $post_type->name, false );
				if ( is_array( $post_type_taxonomies ) && count( $post_type_taxonomies ) ) {
					foreach( $post_type_taxonomies as $tax_slug => $taxonomy ) {
						if ( $taxonomy->hierarchical && $tax_slug !== 'post_tag' && $tax_slug !== 'artists_cat' ) {
							$terms = get_the_terms( self::$post->ID, $tax_slug );
							if ( $terms ) {
								$term = array_shift( $terms );
								if ( $term->parent != 0  ) {
									$ancestors = array_reverse( get_ancestors( $term->term_id, $tax_slug ) );
									foreach ( $ancestors as $ancestor_id ) {
										$ancestor = get_term( $ancestor_id, $tax_slug );
										$bc[] = array( 'title' => $ancestor->name, 'link' => get_term_link( $ancestor, $tax_slug ) );
									}
								}
								$bc[] = array( 'title' => $term->name, 'link' => get_term_link( $term, $tax_slug ) );
								break;
							}
						}
					}
				}
			}

			// return array()
			return $bc;
		}

		public static function add_posts_page_array( $bc ) {
			if ( is_page() || is_front_page() || is_author() || is_date() ) {
				return $bc;
			} else if ( is_category() ) {
				$tax = get_taxonomy( 'category' );
				if ( count( $tax->object_type ) != 1 || $tax->object_type[0] != 'post' ) {
					return $bc;
				}
			} else if ( is_tag() ) {
				$tax = get_taxonomy( 'post_tag' );
				if ( count( $tax->object_type ) != 1 || $tax->object_type[0] != 'post' ) {
					if ( isset( $_GET['post_type'] ) ) {
						$bc[] = array( 'title' => get_post_type_object( $_GET['post_type'] )->labels->name, 'link' => get_post_type_archive_link( $_GET['post_type'] ) );
					}
					return $bc;
				}
			} else if ( is_tax() ) {
				$tax = get_taxonomy( get_query_var( 'taxonomy' ) );
				if ( count( $tax->object_type ) != 1 || $tax->object_type[0] != 'post' ) {
					return $bc;
				}
			} else if ( is_home() && ! get_query_var( 'pagename' ) ) {
				return $bc;
			} else {
				$post_type = get_query_var( 'post_type' ) ? get_query_var( 'post_type' ) : 'post';
				if ( $post_type != 'post' ) {
					return $bc;
				}
			}
			if ( get_option( 'show_on_front' ) === 'page' && get_option( 'page_for_posts' ) && ! is_404() ) {
				$posts_page = get_post( get_option( 'page_for_posts' ) );
				$bc[] = array( 'title' => $posts_page->post_title, 'link' => get_permalink( $posts_page->ID ) );
			}

			// return array()
			return $bc;
		}

		public static function get_month_title( $monthnum = 0 ) {
			global $wp_locale;
			$monthnum = (int) $monthnum;
			$date_format = get_option( 'date_format' );
			if ( in_array( $date_format, array( 'DATE_COOKIE', 'DATE_RFC822', 'DATE_RFC850', 'DATE_RFC1036', 'DATE_RFC1123', 'DATE_RFC2822', 'DATE_RSS' ) ) ) {
				$month_format = 'M';
			} else if ( in_array( $date_format, array( 'DATE_ATOM', 'DATE_ISO8601', 'DATE_RFC3339', 'DATE_W3C' ) ) ) {
				$month_format = 'm';
			} else {
				preg_match( '/(^|[^\\\\]+)(F|m|M|n)/', str_replace( '\\\\', '', get_option( 'date_format' ) ), $m );
				$month_format = empty( $m[2] ) ? 'F' : $m[2];
			}

			if ( $month_format === 'F' ) {
				return $wp_locale->get_month( $monthnum );
			} else if ( $month_format === 'M' ) {
				return $wp_locale->get_month_abbrev( $wp_locale->get_month( $monthnum ) );
			} else {
				return $monthnum;
			}
		}

	}

	new Codevz;
}
