<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private $userRepository; 

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('dashboard.profile.index');
    }
    public function uploadPhotoPic(Request $request)
    {
        $isSuccess = $this->userRepository->uploadPhotoPic($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(["status" => "success", "message"=>$isSuccess['message']]);
        } else {
            return redirect()->back()->with(["message" => $isSuccess['message']]);
        }
    }
    public function deletePhotoPic(Request $request, $id)
    {
        $isSuccess = $this->userRepository->deletePhotoPic($request);
        if ($isSuccess['status'] == "success") {
            return redirect()->back()->with(["status" => "success", "message"=>$isSuccess['message']]);
        } else {
            return redirect()->back()->with(["message" => $isSuccess['message']]);
        }
    }
}
