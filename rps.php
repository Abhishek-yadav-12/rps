<?php
// Ensure the 'name' parameter is present; otherwise, redirect to index.php
if (!isset($_GET['name']) || strlen($_GET['name']) < 1) {
    header('Location: index.php');
    exit();
}

// Handle logout request
if (isset($_POST['logout'])) {
    header('Location: index.php');
    return;
}

// Set up game values
$names = array('Rock', 'Paper', 'Scissors');
$human = isset($_POST["human"]) ? $_POST['human'] + 0 : -1;
$computer = rand(0, 2);

// Determine the result of the game
function check($computer, $human) {
    if ($human == $computer) {
        return "Tie";
    } elseif (
        ($human == 0 && $computer == 2) || 
        ($human == 1 && $computer == 0) || 
        ($human == 2 && $computer == 1)
    ) {
        return "You Win";
    } elseif (
        ($human == 2 && $computer == 0) || 
        ($human == 0 && $computer == 1) || 
        ($human == 1 && $computer == 2)
    ) {
        return "You Lose";
    }
    return false;
}

$result = check($computer, $human);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Abhishek Yadav 58a27eba</title>
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1>Rock Paper Scissors</h1>
    <?php
    if (isset($_GET['name'])) {
        echo "<p>Welcome: " . htmlentities($_GET['name']) . "</p>\n";
    }
    ?>
    <form method="post">
        <select name="human">
            <option value="-1">Select</option>
            <option value="0">Rock</option>
            <option value="1">Paper</option>
            <option value="2">Scissors</option>
        </select>
        <input type="submit" value="Play">
        <input type="submit" name="logout" value="Logout">
    </form>

    <pre>
<?php
if ($human == -1) {
    echo "Please select a strategy and press Play.\n";
} elseif ($human == 3) {
    for ($c = 0; $c < 3; $c++) {
        for ($h = 0; $h < 3; $h++) {
            $r = check($c, $h);
            echo "Human={$names[$h]} Computer={$names[$c]} Result=$r\n";
        }
    }
} else {
    echo "Your Play={$names[$human]} Computer Play={$names[$computer]} Result=$result\n";
}
?>
    </pre>
</div>
</body>
</html>
