<?php

namespace SimpliCeremonyStreamingPlugin;

//This widget dont need to be placed by wordpress so it doesnt extends SimpliWidget


use SimpliCeremonyStreamingPlugin\Models\View;
use SimpliCeremonyStreamingPlugin\Repositorys\BroadcastRepository;

class CeremonyStreamingWidget
{
    public $funeralServiceUuid;
    public $standardView;
    public $broadcast;


    public function __construct()
    {
        //TODO use extend WP_Widget parent::__construct('tunob_widget', 'Tunob', array('description' => 'Un super tunob'));
        add_shortcode('ceremony_streaming_widget', array($this, 'CeremonyStreamingWidgetShortCode'));

        //TODO NOT WORKING
        // register jquery and style on initialization
        //add_action('init',  array($this,'register_script'));
        //add_action('wp_enqueue_style', array($this, 'load_scripts'));

    }


    public function widget($args, $instance)
    {
        echo 'widget tunooob';
    }

    public function CeremonyStreamingWidgetShortCode($atts = [])
    {
        $identifier = $_GET['identifier'];
        $this->broadcast =BroadcastRepository::getInstance()->Get($identifier);
        $this->standardView = new View(plugin_dir_path(__FILE__) . 'Views/StandardView.php', array("broadcast"));
        $this->standardView->Render(array('broadcast' => $this->broadcast));
    }

    public function register_script()
    {
    }

    public function load_scripts()
    {
    }
}