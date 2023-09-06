<?php

namespace Database\Seeders;

use App\Models\Pekerjaan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $superadmin = User::create([
            "id" => 1,
            "name" => "superadmin",
            "display_name" => "superadmin display name",
            "email" => "superadmin@example.com",
            "phone" => "082233334444",
            "address" => "Jalan Mawar No. 4",
            "departement" => "Superadmin",
            "password" => Hash::make('password'),
            "status" => 1
        ]);
        $author = User::create([
            "id" => 2,
            "name" => "author",
            "display_name" => "author display name",
            "email" => "author@example.com",
            "phone" => "082233335555",
            "address" => "Jalan Mawar No. 4",
            "departement" => "Author",
            "password" => Hash::make('password'),
            "status" => 1
        ]);
        $user = User::create([
            "id" => 3,
            "name" => "user",
            "display_name" => "user display name",
            "email" => "user@example.com",
            "phone" => "082233336666",
            "address" => "Jalan Mawar No. 4",
            "departement" => "User",
            "password" => Hash::make('password'),
            "status" => 1
        ]);

        

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
        //MAIN
            //article
            'article-index', 

        //MASTER
            'news-index', 
            'news-add',
            'news-update',
            'news-delete',
        
        //SETTINGS
            //user
            'user-index',
            'user-add',
            'user-update',
            'user-delete',
            //role
            'role-index',
            'role-add',
            'role-update',
            'role-delete',
            //permission
            'permission-index',
            'permission-add',
            'permission-update',
            'permission-delete',
            //profile
            'profile-index',
            'profile-edit',
        ];

        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        Permission::insert($permissions->toArray());

        //ROLE SUPERADMIN
        $role = Role::create(['name' => 'Superadmin'])
            ->givePermissionTo([
        //MAIN
            //article
            'article-index', 

        //MASTER
            //news
            'news-index', 
            'news-add',
            'news-update',
            'news-delete',
        
        //SETTINGS
            //user
            'user-index',
            'user-add',
            'user-update',
            'user-delete',
            //role
            'role-index',
            'role-add',
            'role-update',
            'role-delete',
            //permission
            'permission-index',
            'permission-add',
            'permission-update',
            'permission-delete',
            //profile
            'profile-index',
            'profile-edit',
            ]);

        $superadmin = $superadmin->fresh();
        $superadmin->syncRoles(['superadmin']);

        
        //ROLE Author
        $role = Role::create(['name' => 'Author'])
        ->givePermissionTo([
            //MAIN
                //article
                'article-index', 
                
            //MASTER
               //news
               'news-index', 
               'news-add',
               'news-update',
               'news-delete',
            //SENSOR

            //SETTINGS
                //profile
                'profile-index',
                'profile-edit',
            ]);

            $author = $author->fresh();
            $author->syncRoles(['author']);

        //ROLE User
        $role = Role::create(['name' => 'User'])
        ->givePermissionTo([
            //MAIN
            //article
            'article-index', 
        
            //SENSOR

            //SETTINGS
                //profile
                'profile-index',
                'profile-edit',
            ]);

            $user = $user->fresh();
            $user->syncRoles(['user']);






    }
}
