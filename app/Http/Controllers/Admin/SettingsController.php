<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.settings.index', ['settings' => Setting::all()]);
    }

    public function edit(Setting $setting): View
    {
        return view('admin.settings.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, Setting $setting): Redirector
    {
        $setting->update($request->validated());

        flash('Successfully stored!');

        return redirect(route('admin.settings.index'));
    }
}
