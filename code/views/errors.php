<?php if(($errors) &&  isset($errors[$attribute])) :?>
    <?php foreach($errors[$attribute] as $error) : ?>
        <span class="badge bg-danger">
            <?php echo $error ?>
        </span>
    <?php endforeach ?>
<?php endif; ?>