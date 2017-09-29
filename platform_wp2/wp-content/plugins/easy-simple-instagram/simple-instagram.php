<?php

/*
Plugin Name: Simple Instagram
Version: 1.3
Plugin URI: https://base29.com/
Description: An easy to use plugin to get instagram feed to anywhere in the theme.
Author: Base29
Author URI: https://base29.com/simple-instagram
Text Domain: simple-instagram
Domain Path: /languages
License: GPL v3
*/

/**
 * Simple Instagram Class
 *
 * @copyright Base29 2016
 * @author Omer Hussain
 */
class simple_instagram
{

    /**
     * @var string $client_id Client ID from instagram
     * @var string $script_url Path to the script to get the access token of the user
     * @var string $back_uri Current user location
     * @var array $setting Plugin's options array
     */
    protected $client_id = 'ae4b841101404e03b389c30af21ba6fb';
    protected $script_uri = 'https://www.base29.com/simple-instagram/get-token/';
    public $back_uri;
    public $setting;


    /**
     * Dump everything here for this plugin :p
     *
     * @since 1.0
     */
    public function __construct()
    {

        // Load text domain
        add_action('init', array($this, 'si_textdomain'));

        // Register setings
        add_action('admin_init', array($this, 'si_settings'));

        // Load assets
        add_action('admin_enqueue_scripts', array($this, 'si_admin_assets'));
        add_action('wp_enqueue_scripts', array($this, 'si_assets'));

        // Integrating font-awesome icon for admin menu
        add_action('admin_head', array($this, 'si_fa_icon'));
        add_action('wp_head', array($this, 'si_inline_styles'));

        // Adding menu
        add_action('admin_menu', array($this, 'si_menu'));

        // Shortcode
        add_shortcode('simple-instagram', array($this, 'si_shortcode'));

        // Register Widget
        require_once "si-widget.php";
        add_action('widgets_init', array($this, 'si_register_widget'));

        // Add setting link
        add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($this, 'si_setting_link'));


