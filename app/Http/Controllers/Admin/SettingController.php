<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class SettingController extends Controller
{
    public function tentangKami()
    {
        return view('admin.settings.tentang-kami');
    }

    public function updateTentangKami(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        Setting::set('tentang_kami_title', $request->title, 'text', 'tentang_kami');
        Setting::set('tentang_kami_description', $request->description, 'textarea', 'tentang_kami');

        if ($request->hasFile('image')) {
            // Delete old image files if exists
            $oldImage = Setting::get('tentang_kami_image');
            $oldThumb = Setting::get('tentang_kami_image_thumb');
            
            if ($oldImage && file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
            if ($oldThumb && file_exists(public_path($oldThumb))) {
                unlink(public_path($oldThumb));
            }

            $imageFile = $request->file('image');
            $filename = time() . '_' . str_replace(' ', '_', $imageFile->getClientOriginalName());
            
            // Create directory if not exists
            if (!file_exists(public_path('uploads/tentang-kami'))) {
                mkdir(public_path('uploads/tentang-kami'), 0755, true);
            }
            
            // Save optimized full image (max 1200px width, 85% quality)
            $fullImage = Image::read($imageFile)
                ->scale(width: 1200)
                ->toJpeg(quality: 85);
            
            $fullPath = public_path('uploads/tentang-kami/' . $filename);
            file_put_contents($fullPath, $fullImage);
            
            // Save tiny thumbnail for blur placeholder (50px width, 60% quality)
            $thumbImage = Image::read($imageFile)
                ->scale(width: 50)
                ->toJpeg(quality: 60);
            
            $thumbPath = public_path('uploads/tentang-kami/thumb_' . $filename);
            file_put_contents($thumbPath, $thumbImage);

            Setting::set('tentang_kami_image', 'uploads/tentang-kami/' . $filename, 'image', 'tentang_kami');
            Setting::set('tentang_kami_image_thumb', 'uploads/tentang-kami/thumb_' . $filename, 'image', 'tentang_kami');
        }

        return redirect()->back()->with('success', 'Tentang Kami berhasil diupdate!');
    }

    public function kontak()
    {
        return view('admin.settings.kontak');
    }

    public function updateKontak(Request $request)
    {
        $request->validate([
            'contacts.*.phone' => 'required|string|max:20',
            'contacts.*.name' => 'nullable|string|max:100',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        // Store contacts as JSON
        Setting::set('kontak_contacts', json_encode($request->contacts ?? []), 'text', 'kontak');
        Setting::set('kontak_email', $request->email, 'text', 'kontak');
        Setting::set('kontak_address', $request->address, 'textarea', 'kontak');
        Setting::set('kontak_facebook', $request->facebook, 'text', 'kontak');
        Setting::set('kontak_instagram', $request->instagram, 'text', 'kontak');

        return redirect()->back()->with('success', 'Kontak berhasil diupdate!');
    }
}
