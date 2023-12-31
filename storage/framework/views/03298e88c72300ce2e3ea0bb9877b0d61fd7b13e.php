<?php $__env->startSection('content'); ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Blog Card -->
                <div class="card border-0 bg-transparent">
                    <div class="position-absolute bg-white shadow-primary text-center p-2 rounded ms-3 mt-3">
                        <?php 
                            use Carbon\Carbon;
                            $carbon = new Carbon();
                            $date = $carbon::parse($news->created_at);
                            echo $date->format("d");
                            echo "<br>".$date->format("M")."</div>";

                            $category_unpack = explode(",",$news->category_id); 
                            $category_map = [];
                            foreach($categories as $item){
                                $category_map[$item->id] = $item->title;
                            }
                        ?> 
                    <img class="card-img-top shadow rounded img-thumbnail-detail    " src="<?php echo e($news->picture != null ? "/storage/image_uploaded/".$news->picture : asset('app-assets/images/blog/01.png')); ?>"
                        alt="Image">
                    <div class="card-body pt-5 px-0">
                        <h2 class="font-weight-medium">
                            <?php echo e($news->title); ?>

                        </h2>
                        <p><?php echo $news->content; ?></p>
                    </div>
                    <div class="mt-5 mb-5">
                        <div class="text-md-right mt-5 mt-md-0">
                            <h6 class="mb-2">Category: </h6>
                            <ul class="list-inline">
                                <?php $__currentLoopData = $category_unpack; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $each_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                <li class="list-inline-item"><a
                                    class="btn text-dark btn-sm bg-primary-soft m-1" href="<?php echo e(route('dashboard.article.category', $category_map[$each_category] ?? "")); ?>"><?php echo e($category_map[$each_category] ?? ""); ?></a>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/article/detail.blade.php ENDPATH**/ ?>