<?php
include_once __DIR__ . '/../config/database.php';

/**
 * Get all symptoms grouped by category
 */
function getSymptomsByCategory($conn) {
    $sql = "SELECT * FROM symptoms ORDER BY category, code";
    $result = $conn->query($sql);
    $symptoms = [];
    while ($row = $result->fetch_assoc()) {
        $symptoms[$row['category']][] = $row;
    }
    return $symptoms;
}

/**
 * Get all diseases
 */
function getDiseases($conn) {
    $sql = "SELECT * FROM diseases";
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
    $sql = "SELECT r.*, d.name as disease_name, d.description, d.solution, d.prevention
            FROM rules r
            JOIN diseases d ON r.disease_id = d.id
            WHERE r.symptom_id IN ($symptomIds)";
    $result = $conn->query($sql);

    $diseaseResults = [];

    while ($row = $result->fetch_assoc()) {
        $diseaseId = $row['disease_id'];
        $symptomId = $row['symptom_id'];
        $cfExpert = $row['cf_expert'];
        $cfUser = $selectedSymptoms[$symptomId];

        $cfSymptom = $cfExpert * $cfUser;

        if (!isset($diseaseResults[$diseaseId])) {
            $diseaseResults[$diseaseId] = [
                'id' => $diseaseId,
                'name' => $row['disease_name'],
                'description' => $row['description'],
                'solution' => $row['solution'],
                'prevention' => $row['prevention'],
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
    $stmt = $conn->prepare("INSERT INTO history (user_name, disease_name, cf_percentage, details) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $userName, $diseaseName, $cfPercentage, $details);
    return $stmt->execute();
}

/**
 * Get history
 */
function getHistory($conn, $limit = 10) {
    $sql = "SELECT * FROM history ORDER BY created_at DESC LIMIT $limit";
    $result = $conn->query($sql);
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    return $history;
}
?>
