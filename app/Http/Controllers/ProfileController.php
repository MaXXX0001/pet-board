<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;

class ProfileController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(Request $request)
    {
        $userid = auth()->user()->id;

        $user = User::where('id', '=', $userid)->first();

        $pets = $user->getPets();

        return view('user.profile',
        [
            'user' => $user,
            'pets' => $pets

        ]);
    }
}
