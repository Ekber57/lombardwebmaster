<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\User;
use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //! Customer permissons 
        Permission::create(["name" => "create customer"]);
        Permission::create(["name" => "show customer list"]);
        Permission::create(["name" => "edit customer"]);
       
        //! Credit permissons 
        Permission::create(["name" => "create credit"]);
        Permission::create(["name" => "show credit"]);
       
        //! User permissons 

        Permission::create(["name" => "create user"]);
        Permission::create(["name" => "show user"]);
        Permission::create(["name" => "edit permisson"]);
       
        //! Statics permissons 
        Permission::create(["name" => "show statics"]);
       
        //! Percentage permissons 
        Permission::create(["name" => "change percentage"]);

        $admin = User::create([
            "name" => "Benjamin",
            "lastname" => "Franklin",
            "middlename" => " Josiah",
            "password" => bcrypt("admin123"),
            "email" => "Benjamin@franklin.mail"
        ])->save();
        $admin = User::find(1);
        foreach(Permission::all() as $permission) {
            $admin->givePermissionTo($permission->name);
        }

        Customer::factory()->count(10000)->create();
    }
}
