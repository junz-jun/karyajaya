# Pengujian Black Box - Sistem Pakar Diagnosa Penyakit Kakao (Karya Jaya)

Dokumen ini berisi tabel pengujian black box untuk memastikan seluruh fitur pada sistem pakar berjalan sesuai dengan fungsinya.

| No | Kasus/Fitur yang Diuji | Deskripsi | Hasil yang Diharapkan | Hasil Pengujian | Kesimpulan |
|----|------------------------|-----------|-----------------------|-----------------|------------|
| 1 | **Login Admin** | Melakukan login ke dashboard admin dengan username dan password yang benar. | Sistem berhasil memvalidasi akun dan mengalihkan ke dashboard admin. | Admin diarahkan ke halaman `admin/index.php`. | Berhasil |
| 2 | **Login Admin (Gagal)** | Melakukan login dengan kredensial yang salah. | Sistem menampilkan pesan error dan tetap berada di halaman login. | Muncul notifikasi "Username atau Password salah!" | Berhasil |
| 3 | **Data Penyakit (Tambah)** | Menginput data penyakit baru (kode, nama, deskripsi, solusi, pencegahan). | Sistem mampu menyimpan data penyakit baru ke dalam database. | Data penyakit baru muncul di tabel daftar penyakit. | Berhasil |
| 4 | **Data Penyakit (Ubah)** | Memperbarui informasi pada data penyakit yang sudah ada. | Sistem berhasil memperbarui data di database dan menampilkan perubahan di tabel. | Perubahan data (misal: nama atau deskripsi) tersimpan dengan benar. | Berhasil |
| 5 | **Data Penyakit (Hapus)** | Menghapus salah satu data penyakit dari sistem. | Sistem berhasil menghapus data dari database setelah konfirmasi. | Data terhapus dan tidak lagi muncul di tabel. | Berhasil |
| 6 | **Data Gejala (Tambah)** | Menginput data gejala baru beserta kategori anatominya (Batang/Daun/Buah). | Sistem menyimpan gejala baru dan mengelompokkannya sesuai kategori. | Gejala baru muncul di daftar gejala admin dan form diagnosa. | Berhasil |
| 7 | **Data Gejala (Ubah)** | Mengubah detail gejala (kode, nama, atau kategori). | Sistem memperbarui data gejala dengan informasi terbaru. | Informasi gejala diperbarui di seluruh sistem. | Berhasil |
| 8 | **Data Gejala (Hapus)** | Menghapus data gejala dari sistem. | Sistem menghapus data gejala dan aturan yang terkait dengannya. | Data gejala hilang dari tabel daftar gejala. | Berhasil |
| 9 | **Basis Aturan (Kelola)** | Menentukan nilai CF Pakar untuk hubungan antara penyakit dan gejala. | Sistem mampu menyimpan bobot keyakinan pakar untuk diagnosa. | Nilai CF tersimpan dan digunakan dalam perhitungan diagnosa. | Berhasil |
| 10 | **Proses Diagnosa** | Pengguna memilih beberapa gejala dengan tingkat keyakinan tertentu. | Sistem menghitung Certainty Factor (CF) berdasarkan pilihan pengguna dan aturan pakar. | Hasil perhitungan muncul dengan persentase keyakinan. | Berhasil |
| 11 | **Hasil Diagnosa** | Menampilkan detail penyakit, deskripsi, solusi, dan pencegahan hasil diagnosa. | Sistem menampilkan informasi lengkap mengenai penyakit yang didiagnosa. | Halaman hasil menampilkan nama penyakit dan cara penanganannya. | Berhasil |
| 12 | **Cetak Hasil** | Menekan tombol cetak pada halaman hasil diagnosa. | Sistem membuka jendela cetak browser untuk mencetak laporan. | Muncul preview cetak yang rapi sesuai format laporan. | Berhasil |
| 13 | **Riwayat Diagnosa** | Melihat daftar riwayat diagnosa yang pernah dilakukan. | Sistem menampilkan tabel riwayat berdasarkan tanggal dan nama user. | Daftar riwayat diagnosa ditampilkan secara kronologis. | Berhasil |
| 14 | **Cari Riwayat** | Mencari riwayat diagnosa berdasarkan nama user. | Sistem menampilkan data yang relevan sesuai dengan kata kunci pencarian. | Hasil pencarian memfilter tabel riwayat dengan tepat. | Berhasil |
| 15 | **Detail Riwayat** | Membuka detail dari salah satu entitas riwayat diagnosa. | Sistem merekonstruksi dan menampilkan kembali hasil diagnosa secara detail. | Muncul halaman detail yang identik dengan hasil diagnosa asli. | Berhasil |
| 16 | **Katalog Penyakit** | Menekan tombol "Lihat Detail" pada katalog penyakit di halaman publik. | Sistem menampilkan modal berisi deskripsi lengkap, solusi, dan pencegahan. | Modal terbuka dan menampilkan informasi yang sesuai. | Berhasil |
| 17 | **Navigasi Responsif** | Mengakses aplikasi melalui perangkat mobile (layar kecil). | Sidebar dapat disembunyikan dan dibuka melalui tombol menu (hamburger). | UI menyesuaikan ukuran layar dan menu berfungsi dengan baik. | Berhasil |
