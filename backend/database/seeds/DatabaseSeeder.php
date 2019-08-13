<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class, 15)->create()->first();
        $user->email = 'admin@mail.com';
        $user->password = bcrypt('supersecret');
        $user->save();
    }
}
