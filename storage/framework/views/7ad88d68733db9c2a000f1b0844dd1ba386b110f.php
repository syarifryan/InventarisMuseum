<?php $__env->startSection('title', 'Manage Inventaris | MNI '); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('app-assets/css/select2.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4 d-flex">
                <a href="<?php echo e(route('dashboard.news.index')); ?>" class="auth-back">
                    <i class="iconly-Light-ArrowLeft"></i>
                </a>
                <h4 class="mx-8 h4">Manage Inventaris</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col hp-flex-none w-auto">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-delete')): ?> 
                        <form action="<?php echo e(route("dashboard.news.destroy", $data->id ?? "")); ?>" id="delete-data-form" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="method">
                                <?php echo method_field("delete"); ?>
                            </div>
                        </form>
                        <button type="button" class="btn btn-danger btn-delete" onclick="deleteData();"
                            style="display:none">
                            <span>Delete</span>
                        </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-update')): ?> 
                        <button type="button" class="btn btn-success btn-edit" onclick="editData();"
                            style="display:none">
                            <span>Edit</span>
                        </button>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-update')): ?> 
                        <button type="button" id="cancel-edit" class="btn btn-text btn-cancel" onclick="cancelEdit();"
                            style="display:none">
                            <span>Cancel</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-save" onclick="saveData();"
                            style="display:none">
                            <span>Save</span>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card hp-contact-card mb-32">
            <div class="card-body">
                <form action="<?php echo e(route('dashboard.news.store')); ?>" method="POST" id="formData" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div id="method">
                        <?php echo method_field("POST"); ?>
                    </div>
                    <input type="hidden" name="id" id="id" value="<?php echo e($data->id ?? ""); ?>">
                    <div class="row">
                        <div class="alert-notification">
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
                        </div>

                        
                        
                        <h6>Jenis Koleksi & Nama Benda</h6>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Jenis Koleksi
                                </label>
                                <input type="text" class="form-control" id="jenis_koleksi" name="jenis_koleksi" value="<?php echo e($data->jenis_koleksi ?? old("jenis_koleksi")); ?>">
                            </div>
                        </div>

                        
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nama Benda
                                </label>
                                <input type="text" class="form-control" id="nama_benda" name="nama_benda" value="<?php echo e($data->nama_benda ?? old("nama_benda")); ?>">
                            </div>
                        </div>

                        
                        <h5>No. Inventaris & No. Registrasi</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Inventaris Lama
                                </label>
                                <input type="text" class="form-control" name="no_inv_lama" id="no_inv_lama" value="<?php echo e($data->no_inv_lama ?? old("no_inv_lama")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Inventaris Baru
                                </label>
                                <input type="text" class="form-control" name="no_inv_baru" id="no_inv_baru" value="<?php echo e($data->no_inv_baru ?? old("no_inventaris_baru")); ?>">
                            </div>
                        </div>
                       
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Registrasi Lama
                                </label>
                                <input type="text" class="form-control" name="no_reg_lama" id="no_reg_lama" value="<?php echo e($data->no_reg_lama ?? old("no_reg_lama")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Registrasi Baru
                                </label>
                                <input type="text" class="form-control" name="no_reg_baru" id="no_reg_baru" value="<?php echo e($data->no_reg_baru ?? old("no_reg_baru")); ?>">
                            </div>
                        </div>
                        
                        
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Penyimpanan
                                </label>
                                <input type="text" class="form-control" id="tempat_penyimpanan" name="tempat_penyimpanan" value="<?php echo e($data->tempat_penyimpanan ?? old("tempat_penyimpanan")); ?>">
                            </div>
                        </div>

                        
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Ukuran
                                </label>
                                <input type="text" class="form-control" id="ukuran" name="ukuran" value="<?php echo e($data->ukuran ?? old("ukuran")); ?>">
                            </div>
                        </div>

                        
                        <h6>Bahan & Teknik Pembuatan</h6>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Bahan
                                </label>
                                <input type="text" class="form-control" name="bahan" id="bahan" value="<?php echo e($data->bahan ?? old("bahan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Teknik Pembuatan
                                </label>
                                <input type="text" class="form-control" name="teknik_pembuatan" id="teknik_pembuatan" value="<?php echo e($data->teknik_pembuatan ?? old("teknik_pembuatan")); ?>">
                            </div>
                        </div>

                        
                        <h5>Riwayat Benda</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Asal
                                </label>
                                <input type="text" class="form-control" name="tempat_asal" id="tempat_asal" value="<?php echo e($data->tempat_asal ?? old("tempat_asal")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Negara
                                </label>
                                <input type="text" class="form-control" name="negara" id="negara" value="<?php echo e($data->negara ?? old("negara")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Provinsi
                                </label>
                                <input type="text" class="form-control" name="prov" id="prov" value="<?php echo e($data->prov ?? old("prov")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kabupaten
                                </label>
                                <input type="text" class="form-control" name="kab" id="kab" value="<?php echo e($data->kab ?? old("kab")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Pembuatan
                                </label>
                                <input type="text" class="form-control" id="temp_pembuatan" name="temp_pembuatan" value="<?php echo e($data->temp_pembuatan ?? old("temp_pembuatan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Temuan
                                </label>
                                <input type="text" class="form-control" id="temp_temuan" name="temp_temuan" value="<?php echo e($data->temp_temuan ?? old("temp_temuan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tahun Pembuatan
                                </label>
                                <input type="text" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" value="<?php echo e($data->tahun_pembuatan ?? old("tahun_pembuatan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kegunaan / Fungsi
                                </label>
                                <input type="text" class="form-control" id="guna_fungsi" name="guna_fungsi" value="<?php echo e($data->guna_fungsi ?? old("guna_fungsi")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tanggal Perolehan
                                </label>
                                <input type="text" class="form-control" id="tgl_perolehan" name="tgl_perolehan" value="<?php echo e($data->tgl_perolehan ?? old("tgl_perolehan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Cara Perolehan
                                </label>
                                <input type="text" class="form-control" id="cara_perolehan" name="cara_perolehan" value="<?php echo e($data->cara_perolehan ?? old("cara_perolehan")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Perolehan
                                </label>
                                <input type="text" class="form-control" id="tempat_perolehan" name="tempat_perolehan" value="<?php echo e($data->tempat_perolehan ?? old("tempat_perolehan")); ?>">
                            </div>
                        </div>

                        
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kondisi
                                </label>
                                <input type="text" class="form-control" id="kondisi" name="kondisi" value="<?php echo e($data->kondisi ?? old("kondisi")); ?>">
                            </div>
                        </div>

                        
                        <h5>Deskripsi & Keterangan</h5>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Deskripsi
                                </label>
                                <textarea class="form-control wysiwg" id="deskripsi" name="deskripsi"
                                    rows="2"><?php echo e($data->deskripsi ?? old("deskripsi")); ?></textarea>
                            </div>
                        </div>

                        
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Keterangan
                                </label>
                                <textarea class="form-control wysiwg" id="keterangan" name="keterangan"
                                    rows="2"><?php echo e($data->keterangan ?? old("keterangan")); ?></textarea>
                            </div>
                        </div>

                        
                        <h5>Foto Koleksi</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Foto
                                </label>
                                <input type="text" class="form-control" name="no_foto" id="no_foto" value="<?php echo e($data->no_foto ?? old("no_foto")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Neg Film 
                                </label>
                                <input type="text" class="form-control" name="no_neg_film" id="no_neg_film" value="<?php echo e($data->no_neg_film ?? old("no_neg_film")); ?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Slide
                                </label>
                                <input type="text" class="form-control" name="no_slide" id="no_slide" value="<?php echo e($data->no_slide ?? old("no_slide")); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Photo
                                </label>
                                <input type="file" name="picture" class="form-control" value="<?php echo e(old("picture")); ?>" required>
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('app-assets/js/slug.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/tinymce.min.js')); ?>"></script>
<script src="<?php echo e(asset('app-assets/js/wysiwg.js')); ?>"></script>

<script>
    let loading = '<div class="spinner-border spinner-border-sm ml-3" role="status"></div>'

    function fillDetailData(response){
        $("#jenis_koleksi").val(response.jenis_koleksi);        
        $("#nama_benda").val(response.nama_benda);        
        $("#no_inv_lama").val(response.no_inv_lama);        
        $("#no_inv_baru").val(response.no_inv_baru);        
        $("#no_reg_lama").val(response.no_reg_lama);        
        $("#no_reg_baru").val(response.no_reg_baru);        
        $("#tempat_penyimpanan").val(response.tempat_penyimpanan);        
        $("#ukuran").val(response.ukuran);        
        $("#bahan").val(response.bahan);        
        $("#teknik_pembuatan").val(response.teknik_pembuatan);        
        $("#tempat_asal").val(response.tempat_asal);        
        $("#negara").val(response.negara);        
        $("#prov").val(response.prov);        
        $("#kab").val(response.kab);        
        $("#temp_pembuatan").val(response.temp_pembuatan);        
        $("#temp_temuan").val(response.temp_temuan);        
        $("#tahun_pembuatan").val(response.tahun_pembuatan);        
        $("#guna_fungsi").val(response.guna_fungsi);        
        $("#tgl_perolehan").val(response.tgl_perolehan);        
        $("#cara_perolehan").val(response.cara_perolehan);        
        $("#tempat_perolehan").val(response.tempat_perolehan);        
        $("#kondisi").val(response.kondisi);        
        $("#deskripsi").val(response.deskripsi);        
        $("#keterangan").val(response.keterangan);        
        $("#no_foto").val(response.no_foto);        
        $("#no_neg_film").val(response.no_neg_film);        
        $("#no_slide").val(response.no_slide);        
    }

    function cancelEdit(){
        resetToSavedData();
        disableInput();
    };

    function resetToSavedData() { 
        event.preventDefault();
        const id = $("#id").val()
        $.ajax({
                url: "<?php echo e(route('dashboard.news.show', ':id')); ?>".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                }
        });
    }

    $(document).ready(function () {       
        var url = window.location.pathname.split('/');
        var cond = url.pop() || url.pop();

        if (cond == "create") {
            $('.btn-save').show();
            $('.btn-cancel').hide();
            $('.btn-edit').hide();
            $('.btn-delete').hide();
            $("#formData :input").prop("disabled", false);
        } else {
            $("#formData :input").prop("disabled", true);
            $('.btn-save').hide();
            $('.btn-edit').show();
            $('.btn-delete').show();
        }
    });

    function disableInput(){
        $("#formData :input").prop("disabled", true);
        $('.btn-save').hide();
        $('.btn-cancel').hide();
        $('.btn-edit').show();
        $('.btn-delete').show();
    }


    function editData() {
        $("#formData :input").prop("disabled", false);
        $('.btn-save').show();
        $('.btn-save').attr("onclick", "updateData()");
        $('.btn-cancel').show();
        $('.btn-edit').hide();
        $('.btn-delete').hide();
    }

    function updateData(){
        const id = $("#id").val();
        
        if(id != null && id != undefined){
            $(".btn-save").append(loading);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "<?php echo e(route('dashboard.news.update', ':id')); ?>".replace(":id", id)); 
            $("#method").html(`<?php echo method_field('PUT'); ?>`); 
            $("#formData").submit(); 
        } else {
            alert("Cannot update data, id not found");
        }
    }
    function saveData() {
        $("#formData").submit(); 
    }

    function deleteData(){
        var result = confirm("Want to delete?");
        if (result) { 
            $('#delete-data-form').submit();
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Inventaris\resources\views/dashboard/news/manage.blade.php ENDPATH**/ ?>