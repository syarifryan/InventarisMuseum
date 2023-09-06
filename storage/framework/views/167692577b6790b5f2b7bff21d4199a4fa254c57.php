<?php $__env->startSection('title', 'News Category | PT Eka Akar Jati '); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h4 class="h4">News Category</h4>
            </div>
            
            <div class="col-12 col-md-7"> 
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">
                    <form action="<?php echo e(route('news.category.index')); ?>" method="get">
                        <div class="input-group align-items-center">
                                <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                    <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-8" value="<?php echo e(request('search')??''); ?>" placeholder="Search">
                            </div>
                        </div>
                    </form>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-add')): ?>
                    <div class="col hp-flex-none w-auto">
                        <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Add Category</span>
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
                                <th>Title</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <tr>
                                <td>
                                    <?php echo e($item->title); ?>

                                </td>
                                <td class="text-end">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-update')): ?>
                                    <button onclick="detailData(<?php echo e($item->id); ?>)" class="btn btn-text text-primary btn-sm"
                                        title="Detail">
                                        <i class="iconly-Light-Show"></i>
                                    </button>
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

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-16 px-24">
                <h5 class="modal-title" id="modalDataLabel">Manage Category</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="formData" action="<?php echo e(route('news.category.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div id="method">
                    <?php echo method_field("POST"); ?>
                </div>
                <div class="modal-body">
                    <input type="number" hidden>
                    <input type="text" id="news_category_id" hidden>
                    <div class="row gx-8">
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Title
                                </label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-delete')): ?>
                            <button type="button" class="btn btn-danger btn-delete" onclick="deleteData()">Delete</button>
                            <?php endif; ?>
                        </div>
                        <div>
                            <button type="button" class="btn btn-text btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-edit" onclick="editData()">Edit</button>
                            <button type="submit" class="btn btn-primary btn-save">Save</button>
                            <button type="button" onclick="updateData()" class="btn btn-primary btn-update">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    let loading = '<div class="spinner-border spinner-border-sm ml-3" role="status"></div>'

    function fillDetailData(response){
        $("#news_category_id").val(response.id.toString())
        $("#title").val(response.title)
    }
 
    function saveData() {
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-update').hide();
        $('.btn-save').show();
        $('#modalData').modal('show');
        $(".modal-body :input").prop("disabled", false);
    }

    function detailData(id) {

        if(id != null){
            $.ajax({
                url: "<?php echo e(route('news.category.show', ':id')); ?>".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
            });
        }

        $('.btn-edit').show();
        $('.btn-delete').show();
        $('.btn-save').hide();
        $('.btn-update').hide();
        $(".modal-body :input").prop("disabled", true);
        $('#modalData').modal('show');
    }

    function editData() {
        $(".modal-body :input").prop("disabled", false);
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-save').hide();
        $(".btn-save").prop("disabled", true);
        $('.btn-update').show();
    }

    function updateData(){
        const id = $("#news_category_id").val();        
        if(id != null && id != undefined){
            $(".btn-update").append(loading);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "<?php echo e(route('news.category.update', ':id')); ?>".replace(":id", id)); 
            $("#method").html(`<?php echo method_field('PUT'); ?>`); 
            $("#formData").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }

    function deleteData() {
        var result = confirm("Want to delete?");
        if (result) {
            const id = $("#news_category_id").val();
            if(id != null && id != undefined){
                $(".btn-delete").append(loading);
                $("#formData").attr("method", "POST");
                $("#formData").attr("action", "<?php echo e(route('news.category.destroy', ':id')); ?>".replace(":id", id)); 
                $("#method").html(`<?php echo method_field('delete'); ?>`); 
                $("#formData").submit(); 

            } else {
                alert("Cannot update data, id not found");
            }
        }
    }

    function resetModalState(){ 
        
        $("#title").val("");
        $("#news_category_id").val("");
        $(".btn-save").prop("disabled", false);

    };

    $("#modalData").on("hidden.bs.modal", function () { 
        resetModalState();
    });

    //Disabled Double Click
    $(".btn-save").one('click', function (event) {  
        event.preventDefault();
        $(".btn-save").append(loading)
        $(this).prop('disabled', true);
        $('form#formData').submit();
     });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/news/category.blade.php ENDPATH**/ ?>