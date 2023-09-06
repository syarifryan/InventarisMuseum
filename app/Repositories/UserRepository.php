<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserRepository implements RepositoryInterface
{
    private $model;
    private $role;

    public function __construct(User $model, Role $role)
    {
        $this->model = $model;
        $this->role = $role;
    }

    public function get()
    {
        $data = $this->model::get();
        return $data;
    } 
    
    public function getPaginate($howMany)
    {
        $data = $this->model::paginate($howMany);
        return $data;
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

    public function search($keyword)
    {
        $data = $this->model::where("name", "LIKE", "%$keyword%")
        ->orWhere("email", "LIKE", "%$keyword%")
        ->paginate(10)->withQueryString();
        return $data;
    }

    //User & Role
    public function store($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required|unique:users",
                "phone" => "required",
                "role" => "required|not_regex:/^Role$/i",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            
            $user = $this->model::create([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "departement" => $request->departement,
                "password" => $request->password == "" ? Hash::make("12345678") : $request->password,
                "status" => $request->status,
            ]);
            
            $user = $user->fresh();
            $role = $this->role::find($request->role);
            $user->syncRoles([$role->name]);
            
            return ["status"=>"success", "message"=>"Data stored succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    
    public function update($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required",
                "role" => "required|not_regex:/^Role$/i",
                "status" => "required|not_regex:/^Status$/i"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            if($request->password != $request->confirm_password){
                throw new Exception("Confirmation password is not the same");
            }

            $data = $this->model::find($request->id);
            $data->update([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "departement" => $request->departement,
                "status" => $request->status,
                "password" => Hash::make($request->password),
            ]);

            $user = $this->model::find($request->id);
            $role = $this->role::find($request->role);
            $user->syncRoles([$role->name]);
            return ["status"=>"success", "message"=>"Data updated succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    
    //Profile
    public function update_profile($request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required",
                "phone" => "required",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $data->update([
                "name" => $request->name,
                "display_name" => $request->display_name,
                "email" => $request->email,
                "phone" => $request->phone,
                "address" => $request->address,
                "departement" => $request->departement,
            ]);
            return ["status"=>"success", "message"=>"Data updated succesfully."];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    
    public function uploadPhotoPic($request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "picture" => "required", 
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            $data = $this->model::find($request->id);
            $oldPictureName = $data->picture;
            $pictureName = $this->uploadPictureHelper($request);
            $data->update([
                "picture" => $pictureName, 
            ]); 
            $this->deleteLocalPictureHelper($oldPictureName);
            return ["status"=>"success", "message"=>"Profile picture updated succesfully. "];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    
    public function deletePhotoPic($request)
    {
        try {  
            $data = $this->model::find($request->id);
            $oldPictureName = $data->picture; 
            $data->update([
                "picture" => null, 
            ]); 
            $this->deleteLocalPictureHelper($oldPictureName);
            return ["status"=>"success", "message"=>"Profile picture delete succesfully. "];
        } catch (\Throwable $th) {
            return ["status"=>"error", "message"=>$th->getMessage()];
        }
    }
    
    public function updatePassword($request, $id){

        try {
            $validator = Validator::make($request->all(), [
                "old_password" => "required",
                "new_password" => "required|min:8",
                "password_confirmation" => "required|min:8"
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }
            if($request->new_password != $request->password_confirmation){
                throw new Exception("Password confirmation does not match.");
            }
            
            $user = $this->model::find($request->id);
            if(!Hash::check($request->old_password, $user->password)){
                throw new Exception("Password does not match.");
            } else {
                $user->update([
                    "password"=>Hash::make($request->new_password)
                ]);
            }
            return ["status" => "success", "message" => "Password changed succesfully."];
        } catch (\Throwable $th) {
            return ["status" => "error", "message" => $th->getMessage()];
        }
    }

    private function uploadPictureHelper($request)
    {
        try {
            $picture = $request->file('picture');
            $pictureName = $picture->hashName();
            $picture->storeAs("public/image_uploaded", $pictureName);
            return $pictureName;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    private function deleteLocalPictureHelper($fileName)
    {
        try {
            if($fileName != ""){
                Storage::disk('local')->delete('public/image_uploaded/' . $fileName);
                return null;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    

    public function destroy($id)
    {
        try {
            $data = $this->model::find($id);
            $data->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    
    
}