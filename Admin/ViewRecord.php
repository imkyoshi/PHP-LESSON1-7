<?php
session_start();
include("../connections.php");
include("nav.php");
?>

<script type="application/javascript"> </script>
<script type="application/javascript">
    setInterval(function() {
        $('#retriever').load('retriever.php');

    }, 1000);
</script>

<!-- DELETE -->
<?php
if (empty($_GET["getDelete"])) {
} else {
    include("confirm_delete.php");
}
?>

<!-- UPDATE-->
<?php
if (empty($_GET["getUpdate"])) {
?>

    <div id="retriever">
        <?php include("retriever.php"); ?>
    </div>


<?php
} else {
    include("updating_user.php");
}

// NOTIFY
if (empty($_GET["notify"])) {
} else {
    echo "<font color='green'><h3><center>" . $_GET["notify"] . "</center></h3></font>";
}


?>