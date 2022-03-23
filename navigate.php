<nav>
    <ul>
        <li>
        <a href="/yesterblog/">Home</a>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/yesterblog/approve/">Approve</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/yesterblog/submit/">Submit</a></li>
        <?php endif?>

        
            
        </li>
        <li>
            <a href="/yesterblog/list.php">List</a>
        </li>
        <li>
            <a href="/yesterblog/about/">About</a>
        </li>
        <?php if (!isset($_SESSION['username'])): ?>
        <li><a href="/yesterblog/login/">Login</a></li>
        <?php else: ?>
        <li><a href="/yesterblog/logout.php">Logout</a></li>
        <?php endif?>
        </li>
    </ul>
</nav>