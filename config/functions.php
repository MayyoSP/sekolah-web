<?php
// File: config/functions.php
// Fungsi-fungsi untuk mengambil data dari database

require_once 'database.php';

// Fungsi untuk mengambil pengaturan sekolah
function getSchoolSettings() {
    $conn = getConnection();
    $query = "SELECT setting_key, setting_value FROM settings";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    $settings = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    
    return $settings;
}

// Fungsi untuk mengambil berita terbaru
function getLatestNews($limit = 5) {
    $conn = getConnection();
    $query = "SELECT * FROM news WHERE status = 'published' 
              ORDER BY created_at DESC LIMIT :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengambil detail berita
function getNewsById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM news WHERE id = :id AND status = 'published'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengambil data guru
function getAllTeachers() {
    $conn = getConnection();
    $query = "SELECT * FROM teachers ORDER BY name ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengambil galeri
function getGalleryByCategory($category = null) {
    $conn = getConnection();
    
    if($category) {
        $query = "SELECT * FROM gallery WHERE category = :category 
                  ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category', $category);
    } else {
        $query = "SELECT * FROM gallery ORDER BY created_at DESC";
        $stmt = $conn->prepare($query);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk format tanggal Indonesia
function formatTanggal($date) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $timestamp = strtotime($date);
    $hari = date('d', $timestamp);
    $bulan_num = date('n', $timestamp);
    $tahun = date('Y', $timestamp);
    
    return $hari . ' ' . $bulan[$bulan_num] . ' ' . $tahun;
}

// Fungsi untuk tambah berita (incomplete; add validation)
function addNews($title, $content, $author) {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO news (title, content, author, status) VALUES (:title, :content, :author, 'published')");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':author', $author);
    return $stmt->execute();  // TODO: Handle errors
}

// Fungsi untuk update berita (incomplete)
function updateNews($id, $title, $content) {
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE news SET title = :title, content = :content WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();  // TODO: Add author update if needed
}

// Fungsi untuk delete berita (incomplete)
function deleteNews($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM news WHERE id = :id");
    $stmt->bindParam(':id', $id);
    return $stmt->execute();  // TODO: Confirm deletion
}
?>