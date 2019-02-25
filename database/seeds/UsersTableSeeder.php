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
            'name' => 'ILO',
            'email' => 'admin@gmail.com',
            'img' => 'user.png',
            'userId' => '111111',
            'flag' => '0',
            'password' => bcrypt('secret'),
        ]);

        $user = User::all()->first();
        
        $user->assignRole('admin');

        $users = factory(App\User::class, 1000)
                    ->create()
                    ->each(function ($user) {
                $user->arrival()->save(factory(App\Arrival::class)->make());
            });

    }
}
