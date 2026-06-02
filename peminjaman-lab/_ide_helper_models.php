<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaksi> $transaksis
 * @property-read int|null $transaksis_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property string|null $deskripsi
 * @property int $stok_total
 * @property int $stok_tersedia
 * @property int $id_kondisi_barang
 * @property string|null $lokasi
 * @property int $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\KondisiBarang $kondisi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereIdKondisiBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereLokasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereStokTersedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereStokTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Barang whereUpdatedBy($value)
 */
	class Barang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Barang|null $barang
 * @property-read \App\Models\Transaksi|null $transaksi
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailPeminjaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailPeminjaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DetailPeminjaman query()
 */
	class DetailPeminjaman extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Barang> $barangs
 * @property-read int|null $barangs_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|KondisiBarang whereUpdatedAt($value)
 */
	class KondisiBarang extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $id_barang
 * @property int $id_user
 * @property string $nim
 * @property string $nama
 * @property string $no_hp
 * @property int $id_status_mahasiswa
 * @property int $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Barang $barang
 * @property-read \App\Models\StatusMahasiswa $statusMahasiswa
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereIdBarang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereIdStatusMahasiswa($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereIdUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Peminjam whereUpdatedBy($value)
 */
	class Peminjam extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Peminjam> $peminjams
 * @property-read int|null $peminjams_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusMahasiswa whereUpdatedAt($value)
 */
	class StatusMahasiswa extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nama
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaksi> $transaksis
 * @property-read int|null $transaksis_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StatusPeminjam whereUpdatedAt($value)
 */
	class StatusPeminjam extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $id_peminjam
 * @property int $id_status
 * @property string $tanggal_dipinjam
 * @property string $tanggal_dikembalikan
 * @property int $created_by
 * @property int|null $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Peminjam $peminjam
 * @property-read \App\Models\Peminjam $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereIdPeminjam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereIdStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereTanggalDikembalikan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereTanggalDipinjam($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Transaksi whereUpdatedBy($value)
 */
	class Transaksi extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $nim
 * @property string $no_hp
 * @property int $id_role
 * @property string|null $remember_token
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Role $role
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNim($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

