<?php
// Allow CORS (for frontend to connect)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Only POST method is allowed"]);
    exit;
}

// Read raw POST data
$input = json_decode(file_get_contents('php://input'), true);

// Check for required fields
if (
    !isset($input['Unit Name']) ||
    !isset($input['Arrival']) ||
    !isset($input['Departure']) ||
    !isset($input['Occupants']) ||
    !isset($input['Ages']) ||
    !is_array($input['Ages'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Missing or invalid input fields"]);
    exit;
}

// Convert date format from dd/mm/yyyy to yyyy-mm-dd
function convertDate($dateStr) {
    $date = DateTime::createFromFormat('d/m/Y', $dateStr);
    return $date ? $date->format('Y-m-d') : null;
}

$convertedArrival = convertDate($input['Arrival']);
$convertedDeparture = convertDate($input['Departure']);

if (!$convertedArrival || !$convertedDeparture) {
    http_response_code(400);
    echo json_encode(["error" => "Invalid date format"]);
    exit;
}

// Convert age array to Guest array
$guests = array_map(function ($age) {
    return [
        "Age Group" => $age >= 12 ? "Adult" : "Child"
    ];
}, $input['Ages']);

// Pick a sample Unit Type ID (you can try different ones later)
$unitTypeId = -2147483637;

// Build final payload
$remotePayload = [
    "Unit Type ID" => $unitTypeId,
    "Arrival" => $convertedArrival,
    "Departure" => $convertedDeparture,
    "Guests" => $guests
];

// Send POST to remote API
$remoteUrl = "https://dev.gondwana-collection.com/Web-Store/Rates/Rates.php";
$options = [
    'http' => [
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => json_encode($remotePayload),
    ],
];
$context  = stream_context_create($options);
$response = file_get_contents($remoteUrl, false, $context);

// Send remote response back to frontend
echo $response;
