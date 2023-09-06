

<?php $__env->startSection('title', 'Profil | SIM - KU '); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/pages/page-profile.css')); ?>">
<style>
    #upload-demo {
        width: 250px;
        height: 250px;
        padding-bottom: 25px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row bg-black-0 hp-bg-color-dark-100 rounded pe-16 pe-sm-32 mx-0">
            <div class="col-lg-3 py-24">
                <div class="w-100">
                    <div class="hp-profile-menu-header mt-16 mt-lg-0 text-center mb-64">
                        <div class="hp-menu-header-btn mb-12 text-end">
                            <div class="d-inline-block" id="profile-menu-dropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <button type="button" class="btn btn-text btn-icon-only">
                                    <i class="ri-more-2-line text-black-100 hp-text-color-dark-30 lh-1"
                                        style="font-size: 24px;"></i>
                                </button>
                            </div>

                            <ul class="dropdown-menu" aria-labelledby="profile-menu-dropdown">
                                <li>
                                    <form action="<?php echo e(route("dashboard.user.deletePhotoPic", Auth::user()->id)); ?>" id="deleteProfilePic" method="post">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field("delete"); ?>
                                    </form>
                                    <a class="dropdown-item" href="#" onclick="showModalUpload()">Change Avatar</a>
                                    <a class="dropdown-item text-danger"  href="#" onclick="deletePhotoPic();" >Delete Avatar</a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-center">
                            <div class="d-inline-block position-relative">
                                <div class="avatar-item d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 80px; height: 80px;">
                                    <img id="item-img-output" src="<?php echo e(Auth::user()->picture != null ? '/storage/image_uploaded/'.Auth::user()->picture : asset('app-assets/img/default-profile.svg')); ?>" style="width: 80px; height: 80px; object-fit:cover;">
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-24 mb-4"><?php echo e(Auth::user()->display_name == "" ? Auth::user()->name : Auth::user()->display_name); ?></h4>
                        <span class="hp-p1-body"><?php echo e(Auth::user()->email); ?></span>
                      
                        <input id="profile-img-input" class="item-img" type="file" accept="image/*"hidden/>
                    </div>
                </div>

                <div class="hp-profile-menu-body w-100 text-start mt-48 mt-lg-0">
                    <ul class="me-n1 mx-lg-n12">
                        <li class="mt-4 mb-16">
                            <a href="<?php echo e(url('dashboard/profile')); ?>"
                                class="active position-relative text-black-80 hp-text-color-dark-30 hp-hover-text-color-primary-1 hp-hover-text-color-dark-0 py-12 px-24 d-flex align-items-center">
                                <i class="iconly-Curved-User me-16"></i>
                                <span>Personal Information</span>
                                <span
                                    class="hp-menu-item-line position-absolute opacity-0 h-100 top-0 end-0 bg-primary hp-bg-dark-0"
                                    style="width: 2px;"></span>
                            </a>
                        </li>

                        <li class="mt-4 mb-16">
                            <a href="<?php echo e(url('dashboard/profile/password')); ?>"
                                class="position-relative text-black-80 hp-text-color-dark-30 hp-hover-text-color-primary-1 hp-hover-text-color-dark-0 py-12 px-24 d-flex align-items-center">
                                <i class="iconly-Curved-Password me-16"></i>
                                <span>Password Change</span>

                                <span
                                    class="hp-menu-item-line position-absolute opacity-0 h-100 top-0 end-0 bg-primary hp-bg-dark-0"
                                    style="width: 2px;"></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="hp-profile-menu-footer text-center">
                    <img src="<?php echo e(asset('app-assets/img/profile-page.svg')); ?>" alt="Profile Image">
                </div>
            </div>

            <div class="col-lg-9 ps-16 ps-sm-32 py-24 py-sm-32 overflow-hidden">
                <div class="row">
                    <div class="col-12">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-12 col-md-6">
                                <h2>Personal Information</h2>
                                <p class="hp-p1-body mb-0">Change your info to be better known</p>
                            </div>

                            <div class="col-12 col-md-6 hp-profile-action-btn text-end">
                                <button class="btn btn-success" data-bs-toggle="modal" 
                                    data-bs-target="#profileContactEditModal">Edit</button>
                            </div>

                            <div class="divider border-black-40 hp-border-color-dark-80"></div>

                            <div class="col-12 hp-profile-content-list mt-8 pb-0 pb-sm-120">
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
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo e(Auth::user()->id); ?>">
                                <ul>
                                    <li class="mt-16">
                                        <span class="hp-p1-body">Name</span>
                                        <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">
                                            <?php echo e(Auth::user()->name); ?>

                                        </span>
                                    </li>
                                    <li class="mt-16">
                                        <span class="hp-p1-body">Jabatan</span>
                                        <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">
                                            <?php echo e(Auth::user()->departement == "" ? "-" : Auth::user()->departement); ?>

                                        </span>
                                    </li>
                                    <li class="mt-16">
                                        <span class="hp-p1-body">Email</span>
                                        <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">
                                            <?php echo e(Auth::user()->email); ?>

                                        </span>
                                    </li>
                                    <li class="mt-16">
                                        <span class="hp-p1-body">Phone</span>
                                        <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">
                                            <?php echo e(Auth::user()->phone); ?>

                                        </span>
                                    </li>
                                    <li class="mt-16">
                                        <span class="hp-p1-body">Role</span>
                                        <span class="mt-0 mt-sm-4 hp-p1-body text-black-100 hp-text-color-dark-0">
                                            <?php if(count(Auth::user()->getRoleNames()) > 0): ?>
                                            <div
                                                class="badge bg-primary-4 hp-bg-dark-primary text-primary border-primary">
                                                <?php echo e(Auth::user()->getRoleNames()[0]); ?>

                                            </div>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="profileContactEditModal" tabindex="-1" aria-labelledby="profileContactEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 416px;">
        <div class="modal-content">
            <div class="modal-header py-16">
                <h5 class="modal-title" id="profileContactEditModalLabel">Personal Information</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider my-0"></div>

            <div class="modal-body py-48">
                <form id="formData" action="<?php echo e(route('dashboard.user.update-profile', Auth::user()->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div id="method">
                        <?php echo method_field("POST"); ?>
                    </div>
                    <div class="row g-24">
                        <div class="col-12">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo e(Auth::user()->name); ?>"> 
                        </div>

                        <div class="col-12">
                            <label for="displayName" class="form-label">Display Name</label>
                            <input type="text" class="form-control" id="display_name" name="display_name" value="<?php echo e(Auth::user()->display_name); ?>">
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo e(Auth::user()->email); ?>">
                        </div>

                        <div class="col-12">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(Auth::user()->phone); ?>">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" name="address" ><?php echo e(Auth::user()->address); ?></textarea>
                        </div>


                        <div class="col-6">
                            <div class="btn w-100" data-bs-dismiss="modal">Cancel</div>
                        </div>
                        <div class="col-6">
                            <button type="button" onclick="updateData()" class="btn btn-primary w-100">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalUploadPicture" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-style">
            <div class="mb-24">
                <form id="formData" method="POST" enctype="multipart/form-data" action="<?php echo e(route('dashboard.user.uploadPhotoPic')); ?>">
                    <?php echo csrf_field(); ?>
                    <div id="method">
                        <?php echo method_field("POST"); ?>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label for="name" class="form-label">
                                <span class="text-danger me-4">*</span>
                                File
                                </label>
                                <input type="file" name="picture" class="form-control" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>" class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    let loading = '<div class="spinner-border spinner-border-sm ml-3" role="status"></div>'

    function fillDetailData(response){
        
        $("#user_id").val(response.id.toString());
        $("#title").val(response.title);
        $("#link").val(response.link);
        $("#status").val(response.status).change();
    }

    function updateData(){
        const id = $("#user_id").val();
        if(id != null && id != undefined){
            $(".btn-save").append(loading);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "<?php echo e(route('dashboard.user.update-profile', ':id')); ?>".replace(":id", id)); 
            $("#method").html(`<?php echo method_field('PUT'); ?>`); 
            $("#formData").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }

    // Sandbox upload picture 
    function showModalUpload(){ 
        $('#modalUploadPicture').modal('show');
    }
    function deletePhotoPic($id){ 
        if(confirm("Are you sure you want to delete your profile photo?")){
            $("#deleteProfilePic").submit();
        }
    }
    function uploadPicture(picture, id){ 
        let csrf_token = $('meta[name="csrf-token"]').attr('content');
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': csrf_token
            }
        });
        $.ajax({
            url: "<?php echo e(route('dashboard.user.uploadPhotoPic')); ?>",
            type: "POST", 
            data: {"picture": picture, "id":id},headers: {
                'X-CSRF-Token': csrf_token
            },
            success: function(res){
                ;
            }
        }).fail(function(xhr, textstatus, errorThrown){
            console.log("error details: ");
            console.log(xhr);
            console.log(textstatus);
            console.log(errorThrown);
        });
    }

    // End of sandbox

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/profile/index.blade.php ENDPATH**/ ?>