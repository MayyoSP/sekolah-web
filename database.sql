-- File: database.sql
-- Struktur database untuk website sekolah

-- Tabel untuk berita/pengumuman
CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('draft', 'published') DEFAULT 'published'
);

-- Tabel untuk guru
CREATE TABLE teachers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    subject VARCHAR(100) NOT NULL,
    education VARCHAR(200),
    photo VARCHAR(255),
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel untuk galeri
CREATE TABLE gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    image_path VARCHAR(255) NOT NULL,
    category ENUM('kegiatan', 'fasilitas', 'prestasi') DEFAULT 'kegiatan',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel untuk pengaturan website
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT NOT NULL,
    description VARCHAR(255)
);

-- Tabel untuk users (admins)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Hashed password
    role ENUM('admin') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data awal pengaturan
INSERT INTO settings (setting_key, setting_value, description) VALUES
('school_name', 'SMA Negeri 1 Contoh', 'Nama sekolah'),
('school_address', 'Jl. Pendidikan No. 123, Jakarta', 'Alamat sekolah'),
('school_phone', '(021) 1234-5678', 'Nomor telepon'),
('school_email', 'info@sman1contoh.sch.id', 'Email sekolah'),
('established_year', '1985', 'Tahun berdiri');

-- Insert contoh data berita
INSERT INTO news (title, content, author) VALUES
('Penerimaan Siswa Baru 2024', 'Pendaftaran siswa baru untuk tahun ajaran 2024/2025 telah dibuka. Silakan kunjungi website resmi untuk informasi lebih lanjut.', 'Admin'),
('Prestasi Olimpiade Matematika', 'Siswa kami berhasil meraih juara 1 dalam Olimpiade Matematika tingkat provinsi. Selamat untuk tim yang telah berjuang keras.', 'Admin');

-- Insert contoh data guru
INSERT INTO teachers (name, subject, education, bio) VALUES
('Dr. Ahmad Wijaya, S.Pd', 'Matematika', 'S2 Pendidikan Matematika', 'Guru matematika berpengalaman 15 tahun'),
('Siti Nurhaliza, S.S', 'Bahasa Indonesia', 'S1 Sastra Indonesia', 'Guru bahasa Indonesia yang kreatif dan inovatif');

-- Insert contoh admin (password: admin123 hashed)
INSERT INTO users (username, email, password) VALUES
('admin', 'admin@example.com', '$2y$10$K5z1Y0g3fZ3z7p7q0w0w0eZ3z7p7q0w0w0eZ3z7p7q0w0w0e');  -- Ganti dengan hash baru