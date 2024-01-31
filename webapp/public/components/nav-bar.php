<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">UW Cyberteam Password Manager</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link">
                    <?php echo "Welcome " . $_COOKIE['authenticated'] ?>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vaults/">Vaults</a>
            </li>
            <?php
            if (isset($_COOKIE['isSiteAdministrator']) && $_COOKIE['isSiteAdministrator'] == true) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/users/">Users</a>
                </li>
                <?php
            }
            ?>
            <?php
            if (isset($_COOKIE['isSiteAdministrator']) && $_COOKIE['isSiteAdministrator'] == true) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/">Admin</a>
                </li>
                <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/logout.php">Logout</a>
            </li>
            <!-- Add more navigation items as needed -->
        </ul>
    </div>
</nav>