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
INSERT INTO penyakit (id, kode, nama, deskripsi, solusi, pencegahan) VALUES
(1, 'P01', 'Busuk Buah Hitam',
 'Penyakit ini disebabkan oleh jamur Phytophthora palmivora. Merupakan penyakit paling merugikan yang menyerang buah kakao di segala umur.',
 '1. Segera petik buah yang terinfeksi dan buang jauh dari area kebun atau dikubur sedalam 30 cm.\n2. Semprot dengan fungisida kontak berbahan aktif tembaga (Cu) atau fungisida sistemik.\n3. Lakukan sanitasi kebun secara menyeluruh.',
 '1. Atur jarak tanam agar sirkulasi udara lancar.\n2. Hindari kelembaban tinggi dengan pemangkasan rutin.\n3. Pilih klon yang lebih toleran terhadap serangan Phytophthora.'),
(2, 'P02', 'Vascular Streak Dieback (VSD)',
 'VSD disebabkan oleh jamur Ceratobasidium theobromae. Penyakit ini menyerang sistem pembuluh kayu tanaman kakao, menyebabkan hambatan aliran nutrisi dan air.',
 '1. Lakukan pemangkasan pada cabang yang terinfeksi minimal 30 cm di bawah bagian yang menunjukkan gejala.\n2. Bakar atau kubur sisa pangkasan agar tidak menulari tanaman lain.\n3. Aplikasi fungisida sistemik berbahan aktif Triazol atau Karbendazim sesuai dosis anjuran.',
 '1. Gunakan bibit kakao yang tahan terhadap VSD (seperti klon Sulawesi 1 atau 2).\n2. Jaga kelembaban kebun dengan pemangkasan pohon pelindung dan tanaman kakao secara teratur.\n3. Pemupukan yang berimbang untuk meningkatkan daya tahan tanaman.'),
(3, 'P03', 'Kanker Batang',
 'Juga disebabkan oleh Phytophthora palmivora, menyerang kulit batang dan dapat menyebabkan kematian tanaman jika melingkari batang utama.',
 '1. Kerok bagian kulit batang yang busuk sampai ke bagian kayu yang sehat.\n2. Olesi bekas kerokan dengan pasta fungisida berbahan aktif tembaga.\n3. Jika serangan sudah melingkari batang utama, sebaiknya tanaman diganti.',
 '1. Jaga agar batang tidak sering terluka saat kegiatan budidaya.\n2. Hindari kelembaban yang terlalu tinggi di sekitar pangkal batang.\n3. Kendalikan penyakit busuk buah karena merupakan sumber inokulum yang sama.'),
(4, 'P04', 'Jamur Upas',
 'Disebabkan oleh jamur Upasia salmonicolor, ditandai dengan adanya lapisan merah jambu pada batang atau cabang.',
 '1. Potong cabang yang mati atau terinfeksi parah.\n2. Kerok bagian yang terserang dan olesi dengan fungisida atau cat/bubur bordeaux.\n3. Bersihkan area sekitar tanaman dari gulma yang rimbun.',
 '1. Kurangi kepadatan tajuk melalui pemangkasan.\n2. Perbaiki sanitasi kebun.\n3. Pengamatan rutin terutama pada musim penghujan.'),
(5, 'P05', 'Jamur Akar Cokelat',
 'Penyakit ini menyerang akar tanaman kakao, menyebabkan busuk akar yang akhirnya mematikan pohon. Ditandai dengan adanya lapisan kerak cokelat pada permukaan akar.',
 '1. Bongkar dan musnahkan tanaman yang terserang sampai ke akarnya.\n2. Berikan kapur atau belerang pada lubang bekas tanaman.\n3. Isolasi tanaman sehat dengan parit isolasi.',
 '1. Jaga kebersihan kebun dari sisa-sisa tunggul kayu.\n2. Lakukan pengamatan rutin pada leher akar.\n3. Gunakan agensia hayati Trichoderma spp.'),
