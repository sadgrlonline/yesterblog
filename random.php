<h2>More Articles</h2>
<div class="randomFeatures">
<?php 
include "config.php";
$stmt = $con->prepare("SELECT * FROM blogs WHERE approved = 1 ORDER BY rand() LIMIT 3");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {

    $id = $row['id'];
    $name = $row['owner_name'];
    $link = $row['owner_link'];
    $dateposted = $row['dateposted'];
    $title = $row['title'];
    $entry = $row['entry'];
    echo "<div class='feature'>";
    echo "<div class='smTitle'><a href='view.php?entry=" . $id .  "'>" . $title . "</a></div>";
    echo "<p>by <em>" . $name . "</em></p>";
    echo "<p>" . strip_tags(substr($entry, 0, 250)) . "... <a class='readMore'  href='view.php?entry=" . $id .  "'>Read more...</a></p>";
    echo "</div>";
}
$stmt->close();

?>
</div>