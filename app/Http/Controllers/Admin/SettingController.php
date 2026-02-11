<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\UpdateRequest;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $settings = Setting::firstOrFail();
        $data = $request->validated();

        // logos
        if ($request->hasFile('logo_dark')) {
            if (Storage::disk('public')->exists($settings->logo_dark)) {
                Storage::disk('public')->delete($settings->logo_dark);
            }
            $data['logo_dark'] = ImageService::uploadWithEncoding($request->file('logo_dark'), 'images/settings', format: 'webp');
        }

        if ($request->hasFile('logo_light')) {
            if (Storage::disk('public')->exists($settings->logo_light)) {
                Storage::disk('public')->delete($settings->logo_light);
            }
            $data['logo_light'] = ImageService::uploadWithEncoding($request->file('logo_light'), 'images/settings', format: 'webp');
        }

        // favicons
        if ($request->hasFile('favicon')) {
            if (Storage::disk('public')->exists($settings->favicon)) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $data['favicon'] = ImageService::uploadWithoutEncoding($request->file('favicon'), 'images/settings');
        }

        if ($request->hasFile('favicon32x32')) {
            if (Storage::disk('public')->exists($settings->favicon32x32)) {
                Storage::disk('public')->delete($settings->favicon32x32);
            }
            $data['favicon32x32'] = ImageService::uploadWithEncoding($request->file('favicon32x32'), 'images/settings', format: null);
        }

        if ($request->hasFile('favicon16x16')) {
            if (Storage::disk('public')->exists($settings->favicon16x16)) {
                Storage::disk('public')->delete($settings->favicon16x16);
            }
            $data['favicon16x16'] = ImageService::uploadWithEncoding($request->file('favicon16x16'), 'images/settings', format: null);
        }

        if ($request->hasFile('apple_touch_icon')) {
            if (Storage::disk('public')->exists($settings->apple_touch_icon)) {
                Storage::disk('public')->delete($settings->apple_touch_icon);
            }
            $data['apple_touch_icon'] = ImageService::uploadWithEncoding($request->file('apple_touch_icon'), 'images/settings', format: null);
        }

        if ($request->hasFile('mask_icon')) {
            if (Storage::disk('public')->exists($settings->mask_icon)) {
                Storage::disk('public')->delete($settings->mask_icon);
            }
            $data['mask_icon'] = ImageService::uploadWithoutEncoding($request->file('mask_icon'), 'images/settings');
        }

        try {
            $settings->update($data);
        } catch (\Exception $exception) {
            Log::error("Ayarlar kaydedilemedi: " . $exception->getMessage(), $exception->getTrace());
            return redirect()->back()->with('error', 'Ayarlar kaydedilemedi');
        }

        return redirect()->back()->with('success', 'Ayarlar başarıyla kaydedildi.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
