<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';

$sql = "
    SELECT
        owner_id,
        firstname,
        lastname,
        gender,
        contact_number,
        email,
        address
    FROM pet_owners
    ORDER BY lastname, firstname
";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => mysqli_error($conn),
        'owners' => []
    ]);
    exit;
}

$owners = [];

while ($owner = mysqli_fetch_assoc($result)) {

    $ownerId = (int) $owner['owner_id'];

    $pets = [];

    $petStmt = mysqli_prepare(
        $conn,
        "SELECT
            pet_id,
            pet_name,
            species,
            breed,
            gender,
            color,
            birth_date,
            weight,
            microchip_number
         FROM pets
         WHERE owner_id = ?
         ORDER BY pet_name"
    );

    mysqli_stmt_bind_param($petStmt, "i", $ownerId);
    mysqli_stmt_execute($petStmt);

    $petResult = mysqli_stmt_get_result($petStmt);

    while ($pet = mysqli_fetch_assoc($petResult)) {

        $age = '';

        if (!empty($pet['birth_date'])) {
            $birthDate = new DateTime($pet['birth_date']);
            $today = new DateTime();
            $age = $today->diff($birthDate)->y;
        }

        $pets[] = [
            'pet_id' => (int) $pet['pet_id'],
            'name' => $pet['pet_name'],
            'type' => $pet['species'],
            'species' => $pet['species'],
            'sex' => $pet['gender'] ?? '',
            'gender' => $pet['gender'] ?? '',
            'breed' => $pet['breed'] ?? '',
            'color' => $pet['color'] ?? '',
            'birthdate' => $pet['birth_date'] ?? '',
            'age' => $age,
            'weight' => $pet['weight'] ?? '',
            'microchip_number' => $pet['microchip_number'] ?? ''
        ];
    }

    mysqli_stmt_close($petStmt);

    $owners[] = [
        'id' => 'VT-' . str_pad((string) $ownerId, 4, '0', STR_PAD_LEFT),
        'owner_id' => $ownerId,
        'name' => trim($owner['firstname'] . ' ' . $owner['lastname']),
        'gender' => $owner['gender'] ?? '',
        'phone' => $owner['contact_number'] ?? '',
        'email' => $owner['email'] ?? '',
        'address' => $owner['address'] ?? '',
        'street' => $owner['address'] ?? '',
        'barangay' => $owner['address'] ?? '',
        'birthdate' => '',
        'age' => '',
        'animals' => $pets
    ];
}

echo json_encode([
    'success' => true,
    'owners' => $owners
]);

mysqli_close($conn);