<?php
/**
 * Created by Philippe Lavocat.
 * Date: 09/04/2025
 */
namespace SimpliCeremonyStreamingPlugin\Repositorys;
use SimpliCeremonyStreamingPlugin\Models\PostModel;

class PostRepository {
    public function save(PostModel $postModel) {
		// Save in post data_base (main post table)
        $post_id = wp_insert_post([
            'post_title'   => $postModel->post_title,
            'post_content' => $postModel->post_content,
            'post_status'  => 'publish',
        ]);
		// Save in metadata WP DB : 
		// Via "add_post_meta" WP specific...
        if ($post_id && !is_wp_error($post_id)) {
            add_post_meta($post_id, 'mymeta', $postModel->meta_value);
        }
		
		// For controller
		return $post_id;
    }
}