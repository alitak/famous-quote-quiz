<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index', ['settings' => Setting::all()]);
    }

    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        flash('Successfully stored!');

        return redirect(route('admin.settings.index'));
    }
}
