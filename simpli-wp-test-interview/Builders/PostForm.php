<?php
namespace PostFormPlugin;
class PostForm
{
	public function __construct() {
        // display post-form (WP : Hook)
        add_shortcode('post_form', [$this, 'post_form_shortcode']);
    }
	
	// function include view form
	public function post_form_shortcode() {
        ob_start();
        $view = plugin_dir_path(__FILE__) . '../views/post-form.php';
        if (file_exists($view)) {
            include $view;
        } else {
            error_log('[PostFormPlugin] view file is missing : ' . $view);
            return '<p>Unavailable form.</p>';
        }
        return ob_get_clean();
    }
	
	// use [post_form] in a page to display post-form... or specific page ?
	// Better way to do ?
	// => we select the short code [post_form], more flexible and direct !
}