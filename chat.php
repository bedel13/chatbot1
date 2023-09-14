<?php
// Database configuration
$host = "localhost";
$dbname = "chatbot1";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

if (isset($_POST['send'])) {
    $userMessage = $_POST['user-message'];

    // Find a response from the database based on the user's message
    $query = "SELECT answer FROM responses WHERE question = :question";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':question', $userMessage);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $response = $stmt->fetch(PDO::FETCH_ASSOC)['answer'];
    } else {
        $response = "Sorry, I don't understand your question.";
    }

    // Display the user's message and the response
    echo "<div class='message user'>$userMessage</div>";
    echo "<div class='message bot'>$response</div>";
}
?>
