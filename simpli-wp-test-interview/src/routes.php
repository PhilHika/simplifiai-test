<?php
/**
 * Created by Philippe Lavocat.
 * Date: 09/04/2025
 */
 // Only via url : .../create-post.html
use PostFormPlugin\Controllers\PostController;

$router->get('/create-post', [PostController::class, 'handle']);
$router->post('/create-post', [PostController::class, 'handle']);
