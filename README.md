# Vigloo API Wrapper (PHP) 🎬

Script PHP sederhana, super cepat, dan stabil untuk integrasi ke **API Aplikasi Vigloo**. Sekarang kamu bisa memanggil data film pendek, daftar episode, ranking, dan pencarian video langsung dari aplikasi atau website PHP kamu tanpa ribet!

Repository ini adalah contoh cara menyambungkan aplikasimu ke API Vigloo dengan menggunakan layanan dari [**StreamAPI**](https://streamapi.web.id), sang *Bridge API* andalan khusus buat platform video streaming.

---

## ⚡ Fitur Utama

- **Kecepatan Ngebut**: StreamAPI menggunakan sistem proxy yang dioptimasi agar respon server tidak delay.
- **Selalu Online**: Gak perlu takut API mati. Tersedia mekanisme anti-lelet dan endpoint stabil.
- **Integrasi Gampang Banget**: Lupakan auth token yang ribet dan enkripsi aneh-aneh dari Vigloo. Tinggal panggil URL REST API aja bareng Token kamu.
- **Endpoint Lengkap**: Mulai dari data *For You*, *Rilisan Terbaru*, *Ranking Populer*, *Kategori*, sampai metadata *Detail Nonton* semuanya ready.

## 🚀 Cara Mulai Instalasi

### 1. Dapatkan Token API Kamu
Agar bisa menggunakan bridge StreamAPI, kamu wajib punya **API Token** pribadi. Prosesnya gratis dan cepat kok.
1. Kunjungi [streamapi.web.id/register](https://streamapi.web.id/register) dan buat akun.
2. Buka halaman **Dashboard**.
3. Copy kode `api-token` milikmu di bagian bawah layar.

### 2. Jalankan Code Example ini
Download atau *clone* repository ini, lalu tes langsung script contohnya (`example.php`) di server lokal kamu.

```bash
git clone https://github.com/username-kamu/vigloo-api-php.git
cd vigloo-api-php
php example.php
```

## 📖 Daftar Endpoint (Vigloo)

Berikut adalah beberapa endpoint favorit yang sudah di-mapping oleh StreamAPI:

| **Method** | **Struktur Endpoint** | **Kegunaan** |
|:---:|---|---|
| GET | `/p/vigloo/api/v1/foryou/{page}` | Ambil data drama *For You* yang lagi tren |
| GET | `/p/vigloo/api/v1/new/{page}` | Tarik kumpulan list drama baru rilis |
| GET | `/p/vigloo/api/v1/search/{keyword}/{page}` | Fitur pencarian judul & artis global |
| GET | `/p/vigloo/api/v1/detail/{bookId}` | Lihat metadata, sinopsis, & cover drama |
| GET | `/p/vigloo/api/v1/watch/{bookId}/{chapterId}` | Dapetin URL video/trailer/episode spesifik |

Ingin coba langsung di browser tanpa koding? Mampir aja ke fitur **[Sandbox Interaktif Vigloo](https://streamapi.web.id/docs/vigloo)** kami.

---

## 💻 Contoh Kodingan PHP (REST / cURL)

Buka file `example.php` di repo ini, atau gunakan kerangka kode simpel berikut kalau kamu pakai PHP Native/Laravel:

```php
<?php
$token = "TOKEN_STREAMAPI_KAMU_DISINI";
$bookId = "42000000722";
$chapterId = "1";

$url = "https://streamapi.web.id/p/vigloo/api/v1/watch/{$bookId}/{$chapterId}";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "api-token: {$token}",
    "Accept: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

echo "Respons Data dari API Vigloo:\n" . $response;
?>
```

## 🤝 Layanan & Support
Ini adalah contoh integrasi *Unofficial* memakai bridge sistem API Premium kami. Butuh bantuan teknis atau request API platform streaming lain yang belum ada?
- **Telegram Admin**: [@frierengod](https://t.me/frierengod)
- **Website Utama**: [streamapi.web.id](https://streamapi.web.id)
