<?php include "../includes/session.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(400);
  exit(json_encode(['error' => 'Invalid request method']));
}

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['interview_id']) || !isset($data['message'])) {
  http_response_code(400);
  exit(json_encode(['error' => 'Missing required fields']));
}

$interview_id = (int) $data['interview_id'];
$message = trim($data['message']);
$sender_id = (int) $_SESSION['id_user'];
$sender_type = $_SESSION['role_id'] == 1 ? 'jobseeker' : 'company';

// Verify user has access to this interview
$verify_sql = "SELECT * FROM interview_schedules WHERE id_interview = '$interview_id' 
              AND (id_jobseeker = '$sender_id' OR id_company IN (
                SELECT id_company FROM company WHERE email = '{$_SESSION['email']}'
              ))";
$verify_result = $conn->query($verify_sql);

if ($verify_result->num_rows === 0) {
  http_response_code(403);
  exit(json_encode(['error' => 'Access denied']));
}

// Insert message
$insert_sql = "INSERT INTO interview_messages (id_interview, sender_id, sender_type, message_text, created_at) 
               VALUES ('$interview_id', '$sender_id', '$sender_type', '" . addslashes($message) . "', NOW())";

if ($conn->query($insert_sql)) {
  http_response_code(200);
  echo json_encode(['success' => true, 'message' => 'Message sent']);
} else {
  http_response_code(500);
  echo json_encode(['error' => 'Failed to send message']);
}
