# TODO AquaKu - Fix Gambar

## Rencana perbaikan (tanpa ubah desain / struktur folder)

1. Pastikan file CSS terbaca dan tidak kosong (cek `assets/style.css`).
2. Normalisasi path gambar di `assets/admin/idex.php`:
   - Ubah `src` hero dan kartu ikan menjadi path yang pasti relatif dari lokasi file.
   - Pastikan semua mengarah ke `assets/images/`.
3. Normalisasi path pada halaman admin yang menampilkan gambar (cek `dashboard.php`), agar konsisten.
4. Tangani kasus nama file dari database yang tidak cocok (huruf besar/kecil dan .jpg/.jpeg):
   - Tanpa mengubah database, tambahkan mekanisme fallback yang mencoba beberapa variasi nama file sebelum menganggap rusak.
5. Jalankan reload dan verifikasi:
   - Hero tampil
   - 5 foto ikan tampil
   - Tidak ada icon rusak
   - Tidak ada error console

