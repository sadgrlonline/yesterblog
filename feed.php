<?php

include "config.php";


header("Content-type: text/xml"); 

echo "<?xml version='1.0' encoding='UTF-8'?>
<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
<channel>
<atom:link href='https://sadgrl.online/feed.xml' rel='self' type='application/rss+xml' />
<title>Yesterweb Blog</title>
<link>https://blog.yesterweb.org</link>
<description>A collaborative blog about the internet.</description>
<language>en-us</language>"; 

$stmt = $con->prepare("SELECT * FROM blogs WHERE approved = 1 ORDER BY dateposted DESC");
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $title = $row["title"];
    $link = "https://blog.yesterweb.org/view.php?entry=" . $id;
    
    echo "<item><title>" . $title . "</title><link>" . $link . "</link><description>" . $title . "</description></item>";
}
    echo "</channel></rss>";