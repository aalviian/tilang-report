<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new App\User;
        $user->name = "Guntur";
        $user->email = "guntur@gmail.com";
        $user->password = bcrypt("secret");
        $user->save();
        $this->command->info("Berhasil menambahkan akun Guntur ke database User");
    }
}
