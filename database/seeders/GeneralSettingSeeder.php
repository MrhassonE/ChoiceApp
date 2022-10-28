<?php

namespace Database\Seeders;

use App\Models\GeneralSetting;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=>'Administrator',
            'email'=>'Administrator@app.com',
            'password'=>Hash::make('Password'),
        ]);
        $roles = Role::all();
        foreach ($roles as $role){
            $user->attachRole($role);
        }

        GeneralSetting::create([
            'company_name'=>'Choice App',
            'company_logo'=>'Choice.png',
            'policy'=>'Choice App',
            'conditions'=>'Choice App',
            'email'=>'Choice@App.com',
            'phone'=>'0785522585',
            'phone2'=>'0785522585',
            'facebook'=>'facebook',
            'instagram'=>'instagram',
            'telegram'=>'telegram',
            'whatsapp'=>'whatsapp',

        ]);

    }
}
