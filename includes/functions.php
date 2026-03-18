<?php
include_once __DIR__ . '/../config/database.php';

/**
 * Get all symptoms grouped by category
 */
function getSymptomsByCategory($conn) {
    $sql = "SELECT * FROM gejala ORDER BY kategori, kode";
    $result = $conn->query($sql);
    $symptoms = [];
    while ($row = $result->fetch_assoc()) {
        $symptoms[$row['kategori']][] = $row;
    }
    return $symptoms;
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
function getHistory($conn, $limit = 10) {
    $sql = "SELECT * FROM riwayat ORDER BY dibuat_pada DESC LIMIT $limit";
    $result = $conn->query($sql);
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    return $history;
}
?>
