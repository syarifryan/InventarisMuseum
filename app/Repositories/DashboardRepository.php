<?php

namespace App\Repositories;

use App\Models\BusinessReferral;
use App\Models\Information;
use App\Models\Leads;
use App\Models\News;
use App\Models\RecentActivity;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class DashboardRepository implements RepositoryInterface
{
    private $superadmin;
    private $user;


    // public function __construct(User $superadmin,$user)
    // {
    //     $this->superadmin = $superadmin;
    //     $this->user = $user;
    // }
   
    public function get(){

    }
    public function getPaginate($howMany){

    }
    public function find($id){

    }
    public function store($data){

    }
    public function update($data, $id){

    }
    public function destroy($id){

    }
}
