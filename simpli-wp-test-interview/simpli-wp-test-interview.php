<?php
/*
Plugin Name: simpli-wp-test-interview
Description: TEST
Author: Simplifia
Version: 1.0
*/

namespace SimpliCeremonyStreamingPlugin;
use \SimpliCeremonyStreamingPlugin\Models\Singleton;

include_once plugin_dir_path(__FILE__).'Autoloader.php';
include_once plugin_dir_path(__FILE__).'Models/Singleton.php';

class SimpliCeremonyStreamingPlugin extends Singleton
{

    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'CeremonyStreaming.php';
        new CeremonyStreamingPlugin();
        register_block_type(plugin_dir_path( __FILE__ ) . 'build/demo');
    }

}
Autoloader::register();
\SimpliCeremonyStreamingPlugin\SimpliCeremonyStreamingPlugin::GetInstance();


