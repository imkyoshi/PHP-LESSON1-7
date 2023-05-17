<?php
if (isset($_POST["btn_1"])) {
    echo "Napindot ko na ang first button";
}
if (isset($_POST["btn_2"])) {
    echo "Napindot ko na ang second button";
}
if (isset($_POST["btn_3"])) {
    echo "Napindot ko na ang third button";
}
if (isset($_POST["btn_4"])) {
    echo "Napindot ko na ang fourth button";
}
?>
<form method="POST">
    <input type="submit" name="btn_1" value="1st Button">
    <input type="submit" name="btn_2" value="2nd Button">
    <input type="submit" name="btn_3" value="3rd Button">
    <input type="submit" name="btn_4" value="4th Button">
</form>