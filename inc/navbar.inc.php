<?php require 'permissions/roles.php';

if (isset($_SESSION['role'])) {
    $userArray = $menuItems[$_SESSION["role"]];
} else {
    $userArray = $menuItems['guest'];
}
echo '<nav class="navbar navbar-expand-md navbar-dark bg-dark">';
echo '<a class="navbar-brand" href="index.php?page=home">GreenShift</a>';
echo '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04 aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">"';
echo '<span class="navbar-toggler-icon"></span>';
echo '</button>';
echo '<div class="collapse navbar-collapse" id="navbarsExample04">';


// Linker navbar
echo '<ul class="navbar-nav mr-auto">';
foreach ($userArray as $menuItem) {
    if ($menuItem[2] == 'L') {
        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=' . $menuItem[0] . '"> ' . $menuItem[1] . ' </a></li>';
    }
}
echo '</ul>';


// Rechter navbar
echo '<ul class="navbar-nav form-inline my-2 my-md-0">';
foreach ($userArray as $menuItem) {
    if ($menuItem[2] == 'R') {
        echo '<li class="nav-item"><a class="nav-link" href="index.php?page=' . $menuItem[0] . '">' . $menuItem[1] . '</a></li>';
    }
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</nav>';


?>


