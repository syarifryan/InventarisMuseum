

<?php $__env->startSection('title', 'Dashboard | SIM - KU'); ?>

<?php $__env->startSection('content'); ?>
<div class="col-12">

    <div class="col-lg-12 mb-8 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h4 class="card-title text-primary">Selamat Datang, di Website Inventaris Koleksi Museum Nasional Indonesia 
                        </h4>
                        <p class="mb-8">
                            Website ini berisikan koleksi-koleksi dan input inventaris koleksi Museum Nasional Indoensia
                        </p>
                        <a href="<?php echo e(route('dashboard.article.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Koleksi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 mb-8 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        
                        
                        <p class="mb-8">
                            Pilih Input Inventaris untuk menambahkan inventaris koleksi museum
                        </p>
                        <a href="<?php echo e(route('dashboard.article.index')); ?>" class="btn btn-sm btn-outline-secondary">Input Inventaris</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/js/chartsloader.js')); ?>"></script>
    <script type="text/javascript">
       
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/index.blade.php ENDPATH**/ ?>