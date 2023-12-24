<?php

namespace App\Http\Controllers\Auth;

use App\Domains\Users\Actions\UserActionCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequestCreate;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    public function store(UserRequestCreate $request): RedirectResponse
    {
        $user = UserActionCreate::make($request->validated())->execute();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
