<?php
defined('ABSPATH') OR exit;

class Mcafeesecure
{
    public static function activate()
    {
        update_option('mcafeesecure_active', 1);
    }

    public static function scripts($hook){
        if (strpos($hook, "mcafee-secure-settings") !== false) {
            wp_enqueue_style('trustedsite-settings-fa', plugins_url('../css/font-awesome.min.css',__FILE__));
            wp_enqueue_style('mcafeesecure-settings-css', plugins_url('../css/settings.css',__FILE__));
            wp_enqueue_script('mcafeesecure-mcafeesecure-js', plugins_url('../js/mcafeesecure.js',__FILE__));
        }
    }

    public static function get_site_id(){
        $existing_site_id = get_option('mcafeesecure_site_id');
        if (!empty($existing_site_id)) {
            return $existing_site_id;
        }

        $endpoint_host = "https://www.trustedsite.com";
        $arrHost = parse_url(home_url('', $scheme = 'http'));
        $host = $arrHost['host'];

        $sitemap_req_url = $endpoint_host . "/rpc/ajax?do=lookup-site-status&host=" . urlencode($host);
        $response = wp_remote_get($sitemap_req_url);
        
        $rjson = json_decode($response, true);
        $site_id = $rjson['siteId'];
        update_option('mcafeesecure_site_id', $site_id);
        return $site_id;
    }

    public static function install()
    {
        add_shortcode('mcafeesecure', 'Mcafeesecure::mfes_engagement_trustmark_shortcode');
        add_shortcode('trustedsite', 'Mcafeesecure::ts_engagement_trustmark_shortcode');
        add_shortcode('trustedsite_form', 'Mcafeesecure::ts_form_engagement_trustmark_shortcode');
        add_shortcode('trustedsite_checkout', 'Mcafeesecure::ts_checkout_engagement_trustmark_shortcode');
        add_shortcode('trustedsite_login', 'Mcafeesecure::ts_login_engagement_trustmark_shortcode');
        add_shortcode('mcafeesecure_sip', 'Mcafeesecure::mfes_sip_trustmark_shortcode');
        add_shortcode('trustedsite_sip', 'Mcafeesecure::ts_sip_shortcode');
        add_shortcode('trustedsite_sip_legacy', 'Mcafeesecure::ts_sip_legacy_shortcode');
        add_shortcode('mcafeesecure_hide', 'Mcafeesecure::hide_floating_trustmark_shortcode');
        add_shortcode('trustedsite_hide', 'Mcafeesecure::hide_floating_trustmark_shortcode');

        add_action('admin_menu', 'Mcafeesecure::admin_menus');
        add_action('wp_footer', 'Mcafeesecure::inject_code');
        add_action('do_robots', 'Mcafeesecure::robots');

        add_action('admin_enqueue_scripts', 'Mcafeesecure::scripts');

        add_filter('plugin_action_links_mcafee-secure/mcafee-secure.php', 'Mcafeesecure::add_plugin_settings_link');

        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            Mcafeesecure::install_woocommerce();
        }
    }

    public static function robots(){
        $site_id = Mcafeesecure::get_site_id();
        if(!empty($site_id)){
            echo "\nSitemap: https://cdn.ywxi.net/sitemap/".$site_id."/1.xml\n";
        }
    }

    public static function inject_sip_modal($order_id) {

        $order = wc_get_order($order_id);
        $email = $order->get_billing_email();
        $first_name = $order->get_billing_first_name();
        $last_name = $order->get_billing_last_name();
        $country_code = $order->get_billing_country();
        $state_code = $order->get_billing_state();

        echo <<<EOT
            <script type="text/javascript">
                (function() {
                    var sipScript = document.createElement('script');
                    sipScript.setAttribute("class","trustedsite-track-conversion");
                    sipScript.setAttribute("type","text/javascript");
                    sipScript.setAttribute("data-type","purchase");
                    sipScript.setAttribute("data-orderid", "$order_id");
                    sipScript.setAttribute("data-email", "$email");
                    sipScript.setAttribute("data-firstname", "$first_name");
                    sipScript.setAttribute("data-lastname", "$last_name");
                    sipScript.setAttribute("data-country", "$country_code");
                    sipScript.setAttribute("data-state", "$state_code");
                    sipScript.setAttribute("src", "https://cdn.ywxi.net/js/conversion.js");
                    document.getElementsByTagName("head")[0].appendChild(sipScript);
                })();
            </script>
EOT;
    }

    public static function install_woocommerce()
    {
        add_action('woocommerce_thankyou', 'Mcafeesecure::inject_sip_modal');
    }

    public static function deactivate()
    {
        delete_option("mcafeesecure_active");
    }

    public static function uninstall()
    {
        delete_option("mcafeesecure_active");
        delete_option("mcafeesecure_data");
        delete_option("mcafeesecure_site_id");
    }

    public static function mfes_engagement_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='mfes-trustmark' data-type='102' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_engagement_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='trustedsite-trustmark' data-type='202' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_form_engagement_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='trustedsite-trustmark' data-type='211' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_checkout_engagement_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='trustedsite-trustmark' data-type='212' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_login_engagement_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='trustedsite-trustmark' data-type='213' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function mfes_sip_trustmark_shortcode($atts = array())
    {
        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return "<div class='mfes-trustmark' data-type='103' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_sip_legacy_shortcode($atts = array())
    {

        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return"<div class='trustedsite-trustmark' data-type='203' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function ts_sip_shortcode($atts = array())
    {

        $a = shortcode_atts(array(
            'width' => 90,
        ), $atts);

        $width = intval($a['width']);
        return"<div class='trustedsite-trustmark' data-type='204' data-width=" . $width . " data-ext='svg'></div>";
    }

    public static function hide_floating_trustmark_shortcode($atts = array())
    {
        return "<div class='trustedsite-tm-float-disable'></div>";
    }

    public static function admin_menus()
    {

        add_options_page(
            'McAfee SECURE', 
            'McAfee SECURE', 
            'activate_plugins', 
            'mcafee-secure-settings', 
            'Mcafeesecure::settings_page');

    }

    public static function add_plugin_settings_link( $links )
    {
        array_unshift( $links, '<a href="options-general.php?page=mcafee-secure-settings">Settings</a>' );
        return $links;
    }

    public static function settings_page()
    {
        require WP_PLUGIN_DIR . '/mcafee-secure/lib/settings_page.php';
    }

    public static function inject_code()
    {
        echo <<<EOT
            <script type="text/javascript">
              (function() {
                var sa = document.createElement('script'); sa.type = 'text/javascript'; sa.async = true;
                sa.src = ('https:' == document.location.protocol ? 'https://cdn' : 'http://cdn') + '.ywxi.net/js/1.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(sa, s);
              })();
            </script>
EOT;
    }
}

?>
