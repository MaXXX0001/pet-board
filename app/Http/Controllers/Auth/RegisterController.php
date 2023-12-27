<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Retrieve the index view for the registration page.
     *
     * @return View The index view.
     */
    public function index(): View
    {
        return view('register.index');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */

    /**
     * Store a new user in the database.
     *
     * @param RegisterRequest $request The request object containing the registration data.
     * @return RedirectResponse The redirect response to the home route with a success message.
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);

            return redirect()->route('home')->with('success', 'Ви успішно зареєстровані!');

    }
}
