<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Tentang Kami
            [
                'key' => 'tentang_kami_title',
                'value' => 'Tentang Agrowisata Kami',
                'type' => 'text',
                'group' => 'tentang_kami',
            ],
            [
                'key' => 'tentang_kami_description',
                'value' => 'Agrowisata Dadi Raharja Bumkal Margodadi adalah wisata yang didirikan dengan memanfaatkan lahan milik Bumi Kalurahan (Bumkal) dan menggali potensi sumber daya di sekitar. Agrowisata ini berfokus pada 3 bidang yakni Agrowisata, Usaha Mikro Kecil dan Menengah (UMKM), serta Perkebunan, Pertanian, Perikanan, dan lain-lain.',
                'type' => 'textarea',
                'group' => 'tentang_kami',
            ],
            
            // Kontak
            [
                'key' => 'kontak_contacts',
                'value' => json_encode([
                    ['phone' => '+62 123 4567 890', 'name' => '']
                ]),
                'type' => 'text',
                'group' => 'kontak',
            ],
            [
                'key' => 'kontak_email',
                'value' => 'info@agrowisata.com',
                'type' => 'text',
                'group' => 'kontak',
            ],
            [
                'key' => 'kontak_address',
                'value' => 'Kel. Margodadi, Kec. Seyegan, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55561',
                'type' => 'textarea',
                'group' => 'kontak',
            ],
            [
                'key' => 'kontak_maps_embed',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5!2d107.123!3d-6.789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNDcnMjAuNCJTIDEwN8KwMDcnMjIuOCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'type' => 'textarea',
                'group' => 'kontak',
            ],
            [
                'key' => 'kontak_facebook',
                'value' => '',
                'type' => 'text',
                'group' => 'kontak',
            ],
            [
                'key' => 'kontak_instagram',
                'value' => '',
                'type' => 'text',
                'group' => 'kontak',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Settings berhasil dibuat/diupdate');
    }
}
