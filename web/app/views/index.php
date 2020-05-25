<?php
if (isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
?>

<script src="./public/dist/homepage-bundle.js"></script>
