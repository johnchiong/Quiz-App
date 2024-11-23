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
        "question" => "What is the name of the Traveler's sibling in Genshin Impact?",
        "options" => ["Aether/Lumine", "Venti", "Paimon", "Dainsleif"],
        "answer" => 0
    ],
    [
        "question" => "Which Archon is known as the 'God of Contracts'?",
        "options" => ["Raiden Shogun", "Venti", "Zhongli", "Nahida"],
        "answer" => 2
    ],
    [
        "question" => "What is the name of the city that serves as Mondstadt's main location?",
        "options" => ["Liyue Harbor", "Springvale", "Mondstadt City", "Dragonspine"],
        "answer" => 2
    ],
    [
        "question" => "Which region is the home of the Raiden Shogun?",
        "options" => ["Sumeru", "Inazuma", "Mondstadt", "Liyue"],
        "answer" => 1
    ],
    [
        "question" => "What is the name of the mysterious traveler who calls themselves the 'Bough Keeper'?",
        "options" => ["Kaeya", "Dainsleif", "Albedo", "Childe"],
        "answer" => 1
    ],
    [
        "question" => "What elemental vision does the character Diluc possess?",
        "options" => ["Pyro", "Cryo", "Electro", "Anemo"],
        "answer" => 0
    ],
    [
        "question" => "What is the name of the Archipelago that appears during the Midsummer Island Adventure?",
        "options" => ["Golden Apple Archipelago", "Seirai Island", "Narukami Island", "Dragonspine"],
        "answer" => 0
    ],
    [
        "question" => "Who is the Fatui Harbinger known as 'Childe'?",
        "options" => ["Scaramouche", "Tartaglia", "Pantalone", "Columbina"],
        "answer" => 1
    ],
    [
        "question" => "What is the real name of the Geo Archon?",
        "options" => ["Zhongli", "Morax", "Rex Lapis", "All of the above"],
        "answer" => 3
    ],
    [
        "question" => "What is the name of the organization that Ningguang leads?",
        "options" => ["The Adventurers' Guild", "The Millelith", "The Liyue Qixing", "The Fatui"],
        "answer" => 2
    ]
];

$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($questions as $index => $question) {
        if (isset($_POST["question$index"]) && $_POST["question$index"] == $question['answer']) {
            $score++;
        }
    }
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
    <title>PHP Quiz</title>
</head>
<body>
    <h1>PHP Quiz</h1>
    <form method="post" action="">
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
