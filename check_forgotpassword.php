
<?php
    require("connection.php");
    if (isset($_POST['email'])) {
        $query = $conn->prepare("SELECT * FROM member WHERE email = '" . $_POST['email'] . "'");
        $query->execute();
        echo $query->rowCount();
    }
?>