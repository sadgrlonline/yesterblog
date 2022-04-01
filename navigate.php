<nav>
    <ul>
        <li>
        <a href="/">Home</a>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/approve/">Approve Entries</a></li>
        <li><a href="/approve/topics.php">Approve Topics</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <li><a href="/submit/topic.php">Submit</a></li>
        <?php else: ?>
        <li><a href="/submit/">Submit</a></li>
        <?php endif?>
        
        </li>
        <li>
            <a href="/list.php">List</a>
        </li>
        <li>
            <a href="/about/">About</a>
        </li>
        <?php if (!isset($_SESSION['username'])): ?>
        <li><a href="/login/">Login</a></li>
        <?php else: ?>
        <li><a href="/logout.php">Logout</a></li>
        <?php endif?>
        </li>
    </ul>
    

    
<div class="chooseTheme">
            <label for="themes">Choose a theme</label>
            <select name="themes" id="theme-selector">
                <?php
                include "config.php";
                // SELECT
                $stmt = $con->prepare("SELECT * FROM stylesheets");
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['title'] . "'>" . $row['title'] . "</option>";
                }
                $stmt->close();
                
                ?>
                n>
            </select><br>
            <!--<a class="sm" href="#">Want to create a theme?</a>-->
            </div>
</nav>

