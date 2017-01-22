<?php

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

$connection = mysqli_connect($host, $username, $password, $database_name);

$rating = $_GET['rating'];

$sql="
SELECT title, genre_name, format_name, rating_name
FROM dvds
INNER JOIN genres
ON dvds.genre_id = genres.id
INNER JOIN formats
ON dvds.format_id = formats.id
INNER JOIN ratings
ON dvds.rating_id = ratings.id
WHERE rating_name ='$rating'"
;

$dvds = mysqli_query($connection, $sql);
?>

<?php echo "<h2>All " . $_GET['rating'] . "-rated movies"; ?></h2>

<?php while ($dvd = mysqli_fetch_array($dvds)) : ?>

    <li>
        <?= $dvd['title']; ?>
    </li>
<?php endwhile; ?>