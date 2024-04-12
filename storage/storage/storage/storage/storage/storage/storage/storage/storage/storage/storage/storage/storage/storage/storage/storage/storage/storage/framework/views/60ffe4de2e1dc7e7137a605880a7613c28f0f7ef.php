<?php $attributes = $attributes->exceptProps(['status' => 'info']); ?>
<?php foreach (array_filter((['status' => 'info']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
if (session('status') === 'info') { $bgColor = 'bg-blue-300'; }
if(session('status') === 'alert'){ $bgColor = 'bg-red-500'; }
?>

<?php if(session('message')): ?>
    <div class="<?php echo e($bgColor); ?> w-1/2 mx-auto p-2 text-white">
        <?php echo e(session('message' )); ?>

    </div>
    
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel\umarche\resources\views/components/flash-message.blade.php ENDPATH**/ ?>