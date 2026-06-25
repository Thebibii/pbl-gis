<?php

namespace App\Database\Seeds;

use App\Models\KelurahanModel;
use CodeIgniter\Database\Seeder;

class KelurahanSeeder extends Seeder
{
    public function run()
    {
        $model = new KelurahanModel();

        $data = [
            // 1. X Koto (9 Nagari)
            [1, 'Koto Baru', '1304012001'],
            [1, 'Koto Laweh', '1304012002'],
            [1, 'Paninjauan', '1304012003'],
            [1, 'Pandai Sikek', '1304012004'],
            [1, 'Panyalaian', '1304012005'],
            [1, 'Jaho', '1304012006'],
            [1, 'Aie Angek', '1304012007'],
            [1, 'Singgalang', '1304012008'],
            [1, 'Tambangan', '1304012009'],

            // 2. Batipuh (8 Nagari)
            [2, 'Batipuah Baruah', '1304022001'],
            [2, 'Andaleh', '1304022002'],
            [2, 'Pitalah', '1304022003'],
            [2, 'Gunuang Rajo', '1304022004'],
            [2, 'Sabu', '1304022005'],
            [2, 'Batipuah Ateh', '1304022006'],
            [2, 'Bungo Tanjuang', '1304022007'],
            [2, 'Tanjuang Barulak', '1304022008'],

            // 3. Batipuh Selatan (4 Nagari)
            [3, 'Sumpur', '1304142001'],
            [3, 'Batu Taba', '1304142002'],
            [3, 'Padang Laweh Malalo', '1304142003'],
            [3, 'Guguak Malalo', '1304142004'],

            // 4. Lima Kaum (5 Nagari)
            [4, 'Labuh', '1304042001'],
            [4, 'Cubadak', '1304042002'],
            [4, 'Parambahan', '1304042003'],
            [4, 'Baringin', '1304042004'],
            [4, 'Limo Kaum', '1304042005'],

            // 5. Lintau Buo (4 Nagari)
            [5, 'Taluak', '1304062001'],
            [5, 'Buo', '1304062002'],
            [5, 'Tigo Jangko', '1304062003'],
            [5, 'Pangian', '1304062004'],

            // 6. Lintau Buo Utara (5 Nagari)
            [6, 'Tanjuang Bonai', '1304132001'],
            [6, 'Batu Bulek', '1304132002'],
            [6, 'Balai Tangah', '1304132003'],
            [6, 'Lubuak Jantan', '1304132004'],
            [6, 'Tepi Selo', '1304132005'],

            // 7. Padang Ganting (2 Nagari)
            [7, 'Atar', '1304112001'],
            [7, 'Padang Ganting', '1304112002'],

            // 8. Pariangan (6 Nagari)
            [8, 'Sawah Tangah', '1304092001'],
            [8, 'Pariangan', '1304092002'],
            [8, 'Tabek', '1304092003'],
            [8, 'Batu Basa', '1304092004'],
            [8, 'Sungai Jambu', '1304092005'],
            [8, 'Simabur', '1304092006'],

            // 9. Rambatan (5 Nagari)
            [9, 'Rambatan', '1304032001'], // Kode Kemendagri 13.04.03
            [9, 'Balimbing', '1304032002'],
            [9, 'III Koto', '1304032003'],
            [9, 'Padang Magek', '1304032004'],
            [9, 'Simawang', '1304032005'],

            // 10. Salimpaung (6 Nagari)
            [10, 'Salimpaung', '1304102001'],
            [10, 'Tabek Patah', '1304102002'],
            [10, 'Situmbuk', '1304102003'],
            [10, 'Lawang Mandahiling', '1304102004'],
            [10, 'Sumanik', '1304102005'],
            [10, 'Supayang', '1304102006'],

            // 11. Sungai Tarab (10 Nagari)
            [11, 'Rao Rao', '1304082001'],
            [11, 'Sungai Tarab', '1304082002'],
            [11, 'Pasie Laweh', '1304082003'],
            [11, 'Kumango', '1304082004'],
            [11, 'Koto Tuo', '1304082005'],
            [11, 'Talang Tangah', '1304082006'],
            [11, 'Koto Baru', '1304082007'],
            [11, 'Gurun', '1304082008'],
            [11, 'Padang Laweh', '1304082009'],
            [11, 'Simpuruik', '1304082010'],

            // 12. Sungayang (5 Nagari)
            [12, 'Sungayang', '1304072001'],
            [12, 'Andaleh Baruh Bukik', '1304072002'],
            [12, 'Tano Tanjuang', '1304072003'],
            [12, 'Minangkabau', '1304072004'],
            [12, 'Sungai Patai', '1304072005'],

            // 13. Tanjuang Baru (2 Nagari)
            [13, 'Barulak', '1304122001'],
            [13, 'Tanjuang Alam', '1304122002'],

            // 14. Tanjung Emas (4 Nagari)
            [14, 'Saruaso', '1304052001'], // Kode Kemendagri 13.04.05
            [14, 'Koto Tangah', '1304052002'],
            [14, 'Pagaruyung', '1304052003'],
            [14, 'Tanjuang Barulak', '1304052004'],
        ];

        foreach ($data as $item) {
            $model->insert([
                'kecamatan_id'   => $item[0],
                'nama_kelurahan' => $item[1],
                'kode_kelurahan' => $item[2],
            ]);
        }
    }
}
