<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Sebastian";
        $user->surname = "Sangermano";
        $user->direccion = "Berutti 1258";
        $user->telefono = "402641";
        $user->celular = "3755309633";
        $user->email = "seba_sanger@hotmail.com";
        $user->role = "Admin";
        $user->created_at = Carbon::now();
        $user->email_verified_at = Carbon::now();
        $user->password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $user->remember_token = "esdersdras";

        $user->save();

        $user = new User();
        $user->name = "nora";
        $user->surname = "graziosetti";
        $user->direccion = "Berutti 1258";
        $user->telefono = "402641";
        $user->celular = "7878554";
        $user->email = "nora@hotmail.com";
        $user->role = "User";
        $user->created_at = Carbon::now();
        $user->email_verified_at = Carbon::now();
        $user->password = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $user->remember_token = "sdsersdras";

        $user->save();
    }
}