        // Back to plugin URI
        $this->back_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Instagram information & settings
        $this->setting = get_option('simple_instagram_settings');

    }


    /**
     * Load text domain
     *
     * @since 1.0
     */
    public function si_textdomain()
    {
        load_plugin_textdomain('simple-instagram', false, dirname(plugin_basename(__FILE__)) . '/languages');
    }


    /**
     * Register Settings
     *
     * @since 1.0
     */
    public function si_settings()
    {

        register_setting('simple_instagram_settings', 'simple_instagram_settings');


    }


    /**
     * Load admin assets
     *
     * @since 1.0
     */
    public function si_admin_assets()
    {

        wp_enqueue_style('fontawesome', plugins_url('assets/css/font-awesome.css', __FILE__));
        wp_enqueue_style('si-admin-style', plugins_url('assets/css/si-admin.css', __FILE__));
        wp_enqueue_script('si-admin-js', plugins_url('assets/js/si-admin.js', __FILE__));

    }


    /**
     * Load Assets
     *
     * @since 1.0
     */
    public function si_assets()
    {

    }


    /**
     * Add admin menu
     *
     * @since 1.0
     */
    public function si_menu()
    {

        add_menu_page(__('Simple Instagram', 'simple-instagram'), __('Simple Instagram', 'simple-instagram'), 'manage_options', 'simple_instagram', array($this, 'si_settings_page',));

    }


    /**
     * Font Awesome icon for dashbaord menu
     *
     * @since 1.0
     */
    public function si_fa_icon()
    {
        ?>
        <style type='text/css' media='screen'>
            #adminmenu #toplevel_page_simple_instagram div.wp-menu-image:before {
                font-family: 'FontAwesome' !important;
                content: '\f16d';
            }
        </style>
        <?php
    }


    function si_inline_styles() { 
        ?>
        <style type='text/css' media='screen'>
            .simple-instagram-list {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            .simple-instagram-list-item {
                float: left;
                margin:  0 10px 10px 0;
                padding: 0;
                width: calc((100% - 20px) / 3);
                border: none;
            }

            .simple-instagram-list-item:nth-child(3n) {
                margin-right: 0;
            }

            .simple-instagram-list-item img {
                max-width: 100%;
                height: auto;
            }
            .widget ul li.simple-instagram-list-item {
                padding-bottom: 0;
                border-bottom: none;
            }
        </style>
        <?php
    }

    /**
     * Settings Page
     *
     * @since 1.0
     */
    public function si_settings_page()
    {
        ?>
        <div class="wrap" id="si-wrap">
            <h1>
                <?php echo get_admin_page_title(); ?>
            </h1>


            <!-- on success -->
            <?php if (isset($_GET['settings-updated'])) { ?>
                <div id="message" class="updated notice notice-success is-dismissible">
                    <p><?php _e('Settings saved!', 'simple-instagram'); ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text"><?php _e('Dismiss this notice.', 'simple-instagram'); ?></span>
                    </button>
                </div>
            <?php } ?>
            <!-- on success -->

            <form method="post" action="options.php">
                <?php settings_fields('simple_instagram_settings'); ?>
                <fieldset>
                    <legend>
                        <h2><?php _e('Configuration', 'simple-instagram'); ?></h2>
                    </legend>

                    <!-- Get my instagram -->
                    <div class="si-row">
                        <a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo $this->client_id ?>&scope=basic+public_content&redirect_uri=<?php echo $this->script_uri . '?return_uri=' . $this->back_uri; ?>&response_type=token"
                           class="si-get-btn"><?php _e('Get me my Access Token and User ID', 'simple-instagram'); ?></a>
                    </div>
                    <!-- Get my instagram -->

                    <!-- Display Access Token & User ID -->
                    <?php if (isset($_GET['code'])) {

                        $recv_access_token = $_GET['code'];
                        $user_id = explode('.', $recv_access_token);

                        ?>
                        <div class="si-code">
                            <p>
                                <label><i class="fa fa-unlock-alt"
                                          aria-hidden="true"></i> <?php _e('Access Token:', 'simple-instagram'); ?>
                                </label>
                                <input type="text" size="79" readonly="" value="<?php echo $recv_access_token; ?>"
                                       onclick="this.focus();this.select()"
                                       title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'simple-instagram'); ?>">
                            </p>
                            <p>
                                <label><i class="fa fa-user" aria-hidden="true"></i> <?php _e('User ID:'); ?> </label>
                                <input type="text" size="79" readonly="" value="<?php echo $user_id[0]; ?>"
                                       onclick="this.focus();this.select()"
                                       title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'simple-instagram'); ?>">
                            </p>
                            <p class="si-note">
                                <i class="fa fa-clipboard" aria-hidden="true"></i>
                                <span><?php _e('Important Note:', 'simple-instagram'); ?></span>
                                <strong><?php _e('COPY', 'simple-instagram'); ?></strong> <?php _e('and', 'simple-instagram'); ?>
                                <strong><?php _e('PASTE', 'simple-instagram'); ?></strong> <?php _e('the above information into fields below and click'); ?>
                                <strong><?php _e('SAVE SETTINGS', 'simple-instagram'); ?></strong>
                            </p>
                        </div>
                        <?php
                    } ?>
                    <!-- Display Access Token & User ID -->

                    <div class="si-row">
                        <div class="si-left-col">
                            <label for="si-access-token">
                                <?php _e('Access Token', 'simple-instagram'); ?>
                            </label>
                        </div>
                        <div class="si-right-col">
                            <input id="si-access-token"
                                   type="text"
                                   class="large-text"
                                   name="simple_instagram_settings[access_token]"
                                   value="<?php echo $this->setting['access_token']; ?>">
                            <a href="#" class="si-what" data-info="access-token">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </a>
                            <div class="si-info-box" id="access-token">
                                <p><?php _e('For displaying your Instagram feed you need to get your access token. We have eased
                                    the process for getting the access token you just need to click on the above button
                                    and sign in to your instagram account we will retrieve the access token
                                    automatically.', 'simple-instagream'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="si-row">
                        <div class="si-left-col">
                            <label>
                                <?php _e('Display Photos By:', 'simple-instagram'); ?>
                            </label>
                        </div>
                        <div class="si-right-col si-options">
                            <div>
                                <input id="si-user-id"
                                       type="radio"
                                       name="simple_instagram_settings[display_opt]"
                                       value="feed"
                                    <?php
                                    checked('feed', $this->setting['display_opt']);
                                    echo ($this->setting['display_opt'] == '') ? 'checked="checked"' : '';
                                    ?>>
                                <label for="si-user-id"><?php _e('User ID:', 'simple-instagram'); ?></label>
                                <input type="text"
                                       name="simple_instagram_settings[user_id]"
                                       value="<?php echo $this->setting['user_id']; ?>">
                                <a href="#" class="si-what" data-info="user-id">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                                <div class="si-info-box" id="user-id">
                                    <p><?php _e('You can use your or someone else&acute;s User ID to display your or their&acute; instagram feed. You can get your user ID by signing in using the above button.', 'simple-instagram'); ?></p>
                                </div>
                            </div>
                            <div>
                                <input id="si-hashtag"
                                       type="radio"
                                       name="simple_instagram_settings[display_opt]"
                                       value="hashtag"
                                    <?php checked('hashtag', $this->setting['display_opt']) ?>>
                                <label for="si-hashtag"><?php _e('Hashtag:', 'simple-instagram'); ?></label>
                                <input type="text"
                                       name="simple_instagram_settings[hashtag]"
                                       value="<?php echo $this->setting['hashtag']; ?>">
                                <a href="#" class="si-what" data-info="hashtag">
                                    <i class="fa fa-question-circle" aria-hidden="true"></i>
                                </a>
                                <div class="si-info-box" id="hashtag">
                                    <p><?php _e('You can show feed of a specific hashtag (#). It will display all the photos related to the hashtag defined above. You can use only one hashtag for now. i.e. #cat', 'simple-instagram'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="si-row">
                        <div class="si-left-col">
                            <label for="si-follow-btn">
                                <?php _e('Hide Follow Button', 'simple-instagram'); ?>
                            </label>
                        </div>
                        <div class="si-right-col">
                            <input id="si-follow-btn"
                                   type="checkbox"
                                   name="simple_instagram_settings[follow_button]"
                                   value="1"
                                <?php echo (isset($this->setting['follow_button'])) ? 'checked="checked"' : ''; ?>>
                            <a href="#" class="si-what" data-info="follow-button">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </a>
                            <div class="si-info-box" id="follow-button">
                                <p><?php _e('You can hide the FOLLOW button that is showing under your feed by default.', 'simple-instagream'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="si-row">
                        <div class="si-left-col">
                            <label for="si-limit">
                                <?php _e('Caption Words Limit', 'simple-instagram'); ?>
                            </label>
                        </div>
                        <div class="si-right-col">
                            <input id="si-limit"
                                   type="text"
                                   class="small-text"
                                   name="simple_instagram_settings[caption_limit]"
                                   value="<?php echo $this->setting['caption_limit']; ?>">
                            <a href="#" class="si-what" data-info="caption-limit">
                                <i class="fa fa-question-circle" aria-hidden="true"></i>
                            </a>
                            <div class="si-info-box" id="caption-limit">
                                <p><?php _e('Define the limit of words to display the caption', 'simple-instagream'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="button-primary"
                               value="<?php _e('Save Settings', 'simple-instagram'); ?>">
                    </div>
                </fieldset>

                <div class="si-box">
                    <h2><i class="fa fa-star" aria-hidden="true"></i> <?php _e('Rate us!', 'simple-instagram'); ?></h2>
                    <p><?php _e('Like our plugin? Help us spread it\'s charm by rating and reviewing us.', 'simple-instagram'); ?>
                        <a href="https://wordpress.org/support/view/plugin-reviews/easy-simple-instagram"
                           target="_blank"><?php _e('Rate us now!'); ?></a></p>
                </div>
                <div class="si-box">
                    <h2><i class="fa fa-heart"
                           aria-hidden="true"></i> <?php _e('We\'d love your suggestions!', 'simple-instagram'); ?></h2>
                    <p><?php _e('We would love to know what our users think of Simple Instagram plugin and help us make this plugin even better and more user frinedly and suggest feature they would like to be added to it.', 'simple-instagram'); ?>
                        <a href="https://wordpress.org/support/topic/we-would-love-to-hear-from-you-❤️"
                           target="_blank"><?php _e('Let us know!'); ?></a></p>
                </div>

            </form>
            <div class="si-how">
                <h2><?php _e('How to use?', 'simple-instagram'); ?></h2>
                <ul>
                    <li>
                        <strong><?php _e('Simple Usage:', 'simple-instagram'); ?> </strong><?php _e('You can display photos on any post or page you like with a simple short code', 'simple-instagram'); ?>
                        <code>[simple-instagram]</code></li>
                    <li>
                        <strong><?php _e('Limit Photos:', 'simple-instagram'); ?> </strong><?php _e('You can use ', 'simple-instagram'); ?>
                        <code>[simple-instagram
                            limit="10"]</code> <?php _e('to display specific amount of photos.', 'simple-instagram'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Display Caption:', 'simple-instagram'); ?> </strong><?php _e('Use ', 'simple-instagram'); ?>
                        <code>[simple-instagram
                            caption="true"]</code> <?php _e('to display captions for each photo under them.', 'simple-instagram'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Widget:', 'simple-instagram'); ?> </strong><?php _e('You can also display photos through our widget which can be found in Appearance > Widgets.', 'simple-instagram'); ?>
                    </li>
                    <li>
                        <strong><?php _e('Function:', 'simple-instagram'); ?> </strong><?php _e('Display feed anywhere in the theme by calling the global function', 'simple-instagram'); ?> <code>&lt;?php
                            simple_instagram($limit, $caption); ?&gt;</code> (<strong>$limit</strong> <?php _e('accepts an integer and you can define any number to limit the feed and', 'simple-instagram'); ?> <strong>$caption</strong> <?php _e('accepts a boolean and you can enable (true) / disable (false) the captions.', 'simple-instagram'); ?>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }


    /**
     * Shortcode
     *
     * @param array Default parameters
     * @return content
     * @since 1.0
     */
    public function si_shortcode($atts)
    {

        try {

            if (($this->setting['access_token']) && ($this->setting['hashtag'] || $this->setting['user_id'])) {

	            if ($this->setting['user_id']) {

		            // Attributes
		            $attr = shortcode_atts( array(
			            'limit'   => '',
			            'caption' => ''
		            ), $atts );

		            // Get feed
		            $feed = $this->si_instagram_data( $this->setting['display_opt'], $attr['limit'] );


		            if ( $feed->meta->code == 400 ) {
			            throw new Exception( '<h3>Oops!!! ... Something went wrong with Simple Instagram Plugin ... ' . $feed->meta->error_message . '</h3>' );
		            }


		            $content = '<div id="simple-instagram-wrap">';
		            $content .= '<ul class="simple-instagram-list">';

		            foreach ( $feed->data as $feed ) {

			            $content .= '<li class="simple-instagram-list-item">';
			            $content .= '<a href="' . $feed->link . '" target="_blank">';
			            $content .= '<img src="' . $feed->images->standard_resolution->url . '" alt="">';
			            $content .= '</a>';

			            if ( $attr['caption'] != '' ) {
				            if ( isset($feed->caption->text) ) {

					            if ( $this->setting['caption_limit'] ) {

						            // Execute if words are more than limit
						            if ( str_word_count( $feed->caption->text, 0 ) > $this->setting['caption_limit'] ) {

							            $words   = str_word_count( $feed->caption->text, 2 );
							            $pos     = array_keys( $words );
							            $caption = substr( $feed->caption->text, 0, $pos[ $this->setting['caption_limit'] ] ) . ' ...';

						            } else {

							            // If words are less than limit
							            $caption = $feed->caption->text;

						            }

					            } else {

						            $caption = $feed->caption->text;

					            }

					            $content .= '<div class="simple-instagram-caption">' . $caption . '</div>';
				            } else {
					            $content .= '<div class="simple-instagram-caption">' . __( 'No Caption', 'simple-instagram' ) . '</div>';
				            }
			            }

			            $content .= '</li>';

		            }

		            // Get user data
		            $user_data = $this->si_instagram_data( 'user-info', null );

		            $content .= '</ul>';

		            if ( ! isset($this->setting['follow_button']) ) {

			            $content .= '<div class="si-follow-me">';
			            $content .= '<a href="https://www.instagram.com/' . $user_data->data->username . '" target="_blank">Follow &nbsp;<i class="fa fa-instagram" aria-hidden="true"></i>&nbsp; ' . $user_data->data->username . '</a>';
			            $content .= '</div>';

		            }

		            $content .= '</div>';

	            } else {

		            $content = '<h3 style="text-align: center">' . __('User ID must be defined.', 'simple_instagram') . '</h3>';

	            }

            } else {

                $content = '<h3 style="text-align: center">' . __('Simple Instagram Feed plugin is successfully installed and activated but in order to use the plugin you must configure it first.', 'simple_instagram') . '</h3>';

            }


        } catch (Exception $ex) {

            $content = $ex->getMessage();

        }

        return $content;


    }


    /**
     * Instagram Feed
     *
     * @param string $type Define the type of the feed i.e. user-info, hashtag, feed
     * @param int $limit Define the limit to display results
     * @return json
     * @since 1.0
     */
    public function si_instagram_data($type, $limit)
    {

        // If user set display limit
        if ($limit) {
            $count = '&count=' . $limit;
        } else {
            $count = '';
        }

        // Determine data type
        switch ($type) {

            case 'user-info':

                $user_id = explode('.', $this->setting['access_token']);

                $api_url = "https://api.instagram.com/v1/users/{$user_id[0]}?access_token={$this->setting['access_token']}" . $count;

                break;

            case 'feed':

                $api_url = "https://api.instagram.com/v1/users/{$this->setting['user_id']}/media/recent/?access_token={$this->setting['access_token']}" . $count;

                break;

            case 'hashtag':

                $hashtag = substr($this->setting['hashtag'], 1);
                $api_url = "https://api.instagram.com/v1/tags/{$hashtag}/media/recent/?access_token={$this->setting['access_token']}" . $count;

                break;
        }

        // Accessing API
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $api_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data_raw = curl_exec($curl);

        curl_close($curl);


        // JSON decoding
        $data = json_decode($data_raw);


        return $data;

    }


    /**
     * Widget
     *
     * @since 1.0
     */
    public function si_register_widget()
    {
        register_widget("si_widget");
    }


    /**
     * For setting link in plugin listing area.
     *
     * @param $links
     * @return array
     */
    public function si_setting_link($links)
    {

        $plugin_links = array(
            '<a href="' . esc_url(admin_url('admin.php?page=simple_instagram')) . '">' . __('Settings', 'simple-instagram') . '</a>',
        );

        return array_merge($plugin_links, $links);
    }


}

/**
 * Creating new instance
 */
$simple_instagram = new simple_instagram;


/**
 * Global Function
 *
 * This function is for our developer friends out there to call it anywhere in the theme :)
 *
 * @param integer $limit Limit of displaying images
 * @param boolean $caption Enable / Disable caption (true = enable, false = disable) by default its false
 * @since 1.1
 */
function simple_instagram($limit, $caption = false)
{

    echo do_shortcode("[simple-instagram limit=" . $limit . " caption=" . $caption . "]");

}
