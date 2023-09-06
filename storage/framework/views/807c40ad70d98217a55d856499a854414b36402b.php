<?php $__env->startSection('content'); ?>
<section class="p-0 bg-light">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-12 col-lg-8 mt-8 mb-8 mb-lg-0">
                <div class="mb-8 text-center">
                    <h2 class="mt-3 font-w-6"><?php echo e($web->article_title ?? ''); ?></h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php if(count($news) > 0): ?>
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $each_news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('dashboard.article.single-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <!-- Null -->
            <?php endif; ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/article/index.blade.php ENDPATH**/ ?>