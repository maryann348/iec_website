<?php


/**
 * Enqueue Styles and Scripts
 */
function seedprod_pro_admin_enqueue_scripts( $hook_suffix ) {
	// global admin style
	wp_enqueue_style(
		'seedprod-global-admin',
		SEEDPROD_PRO_PLUGIN_URL . 'public/css/global-admin.css',
		false,
		SEEDPROD_PRO_VERSION
	);

	$is_localhost = seedprod_pro_is_localhost();

	// Load our admin styles and scripts only on our pages
	if ( strpos( $hook_suffix, 'seedprod_pro' ) !== false ) {
		// remove conflicting scripts
		wp_dequeue_script( 'googlesitekit_admin' );

		$vue_app_folder = 'pro';
		if ( strpos( $hook_suffix, 'seedprod_pro_builder' ) !== false || strpos( $hook_suffix, 'seedprod_pro_template' ) !== false ) {
			if ( $is_localhost ) {
				

				wp_register_script(
					'seedprod_vue_builder_app',
					'http://localhost:8083/index.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_set_script_translations( 'seedprod_vue_builder_app', 'seedprod-pro' );
				wp_enqueue_script( 'seedprod_vue_builder_app' );
				
			} else {
				wp_register_script(
					'seedprod_vue_builder_app_1',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/index.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_builder_app_2',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-vendors.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_builder_app_3',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-common.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);

				wp_set_script_translations( 'seedprod_vue_builder_app_1', 'seedprod-pro' );
				wp_set_script_translations( 'seedprod_vue_builder_app_2', 'seedprod-pro' );
				wp_set_script_translations( 'seedprod_vue_builder_app_3', 'seedprod-pro' );

				wp_enqueue_script( 'seedprod_vue_builder_app_1' );
				wp_enqueue_script( 'seedprod_vue_builder_app_2' );
				wp_enqueue_script( 'seedprod_vue_builder_app_3' );
				wp_enqueue_style( 'seedprod_vue_builder_app_css_1', SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/css/chunk-vendors.css', false, SEEDPROD_PRO_VERSION );
			}
		} else {
			if ( $is_localhost ) {
				
				wp_register_script(
					'seedprod_vue_admin_app',
					'http://localhost:8083/admin.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_set_script_translations( 'seedprod_vue_admin_app', 'seedprod-pro' );
				wp_enqueue_script( 'seedprod_vue_admin_app' );

				
			} else {
				wp_register_script(
					'seedprod_vue_admin_app_1',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/admin.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_admin_app_2',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-vendors.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);
				wp_register_script(
					'seedprod_vue_admin_app_3',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/js/chunk-common.js',
					array( 'wp-i18n' ),
					SEEDPROD_PRO_VERSION,
					true
				);

				wp_set_script_translations( 'seedprod_vue_admin_app_1', 'seedprod-pro' );
				wp_set_script_translations( 'seedprod_vue_admin_app_2', 'seedprod-pro' );
				wp_set_script_translations( 'seedprod_vue_admin_app_3', 'seedprod-pro' );

				wp_enqueue_script( 'seedprod_vue_admin_app_1' );
				wp_enqueue_script( 'seedprod_vue_admin_app_2' );
				wp_enqueue_script( 'seedprod_vue_admin_app_3' );
				wp_enqueue_style(
					'seedprod_vue_admin_app_css_1',
					SEEDPROD_PRO_PLUGIN_URL . 'public/' . $vue_app_folder . '/vue-backend/css/chunk-vendors.css',
					false,
					SEEDPROD_PRO_VERSION
				);
				// wp_enqueue_style(
				//     'seedprod_vue_admin_app_css_2',
				//     SEEDPROD_PRO_PLUGIN_URL . 'public/'.$vue_app_folder.'/vue-backend/css/admin.css',
				//     false,
				//     SEEDPROD_PRO_VERSION
				// );
			}
		}

		if ( strpos( $hook_suffix, 'seedprod_pro_builder' ) !== false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PRO_PLUGIN_URL . 'public/css/admin-style.min.css',
				false,
				SEEDPROD_PRO_VERSION
			);
			wp_enqueue_style(
				'seedprod-builder-css',
				SEEDPROD_PRO_PLUGIN_URL . 'public/css/tailwind-builder.min.css',
				false,
				SEEDPROD_PRO_VERSION
			);

			// Load WPForms CSS assets.
			if ( function_exists( 'wpforms' ) ) {
				add_filter( 'wpforms_global_assets', '__return_true' );
				wpforms()->frontend->assets_css();
			}

			// Load WooCommerce default styles if WooCommerce is active
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				wp_enqueue_style(
					'seedprod-woocommerce-layout',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-layout.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'all'
				);
				wp_enqueue_style(
					'seedprod-woocommerce-smallscreen',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce-smallscreen.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'only screen and (max-width: 1088px)' // 768px default break + 320px for sidebar
				);
				wp_enqueue_style(
					'seedprod-woocommerce-general',
					str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/woocommerce.css',
					'',
					defined( 'WC_VERSION' ) ? WC_VERSION : null,
					'all'
				);
			}
		}

		if ( strpos( $hook_suffix, 'seedprod_pro_template' ) !== false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PRO_PLUGIN_URL . 'public/css/admin-style.min.css',
				false,
				SEEDPROD_PRO_VERSION
			);
			wp_enqueue_style(
				'seedprod-builder-css',
				SEEDPROD_PRO_PLUGIN_URL . 'public/css/tailwind-builder.min.css',
				false,
				SEEDPROD_PRO_VERSION
			);
		}

		if ( strpos( $hook_suffix, 'seedprod_pro_builder' ) === false ) {
			wp_enqueue_style(
				'seedprod-css',
				SEEDPROD_PRO_PLUGIN_URL . 'public/css/tailwind-admin.min.css',
				false,
				SEEDPROD_PRO_VERSION
			);
		}

		wp_enqueue_style( 'seedprod-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,400,600,700&display=swap', false );

		wp_enqueue_style(
			'seedprod-fontawesome',
			SEEDPROD_PRO_PLUGIN_URL . 'public/fontawesome/css/all.min.css',
			false,
			SEEDPROD_PRO_VERSION
		);

		wp_register_script(
			'seedprod-iframeresizer',
			SEEDPROD_PRO_PLUGIN_URL . 'public/js/iframeResizer.min.js',
			array(),
			SEEDPROD_PRO_VERSION,
			false
		);
		wp_enqueue_script( 'seedprod-iframeresizer' );

		wp_enqueue_media();
		wp_enqueue_script( 'wp-tinymce' );
		wp_enqueue_editor();
	}
}
add_action( 'admin_enqueue_scripts', 'seedprod_pro_admin_enqueue_scripts', 99999 );



function seedprod_pro_wp_enqueue_styles() {
	 // wp_register_style(
	//     'seedprod-style',
	//     SEEDPROD_PRO_PLUGIN_URL . 'public/css/seedprod-style.min.css',
	//     false,
	//     SEEDPROD_PRO_VERSION
	//     );
	//wp_enqueue_style('seedprod-style');

	$is_user_logged_in = is_user_logged_in();
	if ( $is_user_logged_in ) {
		wp_enqueue_style(
			'seedprod-global-admin',
			SEEDPROD_PRO_PLUGIN_URL . 'public/css/global-admin.css',
			false,
			SEEDPROD_PRO_VERSION
		);
	}

	wp_register_style(
		'seedprod-fontawesome',
		SEEDPROD_PRO_PLUGIN_URL . 'public/fontawesome/css/all.min.css',
		false,
		SEEDPROD_PRO_VERSION
	);

	//wp_enqueue_style('seedprod-fontawesome');
}
add_action( 'init', 'seedprod_pro_wp_enqueue_styles' );


/**
 * Display settings link on plugin page
 */
add_filter( 'plugin_action_links', 'seedprod_pro_plugin_action_links', 10, 2 );

function seedprod_pro_plugin_action_links( $links, $file ) {
	$plugin_file = SEEDPROD_PRO_SLUG;

	if ( $file == $plugin_file ) {
		$settings_link = '<a href="admin.php?page=seedprod_pro">Setup</a>';
		array_unshift( $links, $settings_link );
	}
	return $links;
}

/**
 * Remove other plugin's style from our page so they don't conflict
 */

add_action( 'admin_enqueue_scripts', 'seedprod_pro_deregister_backend_styles', PHP_INT_MAX );

function seedprod_pro_deregister_backend_styles() {
	 // remove scripts registered by the theme so they don't screw up our page's style
	if ( isset( $_GET['page'] ) && strpos( $_GET['page'], 'seedprod_pro_builder' ) !== false ) {
		wp_dequeue_style( 'dashicons', 9999 );
		$seedprod_builder_debug = get_option( 'seedprod_builder_debug' );
		if ( empty( $seedprod_builder_debug ) ) {
			global $wp_styles;
			// list of styles to keep else remove
			$keep_styles = 'media-views|editor-buttons|imgareaselect|buttons|wp-auth-check|wpforms-full|thickbox|wp-mediaelement|wp-util';
			$s           = explode( '|', $keep_styles );

			$wpforms_url = plugins_url( 'wpforms' );

			foreach ( $wp_styles->queue as $handle ) {
				//echo '<br> '.$handle;
				if ( ! in_array( $handle, $s ) ) {
					if ( strpos( $handle, 'seedprod' ) === false ) {
						wp_dequeue_style( $handle );
						wp_deregister_style( $handle );
						//echo '<br>removed '.$handle;
					}
				}
			}

			// foreach ($wp_styles->registered as $handle => $asset) {
			//     //echo '<br> '.$handle;
			//     if (!in_array($handle, $s)) {
			//         if (strpos($handle, 'seedprod') === false && strpos($asset->src, $wpforms_url) === false) {
			//             wp_dequeue_style($handle);
			//             wp_deregister_style($handle);
			//             echo '<br>removed '.$handle;
			//         }
			//     }
			// }

			// remove scripts

			$s = 'admin-bar|common|utils|wp-auth-check|media-upload|jquery|media-editor|media-audiovideo|mce-view|image-edit|wp-tinymce|editor|quicktags|wplink|jquery-ui-autocomplete|thickbox|svg-painter|jquery-ui-core|jquery-ui-mouse|jquery-ui-accordion|jquery-ui-datepicker|jquery-ui-dialog|jquery-ui-slider|jquery-ui-sortable|jquery-ui-droppable|jquery-ui-tabs|jquery-ui-widget|wp-mediaelement|wp-util|underscore|wp-dom-ready|wp-components|wp-element|wp-i18n|wp-polyfill';
			$d = explode( '|', urldecode( $s ) );

			global $wp_scripts;
			foreach ( $wp_scripts->queue as $handle ) :
				//echo '<br>removed '.$handle;

				if ( ! empty( $d ) ) {
					if ( ! in_array( $handle, $d ) ) {
						if ( strpos( $handle, 'seedprod' ) === false ) {
							wp_dequeue_script( $handle );
							wp_deregister_script( $handle );
							//echo '<br>removed '.$handle;
						}
					}
				}
			endforeach;
		}
	}
}


add_filter( 'admin_body_class', 'seedprod_pro_add_admin_body_classes' );
function seedprod_pro_add_admin_body_classes( $classes ) {
	if ( ! empty( $_GET['page'] ) && strpos( $_GET['page'], 'seedprod_pro' ) !== false ) {
		$classes .= ' seedprod-body seedprod-pro';
	}
	if ( ! empty( $_GET['page'] ) && ( strpos( $_GET['page'], 'seedprod_pro_builder' ) !== false ) ) {
		$classes .= ' seedprod-builder seedprod-pro';
	}
	return $classes;
}


// Review Request
add_action( 'admin_footer_text', 'seedprod_pro_admin_footer' );

function seedprod_pro_admin_footer( $text ) {
	global $current_screen;

	if ( ! empty( $current_screen->id ) && strpos( $current_screen->id, 'seedprod' ) !== false && SEEDPROD_PRO_BUILD == 'lite' ) {
		$url  = 'https://wordpress.org/support/plugin/coming-soon/reviews/?filter=5#new-post';
		$text = sprintf( __( 'Please rate <strong>SeedProd</strong> <a href="%1$s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="%2$s" target="_blank">WordPress.org</a> to help us spread the word. Thank you from the SeedProd team!', 'seedprod-pro' ), $url, $url );
	}
	return $text;
}



// Add or Upgrade DB
add_action( 'admin_init', 'seedprod_pro_upgrade', 0 );


/**
 * Upgrade setting pages. This allows you to run an upgrade script when the version changes.
 *
 */
function seedprod_pro_upgrade() {
	// try to update license key
	$old_key = get_option( 'seed_cspv5_license_key' );
	$new_key = get_option( 'seedprod_api_key' );
	if ( ! empty( $old_key ) && empty( $new_key ) ) {
		update_option( 'seedprod_api_key', $old_key );
		$r = seedprod_pro_save_api_key( $old_key );
	}

	// get current version
	$seedprod_current_version = get_option( 'seedprod_version' );
	$upgrade_complete         = false;
	if ( empty( $seedprod_current_version ) ) {
		$seedprod_current_version = 0;
	}

	//if ($seedprod_current_version === 0) {
	if ( version_compare( $seedprod_current_version, SEEDPROD_PRO_VERSION ) === -1 || ! empty( $_GET['seedprod_force_db_setup'] ) ) {
		// Upgrade db if new version
		seedprod_pro_database_setup();
		seedprod_pro_domain_mapping_db_setup();
		$upgrade_complete = true;
	}

	if ( $upgrade_complete ) {
		update_option( 'seedprod_version', SEEDPROD_PRO_VERSION );
	}
	//}
}

/**
 * Create Database to Store Emails
 */
function seedprod_pro_database_setup() {
	global $wpdb;
	$tablename = $wpdb->prefix . 'csp3_subscribers';

	$sql = "CREATE TABLE `$tablename` (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            page_id int(11) NOT NULL,
            page_uuid varchar(255) DEFAULT NULL,
            email varchar(255) DEFAULT NULL,
            fname varchar(255) DEFAULT NULL,
            lname varchar(255) DEFAULT NULL,
            ref_url varchar(255) DEFAULT NULL,
            clicks int(11) NOT NULL DEFAULT '0',
            conversions int(11) NOT NULL DEFAULT '0',
            referrer int(11) NOT NULL DEFAULT '0',
            confirmed int(11) NOT NULL DEFAULT '0',
            optin_confirm int(11) NOT NULL DEFAULT '0',
            ip varchar(255) DEFAULT NULL,
            meta text DEFAULT NULL,
            created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY csp3_subscribers_page_uuid_idx (page_uuid)
        );";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta( $sql );
}

