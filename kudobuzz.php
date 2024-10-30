<?php

/*
  Plugin Name: Kudobuzz
  Plugin URI: https://kudobuzz.com
  Description: Collect your business and social reviews from Facebook, Twitter, Instagram, Google+ and Yelp.
  Version: 5.3.2
  Author: Kudobuzz
  Author URI: https://kudobuzz.com
  License: GPL
 */

if (!defined('WPINC'))
    die;

if(phpversion() < 7) {
    echo '<span style="font-family: arial; color: crimson">Your current PHP version is '. phpversion() .'. Please upgrade to PHP version 7 to use the Kudobuzz plugin.</span>';
    die;
}

require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

use Kudobuzz\Services\Storage;
use Kudobuzz\Services\ShortCodes;

if (!class_exists('Kudobuzz')) {

    class Kudobuzz {

        const INSTALLED = 'installed';
        const SIGNED_UP = 'signed_updash';
        const EMAIL_VERIFIED = 'email_verified';
        const BUSINESS_CREATED = 'business_created';
        const ACCOUNT_ACTIVATED = 'account_activated';
        const WIDGET_INSTALLED = 'widget_installed';

        public $shortCode;

        /**
         * Kudobuzz constructor
         */
        public function __construct()
        {
            //Loading env keys

            loadEnv();
            $this->shortCode = new ShortCodes();

            //Run admin actions
            $this->run_admin_actions();

            //Register hooks
            $this->run_registration_hooks();

            //Register shortcode
            $this->register_shortcodes();

            add_action('wp_ajax_create_account', [$this, 'create_account']);
            add_action('wp_ajax_create_business', [$this, 'create_business']);
            add_action('wp_ajax_install_widget', [$this, 'install_widget']);
            add_action('admin_init', [$this, 'init_plugin']);

            //Load JS & CSS files
            add_action('admin_enqueue_scripts', [$this, 'load_css_files']);
            add_action('wp_head', [$this, 'inject_js_code']);
        }


        /**
         * Inject JS code in the user theme
         */
        public function inject_js_code()
        {
           try{
            $code =  getWidget();
                if(isset($code) && !is_null($code)) {
                    echo $code;
                }
            } catch (\Exception $exception) {
                reportException($exception,[]);
           }
        }

        /**
         * Register shortcodes
         *
         * @return void
         */
        public function register_shortcodes()
        {
            add_shortcode('kudobuzz-fullpage', [$this->shortCode, 'fullpage']);
            add_shortcode('kudobuzz-slider', [$this->shortCode, 'slider']);
            add_shortcode('kudobuzz-badge', [$this->shortCode, 'badge']);
        }

        /**
         * Run hooks when plugin is activated/uninstalled
         *
         * @return void
         */
        public function run_registration_hooks()
        {
            register_activation_hook(__FILE__, [$this, 'activate_plugin']);
        }

        /**
         * Run admin actions on startup
         */
        public function run_admin_actions()
        {
            add_action('admin_menu', [$this, 'add_menu']);
        }

        /**
         * Add menu and submenu items
         */
        public function add_menu()
        {
            add_menu_page(
                'Kudobuzz', 'Kudobuzz', 'manage_options', 'dashboard',
                [$this, 'check_plugin_status'], plugins_url('assets/images/kudobuzz_mini_logo.png', __FILE__), '2.2.9'
            );

            add_submenu_page(
                'dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'dash',
                [$this, 'load_dash_view']
            );

            add_submenu_page(
                'dashboard', 'Installation Instructions', 'Documentation', 'manage_options', 'documentation',
                [$this, 'load_documentation_view']
            );

            add_submenu_page(
                'dashboard', 'Leave a Review', 'Leave a Review', 'manage_options', 'leave-review',
                [$this, 'load_leave_review_view']
            );

            add_submenu_page(
                'dashboard', 'Get Help', 'Get Help', 'manage_options', 'get-help',
                [$this, 'load_get_help_view']
            );

            add_submenu_page(
                '', 'Sign Up', 'Sign Up', 'manage_options', 'sign-up',
                [$this, 'load_signup_view']
            );

            add_submenu_page(
                '', 'Create Business', 'Create Business', 'manage_options', 'create-business',
                [$this, 'load_create_business_view']
            );

        }

        /**
         * Init plugin
         *
         * @return void
         */
        public function init_plugin()
        {
            if (get_option('kudobuzz_activation_redirect', false)) {
                delete_option('kudobuzz_activation_redirect');
                $this->check_plugin_status();
                exit();
            }
        }

        /**
         * Set option when plugin is activated
         *
         * @return void
         */
        public function activate_plugin()
        {

            $options = [
                'kudobuzz_activation_redirect' => true,
                'kudobuzz_fullpage_widget' => '<div id="kudobuzz_fullpage_widget"></div>',
                'kudobuzz_slider_widget' => '<div id="kudobuzz_slider_widget"></div>',
                'kudobuzz_badge_widget' => '<div id="kudobuzz_badge_widget"></div>'
            ];
            Storage::update($options);

            $this->register_shortcodes();
        }


        /**
         * Sign up users
         *
         * @return void
         */
        public function create_account()
        {
            try {
                $admin_email = get_bloginfo('admin_email');

                $details = [
                    'email' => $admin_email,
                    'domain' => get_site_url(),
                ];

                $business = getBusiness( $details['domain'] );

                if (gettype( $business ) === 'string' && strpos( $business, 'user does not exist' )) {
                    $business = createBusiness( $details );
                }

                if ($business->type) {
                    $status = ($business->type === 'new_business') ? self::BUSINESS_CREATED : self::SIGNED_UP;
                }

                if ($business->data && $business->data->id) {
                    $options = [
                        'kudobuzz_id' => $business->data->id,
                        'kudobuzz_business_id' => $business->data->businesses[0]->id,
                        'kudobuzz_user_name' => $business->data->name,
                        'kudobuzz_user_role' => $business->data->role,
                        'kudobuzz_user_email' => $business->data->email,
                        'kudobuzz_user_status' => $business->data->status,
                        'kudobuzz_onboarding_status' => $status
                    ];
                    Storage::saveOrUpdate( $options );
                    $business->authUrl = get_dashboard_auth_url( $business->data->id, $business->data->access_token );
                }
                if (gettype( $business ) === 'string' && strpos( $business, '"email already exists' )) {
                    echo json_encode( [
                        'errors' => [
                            'title' => 'email_error',
                            'msg' => "<p>The email {$admin_email} is already taken by another user.</p> <a href=\"mailto:help@kudobuzz.com\"> Support here</a>"
                        ]
                    ] );
                    wp_die();
                }
            } catch (\Exception $e) {
                echo json_encode([
                    'errors' => [
                        'msg' => 'An error occurred, please try again.'
                    ]
                ]);
                reportException($e, [
                    'action' => 'fetching_business',
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'code' => $e->getCode(),
                    'line' => $e->getLine()
                ]);
                wp_die();
            }

            response()->json( $business );
        }

        /**
         * Installation instructions
         */
        public function load_documentation_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/documentation.php');
        }

        /**
         * Installation leave a review
         */
        public function load_leave_review_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/leave_review.php');
        }

        /**
         * Get help
         */
        public function load_get_help_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/get_help.php');
        }

        /**
         * Load signup view
         */
        public function load_signup_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/signup.php');
        }

        /**
         * Load installation instructions view
         *
         * @return void
         */
        public function load_short_codes_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/shortcodes.php');
        }

        /**
         * Inject rich snippet
         *
         * @return void
         */
        public function inject_rich_snippet()
        {
            echo do_shortcode('[site_rich_snippet]');
        }

        /**
         * Load dash view
         *
         */
        public function load_dash_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/dashboard.php');
        }

        /* Load dashboard view
         *
         * @return void
         */

        public function check_plugin_status()
        {
            $plugin_status = Storage::get('kudobuzz_onboarding_status');

            switch ($plugin_status) {

                case self::SIGNED_UP:
                    wp_redirect('admin.php?page=dashboard');
                    include(plugin_dir_path(__FILE__) . './views/dashboard.php');
                    exit();
                    break;

                case self::EMAIL_VERIFIED:
                    wp_redirect('admin.php?page=create-business');
                    include(plugin_dir_path(__FILE__) . '/views/create_business.php');
                    exit();
                    break;

                case self::BUSINESS_CREATED:
                    wp_redirect('admin.php?page=dash');
                    include(plugin_dir_path(__FILE__) . '/views/dashboard.php');
                    exit();
                    break;

                default:
                    wp_redirect('admin.php?page=sign-up');
                    include(plugin_dir_path(__FILE__) . '/views/signup.php');
                    exit();
            }
        }

        /**
         * Load create business view
         *
         * @return void
         */
        public function load_create_business_view()
        {
            include(plugin_dir_path(__FILE__) . '/views/create_business.php');
        }


        /**
         * Load JS and CSS files
         */
        public function load_css_files()
        {
            //CSS files
            wp_register_style('bootstrap-css', plugins_url('/assets/css/kudobuzz-bootstrap.css', __FILE__), false, '3.0.1');
            wp_enqueue_style('bootstrap-css');
            wp_register_style('main-css', plugins_url('/assets/css/main.css', __FILE__), false, '1.0.0');
            wp_enqueue_style('main-css');
        }

    }

    new Kudobuzz();
}
