<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $whatsappNumber = Setting::getValue('whatsapp_number', '6281234567890');

        return view('settings.index', compact('whatsappNumber'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => 'required|string|max:20',
        ]);

        // Hapus spasi/tanda baca dan ubah awalan 0 menjadi 62
        $cleanNumber = preg_replace('/[^0-9]/', '', $request->whatsapp_number);
        if (str_starts_with($cleanNumber, '0')) {
            $cleanNumber = '62' . substr($cleanNumber, 1);
        }

        Setting::setValue('whatsapp_number', $cleanNumber);

        return back()->with('success', 'Nomor WhatsApp resmi berhasil diperbarui!');
    }
}