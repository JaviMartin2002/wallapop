<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Sale, Setting, Image};

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate(['maxFiles' => 'required|integer|min:1']);
        $setting->update($request->only('maxFiles'));
        return back()->with('success', 'Settings updated successfully!');
    }
}
