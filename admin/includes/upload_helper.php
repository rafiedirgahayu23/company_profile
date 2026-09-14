<?php
/**
 * Fungsi Helper: Upload Gambar
 * Dipakai bersama oleh modul Produk, Artikel, dan Galeri
 * supaya logic upload tidak ditulis berulang-ulang (menghindari duplikasi kode).
 *
 * @param array  $file        Data dari $_FILES['nama_input']
 * @param string $prefix      Prefix nama file, contoh: 'produk', 'artikel', 'galeri'
 * @return array ['sukses' => bool, 'nama_file' => string|null, 'pesan' => string]
 */
function uploadGambar($file, $prefix = 'img')
{
    $folder_tujuan = __DIR__ . '/../../assets/img/';
    $tipe_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];
    $maks_ukuran_mb = 9;

    // Tidak ada file dipilih (misal saat edit dan gambar tidak diganti)
    if (!isset($file) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['sukses' => false, 'nama_file' => null, 'pesan' => 'no_file'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['sukses' => false, 'nama_file' => null, 'pesan' => 'Terjadi kesalahan saat upload file.'];
    }

    $ekstensi = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ekstensi, $tipe_diizinkan)) {
        return ['sukses' => false, 'nama_file' => null, 'pesan' => 'Format file harus JPG, PNG, atau WEBP.'];
    }

    if ($file['size'] > $maks_ukuran_mb * 1024 * 1024) {
        return ['sukses' => false, 'nama_file' => null, 'pesan' => "Ukuran file maksimal {$maks_ukuran_mb}MB."];
    }

    // Buat nama file unik supaya tidak bentrok dengan file lain
    $nama_file_baru = $prefix . '-' . time() . '-' . uniqid() . '.' . $ekstensi;
    $path_tujuan = $folder_tujuan . $nama_file_baru;

    if (!move_uploaded_file($file['tmp_name'], $path_tujuan)) {
        return ['sukses' => false, 'nama_file' => null, 'pesan' => 'Gagal menyimpan file ke server.'];
    }

    return ['sukses' => true, 'nama_file' => $nama_file_baru, 'pesan' => 'Upload berhasil.'];
}

/**
 * Fungsi Helper: Hapus file gambar lama dari folder assets/img
 * Dipanggil saat data dihapus atau gambar diganti dengan yang baru.
 */
function hapusGambarLama($nama_file)
{
    $path = __DIR__ . '/../../assets/img/' . $nama_file;
    if ($nama_file && file_exists($path)) {
        unlink($path);
    }
}
