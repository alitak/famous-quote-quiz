<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UsersController extends Controller
{

    public function index(): View
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update(UserRequest $request, User $user): Redirector|RedirectResponse
    {
        $user->update($request->validated());

        flash('Successfully stored!');

        return redirect(route('admin.users.index'));
    }

    public function destroy($id): Redirector|RedirectResponse
    {
        User::query()->where('id', $id)->delete();

        flash('Successfully deleted!');

        return redirect(route('admin.users.index'));
    }
}
