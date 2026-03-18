CREATE DATABASE IF NOT EXISTS karyajaya_kakao;
USE karyajaya_kakao;

-- Table: penyakit
CREATE TABLE penyakit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NOT NULL UNIQUE,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    solusi TEXT,
    pencegahan TEXT,
    gambar VARCHAR(255)
);

-- Table: gejala
CREATE TABLE gejala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NOT NULL UNIQUE,
    nama TEXT NOT NULL,
    kategori VARCHAR(50)
);

-- Table: aturan
CREATE TABLE aturan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_penyakit INT,
    id_gejala INT,
    cf_pakar DECIMAL(3,2),
    FOREIGN KEY (id_penyakit) REFERENCES penyakit(id) ON DELETE CASCADE,
    FOREIGN KEY (id_gejala) REFERENCES gejala(id) ON DELETE CASCADE
);

-- Table: riwayat
CREATE TABLE riwayat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengguna VARCHAR(100),
    nama_penyakit VARCHAR(255),
    persentase_cf DECIMAL(5,2),
    detail TEXT,
    dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: pengguna (admin)
CREATE TABLE pengguna (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pengguna VARCHAR(50) UNIQUE NOT NULL,
    kata_sandi VARCHAR(255) NOT NULL
);

-- Insert Data: Penyakit
INSERT INTO penyakit (kode, nama, deskripsi, solusi, pencegahan) VALUES
('P01', 'Vascular Streak Dieback (VSD)',
 'VSD disebabkan oleh jamur Ceratobasidium theobromae. Penyakit ini menyerang sistem pembuluh kayu tanaman kakao, menyebabkan hambatan aliran nutrisi dan air.',
 '1. Lakukan pemangkasan pada cabang yang terinfeksi minimal 30 cm di bawah bagian yang menunjukkan gejala.\n2. Bakar atau kubur sisa pangkasan agar tidak menulari tanaman lain.\n3. Aplikasi fungisida sistemik berbahan aktif Triazol atau Karbendazim sesuai dosis anjuran.',
 '1. Gunakan bibit kakao yang tahan terhadap VSD (seperti klon Sulawesi 1 atau 2).\n2. Jaga kelembaban kebun dengan pemangkasan pohon pelindung dan tanaman kakao secara teratur.\n3. Pemupukan yang berimbang untuk meningkatkan daya tahan tanaman.'),
('P02', 'Busuk Buah (Black Pod Rot)',
 'Penyakit ini disebabkan oleh jamur Phytophthora palmivora. Merupakan penyakit paling merugikan yang menyerang buah kakao di segala umur.',
 '1. Segera petik buah yang terinfeksi dan buang jauh dari area kebun atau dikubur sedalam 30 cm.\n2. Semprot dengan fungisida kontak berbahan aktif tembaga (Cu) atau fungisida sistemik.\n3. Lakukan sanitasi kebun secara menyeluruh.',
 '1. Atur jarak tanam agar sirkulasi udara lancar.\n2. Hindari kelembaban tinggi dengan pemangkasan rutin.\n3. Pilih klon yang lebih toleran terhadap serangan Phytophthora.'),
('P03', 'Penggerek Buah Kakao (PBK)',
 'Hama Conopomorpha cramerella yang larvanya merusak biji kakao dan menyebabkan buah matang prematur dengan biji yang lengket.',
 '1. Lakukan panen sering (setiap minggu) untuk memutus siklus hidup hama.\n2. Kondomisasi (penyelongsongan) buah muda yang berukuran 8-10 cm dengan plastik.\n3. Rampasan: memetik semua buah yang ada di pohon saat populasi hama sangat tinggi untuk memutus siklus.',
 '1. Pemangkasan tajuk untuk memudahkan sinar matahari masuk.\n2. Pemupukan rutin agar tanaman tetap sehat dan kuat.\n3. Pengendalian hayati dengan pemanfaatan semut hitam atau jamur Beauveria bassiana.'),
('P04', 'Kanker Batang',
 'Juga disebabkan oleh Phytophthora palmivora, menyerang kulit batang dan dapat menyebabkan kematian tanaman jika melingkari batang utama.',
 '1. Kerok bagian kulit batang yang busuk sampai ke bagian kayu yang sehat.\n2. Olesi bekas kerokan dengan pasta fungisida berbahan aktif tembaga.\n3. Jika serangan sudah melingkari batang utama, sebaiknya tanaman diganti.',
 '1. Jaga agar batang tidak sering terluka saat kegiatan budidaya.\n2. Hindari kelembaban yang terlalu tinggi di sekitar pangkal batang.\n3. Kendalikan penyakit busuk buah karena merupakan sumber inokulum yang sama.'),
