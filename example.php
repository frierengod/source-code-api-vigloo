<?php
/**
 * Contoh Script Bridge API Vigloo via StreamAPI.web.id
 * ----------------------------------------------------
 * Wajib punya Token dulu dari: https://streamapi.web.id/register
 * Token dikirim lewat http header "api-token".
 */

// 1. Taruh API Token StreamAPI Web ID kamu di sini
$API_TOKEN = 'TOKEN_API_KAMU_DISINI';

// Fungsi bantuan buat manggil endpoint Vigloo di sistem Bridge
function callViglooAPI($urlTujuan, $token) {
    if ($token === 'TOKEN_API_KAMU_DISINI') {
        die("❌ Error Bro: Masukin Token StreamAPI kamu dulu di baris ke-10!\n");
    }

    echo "Sedang memuat data dari: {$urlTujuan}\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlTujuan);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Jangan lupa Token dimasukin ke dalam Header
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "api-token: {$token}",
        "Accept: application/json"
    ]);

    $response = curl_exec($ch);
    $kodeStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($kodeStatus !== 200) {
        echo "❌ Gagal Terhubung! Kode HTTP Server: {$kodeStatus}\n";
        echo "Pesan Error: {$response}\n";
        return null;
    }

    // Ubah string JSON mentah biar jadi Array PHP
    return json_decode($response, true);
}


// -----------------------------------------------------------------
// UJI COBA KODE
// -----------------------------------------------------------------
$baseUrl = "https://streamapi.web.id/p/vigloo/api/v1";

// Contoh 1: Fitur Cari Film Vigloo
echo "\n=====================[ 1. Pencarian Vigloo ]==================\n";
$kataKunci = urlencode("cinta");
$halaman = 1;
$urlCari = "{$baseUrl}/search/{$kataKunci}/{$halaman}?lang=in";

$hasilCari = callViglooAPI($urlCari, $API_TOKEN);
if ($hasilCari) {
    echo "✅ Sukses nemu drama dengan kata kunci 'cinta'\n";
    // echo print_r($hasilCari, true); // Hapus comment ini kalau mau leeat output raw-nya
}

// Contoh 2: Tarik Info Detail Drama
echo "\n=====================[ 2. Metadata Drama ]======================\n";
// Uji coba pakai ID Buku (bookId)
$bookIdFilm = "42000000722";
$urlDetail = "{$baseUrl}/detail/{$bookIdFilm}";

$hasilDetail = callViglooAPI($urlDetail, $API_TOKEN);
if ($hasilDetail) {
    echo "✅ Berhasil ambil metadata untuk film ID {$bookIdFilm}!\n";
}

// Contoh 3: Ambil Link Nonton / Episode
echo "\n=====================[ 3. Link Nonton Episode ]=================\n";
$episodeId = "1";
$urlNonton = "{$baseUrl}/watch/{$bookIdFilm}/{$episodeId}?lang=in";

$hasilNonton = callViglooAPI($urlNonton, $API_TOKEN);
if ($hasilNonton) {
    echo "✅ Sukses manggil endpoint 'watch' (nonton)!\n";
    // Data sukses, tinggal bongkar struktur JSON nya buat ambil Link Video / Subtitlenya
}

echo "\n================================================================\n";
echo "Mau liat lebih banyak route/endpoint yang tersedia?\nKunjungi Dokumentasi Interaktif Kami:\n";
echo "▶▶▶ https://streamapi.web.id/docs/vigloo ◀◀◀\n\n";

?>