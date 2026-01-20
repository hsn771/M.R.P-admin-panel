<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeaderLogoController extends Controller
{
    public function index(): View
    {
        $setting = Setting::first();

        return view('admin.header-logos.index', compact('setting'));
    }

    public function edit(): View
    {
        $setting = Setting::first();

        return view('admin.header-logos.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name_eng' => ['required', 'string', 'max:255'],
            'name_bn' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'logo_footer' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:2048'],
            'logo_header' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp,svg', 'max:2048'],
            'contact_page_title' => ['required', 'string', 'max:255'],
            'contact_page_description' => ['required', 'string'],
            'contact_page_subtitle' => ['required', 'string', 'max:255'],
            'footer_description' => ['nullable', 'string'],
        ]);
    
        $setting = Setting::first();
    
        /* =========================
           Handle Footer Logo
        ========================== */
        if ($request->hasFile('logo_footer')) {
    
            // Delete old footer logo
            if ($setting && $setting->logo_footer && file_exists(public_path('storage/'.$setting->logo_footer))) {
                unlink(public_path('storage/'.$setting->logo_footer));
            }
    
            $image = $request->file('logo_footer');
            $imageName = 'footer_' . time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('storage/settings');
    
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
    
            $image->move($destination, $imageName);
            $data['logo_footer'] = 'settings/' . $imageName;
        } else {
            unset($data['logo_footer']);
        }
    
        /* =========================
           Handle Header Logo
        ========================== */
        if ($request->hasFile('logo_header')) {
    
            // Delete old header logo
            if ($setting && $setting->logo_header && file_exists(public_path('storage/'.$setting->logo_header))) {
                unlink(public_path('storage/'.$setting->logo_header));
            }
    
            $image = $request->file('logo_header');
            $imageName = 'header_' . time() . '.' . $image->getClientOriginalExtension();
            $destination = public_path('storage/settings');
    
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
    
            $image->move($destination, $imageName);
            $data['logo_header'] = 'settings/' . $imageName;
        } else {
            unset($data['logo_header']);
        }
    
        /* =========================
           Save Settings
        ========================== */
        if ($setting) {
            $setting->update($data);
        } else {
            Setting::create($data);
        }
    
        return redirect()
            ->route('admin.header-logos.index')
            ->with('status', 'Settings updated successfully.');
    }

}
