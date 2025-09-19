<?php

use App\Models\User;
use App\Models\Kelas;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class); //fungsinya Setiap test pakai transaksi/migrate fresh sehingga DB bersih.

beforeEach(function () {
    // Membuat user dengan email, password, dan role tertentu
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    $this->user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
    ]);

    //kasih role
    $this->user->assignRole('admin');

    // Login sebagai user tersebut
    $this->actingAs($this->user);
});

/**
 * INDEX
 */
it('menampilkan halaman index dengan data kelas terpaginasi', function () {
    Kelas::factory()->count(15)->create();

    $response = $this->get(route('kelas.index'));

    $response->assertOk()
        ->assertViewIs('adminPanel.pages.kelas.index')
        ->assertViewHas('kelas', function ($paginator) {
            // Default paginate(8) => perPage 8, total 15
            return $paginator->perPage() === 8 && $paginator->total() === 15;
        });
});

/**
 * STORE - berhasil
 */
it('menyimpan data kelas saat input valid dan melakukan logging', function () {
    Log::spy();

    $payload = ['nama_kelas' => 'Kelas Unggulan 1'];

    $response = $this->post(route('kelas.store'), $payload);

    $response->assertRedirect(); // redirect()->back()
    $this->assertDatabaseHas('kelas', $payload);

    Log::shouldHaveReceived('info')
        ->once()
        ->withArgs(function ($message, $context) use ($payload) {
            return str_contains($message, 'berhasil menambah data kelas')
                && $context['data'] === $payload
                && $context['created_by'] === $this->user->name;
        });
});

/**
 * STORE - gagal karena duplikat nama (validasi unique)
 */
it('gagal menyimpan jika nama_kelas sudah ada', function () {
    Kelas::factory()->create(['nama_kelas' => 'Kelas 7A']);

    $response = $this->from(route('kelas.index'))
        ->post(route('kelas.store'), ['nama_kelas' => 'Kelas 7A']);

    $response->assertRedirect(route('kelas.index'))
        ->assertSessionHasErrors(['nama_kelas']);

    // tidak ada duplikat baru
    $this->assertEquals(1, Kelas::where('nama_kelas', 'Kelas 7A')->count());
});

/**
 * UPDATE - berhasil (unique ignore id sendiri)
 */
it('mengupdate data kelas dan melewati unique untuk id sendiri', function () {
    Log::spy();

    $kelas = Kelas::factory()->create(['nama_kelas' => 'Kelas Lama']);
    $payload = ['nama_kelas' => 'Kelas Baru'];

    $response = $this->put(route('kelas.update', $kelas), $payload);

    $response->assertRedirect();
    $this->assertDatabaseHas('kelas', [
        'id' => $kelas->id,
        'nama_kelas' => 'Kelas Baru',
    ]);

    Log::shouldHaveReceived('info')
        ->once()
        ->withArgs(function ($message, $context) {
            return str_contains($message, 'berhasil mengupdate data')
                && $context['created_by'] === $this->user->name;
        });
});

/**
 * UPDATE - gagal karena menabrak nama existing milik record lain
 */
it('gagal update jika nama_kelas sudah dipakai kelas lain', function () {
    $a = Kelas::factory()->create(['nama_kelas' => 'Kelas A']);
    $b = Kelas::factory()->create(['nama_kelas' => 'Kelas B']);

    $response = $this->from(route('kelas.index'))
        ->put(route('kelas.update', $b), ['nama_kelas' => 'Kelas A']);

    $response->assertRedirect(route('kelas.index'))
        ->assertSessionHasErrors(['nama_kelas']);

    // pastikan b tidak berubah
    $this->assertDatabaseHas('kelas', ['id' => $b->id, 'nama_kelas' => 'Kelas B']);
});

/**
 * DESTROY
 */
it('menghapus data kelas dan melakukan redirect', function () {
    Log::spy();

    $kelas = Kelas::factory()->create();

    $response = $this->delete(route('kelas.destroy', $kelas));

    $response->assertRedirect();
    $this->assertDatabaseMissing('kelas', ['id' => $kelas->id]);

    Log::shouldHaveReceived('info')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, 'berhasil menghapus data kelas');
        });
});

/**
 * OPSIONAL: assert session toast (jika pakai realrashid/sweet-alert)
 * Perhatikan key-nya bisa berbeda tergantung versi; sesuaikan sendiri.
 */
it('opsional - session memiliki flash alert setelah store', function () {
    $response = $this->post(route('kelas.store'), ['nama_kelas' => 'Kelas C']);

    $response->assertRedirect();
    // Contoh umum:
    // $response->assertSessionHas('alert'); // atau 'alert.config' tergantung paket/versi
});
