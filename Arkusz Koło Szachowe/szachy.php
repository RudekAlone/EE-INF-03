<?php

$con = new mysqli("localhost", "root", "", "szachy");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $con->connect_error;
    exit();
}

function skrypt1($con){
    $sql = "SELECT zawodnicy.pseudonim, zawodnicy.tytul, zawodnicy.ranking, zawodnicy.klasa FROM zawodnicy WHERE zawodnicy.ranking > 2787 ORDER BY zawodnicy.ranking DESC;";

    $result = mysqli_query($con, $sql);
    $numer_pozycji = 1;
   while($row = mysqli_fetch_row($result)) {
        echo "<tr>";
        echo "<td>" . $numer_pozycji++ . "</td>";
        echo "<td>" . $row[0] . "</td>";
        echo "<td>" . $row[1] . "</td>";
        echo "<td>" . $row[2] . "</td>";
        echo "<td>" . $row[3] . "</td>";
        echo "</tr>";
    }
}

function skrypt2($con){
    $sql = "SELECT zawodnicy.pseudonim, zawodnicy.klasa FROM zawodnicy ORDER BY RAND() LIMIT 2;";

    $result = mysqli_query($con, $sql);

    echo "<h4>";
    while($row = mysqli_fetch_row($result)) {
        
        echo $row[0] . " ". $row[1] . " ";
    }
    echo "</h4>";
}


?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KOŁO SZACHOWE</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h2>Koło szachowe <em>gambit piona</em></h2>
    </header>
    <section id="lewy">
        <h4>Polecane linki</h4>
        <ul>
            <li><a href="../kw1.png">kwerenda 1</a></li>
            <li><a href="../kw2.png">kwerenda 2</a></li>
            <li><a href="../kw3.png">kwerenda 3</a></li>
            <li><a href="../kw4.png">kwerenda 4</a></li>
        </ul>
        <img src="./logo.png" alt="Logo koła">
    </section>
    <section id="prawy">
        <h3>Najlepsi gracze naszego koła</h3>
        <table>
            <thead>
                <tr>
                    <th>Pozycja</th>
                    <th>Pseudonim</th>
                    <th>Tytuł</th>
                    <th>Ranking</th>
                    <th>Klasa</th>
                </tr>
            </thead>
            <tbody>
                <?php skrypt1($con); ?>
            </tbody>
        </table>
        <form >
            <button>Losuj nową parę graczy</button>
            <?php skrypt2($con); ?>
        </form>
        <p>Legenda: AM - Absolutny Mistrz, SM - Szkolny Mistrz, PM - Mistrz Poziomu, KM - Mistrz Klasowy</p>
    </section>
    <footer><p>Stronę wykonał: 2137</p></footer>
</body>
</html>

<?php
mysqli_close($con);
?>