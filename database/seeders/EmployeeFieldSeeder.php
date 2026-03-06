<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeField;

class EmployeeFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'key' => 'ukuran_baju',
                'label' => 'Ukuran Baju',
                'type' => 'select',
                'required' => false,
                'options' => ['S','M','L','XL','XXL'],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'key' => 'bpjs_kesehatan',
                'label' => 'Nomor BPJS Kesehatan',
                'type' => 'text',
                'required' => false,
                'options' => null,
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'key' => 'nama_kontak_darurat',
                'label' => 'Nama Kontak Darurat',
                'type' => 'text',
                'required' => false,
                'options' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'key' => 'hubungan_kontak_darurat',
                'label' => 'Hubungan Kontak Darurat',
                'type' => 'radio',
                'required' => false,
                'options' => ['Orang Tua','Suami/Istri','Saudara','Teman'],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'key' => 'catatan_tambahan',
                'label' => 'Catatan Tambahan',
                'type' => 'textarea',
                'required' => false,
                'options' => null,
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($fields as $f) {
            EmployeeField::updateOrCreate(['key' => $f['key']], $f);
        }
    }
}