/**
 * Create Domain Mapping Database
 */
function seedprod_pro_domain_mapping_db_setup() {
	global $wpdb;
	$tablename = $wpdb->prefix . 'sp_domain_mapping';

	$sql = "CREATE TABLE `$tablename` (
            id int(11) unsigned NOT NULL AUTO_INCREMENT,
            domain varchar(255) DEFAULT NULL,
            path varchar(255) DEFAULT NULL,
            mapped_page_id int(11) NOT NULL,
            force_https boolean DEFAULT false,
            PRIMARY KEY  (id)
        );";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';

	dbDelta( $sql );
}


function seedprod_pro_change_footer_version( $str ) {
	if ( ! empty( $_GET['page'] ) && strpos( $_GET['page'], 'seedprod_pro' ) !== false ) {
		return $str . ' - SeedProd ' . SEEDPROD_PRO_VERSION;
	}

	return $str;
}
add_filter( 'update_footer', 'seedprod_pro_change_footer_version', 9999 );



/*
add_action( 'admin_footer', 'seedprod_pro_print_admin_js_template');
function seedprod_pro_print_admin_js_template() {
	?>
	<script id="seedprod-button-switch-mode" type="text/html">
		<div id="seedprod-switch-mode">
			<?php echo __( 'Edit with SeedProd', 'elementor' ); ?>
		</div>
	</script>
	<?php
}
*/


