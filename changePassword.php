<?php
require_once('./config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize user input
    $email = filter_var(isset($_POST['email']) ? $_POST['email'] : '', FILTER_SANITIZE_EMAIL);
    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $newPassword = isset($_POST['newPass']) ? $_POST['newPass'] : '';

    // Check if email and token exist in the forgotPassword table
    $checkTokenQuery = $conn->prepare("SELECT * FROM `forgotPassword` WHERE email = ? AND token = ?");
    $checkTokenQuery->bind_param('ss', $email, $token);
    $checkTokenQuery->execute();
    $result = $checkTokenQuery->get_result();
    $tokenExists = $result->num_rows > 0;

    if ($tokenExists) {
        // Hash the new password using password_hash
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update password in the client_list table
        $changePass = $conn->prepare("UPDATE `client_list` SET `password` = ? WHERE email = ?");
        $changePass->bind_param('ss', $hashedPassword, $email);
        $changePassResult = $changePass->execute();

        if ($changePassResult) {
            // Delete the record from the forgotPassword table
            $deleteTokenQuery = $conn->prepare("DELETE FROM `forgotPassword` WHERE email = ? AND token = ?");
            $deleteTokenQuery->bind_param('ss', $email, $token);
            $deleteTokenResult = $deleteTokenQuery->execute();

            if ($deleteTokenResult) {
                echo json_encode(['status' => 'success', 'msg' => 'Update successful']);
            } else {
                // Log the error and provide a generic message
                error_log('Failed to delete token: ' . mysqli_error($conn));
                echo json_encode(['status' => 'failed', 'msg' => 'Failed to update password']);
            }
        } else {
            // Log the error and provide a generic message
            error_log('Update failed: ' . mysqli_error($conn));
            echo json_encode(['status' => 'failed', 'msg' => 'Failed to update password']);
        }
    } else {
        echo json_encode(['status' => 'failed', 'msg' => 'Invalid token or email']);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    echo json_encode(['status' => 'failed', 'msg' => 'Method Not Allowed']);
}
?>
