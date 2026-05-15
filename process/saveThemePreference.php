<?php include "../includes/session.php";

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(400);
  exit(json_encode(['error' => 'Invalid request method']));
}

// Get JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['dark_mode'])) {
  http_response_code(400);
  exit(json_encode(['error' => 'Missing dark_mode parameter']));
}

// Only save if user is logged in
if (!isset($_SESSION['id_user'])) {
  http_response_code(401);
  exit(json_encode(['error' => 'Not authenticated']));
}

$id_user = (int) $_SESSION['id_user'];
$user_type = $_SESSION['role_id'] == 1 ? 'jobseeker' : ($_SESSION['role_id'] == 2 ? 'company' : 'admin');
$dark_mode = (bool) $data['dark_mode'];

// Check if preference exists
$check_sql = "SELECT * FROM user_theme_preferences WHERE id_user = '$id_user'";
$check_result = $conn->query($check_sql);

if ($check_result->num_rows > 0) {
  // Update existing preference
  $update_sql = "UPDATE user_theme_preferences SET dark_mode = " . ($dark_mode ? '1' : '0') . " WHERE id_user = '$id_user'";
  $conn->query($update_sql);
} else {
  // Insert new preference
  $insert_sql = "INSERT INTO user_theme_preferences (id_user, user_type, dark_mode) 
                VALUES ('$id_user', '$user_type', " . ($dark_mode ? '1' : '0') . ")";
  $conn->query($insert_sql);
}

http_response_code(200);
echo json_encode(['success' => true, 'message' => 'Theme preference saved']);