function seedprod_pro_add_admin_edit_seedprod() {
	$screen = get_current_screen();
	if ( 'page' === $screen->post_type ) {
		$id                      = 0;
		$is_seedprod             = 0;
		$seedprod_template_label = 'seedprod_lite';
		$is_seedprod_true        = 'seed_editor_false';
		$remove_post_callback    = 'seedprod_lite_remove_post';
		$seedprod_template_type  = 'template';

		
		if ( SEEDPROD_PRO_BUILD == 'pro' ) {
			$seedprod_template_label = 'seedprod_pro';
			$remove_post_callback    = 'seedprod_pro_remove_post';
		}
		

		if ( ! empty( $_GET['post'] ) ) {
			$id = absint($_GET['post']);

			if ( ! empty( get_post_meta( $id, '_seedprod_page', true ) ) ) {
				$is_seedprod            = get_post_meta( $id, '_seedprod_page', true );
				$is_seedprod_true       = 'seed_editor_true';
				$seedprod_template_type = 'builder';
			}

			if ( ! empty( get_post_field( 'post_content_filtered', $id ) ) ) {
				$seedprod_template_type = 'builder';
			}
		}

		if ( $seedprod_template_type == 'template' ) {
			$edit_url = admin_url() . 'admin.php?page=' . $seedprod_template_label . '_template&id=' . $id . '#/template/' . $id;
		} else {
			$edit_url = admin_url() . 'admin.php?page=' . $seedprod_template_label . '_builder&id=' . $id . '#/setup/' . $id;
		}

		$edit_seedprod_label  = '<img src="' . SEEDPROD_PRO_PLUGIN_URL . 'public/svg/admin-bar-icon.svg" style="margin-right:7px; margin-top:5px">' . __( 'Edit with SeedProd', 'seedprod-pro' );
		$back_wordpress_label = __( 'Back to WordPress Editor', 'seedprod-pro' );

		$localizations = array( 
			'ajax_url' => admin_url( 'admin-ajax.php' ), 
			'nonce' =>  wp_create_nonce( 'seedprod_back_to_editor_'.$id ),
		);

		printf(
			'
        <div class="active-seed-prod-buttons">
        <div class="' . $is_seedprod_true . '">
            <span class="seedprod-off">
            <a href="' . $edit_url . '" id="edit_seedprod_custom_link" class="edit_seedprod_custom_link button button-primary">
            ' . $edit_seedprod_label . '
            </a></span>
            <span class="seedprod-on">
            <a href="#back" class="back_to_wp_editor button">' . $back_wordpress_label . '</a>
            </span>
        </div>
        </div>
        <div class="seedprod_hidden_data">
            <input type="hidden" class="_seedprod_template_type" name="_seedprod_template_type" value="' . $seedprod_template_type . '"/>
            <input type="hidden" class="_seedprod_label" name="_seedprod_label" value="' . $seedprod_template_label . '"/>
            <input type="hidden" class="_seedprod_template_edit_url" name="_seedprod_template_edit_url" value="' . $edit_url . '"/>
            <input type="hidden" class="_seedprod_true" name="_seedprod_true" value="' . $is_seedprod_true . '"/>
        </div>
        '
		);

		echo '
        <script type="text/javascript">
        
        jQuery(document).ready(function(){  

            jQuery(document).on("click", ".edit_seedprod_custom_link", function(event) { 
                
                if(confirm("Please note by switching to SeedProd the current page\'s content will be replaced.")){
                    
                    var url_string = window.location;
                    var url = new URL(url_string);
                    var postid = url.searchParams.get("post");
                    //console.log(postid);

                    var post_ID = 0; 
                    if(postid!=null){
                        post_ID = jQuery("#post_ID").val();
                    }
                    //console.log(post_ID);

                    var seedprod_template_type = jQuery("._seedprod_template_type").val();
                    var seedprod_label = jQuery("._seedprod_label").val();
                    var seedprod_template_edit_url = jQuery("._seedprod_template_edit_url").val();
                    var seedprod_true = jQuery("._seedprod_true").val();
                    
                    var seedprod_template_edit_url_ = "";
                    var admin_url = localizedVars.admin_url; 

                    if(seedprod_template_type=="template"){
                        seedprod_template_edit_url_ = `${admin_url}?page=${seedprod_label}_${seedprod_template_type}&id=${post_ID}#/template/${post_ID}`;
                    }else{
                        seedprod_template_edit_url_ = `${admin_url}?page=${seedprod_label}_${seedprod_template_type}&id=${post_ID}#/setup/${post_ID}`;
                    }

                    location.href = seedprod_template_edit_url_;

                }
                

            });

            jQuery(document).on("click", ".back_to_wp_editor", function(event) { 
                
                if (jQuery(".edit-post-header-toolbar").length) {
                    wp.data.dispatch( "core/block-editor" ).resetBlocks([]);
                    jQuery(".block-editor-block-list__layout").show();
                }

                if (jQuery("#postdivrich").length) {
                    //jQuery("#postdivrich").show();
                    //jQuery("#postdivrich .wp-editor-area").html("");
                }
                jQuery(".managed_by_seedprod").hide();
                
                var ajax_url = "' . $localizations['ajax_url'] . '";
                var post_id =  jQuery("#post_ID").val();
    
                var formData = new FormData();
                formData.append("action", "' . $remove_post_callback . '");
				formData.append("nonce", "' . $localizations['nonce'] . '");
                formData.append("post_id", post_id);
                //console.log(formData);
    
                jQuery.ajax({ 
                    type: "POST",
                    url: ajax_url, 
                    data: formData,
                    cache: false,
                    processData : false,
                    contentType: false,
                    success: function(data) {
                        
                        jQuery(".seed_editor_true").addClass("seed_editor_false");
                        jQuery(".seed_editor_false").addClass("seed_editor_true");
                        //console.log("removed seedprod settings");

                        location.reload();

                    },
                });
                
            }); 
        });
        </script>
        ';
	}
}


