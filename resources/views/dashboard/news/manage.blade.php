@extends('layouts.dashboard')

@section('title', 'Manage Inventaris | MNI ')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/select2.min.css')}}">
@endsection

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4 d-flex">
                <a href="{{ route('dashboard.news.index') }}" class="auth-back">
                    <i class="iconly-Light-ArrowLeft"></i>
                </a>
                <h4 class="mx-8 h4">Manage Inventaris</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col hp-flex-none w-auto">
                        @can('news-delete') 
                        <form action="{{route("dashboard.news.destroy", $data->id ?? "")}}" id="delete-data-form" method="post">
                            @csrf
                            <div class="method">
                                @method("delete")
                            </div>
                        </form>
                        <button type="button" class="btn btn-danger btn-delete" onclick="deleteData();"
                            style="display:none">
                            <span>Delete</span>
                        </button>
                        @endcan
                        @can('news-update') 
                        <button type="button" class="btn btn-success btn-edit" onclick="editData();"
                            style="display:none">
                            <span>Edit</span>
                        </button>
                        @endcan
                        @can('news-update') 
                        <button type="button" id="cancel-edit" class="btn btn-text btn-cancel" onclick="cancelEdit();"
                            style="display:none">
                            <span>Cancel</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-save" onclick="saveData();"
                            style="display:none">
                            <span>Save</span>
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card hp-contact-card mb-32">
            <div class="card-body">
                <form action="{{route('dashboard.news.store')}}" method="POST" id="formData" enctype="multipart/form-data">
                    @csrf
                    <div id="method">
                        @method("POST")
                    </div>
                    <input type="hidden" name="id" id="id" value="{{$data->id ?? ""}}">
                    <div class="row">
                        <div class="alert-notification">
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        
                        {{-- 1.Jenis Koleksi --}}
                        <h6>Jenis Koleksi & Nama Benda</h6>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Jenis Koleksi
                                </label>
                                <input type="text" class="form-control" id="jenis_koleksi" name="jenis_koleksi" value="{{$data->jenis_koleksi ?? old("jenis_koleksi")}}">
                            </div>
                        </div>

                        {{-- 2.Nama Benda --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nama Benda
                                </label>
                                <input type="text" class="form-control" id="nama_benda" name="nama_benda" value="{{$data->nama_benda ?? old("nama_benda")}}">
                            </div>
                        </div>

                        {{-- 3.No Inv & No. Reg --}}
                        <h5>No. Inventaris & No. Registrasi</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Inventaris Lama
                                </label>
                                <input type="text" class="form-control" name="no_inv_lama" id="no_inv_lama" value="{{$data->no_inv_lama ?? old("no_inv_lama")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Inventaris Baru
                                </label>
                                <input type="text" class="form-control" name="no_inv_baru" id="no_inv_baru" value="{{$data->no_inv_baru ?? old("no_inventaris_baru")}}">
                            </div>
                        </div>
                       
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Registrasi Lama
                                </label>
                                <input type="text" class="form-control" name="no_reg_lama" id="no_reg_lama" value="{{$data->no_reg_lama ?? old("no_reg_lama")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    No Registrasi Baru
                                </label>
                                <input type="text" class="form-control" name="no_reg_baru" id="no_reg_baru" value="{{$data->no_reg_baru ?? old("no_reg_baru")}}">
                            </div>
                        </div>
                        
                        {{-- 4.Tempat Penyimpanan --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Penyimpanan
                                </label>
                                <input type="text" class="form-control" id="tempat_penyimpanan" name="tempat_penyimpanan" value="{{$data->tempat_penyimpanan ?? old("tempat_penyimpanan")}}">
                            </div>
                        </div>

                        {{-- 5.Ukuran --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Ukuran
                                </label>
                                <input type="text" class="form-control" id="ukuran" name="ukuran" value="{{$data->ukuran ?? old("ukuran")}}">
                            </div>
                        </div>

                        {{-- 6.Bahan dan Teknik --}}
                        <h6>Bahan & Teknik Pembuatan</h6>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Bahan
                                </label>
                                <input type="text" class="form-control" name="bahan" id="bahan" value="{{$data->bahan ?? old("bahan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Teknik Pembuatan
                                </label>
                                <input type="text" class="form-control" name="teknik_pembuatan" id="teknik_pembuatan" value="{{$data->teknik_pembuatan ?? old("teknik_pembuatan")}}">
                            </div>
                        </div>

                        {{-- 7.Riwayat Benda --}}
                        <h5>Riwayat Benda</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Asal
                                </label>
                                <input type="text" class="form-control" name="tempat_asal" id="tempat_asal" value="{{$data->tempat_asal ?? old("tempat_asal")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Negara
                                </label>
                                <input type="text" class="form-control" name="negara" id="negara" value="{{$data->negara ?? old("negara")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Provinsi
                                </label>
                                <input type="text" class="form-control" name="prov" id="prov" value="{{$data->prov ?? old("prov")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kabupaten
                                </label>
                                <input type="text" class="form-control" name="kab" id="kab" value="{{$data->kab ?? old("kab")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Pembuatan
                                </label>
                                <input type="text" class="form-control" id="temp_pembuatan" name="temp_pembuatan" value="{{$data->temp_pembuatan ?? old("temp_pembuatan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Temuan
                                </label>
                                <input type="text" class="form-control" id="temp_temuan" name="temp_temuan" value="{{$data->temp_temuan ?? old("temp_temuan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tahun Pembuatan
                                </label>
                                <input type="text" class="form-control" id="tahun_pembuatan" name="tahun_pembuatan" value="{{$data->tahun_pembuatan ?? old("tahun_pembuatan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kegunaan / Fungsi
                                </label>
                                <input type="text" class="form-control" id="guna_fungsi" name="guna_fungsi" value="{{$data->guna_fungsi ?? old("guna_fungsi")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tanggal Perolehan
                                </label>
                                <input type="text" class="form-control" id="tgl_perolehan" name="tgl_perolehan" value="{{$data->tgl_perolehan ?? old("tgl_perolehan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Cara Perolehan
                                </label>
                                <input type="text" class="form-control" id="cara_perolehan" name="cara_perolehan" value="{{$data->cara_perolehan ?? old("cara_perolehan")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Tempat Perolehan
                                </label>
                                <input type="text" class="form-control" id="tempat_perolehan" name="tempat_perolehan" value="{{$data->tempat_perolehan ?? old("tempat_perolehan")}}">
                            </div>
                        </div>

                        {{-- 8. Kondisi --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Kondisi
                                </label>
                                <input type="text" class="form-control" id="kondisi" name="kondisi" value="{{$data->kondisi ?? old("kondisi")}}">
                            </div>
                        </div>

                        {{-- 9.Deskripsi --}}
                        <h5>Deskripsi & Keterangan</h5>
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Deskripsi
                                </label>
                                <textarea class="form-control wysiwg" id="deskripsi" name="deskripsi"
                                    rows="2">{{$data->deskripsi ?? old("deskripsi")}}</textarea>
                            </div>
                        </div>

                        {{-- 10.Keterangan --}}
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Keterangan
                                </label>
                                <textarea class="form-control wysiwg" id="keterangan" name="keterangan"
                                    rows="2">{{$data->keterangan ?? old("keterangan")}}</textarea>
                            </div>
                        </div>

                        {{-- Foto --}}
                        <h5>Foto Koleksi</h5>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Foto
                                </label>
                                <input type="text" class="form-control" name="no_foto" id="no_foto" value="{{$data->no_foto ?? old("no_foto")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Neg Film 
                                </label>
                                <input type="text" class="form-control" name="no_neg_film" id="no_neg_film" value="{{$data->no_neg_film ?? old("no_neg_film")}}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Nomor Slide
                                </label>
                                <input type="text" class="form-control" name="no_slide" id="no_slide" value="{{$data->no_slide ?? old("no_slide")}}">
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Photo
                                </label>
                                <input type="file" name="picture" class="form-control" value="{{old("picture")}}" required>
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('app-assets/js/slug.js')}}"></script>
<script src="{{asset('app-assets/js/select2.min.js')}}"></script>
<script src="{{asset('app-assets/js/tinymce.min.js')}}"></script>
<script src="{{asset('app-assets/js/wysiwg.js')}}"></script>

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
                url: "{{route('dashboard.news.show', ':id')}}".replace(":id", id),
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
            $("#formData").attr("action", "{{route('dashboard.news.update', ':id')}}".replace(":id", id)); 
            $("#method").html(`@method('PUT')`); 
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
@endsection
