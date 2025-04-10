<?php
/**
 * Created by Philippe Lavocat.
 * Date: 09/04/2025
 */
namespace PostFormPlugin\Models;

class PostModel {
    public $post_title;
    public $post_content;
    public $meta_value;

    public function __construct($title, $content, $meta) {
        $this->post_title = $title;
        $this->post_content = $content;
        $this->meta_value = $meta;
    }
}