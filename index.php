<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_app";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$questions = [
    [
        "question" => "What is 5 + 7?",
        "options" => ["10", "12", "14", "15"],
        "answer" => 1 // Correct answer is "12"
    ],
    [
        "question" => "What is 8 × 6?",
        "options" => ["42", "46", "48", "50"],
        "answer" => 2 // Correct answer is "48"
    ],
    [
        "question" => "What is 9 - 4?",
        "options" => ["3", "4", "5", "6"],
        "answer" => 2 // Correct answer is "5"
    ],
    [
        "question" => "What is 15 ÷ 3?",
        "options" => ["3", "4", "5", "6"],
        "answer" => 2 // Correct answer is "5"
    ],
    [
        "question" => "What is the square root of 49?",
        "options" => ["6", "7", "8", "9"],
        "answer" => 1 // Correct answer is "7"
    ],
    [
        "question" => "What is 10²?",
        "options" => ["100", "200", "50", "20"],
        "answer" => 0 // Correct answer is "100"
    ],
    [
        "question" => "What is the value of π approximately?",
        "options" => ["2.14", "3.14", "3.41", "4.13"],
        "answer" => 1 // Correct answer is "3.14"
    ],
    [
        "question" => "If x = 5, what is 2x + 3?",
        "options" => ["10", "11", "12", "13"],
        "answer" => 3 // Correct answer is "13"
    ],
    [
        "question" => "What is 7 × 7?",
        "options" => ["47", "48", "49", "50"],
        "answer" => 2 // Correct answer is "49"
    ],
    [
        "question" => "What is the perimeter of a square with a side length of 6?",
        "options" => ["18", "24", "26", "36"],
        "answer" => 1 // Correct answer is "24"
    ]
];

$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $index => $question) {
        if (isset($_POST["question$index"]) && $_POST["question$index"] == $question['answer']) {
            $score++;
        }
    }

    $stmt = $conn->prepare("INSERT INTO quiz_scores (user_name, score) VALUES (?, ?)");
    $stmt->bind_param("si", $username, $score);
    $stmt->execute();
    $stmt->close();
    
    echo "<h2>Your Score: $score/" . count($questions) . "</h2>";
    echo '<a href="index.php">Try Again</a>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>

    <script>
        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', event => {
            if (event.key === "F12" || (event.ctrlKey && event.shiftKey && event.key === "I")) {
                event.preventDefault();
            }
        });
    </script>

</head>
<body>
    <h1>Math Quiz</h1>
    <form method="post" action="">

    <label for="user_name">Enter your name:</label>
    <input type="text" name="user_name" id="user_name" placeholder="Your name..." required>
    
        <?php foreach ($questions as $index => $question): ?>
            <fieldset>
                <legend><?php echo $question['question']; ?></legend>
                <?php foreach ($question['options'] as $optionIndex => $option): ?>
                    <label>
                        <input type="radio" name="question<?php echo $index; ?>" value="<?php echo $optionIndex; ?>">
                        <?php echo $option; ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
