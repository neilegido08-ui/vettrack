<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

$ownerId  = (int) ($_POST['owner_id'] ?? 0);
$petName  = trim($_POST['pet_name'] ?? '');
$species  = trim($_POST['species'] ?? '');
$gender   = trim($_POST['gender'] ?? '');
$color    = trim($_POST['color'] ?? '');
$birthDate = trim($_POST['birth_date'] ?? '');

if ($ownerId <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid owner ID.'
    ]);
    exit;
}

if ($petName === '' || $species === '') {
    echo json_encode([
        'success' => false,
        'message' => 'Pet name and species are required.'
    ]);
    exit;
}

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO pets
    (
        owner_id,
        pet_name,
        species,
        gender,
        color,
        birth_date
    )
    VALUES (?, ?, ?, ?, ?, NULLIF(?, ''))"
);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Prepare error: ' . mysqli_error($conn)
    ]);
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    'isssss',
    $ownerId,
    $petName,
    $species,
    $gender,
    $color,
    $birthDate
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'success' => true,
        'message' => 'Pet saved successfully.',
        'pet_id' => mysqli_insert_id($conn)
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . mysqli_stmt_error($stmt)
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);