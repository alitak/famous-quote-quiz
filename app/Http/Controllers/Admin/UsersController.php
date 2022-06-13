<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\View;
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

    public function update(UserRequest $request, User $user): Redirector
    {
        $user->update($request->validated());

        flash('Successfully stored!');

        return redirect(route('admin.users.index'));
    }

    public function destroy($id): Redirector
    {
        User::query()->where('id', $id)->delete();

        flash('Successfully deleted!');

        return redirect(route('admin.users.index'));
    }
}
