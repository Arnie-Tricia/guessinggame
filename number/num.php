<?php
//para makapag save ng info. like numbers of guesses
session_start();

$secretNumber = 7; 
$maxAttempts = 3; //number ng attemps


//first magiinitialize tayo ng attempt
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 1; //chinecheck if the user is nakapag attempt na
}


//form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guess = $_POST['guess']; 
    $_SESSION['attempts']++;


    //chinecheck niya yung guess if correct or wrong
    if ($guess == $secretNumber) {
        echo "<p>Korique ka dyarn!</p>";
        session_destroy(); 
    } else {
      
        if ($_SESSION['attempts'] >= $maxAttempts) {
            echo "<p>Sarreh! Ubos na life mo, beh. The secret number was $secretNumber.</p>";
            session_destroy(); 
        } else {
            echo "<p>No, you're wrong!!! Try again hmp.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guessing Game</title>
</head>
<body>
    <h1>Guess the Secret Number</h1>

    <?php if (!isset($_SESSION['attempts']) || $_SESSION['attempts'] < $maxAttempts): ?>
        <form method="POST" action="">
            <label for="guess">Enter your guess (1-10): </label>
            <input type="number" name="guess" min="1" max="10" required autofocus>
            <button type="submit">Submit Guess</button>
        </form>
    <?php endif; ?>
    
    <p>Attempts: <?php echo $_SESSION['attempts']; ?>/<?php echo $maxAttempts; ?></p>

    <?php if (isset($_SESSION['attempts']) && $_SESSION['attempts'] >= $maxAttempts): ?>
        <p>Awat na, ubos na attempts. Pa-refresh na lang to try again thxxx.</p>
    <?php endif; ?>
</body>
</html>