add_action( 'admin_footer', 'seedprod_pro_add_admin_edit_seedprod' );
add_action( 'edit_form_after_title', 'seedprod_pro_before_editor' );

function seedprod_pro_before_editor() {
	$seedprod_app_settings = get_option( 'seedprod_app_settings' );
	if ( ! empty( $seedprod_app_settings ) ) {
		$seedprod_app_settings = json_decode( stripslashes( $seedprod_app_settings ) );
	} else {
		// fail safe incase settings go missing
		require_once SEEDPROD_PRO_PLUGIN_PATH . 'resources/data-templates/default-settings.php';
		update_option( 'seedprod_app_settings', $seedprod_app_default_settings );
		$seedprod_app_settings = json_decode( $seedprod_app_default_settings );
	}
	$disable_seedprod_button = $seedprod_app_settings->disable_seedprod_button;

	if ( $disable_seedprod_button == false ) {
		echo '
        <div class="active-seed-prod-buttons-classic"></div>
        <script type="text/javascript">
        jQuery(document).ready(function(){  
            var active_seedprod_btn = jQuery(".active-seed-prod-buttons").html();
            jQuery(".active-seed-prod-buttons-classic").html(active_seedprod_btn);
        });
        </script>
    ';
	}
}




add_action( 'enqueue_block_editor_assets', 'seedprod_pro_link_injection_to_gutenberg_toolbar' );
function seedprod_pro_link_injection_to_gutenberg_toolbar() {
	$seedprod_app_settings = get_option( 'seedprod_app_settings' );
	if ( ! empty( $seedprod_app_settings ) ) {
		$seedprod_app_settings = json_decode( stripslashes( $seedprod_app_settings ) );
	} else {
		// fail safe incase settings go missing
		require_once SEEDPROD_PRO_PLUGIN_PATH . 'resources/data-templates/default-settings.php';
		update_option( 'seedprod_app_settings', $seedprod_app_default_settings );
		$seedprod_app_settings = json_decode( $seedprod_app_default_settings );
	}
	$disable_seedprod_button = $seedprod_app_settings->disable_seedprod_button;

	if ( $disable_seedprod_button == false ) {
		$screen = get_current_screen();
		if ( 'page' === $screen->post_type ) {
			$localizations = array(
				'admin_url'  => admin_url() . 'admin.php',
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'_wp_nonce'  => wp_create_nonce( 'ajax-nonce' ),
				'plugin_url' => SEEDPROD_PRO_PLUGIN_URL,
			);
			wp_enqueue_script( 'seedprod-link-in-toolbar', SEEDPROD_PRO_PLUGIN_URL . 'public/js/toolbar.js', array(), '1.0', true );
			wp_localize_script( 'seedprod-link-in-toolbar', 'localizedVars', $localizations );
		}
	}
}

