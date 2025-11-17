<?php
header('refresh: 10;');

$polonczenie = mysqli_connect("localhost","root","","opony");

if(mysqli_error($polonczenie)) {
    echo "Nie udało się połączyć z bazą danych";
    exit();
}

function dziesiecNajtanszychOpon($polonczenie){
    $wynik = mysqli_query($polonczenie, 'SELECT * FROM opony ORDER by cena ASC LIMIT 10;');

    while($row = mysqli_fetch_row($wynik)){
        echo "<div class='opona'>";
        if($row[3] == 'letnia'){
            echo "<img src='./lato.png' alt='Opona letnia'>";
        } else if($row[3] == 'zimowa'){
            echo "<img src='./zima.png' alt='Opona zimowa'>";
        } else if($row[3] == 'uniwersalna'){
            echo "<img src='./uniwer.png' alt='Opona uniwersalna'>";
        }
        echo "<h4>Opona:" . $row[1] . " " . $row[2] . "</h4>";
        echo "<h3>Cena: " . $row[4] . "</h3>";
        echo "</div>";
    }
}


//SELECT producent, model, sezon, cena FROM opony WHERE opony.nr_kat=9;

function wyswietlOferteDnia($polonczenie){
    $wynik = mysqli_query($polonczenie, 'SELECT producent, model, sezon, cena FROM opony WHERE opony.nr_kat=9;');
    $row =mysqli_fetch_row($wynik);
    echo "<h2>" . $row[0] . " model " . $row[1] . "</h2>";
    echo "<h2>Sezon: " . $row[2] . "</h2>";
    echo "<h2>Tylko: " . $row[3] . " zł!</h2>";

}

function losoweZamowienie($polonczenie)   {
    $wynik =mysqli_query($polonczenie,'SELECT id_zam, ilosc, model, cena FROM zamowienie 
LEFT JOIN opony ON zamowienie.nr_kat=opony.nr_kat 
ORDER BY RAND() 
LIMIT 1;');
    $row =mysqli_fetch_row($wynik);
echo "<h2>". $row[0] ." ". $row[1] . " sztuki modelu ". $row[2] . "</h2>";
echo "<h2>Wartość zamowienia:" . $row[3] * $row[1] . "zł". "</h2>";


    }   









?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPONY</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>
    <main>
        <aside>
            <?php
            dziesiecNajtanszychOpon($polonczenie);

            ?>
            <p>
                <a href="https://opna.pl">więcej ofert</a>
            </p>
        </aside>
        <section>
            <img src="./opona.png" alt="Opona">
            <h2>Opona dnia</h2>
            <?php
            wyswietlOferteDnia($polonczenie);
            ?>
        </section>
        <section>
            <h2>Najnowsze zamówienia</h2>
            <?php
            losoweZamowienie($polonczenie)
            ?>
        </section>
    </main>
    <footer>
        <p>Stronę wykonał: 2137</p>
    </footer>

</body>
</html>

<?php
mysqli_close($polonczenie);
?>