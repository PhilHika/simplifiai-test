<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 09/04/18
 * Time: 09:05
 */
namespace SimpliCeremonyStreamingPlugin\Models;

include_once plugin_dir_path(__FILE__) . "Requester.php";

class SphinxApiRequester extends Requester {
    public function Get($index, $headers = array()){

        if($index){
            $result = wp_remote_get($index);
            $status_code = wp_remote_retrieve_response_code($result);
        } else{
            return array();
        }

        //502 is status code response if sphinx is down
        if(is_wp_error($result) or $status_code == '502'){
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            get_template_part(404);
            exit();
        }


        $result = json_decode($result['body'], true);


        if(is_wp_error($result)){
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            get_template_part(404);
            exit();
        }
        // check if is Sphinx API or Google API. Google Place API has not all_docs
        if (isset($result['result']['all_docs'])) {
            return $result['result']['all_docs'];
        } elseif (isset($result['result'])) {
            return $result['result'];
        };
    }


    public function GetRaw($index, $headers = array()){
        if($index){
            $result = wp_remote_get($index);
        } else{
            return array();
        }

        $result = json_decode($result['body'], true);

        return $result;
    }
}
