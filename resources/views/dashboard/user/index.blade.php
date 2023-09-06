@extends('layouts.dashboard')

@section('title', 'User | SIM - KU ')

@section('content')
<div class="row mb-32 gy-32">
    <div class="col-12">
        <div class="row justify-content-between gy-32">
            <div class="col-12 col-md-4">
                <h3 class="h3">User</h3>
            </div>
            <div class="col-12 col-md-7">
                <div class="row g-16 align-items-center justify-content-end">
                    <div class="col-12 col-md-6 col-xl-4">

                        <form action="{{route('dashboard.user.index')}}" method="get">
                            <div class="input-group align-items-center">
                                <span class="input-group-text bg-white hp-bg-dark-100 border-end-0 pe-0">
                                    <i class="iconly-Light-Search text-black-80" style="font-size: 16px;"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-8" id="search" name="search" value="{{request('search')??''}}" placeholder="Search">
                            </div>
                        </form>

                    </div>

                    <div class="col hp-flex-none w-auto">
                        @can('user-add')
                        <button type="button" class="btn btn-primary w-100" onclick="saveData();">
                            <i class="ri-add-line remix-icon"></i>
                            <span>Add User</span>
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
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
        <div class="card hp-contact-card mb-32">
            <div class="card-body px-0">
                <div class="table-responsive">
                    <table class="table align-middle table-hover table-borderless">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Phone</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                            <div
                                                class="avatar-item avatar-lg d-flex align-items-center justify-content-center bg-primary-4 hp-bg-dark-primary text-primary hp-text-color-dark-0 rounded-circle">
                                                <img src="{{asset('app-assets/img/default-profile.svg')}}"
                                                    alt="Photo">
                                            </div>
                                    </td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>{!!count($item->getRoleNames()) > 0 ? $item->getRoleNames()[0] : "<span style='color:red;'>Not set</span>"!!}</td>
                                    <td>{{$item->email}}</td>
                                    <td>

                                    @if ($item->status == 1)
                                    <div class="badge bg-success-4 hp-bg-dark-success text-success border-success">
                                        active
                                    </div>
                                    @else
                                    <div class="badge bg-danger-4 hp-bg-dark-danger text-danger border-danger">
                                        inactive
                                    </div>
                                    @endif

                                    </td>
                                    <td>{{$item->phone}}</td>
                                    <td class="text-end">
                                        @can('user-update')
                                        <button onclick='detailData({{$item->id}})' class="btn btn-text text-primary btn-sm"
                                            title="Detail">
                                            <i class="iconly-Light-Show"></i>
                                        </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {{$data->links("pagination::bootstrap-4")}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modalData" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-16 px-24">
                <h5 class="modal-title" id="modalDataLabel">Manage User</h5>
                <button type="button" class="btn-close hp-bg-none d-flex align-items-center justify-content-center"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="ri-close-line hp-text-color-dark-0 lh-1" style="font-size: 24px;"></i>
                </button>
            </div>

            <div class="divider m-0"></div>

            <form id="formData" action="{{route('dashboard.user.store')}}" method="POST">
                @csrf
                <div id="method">
                    @method("POST")
                </div>
                <div class="modal-body">
                    <input type="number" hidden>
                    <input type="text" id="user_id" hidden>
                    <div class="row gx-8">
                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="name" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Name
                                </label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="email" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="phone" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Phone
                                </label>
                                <input type="number" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="role" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Jabatan
                                </label>
                                <input type="text" class="form-control" id="departement" name="departement" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="role" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Role
                                </label>
                                <select class="form-select" id="role" name="role" required>
                                    <option selected hidden>Role</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="mb-24">
                                <label for="status" class="form-label">
                                    <span class="text-danger me-4">*</span>
                                    Status
                                </label>
                                <select class="form-select" id="status" name="status" required>
                                    <option selected hidden>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="alert alert-dark default-password">Default Password : 12345678</div>

                        <div class="alert alert-danger notif-pass">
                        Leave the password blank if you don't want to change it
                        </div>

                        <div class="col-12 col-md-6 pass" style="display:none">
                            <div class="mb-24">
                                <label for="phone" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    New Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 confirm_pass" style="display:none">
                            <div class="mb-24">
                                <label for="phone" class="form-label">
                                    <span class="text-danger me-4"></span>
                                    Confirm New Password
                                </label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer pt-0 px-24 pb-24">
                    <div class="divider"></div>
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            @can('user-delete')
                            <button type="button" onclick="deleteData()" class="btn btn-danger btn-delete">Delete</button>
                            @endcan
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
@endsection

@section('js')
<script>
    let loading = '<div class="spinner-border spinner-border-sm ml-3" role="status"></div>';

    function fillDetailData(response){
        const userData = response.user;
        const roleData = response.role;

        $("#user_id").val(userData.id.toString());
        $("#name").val(userData.name);
        $("#email").val(userData.email);
        $("#phone").val(userData.phone);
        $("#departement").val(userData.departement);
        $("#status").val(userData.status).change();
        $('.notif-pass').show();
        $(".pass").show();
        $(".confirm_pass").show();

        let fillingRole = new Promise(function(resolve){
            fillRoleOptions();
            setTimeout(() => {
                    resolve(true)
            }, 300);
        });

        fillingRole.then(function(resolve){
            $("#role").val(roleData.id).change();
        });
    }

    function fillRoleOptions(){
        $.ajax({
            url: "{{route('dashboard.user.getrole')}}",
            method: "GET",
            success: function (res){
                let options = (function(){
                    let option = "<option selected hidden>Role</option>";
                    res.forEach(element => {
                        option = option + `<option value='${element.id}'>${element.name}</option>`
                    });
                    return option;
                })();
                $("#role").html(options);
                return true;
            }
        })
    }

    function saveData() {
        fillRoleOptions();
        $('.default-password').show();
        $('.btn-edit').hide();
        $('.btn-delete').hide();
        $('.btn-update').hide();
        $('.notif-pass').hide();
        $(".pass").hide();
        $(".confirm_pass").hide();
        $('.btn-save').show();
        $(".modal-body :input").prop("disabled", false);
        $('#modalData').modal('show');
    }

    function detailData(id) {
        if(id != null){
            $.ajax({
                url: "{{route('dashboard.user.show', ':id')}}".replace(":id", id),
                type: "GET",
                success: function(res){
                    fillDetailData(res);
                },
                error: function (xhr, err, throwable) {
                    console.log(throwable)
                }
            });
        }
        $('.default-password').hide();
        $('.btn-edit').show();
        $('.btn-delete').show();
        $('.btn-save').hide();
        $('.btn-update').hide();
        $(".modal-body :input").prop("disabled", true);
        $('#modalData').modal('show');
    }

    function editData(){
        $(".modal-body :input").prop("disabled", false);
        $('.btn-edit').show();
        $('.btn-delete').hide();
        $('.btn-save').hide();
        $(".btn-save").prop("disabled", true);
        $('.btn-update').show();
    }

    function updateData(){
        const id = $("#user_id").val();
        if(id != null && id != undefined){
            $(".btn-update").append(loading);
            $("#formData").attr("method", "POST");
            $("#formData").attr("action", "{{route('dashboard.user.update', ':id')}}".replace(":id", id));
            $("#method").html(`@method('PUT')`);
            $("#formData").submit();
        } else {
            alert("Cannot update data, id not found");
        }
    }

    function deleteData() {
        var result = confirm("Want to delete?");
        if (result) {
            const id = $("#user_id").val();
            if(id != null && id != undefined){
                $(".btn-delete").append(loading);
                $("#formData").attr("method", "POST");
                $("#formData").attr("action", "{{route('dashboard.user.destroy', ':id')}}".replace(":id", id));
                $("#method").html(`@method('delete')`);
                $("#formData").submit();

            } else {
                alert("Cannot delete data, id not found");
            }
        }
    }

    function resetModalState(){
        $("#name").val("");
        $("#email").val("");
        $("#phone").val("");
        $("#departement").val("");
        $("#status").val("Status").change();
        $("#role").val("Role").change();
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
@endsection
