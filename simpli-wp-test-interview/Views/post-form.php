<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title</title>
</head>
<body>
    <div>
        <h1>Mon formulaire pour créer un post et ses métadata</h1>

<?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_title'])): ?>
		<p>Post a été soumis avec succès !</p>
<?php endif; ?>

        <form method="POST">
            <div>
                <label for="post_title">Post name</label><br>
                <input type="text" name="post_title" required style="width: 165px">
            </div>
            <div>
                <label for="post_content">Post content</label><br>
                <input type="text" name="post_content" required style="width: 165px">
            </div>
            <div>
                <label for="meta">Metadata : mymeta</label><br>
                <input type="text" name="meta" required style="width: 165px">
            </div>
            <div style="margin-top: 20px;">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>