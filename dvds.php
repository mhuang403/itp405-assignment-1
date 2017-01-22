<?php

if (is_null($_GET['title'])) {
    header("Location: index.php");
}

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

$sql="
SELECT title, genre_name, format_name, rating_name
FROM dvds
INNER JOIN genres
ON dvds.genre_id = genres.id
INNER JOIN formats
ON dvds.format_id = formats.id
INNER JOIN ratings
ON dvds.rating_id = ratings.id
WHERE title LIKE ?
";

$statement = $pdo->prepare($sql); // prepared statement
$like = '%' . $_GET['title']. '%';
$statement->bindParam(1, $like);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

if ($statement->rowCount() > 0) {
    echo "You searched for '" . $_GET['title'] . "'.";
} else {
    exit("Nothing was found. Go back to <a href='index.php'>search page</a>.");
}

?>

<?php foreach ($dvds as $dvd) : ?>
    <div>
        <h2><?= $dvd->title ?></h2>
        <p>Genre: <?= $dvd->genre_name ?></p>
        <p>Format: <?= $dvd->format_name ?></p>
        <p>Rating:
            <a href="ratings.php?rating=<?= $dvd->rating_name ?>">
            <?= $dvd->rating_name ?></p>
        </a>
    </div>
<?php endforeach; ?>