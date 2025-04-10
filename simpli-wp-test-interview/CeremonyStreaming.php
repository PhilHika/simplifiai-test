<?php
namespace SimpliCeremonyStreamingPlugin;

class CeremonyStreamingPlugin
{
    public function __construct()
    {
        if (!defined('URL_SPHINX_BROADCAST')) {
            define('URL_SPHINX_BROADCAST','https://toto.fr');
        }

        $widgetFile = plugin_dir_path(__FILE__) . '/CeremonyStreamingWidget.php';
        if (file_exists($widgetFile)) {
            include_once $widgetFile;
        }
        //TODO utse WP widget in TunobWidget add_action('widgets_init', function(){register_widget('TunobWidget');});
        add_action('init', function (){
            new CeremonyStreamingWidget();
        });

        // Block Gutenberg (mission 2) : 
        add_action('init', [$this, 'registerBlocks']);
        add_action('enqueue_block_editor_assets', [$this, 'enqueueEditorAssets']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueFrontendAssets']);

        // Post form (mission 1) :
        $this->loadPostFormFeature();
    }

    public function registerWidget() {
        register_widget(\CeremonyStreamingWidget::class);
    }

    public function registerBlocks() {
        register_block_type(__DIR__ . '/src/blocks/hello-world');
    }

    public function enqueueEditorAssets() {
       wp_enqueue_script(
            'ceremony-widget-editor-js',
            plugin_dir_url(__FILE__) . 'src/blocks/hello-world/index.js',
            ['wp-blocks', 'wp-editor', 'wp-components'],
            filemtime(plugin_dir_path(__FILE__) . 'src/blocks/hello-world/index.js')
        );
/* Required/optionnal to define ?... Si on veut éditer dynamiquement le css du frontend à partir du backend ?...
       wp_enqueue_style(
            'ceremony-widget-editor-css',
            plugin_dir_url(__FILE__) . 'src/blocks/hello-world/editor.css',
            ['wp-edit-blocks'],
            filemtime(plugin_dir_path(__FILE__) . 'src/blocks/hello-world/editor.css')
        );
    */
    }

    public function enqueueFrontendAssets() {
        wp_enqueue_style(
            'ceremony-widget-style-css',
            plugin_dir_url(__FILE__) . 'src/blocks/hello-world/style.css',
            [],
            filemtime(plugin_dir_path(__FILE__) . 'src/blocks/hello-world/style.css')
        );
    }

    protected function loadPostFormFeature() {
        require_once plugin_dir_path(__FILE__) . 'Builders/PostForm.php';
        $formPlugin = new \PostFormPlugin\PostForm();
    }
}

