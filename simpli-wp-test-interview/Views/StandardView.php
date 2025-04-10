<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Cérémonie en direct</title>
</head>
<body>
<?php if (!empty($broadcast->slug)) { ?>
    <iframe style="margin:0 auto 0 10% " width="80%" height="800px" 
            src=""
            frameBorder="0" scrolling="auto" allowfullscreen="true" allow="autoplay; fullscreen"></iframe>
<?php } else { ?>
    <div class="container">
        <div> Aucune diffusion ne correspond à ce lien.</div>
    </div>
<?php } ?>

</body>
