<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin\Privacy;
use App\Models\Admin\Settings;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;
class DatabaseSeeder extends Seeder
{






    public function run(): void
    {
        //permisions
        $this->call(RolePermissionSeeder::class);




        //Settings
        $setting = Settings::create([

        ]);
        $setting->translateOrNew('az')->name = 'site name';
        $setting->translateOrNew('en')->name = 'site name';
        $setting->translateOrNew('ru')->name = 'site name';

        $setting->save();

        //Privacy
        $privacy = Privacy::create([

        ]);
        $privacy->translateOrNew('az')->text = 'policy and privacy az';
        $privacy->translateOrNew('en')->text = 'policy and privacy en';
        $privacy->translateOrNew('ru')->text = 'policy and privacy ru';

        $privacy->save();
//         \App\Models\User::factory(10)->create();
        $role='Super Admin';
         $user=\App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@gmail.com',
             'status'=>1,
             'password'=>bcrypt('admin'),
         ]);
        $user->assignRole($role);
    }
}
