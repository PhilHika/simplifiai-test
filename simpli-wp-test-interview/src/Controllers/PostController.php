<?php
/**
 * Created by Philippe Lavocat.
 * Date: 09/04/2025
 */
?>
<?php
namespace PostFormPlugin\Controllers;

use PostFormPlugin\Models\PostModel;
use PostFormPlugin\Repositorys\PostRepository;

class PostController {
    public function handle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_title'])) {
            // Process input from form
			$title = sanitize_text_field($_POST['post_title']);
            $content = wp_kses_post($_POST['post_content']);
            $meta = sanitize_text_field($_POST['meta']);
			
			// Create model object 
			$model = new PostModel($title, $content, $meta);
			// To DB via Repo :
            $repo = new PostRepository();
			// psot Saved in DB in post table AND metatable
            $repo->save($model);
        }
		// View include
        include __DIR__ . '/../../Views/post-form.php';
    }
}
