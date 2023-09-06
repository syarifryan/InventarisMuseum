@extends('layouts.dashboard')

@section('title', 'Permission | SIM - KU ')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4 d-flex">
                <a href="{{ url()->previous() }}" class="auth-back">
                    <i class="iconly-Light-ArrowLeft"></i>
                </a>
                <h4 class="mx-8 h4">Permission - {{$role->name}}</h4>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col hp-flex-none w-auto">
                        @can('role-update')
                        <button type="button" class="btn btn-success btn-edit" onclick="editData();">
                            <span>Edit</span>
                        </button>
                        @endcan
                        <button type="button" class="btn btn-text btn-cancel" onclick="cancelEdit();" style="display:none">
                            <span>Cancel</span>
                        </button>
                        @can('role-add')
                        <button type="button" class="btn btn-primary btn-save" onclick="saveData();" style="display:none">
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
            <div class="card-body px-0">
                <div class="table-responsive">
                    <input type="hidden" id="role_id" name="role_id" value="{{$role->id}}">
                    <table class="table align-middle table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Permissions</th>
                                @php
                                $permission_in_role = [];
                                foreach ($role->permissions as $permission ) {
                                    $permission_in_role[] = $permission->name;
                                }
                                @endphp
                                <th>Read</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>

                        <tbody>
                            <form id="formData" action="">
                                @csrf
                                <div id="method">
                                    @method("POST")
                                </div>
                                <tr>
                                    <td>Article</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="article-index" {{in_array("article-index", $permission_in_role) ? "checked" : ""}} id="article-index" name="article-index">
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td>News</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="news-index" {{in_array("news-index", $permission_in_role) ? "checked" : ""}} id="news-index" name="news-index">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="news-add" {{in_array("news-add", $permission_in_role) ? "checked" : ""}} id="news-add" name="news-add">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="news-update" {{in_array("news-update", $permission_in_role) ? "checked" : ""}} id="news-update" name="news-update">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="news-delete" {{in_array("news-delete", $permission_in_role) ? "checked" : ""}} id="news-delete" name="news-delete">
                                    </td>
                                </tr>

                                
                                <tr>
                                    <td>User</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="user-index" {{in_array("user-index", $permission_in_role) ? "checked" : ""}} id="user-index" name="user-index">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="user-add" {{in_array("user-add", $permission_in_role) ? "checked" : ""}} id="user-add" name="user-add">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="user-update" {{in_array("user-update", $permission_in_role) ? "checked" : ""}} id="user-update" name="user-update">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="user-delete" {{in_array("user-delete", $permission_in_role) ? "checked" : ""}} id="user-delete" name="user-delete">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="role-index" {{in_array("role-index", $permission_in_role) ? "checked" : ""}} id="role-index" name="role-index">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="role-add" {{in_array("role-add", $permission_in_role) ? "checked" : ""}} id="role-add" name="role-add">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="role-update" {{in_array("role-update", $permission_in_role) ? "checked" : ""}} id="role-update" name="role-update">
                                    </td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="role-delete" {{in_array("role-delete", $permission_in_role) ? "checked" : ""}} id="role-delete" name="role-delete">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Profil</td>
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="profile-index" {{in_array("profile-index", $permission_in_role) ? "checked" : ""}} id="profile-index" name="profile-index">
                                    </td>
                                        <td>
                                            <input class="form-check-input" type="checkbox" value="profile-add" {{in_array("profile-add", $permission_in_role) ? "checked" : ""}} id="profile-add" name="profile-add" disabled>
                                        </td>                                    
                                    <td>
                                        <input class="form-check-input" type="checkbox" value="profile-edit" {{in_array("profile-edit", $permission_in_role) ? "checked" : ""}} id="profile-edit" name="profile-edit">
                                    </td>                                    
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('modal')
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-16 px-24">
                <h5 class="modal-title" id="modalDataLabel">Add Permission</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="myForm">
                <div class="modal-body">
                    <input type="number" hidden>
                    <div class="row gx-8">
                        <div class="col-12 col-md-12">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Name
                                </label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button type="button" class="btn btn-danger btn-delete">Delete</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-text btn-cancel"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success btn-edit" onclick="editData()">Edit</button>
                            <button type="submit" class="btn btn-primary btn-save">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}

