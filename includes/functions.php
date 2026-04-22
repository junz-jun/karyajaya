<?php
include_once __DIR__ . '/../config/database.php';

/**
 * Get anatomical category mapping
 */
function getCategoryMapping() {
    return [
        'P01' => 'Buah',
        'P06' => 'Buah',
        'P03' => 'Batang',
        'P04' => 'Batang',
        'P05' => 'Batang',
        'P02' => 'Daun',
        'Buah' => 'Buah',
        'Batang' => 'Batang',
        'Daun' => 'Daun'
    ];
}

/**
 * Get all symptoms grouped by category
 */
function getSymptomsByCategory($conn) {
    // Mapping current categories (disease codes) to anatomical categories
    $mapping = getCategoryMapping();

    $sql = "SELECT * FROM gejala ORDER BY kategori, kode";
    $result = $conn->query($sql);
    $symptoms = [];

    while ($row = $result->fetch_assoc()) {
        $rawCat = $row['kategori'];
        $mappedCat = isset($mapping[$rawCat]) ? $mapping[$rawCat] : $rawCat;
        $categoryLabel = 'Penyakit ' . $mappedCat;
        $symptoms[$categoryLabel][] = $row;
    }

    // Ensure the order is Batang, Daun, Buah if they exist
    $categoriesOrder = ['Penyakit Batang', 'Penyakit Daun', 'Penyakit Buah'];
    $orderedSymptoms = [];

    foreach ($categoriesOrder as $label) {
        if (isset($symptoms[$label])) {
            $orderedSymptoms[$label] = $symptoms[$label];
        }
    }

    // Include any other categories that might exist
    foreach ($symptoms as $label => $data) {
        if (!isset($orderedSymptoms[$label])) {
            $orderedSymptoms[$label] = $data;
        }
    }

    return $orderedSymptoms;
}

/**
 * Get all diseases
 */
function getDiseases($conn) {
    $sql = "SELECT * FROM penyakit";
    $result = $conn->query($sql);
    $diseases = [];
    while ($row = $result->fetch_assoc()) {
        $diseases[] = $row;
    }
    return $diseases;
}

/**
 * Certainty Factor Calculation
 * @param array $selectedSymptoms [symptom_id => user_cf]
 */
function calculateDiagnosis($conn, $selectedSymptoms) {
    if (empty($selectedSymptoms)) return [];

    // Sanitize input IDs
    $safeIds = array_map('intval', array_keys($selectedSymptoms));
    $symptomIds = implode(',', $safeIds);

    // Get rules for selected symptoms
    $sql = "SELECT r.*, d.nama as nama_penyakit, d.deskripsi, d.solusi, d.pencegahan
            FROM aturan r
            JOIN penyakit d ON r.id_penyakit = d.id
            WHERE r.id_gejala IN ($symptomIds)";
    $result = $conn->query($sql);

    $diseaseResults = [];

    while ($row = $result->fetch_assoc()) {
        $diseaseId = $row['id_penyakit'];
        $symptomId = $row['id_gejala'];
        $cfExpert = $row['cf_pakar'];
        $cfUser = $selectedSymptoms[$symptomId];

        $cfSymptom = $cfExpert * $cfUser;

        if (!isset($diseaseResults[$diseaseId])) {
            $diseaseResults[$diseaseId] = [
                'id' => $diseaseId,
                'name' => $row['nama_penyakit'],
                'description' => $row['deskripsi'],
                'solution' => $row['solusi'],
                'prevention' => $row['pencegahan'],
                'cf' => 0
            ];
            $diseaseResults[$diseaseId]['cf'] = $cfSymptom;
        } else {
            $cfOld = $diseaseResults[$diseaseId]['cf'];
            $diseaseResults[$diseaseId]['cf'] = $cfOld + ($cfSymptom * (1 - $cfOld));
        }
    }

    // Sort by CF descending
    uasort($diseaseResults, function($a, $b) {
        return $b['cf'] <=> $a['cf'];
    });

    return $diseaseResults;
}

/**
 * Save diagnosis to history
 */
function saveHistory($conn, $userName, $diseaseName, $cfPercentage, $details) {
    $stmt = $conn->prepare("INSERT INTO riwayat (nama_pengguna, nama_penyakit, persentase_cf, detail) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $userName, $diseaseName, $cfPercentage, $details);
    return $stmt->execute();
}

/**
 * Get history
 */
function getHistory($conn, $limit = 10, $search = '') {
    $sql = "SELECT * FROM riwayat";
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $sql .= " WHERE nama_pengguna LIKE '%$search%' OR nama_penyakit LIKE '%$search%'";
    }
    $sql .= " ORDER BY dibuat_pada DESC LIMIT $limit";
    $result = $conn->query($sql);
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    return $history;
}
?>