add_filter( 'display_post_states', 'seedprod_pro_add_post_state', 10, 2 );
function seedprod_pro_add_post_state( $post_states, $post ) {
	$has_settings = get_post_meta( $post->ID, '_seedprod_page', true );

	if ( $post->post_type == 'page' && ! empty( $has_settings ) ) {
		$post_states['seedprod'] = 'SeedProd';
	}
	return $post_states;
}




function seedprod_pro_add_menu_item( $wp_admin_bar ) {
	$seedprod_menu_link = 'admin.php?page=seedprod_lite_template&id=0#/template';
	
	if ( SEEDPROD_PRO_BUILD == 'pro' ) {
		$seedprod_menu_link = 'admin.php?page=seedprod_pro_template&id=0#/template';
	}
	

	$args = array(
		'id'     => 'seedprod_template',
		'title'  => 'SeedProd Landing Page',
		'href'   => $seedprod_menu_link,
		'parent' => 'new-content',
	);

	$wp_admin_bar->add_node( $args );
}

add_action( 'admin_bar_menu', 'seedprod_pro_add_menu_item', 80 );


add_action( 'wp_ajax_seedprod_pro_remove_post', 'seedprod_pro_remove_post' );

function seedprod_pro_remove_post() {
    if (check_ajax_referer('seedprod_back_to_editor_'.absint($_POST['post_id']), 'nonce') && current_user_can('delete_posts')) {
        $post_id = absint($_POST['post_id']);
        $data    = array(
        'ID'           => $post_id,
    	);

        delete_post_meta($post_id, '_seedprod_page');
        wp_die();
    }
}


function seedprod_pro_adding_facebook_xfbml() {
	$facebook_app_id = '383341908396413';
	$page_builder    = 'seedprod_lite_builder';

	if ( SEEDPROD_PRO_BUILD == 'pro' ) {
		$page_builder = 'seedprod_pro_builder';
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == $page_builder ) {

		echo '<div id="fb-root"></div>
        <script async defer crossorigin="anonymous" 
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v9.0&appId=' . $facebook_app_id . '&autoLogAppEvents=1" 
        >
        </script>';

		/*
		echo '
		<div id="fb-root"></div>
		<script>
			window.fbAsyncInit = function() {
				FB.init({
				appId            :'.$facebook_app_id.',
				autoLogAppEvents : true,
				xfbml            : true,
				version          : "v9.0"
				});
			};
		</script>
		<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
		';*/
	}
}
add_action( 'admin_head', 'seedprod_pro_adding_facebook_xfbml' );


