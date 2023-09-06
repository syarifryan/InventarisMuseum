@extends('layouts.dashboard')

@section('title', 'Password | Jidoka.id ')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/page-profile.css')}}">
<style>
    #upload-demo {
        width: 250px;
        height: 250px;
        padding-bottom: 25px;
    }
</style>
@endsection

@section('content')
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
                                    <form action="{{route("dashboard.user.deletePhotoPic", Auth::user()->id)}}" id="deleteProfilePic" method="post">
                                    @csrf
                                    @method("delete")
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
                                    <img id="item-img-output" src="{{Auth::user()->picture != null ? '/storage/image_uploaded/'.Auth::user()->picture : asset('app-assets/img/default-profile.svg')}}"
                                    style="width: 80px; height: 80px; object-fit:cover;">
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-24 mb-4">{{Auth::user()->display_name == "" ? Auth::user()->name : Auth::user()->display_name}}</h4>
                        <a href="mailto:{{Auth::user()->email}}" class="hp-p1-body">{{Auth::user()->email}}</a>
                    </div>
                </div>

                <div class="hp-profile-menu-body w-100 text-start mt-48 mt-lg-0">
                    <ul class="me-n1 mx-lg-n12">
                        <li class="mt-4 mb-16">
                            <a href="{{url('dashboard/profile')}}"
                                class="position-relative text-black-80 hp-text-color-dark-30 hp-hover-text-color-primary-1 hp-hover-text-color-dark-0 py-12 px-24 d-flex align-items-center">
                                <i class="iconly-Curved-User me-16"></i>
                                <span>Personal Information</span>

                                <span
                                    class="hp-menu-item-line position-absolute opacity-0 h-100 top-0 end-0 bg-primary hp-bg-dark-0"
                                    style="width: 2px;"></span>
                            </a>
                        </li>

                        <li class="mt-4 mb-16">
                            <a href="{{url('dashboard/profile/password')}}"
                                class="active   position-relative text-black-80 hp-text-color-dark-30 hp-hover-text-color-primary-1 hp-hover-text-color-dark-0 py-12 px-24 d-flex align-items-center">
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
                    <img src="{{asset('app-assets/img/profile-page.svg')}}" alt="Profile Image">
                </div>
            </div>

            <div class="col-lg-9 ps-16 ps-sm-32 py-24 py-sm-32 overflow-hidden">
                <div class="row">
                    <div class="col-12">
                        <h2>Change Password</h2>
                        <p class="hp-p1-body mb-0">Set a unique password to protect your account.</p>
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    Successfully updated data
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

                    <div class="divider border-black-40 hp-border-color-dark-80"></div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-8 col-md-7 col-xl-5 col-xxxl-3">
                                <form action="{{route('dashboard.user.update-password', Auth::user()->id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="mb-24">
                                        <label for="old_password" class="form-label">Old Password :</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password"
                                            placeholder="Password">
                                    </div>

                                    <div class="mb-24">
                                        <label for="new_password" class="form-label">New Password :</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password"
                                            placeholder="Password">
                                    </div>

                                    <div class="mb-24">
                                        <label for="password_confirmation" class="form-label">Confirm New Password
                                            :</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                            placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('modal')
<div class="modal fade" id="modalUploadPicture" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-style">
            <div class="mb-24">
                <form id="formData" method="POST" enctype="multipart/form-data" action="{{route('dashboard.user.uploadPhotoPic')}}">
                    @csrf
                    <div id="method">
                        @method("POST")
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label for="name" class="form-label">
                                <span class="text-danger me-4">*</span>
                                File
                                </label>
                                <input type="file" name="picture" class="form-control" required>
                        </div>
                        <input type="hidden" name="id" value="{{Auth::user()->id}}" class="form-control" >
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-save">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
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
            url: "{{route('dashboard.user.uploadPhotoPic')}}",
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
@endsection