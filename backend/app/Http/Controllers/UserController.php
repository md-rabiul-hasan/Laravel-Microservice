<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function random(){
        $user = User::inRandomOrder()->first();

        $data = [
            "id" => $user->id
        ];
        return $data;
    }
}
