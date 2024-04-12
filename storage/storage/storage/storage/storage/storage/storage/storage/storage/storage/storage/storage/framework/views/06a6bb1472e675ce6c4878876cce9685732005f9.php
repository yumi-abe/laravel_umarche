<?php
    if($type === 'shops'){
        $path = 'storage/shops/';
    }
    if($type === 'products'){
        $path = 'storage/products/';
    }
?>

<div>
    <?php if(@empty($filename)): ?>
        <img src="<?php echo e(asset('images/no_image.jpg')); ?>">
    <?php else: ?>
    <img src="<?php echo e(asset($path .$filename)); ?>">
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\laravel\umarche\resources\views/components/thumbnail.blade.php ENDPATH**/ ?>