<?php

include "db-connection.php";

// =====================================================
// TERIMA JSON DARI ESP32
// =====================================================

$raw = file_get_contents("php://input");


// =====================================================
// CEK DATA KOSONG
// =====================================================

if (empty($raw)) {

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Tidak ada data JSON"
    ]);

    exit;
}


// =====================================================
// DECODE JSON
// =====================================================

$data = json_decode($raw, true);


// =====================================================
// CEK JSON VALID
// =====================================================

if (json_last_error() !== JSON_ERROR_NONE) {

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "JSON tidak valid",
        "error" => json_last_error_msg()
    ]);

    exit;
}


// =====================================================
// CEK TYPE
// =====================================================

if (!isset($data["type"])) {

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Field type tidak ditemukan"
    ]);

    exit;
}


// =====================================================
// JIKA DATA POWER METER
// =====================================================

if ($data["type"] === "data") {

    // Ambil data dari JSON

    $voltage = $data["voltage"] ?? 0;

    $current = $data["current"] ?? 0;

    $power_kw = $data["power_kw"] ?? 0;

    $power_factor = $data["power_factor"] ?? 0;

    $energy_kwh = $data["energy_kwh"] ?? 0;

    $status = $data["status"] ?? "";

    $trip = $data["trip"] ?? 0;


    // =================================================
    // INSERT DATABASE
    // =================================================

    $sql = "INSERT INTO monitoring
            (
                voltage,
                current,
                power_kw,
                power_factor,
                energy_kwh,
                status,
                trip,
                waktu
            )
            VALUES
            (
                '$voltage',
                '$current',
                '$power_kw',
                '$power_factor',
                '$energy_kwh',
                '$status',
                '$trip',
                NOW()
            )";


    if ($con->query($sql)) {

        echo json_encode([
            "success" => true,
            "message" => "Data berhasil disimpan",
            "data" => [
                "voltage" => $voltage,
                "current" => $current,
                "power_kw" => $power_kw,
                "power_factor" => $power_factor,
                "energy_kwh" => $energy_kwh,
                "status" => $status,
                "trip" => $trip
            ]
        ]);

    } else {

        http_response_code(500);

        echo json_encode([
            "success" => false,
            "message" => "Gagal menyimpan data",
            "error" => $con->error
        ]);
    }

}


// =====================================================
// TYPE TIDAK DIKENAL
// =====================================================

else {

    http_response_code(400);

    echo json_encode([
        "success" => false,
        "message" => "Type data tidak dikenal",
        "type" => $data["type"]
    ]);
}

?>