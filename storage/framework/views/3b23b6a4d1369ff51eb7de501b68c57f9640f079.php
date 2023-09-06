<div class="col-12 col-lg-4 mb-6">
    <div class="card border-0 bg-white">
        <div class="position-absolute bg-white shadow-primary text-center p-2 rounded mx-3 mt-3">
        <?php
            use Carbon\Carbon;
            $carbon = new Carbon();
            $date = $carbon::parse($each_news->created_at);
            echo $date->format("d");
            echo "<br>".$date->format("M")."</div>";
            
        ?> 
        <img class="card-img-top rounded img-thumbnail" src="<?php echo e($each_news->picture != null ? "/storage/image_uploaded/".$each_news->picture : asset('app-assets/images/blog.png')); ?>" alt="Image">
        <div class="card-body pt-5 bg-white px-4 mb-5">
            <h2 class="h5 font-weight-medium">
                <a class="link-title" href="<?php echo e(route("dashboard.article.detail", $each_news->jenis_koleksi)); ?>"><?php echo e($each_news->nama_benda); ?></a>
            </h2>
            <p><?php echo Str::substr($each_news->deskripsi, 0, 100)."..."; ?></p>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/article/single-item.blade.php ENDPATH**/ ?>