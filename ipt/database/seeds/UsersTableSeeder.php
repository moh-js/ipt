<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('users')->delete();

        DB::table('users')->insert([
            'name' => 'Mohamed Said',
            'email' => 'admin@gmail.com',
            'img' => 'user.png',
            'userId' => '201611039',
            'flag' => '1',
            'password' => bcrypt('secret'),
        ]);

        $user = User::all()->first();
        
        $user->assignRole('admin');

        $users = factory(App\User::class, 200)
                    ->create()
                    ->each(function ($user) {
                $user->arrival()->save(factory(App\Arrival::class)->make());
            });

    }
}
