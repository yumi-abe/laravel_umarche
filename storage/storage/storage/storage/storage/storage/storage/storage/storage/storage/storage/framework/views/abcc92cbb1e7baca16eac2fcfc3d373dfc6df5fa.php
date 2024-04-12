<div>
    <?php if(@empty($filename)): ?>
        <img src="<?php echo e(asset('images/no_image.jpg')); ?>">
    <?php else: ?>
    <img src="<?php echo e(asset('storage/shops/' .$filename)); ?>">
    <?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\laravel\umarche\resources\views/components/shop-thumbnail.blade.php ENDPATH**/ ?>