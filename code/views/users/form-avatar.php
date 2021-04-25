<div class="text-center">
    <img alt="Charles Hall" 
        src="<?= sprintf('upload/users/%s/avatar.jpg', $_SESSION['user_id']) ?>" 
        class="rounded-circle img-responsive mt-2" 
        width="128" 
        height="128"
    />
    <div class="mt-2">
        <form method="POST" action="<?= $saveAvatarAction ?>" enctype="multipart/form-data">
            <input type="file" name="avatar" class="form-control m-2">
            <input type="submit" value="Upload" class="btn btn-primary">
        </form>        
    </div>
    <small>For best results, use an image at least 128px by 128px in .jpg format</small>
</div>