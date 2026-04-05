<?php
session_start();

if ( ! isset($_SESSION['name']) ) {
    die("Name parameter missing");
}

$names = array('Rock','Paper','Scissors');

function check($computer, $human) {
    if ( $computer == $human ) return "Tie";

    if ( ($human == 0 && $computer == 2) ||
         ($human == 1 && $computer == 0) ||
         ($human == 2 && $computer == 1) ) {
        return "You Win";
    } else {
        return "You Lose";
    }
}
?>

<html>
<head>
<title>Rock Paper Scissors 6493e35d</title>
</head>
<body>

<h1>Rock Paper Scissors</h1>

<p>Welcome <?= htmlentities($_SESSION['name']) ?></p>

<form method="post">
<select name="play">
<option value="-1">Select</option>
<option value="0">Rock</option>
<option value="1">Paper</option>
<option value="2">Scissors</option>
<option value="3">Test</option>
</select>

<input type="submit" value="Play">
<input type="submit" name="logout" value="Logout">
</form>

<?php
if ( isset($_POST['logout']) ) {
    session_destroy();
    header("Location: index.php");
    return;
}

if ( isset($_POST['play']) ) {

    if ( $_POST['play'] == -1 ) {
        print "Please select a strategy";
    } 
    else if ( $_POST['play'] == 3 ) {
        for($c=0;$c<3;$c++) {
            for($h=0;$h<3;$h++) {
                $r = check($c,$h);
                print "Human=$names[$h] Computer=$names[$c] Result=$r <br>";
            }
        }
    } 
    else {
        $computer = rand(0,2);
        $human = $_POST['play'];

        $result = check($computer, $human);

        print "Your Play=".$names[$human]."<br>";
        print "Computer Play=".$names[$computer]."<br>";
        print "Result=".$result;
    }
}
?>

</body>
</html>
