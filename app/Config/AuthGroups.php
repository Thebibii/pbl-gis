<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin'       => ['title' => 'Super Admin',      'description' => 'Akses penuh'],
        'operator_dinas'   => ['title' => 'Operator Dinas',   'description' => 'Kelola semua sekolah'],
        'operator_sekolah' => ['title' => 'Operator Sekolah', 'description' => 'Kelola sekolah sendiri'],

    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'sekolah.create'   => 'Tambah sekolah baru',
        'sekolah.editAll'  => 'Edit semua sekolah',
        'sekolah.editOwn'  => 'Edit sekolah sendiri',
        'sekolah.delete'   => 'Hapus/nonaktifkan sekolah',
        'sekolah.import'   => 'Import data via Excel',
        'sekolah.export'   => 'Export data ke Excel',
        'wilayah.manage'   => 'Kelola kecamatan & nagari',
        'fasilitas.manage' => 'Kelola jenis fasilitas master',
        'users.manage'     => 'Kelola akun pengguna',
        'log.view'         => 'Lihat activity & import log',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'sekolah.create',
            'sekolah.editAll',
            'sekolah.editOwn',
            'sekolah.delete',
            'sekolah.import',
            'sekolah.export',
            'wilayah.manage',
            'fasilitas.manage',
            'users.manage',
            'log.view',
        ],
        'operator_dinas' => [
            'sekolah.create',
            'sekolah.editAll',
            'sekolah.editOwn',
            'sekolah.import',
            'sekolah.export',
            'log.view',
        ],
        'operator_sekolah' => [
            'sekolah.editOwn',
            'sekolah.export',
        ],
    ];
}
