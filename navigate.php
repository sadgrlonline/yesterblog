<nav>
    <ul>
        <li>
        <?php if (!isset($_SESSION['username'])): ?>
        <a href="/yesterblog/">Home</a>
        <?php else: ?>
        <li><a href="/yesterblog/dashboard/">Home</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/yesterblog/approve/">Approve</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="../submit/">Submit</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/yesterblog/index.php">View</a></li>
        <?php endif?>

        <?php if (!isset($_SESSION['username'])): ?>
        <?php else: ?>
        <li><a href="/yesterblog/edit/">Edit</a></li>
        <?php endif?>
        
            
        </li>
        <li>
            <a href="/yesterblog/list.php">List</a>
        </li>
        <?php if (!isset($_SESSION['username'])): ?>
        <li><a href="/yesterblog/login/">Login</a></li>
        <?php else: ?>
        <li><a href="/yesterblog/logout.php">Logout</a></li>
        <?php endif?>
        </li>
    </ul>
</nav>