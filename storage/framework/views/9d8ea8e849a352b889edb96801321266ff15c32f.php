<?php $__env->startSection('title', 'Article | HI-Tech '); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h4 class="h4">Article</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">
                        <form action="<?php echo e(route('dashboard.news.index')); ?>" method="get">

                        <div class="input-group align-items-center">
                            <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-8" name="search" value="<?php echo e(request('search')??''); ?>" placeholder="Search">
                        </div>
                    </form>

                    </div>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-add')): ?>
                    <div class="col hp-flex-none w-auto">
                        <button onclick="location.href='<?php echo e(route('dashboard.news.create')); ?>';" type="button" class="btn btn-primary w-100">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Add Article</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <?php if(session('status')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('status')); ?>

        </div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card hp-contact-card mb-32">
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>Jenis Koleksi</th>
                                <th>Nama Benda</th>
                                <th>Publish Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 

                            <tr>
                                <td>
                                    <div class="avatar-item avatar-lg d-flex align-items-center justify-content-center bg-primary-4 hp-bg-dark-primary text-primary hp-text-color-dark-0">
                                        <img src="<?php echo e($item->picture != null ? "/storage/image_uploaded/".$item->picture : asset('app-assets/images/blog.png')); ?>"
                                            alt="Thumbnail">
                                    </div>
                                </td>
                                <td>
                                    <?php echo e($item->jenis_koleksi); ?>

                                </td>
                                <td>
                                    <?php echo e($item->jenis_koleksi); ?>

                                </td>
                                <td>
                                    <?php echo e($item->created_at); ?>

                                </td>
                                
                                <td >
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-update')): ?>
                                    <a href="<?php echo e(route('dashboard.news.edit', $item->id)); ?>" class="btn btn-text text-primary btn-sm"
                                        title="Detail">
                                        <i class="iconly-Light-Show"></i>
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div>
                    <?php echo e($data->links("pagination::bootstrap-4")); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/news/index.blade.php ENDPATH**/ ?>