@section('js')
<script>
    let csrf_token;
    $(document).ready(function () {
        csrf_token = $('[name="_token"]').val();
        disableInput()
    });
    
    function disableInput(){
        //CRM
        //article
        $("#article-index").attr("onclick", "return false");
        $("#article-add").attr("onclick", "return false");
        $("#article-update").attr("onclick", "return false");
        $("#article-delete").attr("onclick", "return false");
        //news
        $("#news-index").attr("onclick", "return false");
        $("#news-add").attr("onclick", "return false");
        $("#news-update").attr("onclick", "return false");
        $("#news-delete").attr("onclick", "return false");
        //buku tamu
        $("#tsukamoto-index").attr("onclick", "return false");
        $("#tsukamoto-add").attr("onclick", "return false");
        $("#tsukamoto-update").attr("onclick", "return false");
        $("#tsukamoto-delete").attr("onclick", "return false");
        //rules 
        $("#rules-index").attr("onclick", "return false");
        $("#rules-add").attr("onclick", "return false");
        $("#rules-update").attr("onclick", "return false");
        $("#rules-delete").attr("onclick", "return false");
        //followup 
        $("#followup-index").attr("onclick", "return false");
        $("#followup-add").attr("onclick", "return false");
        $("#followup-update").attr("onclick", "return false");
        $("#followup-delete").attr("onclick", "return false");
        //pesan unit 
        $("#unit-index").attr("onclick", "return false");
        $("#unit-add").attr("onclick", "return false");
        $("#unit-update").attr("onclick", "return false");
        $("#unit-delete").attr("onclick", "return false");

        //KONSTRUKSI
        //proyek
        $("#proyek-index").attr("onclick", "return false");
        $("#proyek-add").attr("onclick", "return false");
        $("#proyek-update").attr("onclick", "return false");
        $("#proyek-delete").attr("onclick", "return false");
        //pekerjaan
        $("#pekerjaan-index").attr("onclick", "return false");
        $("#pekerjaan-add").attr("onclick", "return false");
        $("#pekerjaan-update").attr("onclick", "return false");
        $("#pekerjaan-delete").attr("onclick", "return false");
        //material
        $("#material-index").attr("onclick", "return false");
        $("#material-add").attr("onclick", "return false");
        $("#material-update").attr("onclick", "return false");
        $("#material-delete").attr("onclick", "return false");
        //tipeunit
        $("#tipeunit-index").attr("onclick", "return false");
        $("#tipeunit-add").attr("onclick", "return false");
        $("#tipeunit-update").attr("onclick", "return false");
        $("#tipeunit-delete").attr("onclick", "return false");
        //tambahunit
        $("#tambahunit-index").attr("onclick", "return false");
        $("#tambahunit-add").attr("onclick", "return false");
        $("#tambahunit-update").attr("onclick", "return false");
        $("#tambahunit-delete").attr("onclick", "return false");
        //cluster
        $("#cluster-index").attr("onclick", "return false");
        $("#cluster-add").attr("onclick", "return false");
        $("#cluster-update").attr("onclick", "return false");
        $("#cluster-delete").attr("onclick", "return false");
        //spk
        $("#spk-index").attr("onclick", "return false");
        $("#spk-add").attr("onclick", "return false");

        //SUPERADMIN
        //profile-perusahaan
        $("#profileperusahaan-index").attr("onclick", "return false");
        $("#profileperusahaan-add").attr("onclick", "return false");
        $("#profileperusahaan-update").attr("onclick", "return false");
        $("#profileperusahaan-delete").attr("onclick", "return false");

        //SETTINGS
        //user
        $("#user-index").attr("onclick", "return false");
        $("#user-add").attr("onclick", "return false");
        $("#user-update").attr("onclick", "return false");
        $("#user-delete").attr("onclick", "return false");
        //role
        $("#role-index").attr("onclick", "return false");
        $("#role-add").attr("onclick", "return false");
        $("#role-update").attr("onclick", "return false");
        $("#role-delete").attr("onclick", "return false");
        //profile
        $("#profile-index").attr("onclick", "return false");
        $("#profile-edit").attr("onclick", "return false");
        $('.btn-cancel').hide();
        $('.btn-save').hide();
        $('.btn-edit').show();
    }

    function cancelEdit(){
        resetToSavedData();
        disableInput();
    };

    function getCheckedValue(){
        let checked = [];
    //CRM
        //article
        if($("#article-index").is(":checked")){
            checked.push("article-index");
        }
        if($("#article-add").is(":checked")){
            checked.push("article-add");
        }
        if($("#article-update").is(":checked")){
            checked.push("article-update");
        }
        if($("#article-delete").is(":checked")){
            checked.push("article-delete");
        }
        //news
        if($("#news-index").is(":checked")){
            checked.push("news-index");
        }
        if($("#news-add").is(":checked")){
            checked.push("news-add");
        }
        if($("#news-update").is(":checked")){
            checked.push("news-update");
        }
        if($("#news-delete").is(":checked")){
            checked.push("news-delete");
        }
        //buku tamu
        if($("#tsukamoto-index").is(":checked")){
            checked.push("tsukamoto-index");
        }
        if($("#tsukamoto-add").is(":checked")){
            checked.push("tsukamoto-add");
        }
        if($("#tsukamoto-update").is(":checked")){
            checked.push("tsukamoto-update");
        }
        if($("#tsukamoto-delete").is(":checked")){
            checked.push("tsukamoto-delete");
        }
        //rules        
        if($("#rules-index").is(":checked")){
            checked.push("rules-index");
        }
        if($("#rules-add").is(":checked")){
            checked.push("rules-add");
        }
        if($("#rules-update").is(":checked")){
            checked.push("rules-update");
        }
        if($("#rules-delete").is(":checked")){
            checked.push("rules-delete");
        }
        //followup        
        if($("#followup-index").is(":checked")){
            checked.push("followup-index");
        }
        if($("#followup-add").is(":checked")){
            checked.push("followup-add");
        }
        if($("#followup-update").is(":checked")){
            checked.push("followup-update");
        }
        if($("#followup-delete").is(":checked")){
            checked.push("followup-delete");
        }
        //pesan unit        
        if($("#unit-index").is(":checked")){
            checked.push("unit-index");
        }
        if($("#unit-add").is(":checked")){
            checked.push("unit-add");
        }
        if($("#unit-update").is(":checked")){
            checked.push("unit-update");
        }
        if($("#unit-delete").is(":checked")){
            checked.push("unit-delete");
        }

    //KONSTRUKSI
        //pekerjaan        
        if($("#pekerjaan-index").is(":checked")){
            checked.push("pekerjaan-index");
        }
        if($("#pekerjaan-add").is(":checked")){
            checked.push("pekerjaan-add");
        }
        if($("#pekerjaan-update").is(":checked")){
            checked.push("pekerjaan-update");
        }
        if($("#pekerjaan-delete").is(":checked")){
            checked.push("pekerjaan-delete");
        }   
        //material        
        if($("#material-index").is(":checked")){
            checked.push("material-index");
        }
        if($("#material-add").is(":checked")){
            checked.push("material-add");
        }
        if($("#material-update").is(":checked")){
            checked.push("material-update");
        }
        if($("#material-delete").is(":checked")){
            checked.push("material-delete");
        }   
        //proyek        
        if($("#proyek-index").is(":checked")){
            checked.push("proyek-index");
        }
        if($("#proyek-add").is(":checked")){
            checked.push("proyek-add");
        }
        if($("#proyek-update").is(":checked")){
            checked.push("proyek-update");
        }
        if($("#proyek-delete").is(":checked")){
            checked.push("proyek-delete");
        }   
        //tipeunit        
        if($("#tipeunit-index").is(":checked")){
            checked.push("tipeunit-index");
        }
        if($("#tipeunit-add").is(":checked")){
            checked.push("tipeunit-add");
        }
        if($("#tipeunit-update").is(":checked")){
            checked.push("tipeunit-update");
        }
        if($("#tipeunit-delete").is(":checked")){
            checked.push("tipeunit-delete");
        }   
        //tambahunit        
        if($("#tambahunit-index").is(":checked")){
            checked.push("tambahunit-index");
        }
        if($("#tambahunit-add").is(":checked")){
            checked.push("tambahunit-add");
        }
        if($("#tambahunit-update").is(":checked")){
            checked.push("tambahunit-update");
        }
        if($("#tambahunit-delete").is(":checked")){
            checked.push("tambahunit-delete");
        }   
        //cluster        
        if($("#cluster-index").is(":checked")){
            checked.push("cluster-index");
        }
        if($("#cluster-add").is(":checked")){
            checked.push("cluster-add");
        }
        if($("#cluster-update").is(":checked")){
            checked.push("cluster-update");
        }
        if($("#cluster-delete").is(":checked")){
            checked.push("cluster-delete");
        }   
        //spk        
        if($("#spk-index").is(":checked")){
            checked.push("spk-index");
        }
        if($("#spk-add").is(":checked")){
            checked.push("spk-add");
        }

    //SUPERADMIN
        //profile-perusahaan        
        if($("#profileperusahaan-index").is(":checked")){
            checked.push("profileperusahaan-index");
        }
        if($("#profileperusahaan-add").is(":checked")){
            checked.push("profileperusahaan-add");
        }
        if($("#profileperusahaan-update").is(":checked")){
            checked.push("profileperusahaan-update");
        }
        if($("#profileperusahaan-delete").is(":checked")){
            checked.push("profileperusahaan-delete");
        }    

    //SETTINGS        
        //user
        if($("#user-index").is(":checked")){
            checked.push("user-index");
        }
        if($("#user-add").is(":checked")){
            checked.push("user-add");
        }
        if($("#user-update").is(":checked")){
            checked.push("user-update");
        }
        if($("#user-delete").is(":checked")){
            checked.push("user-delete");
        }
        //role
        if($("#role-index").is(":checked")){
            checked.push("role-index");
        }
        if($("#role-add").is(":checked")){
            checked.push("role-add");
        }
        if($("#role-update").is(":checked")){
            checked.push("role-update");
        }
        if($("#role-delete").is(":checked")){
            checked.push("role-delete");
        }
        //role
        if($("#profile-index").is(":checked")){
            checked.push("profile-index");
        }
        if($("#profile-edit").is(":checked")){
            checked.push("profile-edit");
        }
        return checked;
    }
    function saveData() { 

        let checked = getCheckedValue();

        $.ajax({
            url: "{{route('dashboard.user.permission.store')}}",
            type: "POST",
            data: {
                _token: csrf_token,
                _method: "POST",
                permission: checked,
                role_id: $("#role_id").val()
            },
            dataType: 'JSON',
            success: function(res){
                resetToSavedData();
                disableInput();
            }, error: function (xhr, ajaxOptions, thrownError){
                alert(thrownError)
                console.log(xhr);
            }
        });
        
    }
    function fillDetailData(response){

        //article
        if(response.includes("article-index")){
            $("#article-index").prop("checked", true);
        } else {
            $("#article-index").prop("checked", false);
        }
        if(response.includes("article-add")){
            $("#article-add").prop("checked", true);
        } else {
            $("#article-add").prop("checked", false);
        }
        if(response.includes("article-add")){
            $("#article-add").prop("checked", true);
        } else {
            $("#article-add").prop("checked", false);
        }
        if(response.includes("article-update")){
            $("#article-update").prop("checked", true);
        } else {
            $("#article-update").prop("checked", false);
        }
        if(response.includes("article-delete")){
            $("#article-delete").prop("checked", true);
        } else {
            $("#article-delete").prop("checked", false);
        }
        //news
        if(response.includes("news-index")){
            $("#news-index").prop("checked", true);
        } else {
            $("#news-index").prop("checked", false);
        }
        if(response.includes("news-add")){
            $("#news-add").prop("checked", true);
        } else {
            $("#news-add").prop("checked", false);
        }
        if(response.includes("news-add")){
            $("#news-add").prop("checked", true);
        } else {
            $("#news-add").prop("checked", false);
        }
        if(response.includes("news-update")){
            $("#news-update").prop("checked", true);
        } else {
            $("#news-update").prop("checked", false);
        }
        if(response.includes("news-delete")){
            $("#news-delete").prop("checked", true);
        } else {
            $("#news-delete").prop("checked", false);
        }
        //buku tamu
        if(response.includes("tsukamoto-index")){
            $("#tsukamoto-index").prop("checked", true);
        } else {
            $("#tsukamoto-index").prop("checked", false);
        }
        if(response.includes("tsukamoto-add")){
            $("#tsukamoto-add").prop("checked", true);
        } else {
            $("#tsukamoto-add").prop("checked", false);
        }
        if(response.includes("tsukamoto-update")){
            $("#tsukamoto-update").prop("checked", true);
        } else {
            $("#tsukamoto-update").prop("checked", false);
        }
        if(response.includes("tsukamoto-delete")){
            $("#tsukamoto-delete").prop("checked", true);
        } else {
            $("#tsukamoto-delete").prop("checked", false);
        }
        //rules
        if(response.includes("rules-index")){
            $("#rules-index").prop("checked", true);
        } else {
            $("#rules-index").prop("checked", false);
        }
        if(response.includes("rules-add")){
            $("#rules-add").prop("checked", true);
        } else {
            $("#rules-add").prop("checked", false);
        }
        if(response.includes("rules-update")){
            $("#rules-update").prop("checked", true);
        } else {
            $("#rules-update").prop("checked", false);
        }
        if(response.includes("rules-delete")){
            $("#rules-delete").prop("checked", true);
        } else {
            $("#rules-delete").prop("checked", false);
        }
        //followup
        if(response.includes("followup-index")){
            $("#followup-index").prop("checked", true);
        } else {
            $("#followup-index").prop("checked", false);
        }
        if(response.includes("followup-add")){
            $("#followup-add").prop("checked", true);
        } else {
            $("#followup-add").prop("checked", false);
        }
        if(response.includes("followup-update")){
            $("#followup-update").prop("checked", true);
        } else {
            $("#followup-update").prop("checked", false);
        }
        if(response.includes("followup-delete")){
            $("#followup-delete").prop("checked", true);
        } else {
            $("#followup-delete").prop("checked", false);
        }
        //pesan unit
        if(response.includes("unit-index")){
            $("#unit-index").prop("checked", true);
        } else {
            $("#unit-index").prop("checked", false);
        }
        if(response.includes("unit-add")){
            $("#unit-add").prop("checked", true);
        } else {
            $("#unit-add").prop("checked", false);
        }
        if(response.includes("unit-update")){
            $("#unit-update").prop("checked", true);
        } else {
            $("#unit-update").prop("checked", false);
        }
        if(response.includes("unit-delete")){
            $("#unit-delete").prop("checked", true);
        } else {
            $("#unit-delete").prop("checked", false);
        }
        //pekerjaan
        if(response.includes("pekerjaan-index")){
            $("#pekerjaan-index").prop("checked", true);
        } else {
            $("#pekerjaan-index").prop("checked", false);
        }
        if(response.includes("pekerjaan-add")){
            $("#pekerjaan-add").prop("checked", true);
        } else {
            $("#pekerjaan-add").prop("checked", false);
        }
        if(response.includes("pekerjaan-update")){
            $("#pekerjaan-update").prop("checked", true);
        } else {
            $("#pekerjaan-update").prop("checked", false);
        }
        if(response.includes("pekerjaan-delete")){
            $("#pekerjaan-delete").prop("checked", true);
        } else {
            $("#pekerjaan-delete").prop("checked", false);
        }
        //material
        if(response.includes("material-index")){
            $("#material-index").prop("checked", true);
        } else {
            $("#material-index").prop("checked", false);
        }
        if(response.includes("material-add")){
            $("#material-add").prop("checked", true);
        } else {
            $("#material-add").prop("checked", false);
        }
        if(response.includes("material-update")){
            $("#material-update").prop("checked", true);
        } else {
            $("#material-update").prop("checked", false);
        }
        if(response.includes("material-delete")){
            $("#material-delete").prop("checked", true);
        } else {
            $("#material-delete").prop("checked", false);
        }
        //proyek
        if(response.includes("proyek-index")){
            $("#proyek-index").prop("checked", true);
        } else {
            $("#proyek-index").prop("checked", false);
        }
        if(response.includes("proyek-add")){
            $("#proyek-add").prop("checked", true);
        } else {
            $("#proyek-add").prop("checked", false);
        }
        if(response.includes("proyek-update")){
            $("#proyek-update").prop("checked", true);
        } else {
            $("#proyek-update").prop("checked", false);
        }
        if(response.includes("proyek-delete")){
            $("#proyek-delete").prop("checked", true);
        } else {
            $("#proyek-delete").prop("checked", false);
        }
        //tipeunit
        if(response.includes("tipeunit-index")){
            $("#tipeunit-index").prop("checked", true);
        } else {
            $("#tipeunit-index").prop("checked", false);
        }
        if(response.includes("tipeunit-add")){
            $("#tipeunit-add").prop("checked", true);
        } else {
            $("#tipeunit-add").prop("checked", false);
        }
        if(response.includes("tipeunit-update")){
            $("#tipeunit-update").prop("checked", true);
        } else {
            $("#tipeunit-update").prop("checked", false);
        }
        if(response.includes("tipeunit-delete")){
            $("#tipeunit-delete").prop("checked", true);
        } else {
            $("#tipeunit-delete").prop("checked", false);
        }
        //tambahunit
        if(response.includes("tambahunit-index")){
            $("#tambahunit-index").prop("checked", true);
        } else {
            $("#tambahunit-index").prop("checked", false);
        }
        if(response.includes("tambahunit-add")){
            $("#tambahunit-add").prop("checked", true);
        } else {
            $("#tambahunit-add").prop("checked", false);
        }
        if(response.includes("tambahunit-update")){
            $("#tambahunit-update").prop("checked", true);
        } else {
            $("#tambahunit-update").prop("checked", false);
        }
        if(response.includes("tambahunit-delete")){
            $("#tambahunit-delete").prop("checked", true);
        } else {
            $("#tambahunit-delete").prop("checked", false);
        }
        //cluster
        if(response.includes("cluster-index")){
            $("#cluster-index").prop("checked", true);
        } else {
            $("#cluster-index").prop("checked", false);
        }
        if(response.includes("cluster-add")){
            $("#cluster-add").prop("checked", true);
        } else {
            $("#cluster-add").prop("checked", false);
        }
        if(response.includes("cluster-update")){
            $("#cluster-update").prop("checked", true);
        } else {
            $("#cluster-update").prop("checked", false);
        }
        if(response.includes("cluster-delete")){
            $("#cluster-delete").prop("checked", true);
        } else {
            $("#cluster-delete").prop("checked", false);
        }
        //spk
        if(response.includes("spk-index")){
            $("#spk-index").prop("checked", true);
        } else {
            $("#spk-index").prop("checked", false);
        }
        if(response.includes("spk-add")){
            $("#spk-add").prop("checked", true);
        } else {
            $("#spk-add").prop("checked", false);
        }
        //profile-perusahaan
        if(response.includes("profileperusahaan-index")){
            $("#profileperusahaan-index").prop("checked", true);
        } else {
            $("#profileperusahaan-index").prop("checked", false);
        }
        if(response.includes("profileperusahaan-add")){
            $("#profileperusahaan-add").prop("checked", true);
        } else {
            $("#profileperusahaan-add").prop("checked", false);
        }
        if(response.includes("profileperusahaan-update")){
            $("#profileperusahaan-update").prop("checked", true);
        } else {
            $("#profileperusahaan-update").prop("checked", false);
        }
        if(response.includes("profileperusahaan-delete")){
            $("#profileperusahaan-delete").prop("checked", true);
        } else {
            $("#profileperusahaan-delete").prop("checked", false);
        }
        //user
        if(response.includes("user-index")){
            $("#user-index").prop("checked", true);
        } else {
            $("#user-index").prop("checked", false);
        }
        if(response.includes("user-add")){
            $("#user-add").prop("checked", true);
        } else {
            $("#user-add").prop("checked", false);
        }
        if(response.includes("user-edit")){
            $("#user-edit").prop("checked", true);
        } else {
            $("#user-edit").prop("checked", false);
        }
        if(response.includes("user-delete")){
            $("#user-delete").prop("checked", true);
        } else {
            $("#user-delete").prop("checked", false);
        }
        //role
        if(response.includes("role-index")){
            $("#role-index").prop("checked", true);
        } else {
            $("#role-index").prop("checked", false);
        }
        if(response.includes("role-add")){
            $("#role-add").prop("checked", true);
        } else {
            $("#role-add").prop("checked", false);
        }
        if(response.includes("role-edit")){
            $("#role-edit").prop("checked", true);
        } else {
            $("#role-edit").prop("checked", false);
        }
        if(response.includes("role-delete")){
            $("#role-delete").prop("checked", true);
        } else {
            $("#role-delete").prop("checked", false);
        }
        //profile
        if(response.includes("profile-index")){
            $("#profile-index").prop("checked", true);
        } else {
            $("#profile-index").prop("checked", false);
        }
        if(response.includes("profile-edit")){
            $("#profile-edit").prop("checked", true);
        } else {
            $("#profile-edit").prop("checked", false);
        }
    }
    function editData() {
    //CRM    
        //article
        $('#article-index').attr("onclick", "");
        $('#article-add').attr("onclick", "");
        $('#article-update').attr("onclick", "");
        $('#article-delete').attr("onclick", "");
        //news
        $('#news-index').attr("onclick", "");
        $('#news-add').attr("onclick", "");
        $('#news-update').attr("onclick", "");
        $('#news-delete').attr("onclick", "");
        //buku tamu
        $("#tsukamoto-index").attr("onclick", "");
        $("#tsukamoto-add").attr("onclick", "");
        $("#tsukamoto-update").attr("onclick", "");
        $("#tsukamoto-delete").attr("onclick", "");
        //rules
        $("#rules-index").attr("onclick", "");
        $("#rules-add").attr("onclick", "");
        $("#rules-update").attr("onclick", "");
        $("#rules-delete").attr("onclick", "");
        //followup
        $("#followup-index").attr("onclick", "");
        $("#followup-add").attr("onclick", "");
        $("#followup-update").attr("onclick", "");
        $("#followup-delete").attr("onclick", "");
        //pesan unit
        $("#unit-index").attr("onclick", "");
        $("#unit-add").attr("onclick", "");
        $("#unit-update").attr("onclick", "");
        $("#unit-delete").attr("onclick", "");

    //KONSTRUKSI
        //pekerjaan
        $("#pekerjaan-index").attr("onclick", "");
        $("#pekerjaan-add").attr("onclick", "");
        $("#pekerjaan-update").attr("onclick", "");
        $("#pekerjaan-delete").attr("onclick", "");
        //material
        $("#material-index").attr("onclick", "");
        $("#material-add").attr("onclick", "");
        $("#material-update").attr("onclick", "");
        $("#material-delete").attr("onclick", "");
        //proyek
        $("#proyek-index").attr("onclick", "");
        $("#proyek-add").attr("onclick", "");
        $("#proyek-update").attr("onclick", "");
        $("#proyek-delete").attr("onclick", "");
        //tipeunit
        $("#tipeunit-index").attr("onclick", "");
        $("#tipeunit-add").attr("onclick", "");
        $("#tipeunit-update").attr("onclick", "");
        $("#tipeunit-delete").attr("onclick", "");
        //tambahunit
        $("#tambahunit-index").attr("onclick", "");
        $("#tambahunit-add").attr("onclick", "");
        $("#tambahunit-update").attr("onclick", "");
        $("#tambahunit-delete").attr("onclick", "");
        //cluster
        $("#cluster-index").attr("onclick", "");
        $("#cluster-add").attr("onclick", "");
        $("#cluster-update").attr("onclick", "");
        $("#cluster-delete").attr("onclick", "");
        //spk
        $("#spk-index").attr("onclick", "");
        $("#spk-add").attr("onclick", "");

    //SUPERADMIN
        //profile-perusahaan
        $("#profileperusahaan-index").attr("onclick", "");
        $("#profileperusahaan-add").attr("onclick", "");
        $("#profileperusahaan-update").attr("onclick", "");
        $("#profileperusahaan-delete").attr("onclick", "");

    //SETTINGS    
        //user
        $("#user-index").attr("onclick", "");
        $("#user-add").attr("onclick", "");
        $("#user-update").attr("onclick", "");
        $("#user-delete").attr("onclick", "");
        //role
        $("#role-index").attr("onclick", "");
        $("#role-add").attr("onclick", "");
        $("#role-update").attr("onclick", "");
        $("#role-delete").attr("onclick", "");
        //profile
        $("#profile-index").attr("onclick", "");
        $("#profile-edit").attr("onclick", "");

        //button
        $('.btn-save').show();
        $('.btn-cancel').show();
        $('.btn-edit').hide();
    }

    function resetToSavedData() { 
        event.preventDefault();
        $.ajax({
            url: "{{route('dashboard.user.permission.index')}}",
            type: "GET",
            data: {
                role: $("#role_id").val()
            },
            success: function(res){
                fillDetailData(res);
            }
        });
    }

</script>
@endsection