(6, 'P06', 'Antraknosa',
 'Disebabkan oleh jamur Colletotrichum gloeosporioides, sering menyerang daun muda dan buah muda (cherelle).',
 '1. Buang daun atau buah muda yang terserang.\n2. Gunakan fungisida berbahan aktif Mankozeb atau Tembaga.\n3. Perbaiki drainase kebun agar tidak terlalu lembab.',
 '1. Pemangkasan untuk memperbaiki sirkulasi udara.\n2. Pemberian nutrisi tambahan seperti Kalium untuk memperkuat jaringan tanaman.\n3. Gunakan naungan yang cukup untuk tanaman muda.');

-- Insert Data: Gejala
INSERT INTO gejala (id, kode, nama, kategori) VALUES
(1, 'G01', 'Daun menguning dengan bercak hijau (green islands)', 'Daun'),
(2, 'G02', 'Daun gugur dimulai dari bagian tengah cabang', 'Daun'),
(3, 'G03', 'Terdapat tiga bintik hitam pada bekas duduk daun', 'Daun'),
(4, 'G04', 'Ranting mati dari ujung (dieback)', 'Daun'),
(5, 'G05', 'Bercak coklat kecil pada buah', 'Buah'),
(6, 'G06', 'Bercak coklat menyebar cepat ke seluruh buah', 'Buah'),
(7, 'G07', 'Buah tertutup lapisan jamur putih/abu-abu', 'Buah'),
(8, 'G08', 'Buah menjadi hitam dan keras', 'Buah'),
(9, 'G09', 'Daun menguning dan layu secara serentak', 'Batang'),
(10, 'G10', 'Terdapat kerak berwarna cokelat kehitaman pada leher akar', 'Batang'),
(11, 'G11', 'Akar membusuk dan mengeluarkan bau yang khas', 'Batang'),
(12, 'G12', 'Pertumbuhan tanaman terhenti (stagnan)', 'Batang'),
(13, 'G13', 'Batang mengeluarkan cairan kemerahan (seperti karat)', 'Batang'),
(14, 'G14', 'Kulit batang membusuk dan berwarna coklat kehitaman', 'Batang'),
(15, 'G15', 'Lapisan kayu di bawah kulit berwarna merah anggur', 'Batang'),
(16, 'G16', 'Daun muda layu dan mengering (blight)', 'Buah'),
(17, 'G17', 'Terdapat bercak coklat pada ujung atau pinggir daun', 'Buah'),
(18, 'G18', 'Buah muda mengkerut dan kering (cherelle wilt)', 'Buah'),
(19, 'G19', 'Terdapat benang-benang putih seperti sarang laba-laba pada cabang', 'Batang'),
(20, 'G20', 'Cabang yang terinfeksi berubah warna menjadi merah muda', 'Batang'),
(21, 'G21', 'Kulit cabang pecah-pecah dan mengelupas', 'Batang');

-- Insert Data: Aturan (Expert CF)
INSERT INTO aturan (id_penyakit, id_gejala, cf_pakar) VALUES
(2, 1, 0.8), (2, 2, 0.7), (2, 3, 0.9), (2, 4, 0.6), -- VSD (P02)
(1, 5, 0.5), (1, 6, 0.8), (1, 7, 0.9), (1, 8, 0.7), -- Busuk Buah (P01)
(5, 9, 0.8), (5, 10, 0.9), (5, 11, 0.6), (5, 12, 0.7), -- Jamur Akar Cokelat (P05)
(3, 13, 0.9), (3, 14, 0.8), (3, 15, 0.9), -- Kanker Batang (P03)
(6, 16, 0.7), (6, 17, 0.6), (6, 18, 0.8), -- Antraknosa (P06)
(4, 19, 0.8), (4, 20, 0.9), (4, 21, 0.7); -- Jamur Upas (P04)

-- Insert Admin User (password: admin123)
INSERT INTO pengguna (nama_pengguna, kata_sandi) VALUES ('admin', '$2y$10$xevtMEkXJgkeRHh56IsbDeXSxU0gwj4mp56sMdaIsESkWlgiapPZO');
