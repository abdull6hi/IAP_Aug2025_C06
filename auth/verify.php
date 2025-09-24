<?php
require "../config/db.php";

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_code=?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $conn->query("UPDATE users SET is_verified=1 WHERE verification_code='$code'");
        echo "Account verified! <a href='signin.php'>Login here</a>";
    } else {
        echo "Invalid verification link!";
    }
}
?>
