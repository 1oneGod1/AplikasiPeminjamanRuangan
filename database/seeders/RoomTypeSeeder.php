<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'laboratorium',
                'label' => 'Laboratorium',
                'description' => 'Ruangan untuk praktikum dan eksperimen',
                'is_active' => true,
            ],
            [
                'name' => 'ruang_musik',
                'label' => 'Ruang Musik',
                'description' => 'Ruangan untuk kegiatan musik dan seni suara',
                'is_active' => true,
            ],
            [
                'name' => 'audio_visual',
                'label' => 'Audio Visual',
                'description' => 'Ruangan dengan fasilitas multimedia',
                'is_active' => true,
            ],
            [
                'name' => 'lapangan_basket',
                'label' => 'Lapangan Basket',
                'description' => 'Lapangan olahraga basket',
                'is_active' => true,
            ],
            [
                'name' => 'kolam_renang',
                'label' => 'Kolam Renang',
                'description' => 'Fasilitas kolam renang',
                'is_active' => true,
            ],
        ];

        foreach ($roomTypes as $type) {
            RoomType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
