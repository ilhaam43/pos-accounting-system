<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name'          => 'Superadmin',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('roles')->insert([
            'role_name'          => 'Admin',
            'created_at'    =>  Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }
}