('P05', 'Antraknosa',
 'Disebabkan oleh jamur Colletotrichum gloeosporioides, sering menyerang daun muda dan buah muda (cherelle).',
 '1. Buang daun atau buah muda yang terserang.\n2. Gunakan fungisida berbahan aktif Mankozeb atau Tembaga.\n3. Perbaiki drainase kebun agar tidak terlalu lembab.',
 '1. Pemangkasan untuk memperbaiki sirkulasi udara.\n2. Pemberian nutrisi tambahan seperti Kalium untuk memperkuat jaringan tanaman.\n3. Gunakan naungan yang cukup untuk tanaman muda.'),
('P06', 'Jamur Upas (Pink Disease)',
 'Disebabkan oleh jamur Upasia salmonicolor, ditandai dengan adanya lapisan merah jambu pada batang atau cabang.',
 '1. Potong cabang yang mati atau terinfeksi parah.\n2. Kerok bagian yang terserang dan olesi dengan fungisida atau cat/bubur bordeaux.\n3. Bersihkan area sekitar tanaman dari gulma yang rimbun.',
 '1. Kurangi kepadatan tajuk melalui pemangkasan.\n2. Perbaiki sanitasi kebun.\n3. Pengamatan rutin terutama pada musim penghujan.');

-- Insert Data: Gejala
-- Note: Categories are updated to use Disease Codes/Names as per request
INSERT INTO gejala (kode, nama, kategori) VALUES
('G01', 'Daun menguning dengan bercak hijau (green islands)', 'P01'),
('G02', 'Daun gugur dimulai dari bagian tengah cabang', 'P01'),
('G03', 'Terdapat tiga bintik hitam pada bekas duduk daun', 'P01'),
('G04', 'Ranting mati dari ujung (dieback)', 'P01'),
('G05', 'Bercak coklat kecil pada buah', 'P02'),
('G06', 'Bercak coklat menyebar cepat ke seluruh buah', 'P02'),
('G07', 'Buah tertutup lapisan jamur putih/abu-abu', 'P02'),
('G08', 'Buah menjadi hitam dan keras', 'P02'),
('G09', 'Buah matang tidak merata (belang)', 'P03'),
('G10', 'Biji saling melekat dan sulit dikeluarkan', 'P03'),
('G11', 'Terdapat lubang kecil pada kulit buah', 'P03'),
('G12', 'Buah terasa berat tapi isinya kosong/rusak', 'P03'),
('G13', 'Batang mengeluarkan cairan kemerahan (seperti karat)', 'P04'),
('G14', 'Kulit batang membusuk dan berwarna coklat kehitaman', 'P04'),
('G15', 'Lapisan kayu di bawah kulit berwarna merah anggur', 'P04'),
('G16', 'Daun muda layu dan mengering (blight)', 'P05'),
('G17', 'Terdapat bercak coklat pada ujung atau pinggir daun', 'P05'),
('G18', 'Buah muda mengkerut dan kering (cherelle wilt)', 'P05'),
('G19', 'Terdapat benang-benang putih seperti sarang laba-laba pada cabang', 'P06'),
('G20', 'Cabang yang terinfeksi berubah warna menjadi merah muda', 'P06'),
('G21', 'Kulit cabang pecah-pecah dan mengelupas', 'P06');

-- Insert Data: Aturan (Expert CF)
INSERT INTO aturan (id_penyakit, id_gejala, cf_pakar) VALUES
(1, 1, 0.8), (1, 2, 0.7), (1, 3, 0.9), (1, 4, 0.6), -- VSD
(2, 5, 0.5), (2, 6, 0.8), (2, 7, 0.9), (2, 8, 0.7), -- Busuk Buah
(3, 9, 0.8), (3, 10, 0.9), (3, 11, 0.6), (3, 12, 0.7), -- PBK
(4, 13, 0.9), (4, 14, 0.8), (4, 15, 0.9), -- Kanker Batang
(5, 16, 0.7), (5, 17, 0.6), (5, 18, 0.8), -- Antraknosa
(6, 19, 0.8), (6, 20, 0.9), (6, 21, 0.7); -- Jamur Upas

-- Insert Admin User (password: admin123)
INSERT INTO pengguna (nama_pengguna, kata_sandi) VALUES ('admin', '$2y$10$xevtMEkXJgkeRHh56IsbDeXSxU0gwj4mp56sMdaIsESkWlgiapPZO');
