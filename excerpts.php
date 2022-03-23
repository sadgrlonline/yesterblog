<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css">
      
    </head>
    <body>
    <?php
    session_start();
    include 'navigate.php' 
    ?>
        <div class="container">
        <h1>Yesterblog</h1>
                   <p>A collaborative blog about the past, present and future of the internet. </p>
                   <p>You can subscribe via RSS <a href="feed.php">here</a>.</p>
            <div class="flex">
            <div class="wrapper">

                        <?php
                        include "config.php";

                        date_default_timezone_set("US/Eastern");

                        $stmt = $con->prepare("SELECT * FROM blogs WHERE approved = 1 ORDER BY id DESC");
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['owner_name'];
                            $link = $row['owner_link'];
                            $dateposted = $row['dateposted'];
                            $title = $row['title'];
                            $entry = $row['entry'];
                            $formattedDate = date("l, F j, Y", strtotime($dateposted));
                            //echo $id, $bowner, $dateposted, $timeposted, $title, $entry, $likes;
                            echo '<div class="blog">';
                            echo '<div class="title"><h2>' . $title . '</h2></div>';
                            echo '<div class="whoWhen">Posted on <span class="date">' . $formattedDate . '</span>';
                            echo '<span class="author"> by <a href="' . $link . '">' . $name . '</a></span></div>';
                            echo '<div class="post">' . substr($entry, 0, 350) . '... <a href="view.php?entry=' . $id . '">Read more...</a></div>';
                            echo '</div></div>';

                        }
                        $stmt->close();
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="sidebar"><? include "sidebar.php" ?>
                    </div>
        </div></div>
    </body>
</html>
<style>
    .fa-solid {
        font-family:'Font Awesome 6 Free';
    }
</style>
<script>

var random;


$('#surf').on("click", function(e) {
    e.preventDefault();
    random = Math.floor(Math.random() * urlArr.length);
    console.log(shuffle(urlArr));
    window.open(shuffle(urlArr)[0]);
    shuffle(urlArr[0].pop());
});

// this puts all of the entries in a random order
function shuffle(urlArr) {
    let currentIndex = urlArr.length, randomIndex;

    // while there are items left to shuffle...
    while (currentIndex != 0) {
        // pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        // decrease
        currentIndex--;

        // swap with current element
        [urlArr[currentIndex], urlArr[randomIndex]] = [urlArr[randomIndex], urlArr[currentIndex]];
    }
    return urlArr;
}
var firstClick = 0;
$('input[type=checkbox]').on("change", function() {
    if (firstClick !== 1) {
    //$('tbody').css('display', 'none');
    firstClick = 1;
    

    if ($(this).prop("checked") == true) {
        console.log('checked');
        var cat = $(this).val();
        console.log($(this).val());
        $('.' + cat).css("display", "table-row");
    } else if ($(this).prop("checked") == false) {
        console.log('unchecked');
        var removeCat = $(this).val();
        $('.' + removeCat).css("display", "none");
    }
    // if not first click...
} else {
    //$(this).css("display", "none");
    if ($(this).prop("checked") == true) {
        console.log('checked');
        var cat = $(this).val();
        console.log($(this).val());
        $('.' + cat).css("display", "table-row");
    } else if ($(this).prop("checked") == false) {
        console.log('unchecked');
        var removeCat = $(this).val();
        $('.' + removeCat).css("display", "none");
    }
}

});
fetch("https://webring.yesterweb.org/webring.json")
  .then(function (response) {
    return response.json();
  })
  .then(function (data) {
    appendData(data);
  })
  .catch(function (err) {
    console.log("error: " + err);
  });

function appendData(data) {
  
var random = Math.floor(Math.random() * data.length);
  
  var name = data[random].name;
  var url = data[random].url;
  var owner = data[random].owner;
  
  console.log(name, url, owner);
  $('.webringRand').append("<a href='" + url + "' target='_blank'>" + name + "</a>");
  
}
</script>

