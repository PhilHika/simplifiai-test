<?php
/**
 * Created by PhpStorm.
 * User: benoit
 * Date: 18/05/18
 * Time: 09:30
 */
namespace SimpliCeremonyStreamingPlugin\Models;

class Requester {
    public function __construct(){ }

    public function Get($index, $headers){
        $result = wp_remote_get($index);
        $result = json_decode($result['body'], true);

        return $result;
    }

    public function Post($index, $body, $headers = array()){
        $result = wp_remote_post($index, array('body' => $body, 'headers' => $headers));
    }
}