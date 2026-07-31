<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method.'
    ]);
    exit;
}

$firstname = trim($_POST['firstname'] ?? '');
$lastname = trim($_POST['lastname'] ?? '');
$gender = trim($_POST['gender'] ?? 'Male');
$contactNumber = trim($_POST['contact_number'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');

if ($firstname === '' || $lastname === '') {
    echo json_encode([
        'success' => false,
        'message' => 'First name and last name are required.'
    ]);
    exit;
}

$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO pet_owners
    (firstname, lastname, gender, contact_number, email, address)
    VALUES (?, ?, ?, ?, ?, ?)"
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
    'ssssss',
    $firstname,
    $lastname,
    $gender,
    $contactNumber,
    $email,
    $address
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        'success' => true,
        'message' => 'Owner registered successfully.',
        'owner_id' => mysqli_insert_id($conn)
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . mysqli_stmt_error($stmt)
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);