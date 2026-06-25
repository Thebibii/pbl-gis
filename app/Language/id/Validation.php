<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// Validation language strings
return [
    // Core Messages
    'noRuleSets'            => 'Tidak ada set aturan yang ditentukan dalam konfigurasi Validasi.',
    'foreignKey'            => 'Nilai {field} tidak valid.',
    'field_exists'          => 'Kolom {field} tidak ditemukan.',

    // Rule Messages
    'alpha'                 => 'Kolom {field} hanya boleh berisi karakter alfabet.',
    'alpha_dash'            => 'Kolom {field} hanya boleh berisi karakter alfanumerik, garis bawah, dan tanda hubung.',
    'alpha_numeric'         => 'Kolom {field} hanya boleh berisi karakter alfanumerik.',
    'alpha_numeric_punct'   => 'Kolom {field} hanya boleh berisi karakter alfanumerik, spasi, dan karakter ~ ! # $ % & * _ - + = | : .',
    'alpha_space'           => 'Kolom {field} hanya boleh berisi karakter alfabet dan spasi.',
    'any_in_list'           => 'Kolom {field} harus berupa salah satu dari nilai yang terdaftar: {param}.',
    'decimal'               => 'Kolom {field} harus berisi angka desimal.',
    'differs'               => 'Kolom {field} harus berbeda dari kolom {param}.',
    'equals'                => 'Kolom {field} harus sama persis dengan nilai {param}.',
    'exact_length'          => 'Kolom {field} harus tepat sepanjang {param} karakter.',
    'greater_than'          => 'Kolom {field} harus berisi angka yang lebih besar dari {param}.',
    'greater_than_equal_to' => 'Kolom {field} harus berisi angka yang lebih besar atau sama dengan {param}.',
    'hex'                   => 'Kolom {field} hanya boleh berisi karakter heksadesimal.',
    'in_list'               => 'Kolom {field} harus berupa salah satu dari nilai yang terdaftar: {param}.',
    'integer'               => 'Kolom {field} harus berisi bilangan bulat.',
    'is_not_unique'         => 'Kolom {field} harus berisi nilai yang sudah ada di database.',
    'is_numeric'            => 'Kolom {field} hanya boleh berisi karakter numerik.',
    'is_unique'             => 'Kolom {field} harus berisi nilai yang unik (belum pernah digunakan).',
    'less_than'             => 'Kolom {field} harus berisi angka yang kurang dari {param}.',
    'less_than_equal_to'    => 'Kolom {field} harus berisi angka yang kurang atau sama dengan {param}.',
    'matches'               => 'Kolom {field} tidak cocok dengan kolom {param}.', // Berguna untuk konfirmasi password
    'max_length'            => 'Kolom {field} tidak boleh melebihi {param} karakter.',
    'min_length'            => 'Kolom {field} minimal harus terdiri dari {param} karakter.',
    'not_equals'            => 'Kolom {field} tidak boleh sama dengan nilai {param}.',
    'not_in_list'           => 'Kolom {field} tidak boleh berupa salah satu dari nilai yang terdaftar: {param}.',
    'numeric'               => 'Kolom {field} harus berisi angka.',
    'regex_match'           => 'Kolom {field} tidak sesuai dengan format yang benar.',
    'required'              => 'Kolom {field} wajib diisi.', // Paling sering dipakai di form login
    'required_with'         => 'Kolom {field} wajib diisi jika {param} ada.',
    'required_without'      => 'Kolom {field} wajib diisi jika {param} tidak ada.',
    'string'                => 'Kolom {field} harus berupa string yang valid.',
    'timezone'              => 'Kolom {field} harus berupa zona waktu yang valid.',
    'valid_base64'          => 'Kolom {field} harus berupa string base64 yang valid.',
    'valid_email'           => 'Kolom {field} harus berisi alamat email yang valid.', // Digunakan untuk input email login
    'valid_emails'          => 'Kolom {field} harus berisi semua alamat email yang valid.',
    'valid_ip'              => 'Kolom {field} harus berisi IP yang valid.',
    'valid_url'             => 'Kolom {field} harus berisi URL yang valid.',
    'valid_url_strict'      => 'Kolom {field} harus berisi URL resmi yang valid.',
    'valid_date'            => 'Kolom {field} harus berisi tanggal yang valid.',
    'valid_json'            => 'Kolom {field} harus berupa format JSON yang valid.',

    // Credit Cards
    'valid_cc_number'       => 'Kolom {field} tidak berisi nomor kartu kredit yang valid.',

    // Files
    'uploaded'              => 'Kolom {field} bukan berkas unggahan yang valid.',
    'max_size'              => 'Kolom {field} terlalu besar, ukuran berkas maksimal adalah {param}.',
    'is_image'              => 'Kolom {field} bukan berkas gambar yang valid.',
    'mime_in'               => 'Kolom {field} tidak memiliki tipe mime yang valid: {param}.',
    'ext_in'                => 'Kolom {field} tidak memiliki ekstensi berkas yang valid: {param}.',
    'max_dims'              => 'Kolom {field} bukan gambar yang valid, atau dimensinya terlalu lebar/tinggi.',
];
