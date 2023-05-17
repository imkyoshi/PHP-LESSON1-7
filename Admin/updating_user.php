<?php
include("../connections.php");

// Get the "id_user" parameter from the URL
$id_user = $_GET["id_user"];

// Retrieve user record from the database based on the provided id_user
$get_record = mysqli_query($connections, "SELECT * FROM tbl_user WHERE id_user = '$id_user' ");

while ($get = mysqli_fetch_assoc($get_record)) {
    // Store retrieved data into variables for displaying in the form
    $db_first_name = $get["first_name"];
    $db_middle_name = $get["middle_name"];
    $db_last_name = $get["last_name"];
    $db_gender = ucfirst($get["gender"]);
    $db_preffix = $get["preffix"];
    $db_seven_digit = $get["seven_digit"];
    $db_email = $get["email"];
    $db_password = $get["password"];
}

// Initialize variables for the updated values and corresponding error messages
$new_first_name = $new_middle_name = $new_last_name = $new_gender = $new_preffix = $new_seven_digit = $new_email = "";
$new_first_nameErr = $new_middle_nameErr = $new_last_nameErr = $new_genderErr = $new_preffixErr = $new_seven_digitErr = $new_emailErr = "";

// Process the form when the "Update" button is clicked
if (isset($_POST["btnUpdate"])) {
    // Validate and update the values if they are not empty

    // FIRST NAME
    if (empty($_POST["new_first_name"])) {
        $new_first_nameErr = "This field must not be empty!";
    } else {
        $new_first_name = $_POST["new_first_name"];
        $db_first_name = $new_first_name;
    }

    // MIDDLE NAME
    if (empty($_POST["new_middle_name"])) {
        $new_middle_nameErr = "This field must not be empty!";
    } else {
        $new_middle_name = $_POST["new_middle_name"];
        $db_middle_name = $new_middle_name;
    }

    // LAST NAME
    if (empty($_POST["new_last_name"])) {
        $new_last_nameErr = "This field must not be empty!";
    } else {
        $new_last_name = $_POST["new_last_name"];
        $db_last_name = $new_last_name;
    }

    // SEVEN DIGIT
    if (empty($_POST["new_seven_digit"])) {
        $new_seven_digitErr = "This field must not be empty!";
    } else {
        $new_seven_digit = $_POST["new_seven_digit"];
        $db_seven_digit = $new_seven_digit;
    }

    // EMAIL
    if (empty($_POST["new_email"])) {
        $new_emailErr = "This field must not be empty!";
    } else {
        $new_email = $_POST["new_email"];
        $db_email = $new_email;
    }

    // Update the user record if all required fields are filled
    if ($new_first_name && $new_middle_name && $new_last_name && $new_seven_digit && $new_email) {
        $query = "UPDATE tbl_user SET
            first_name = '$db_first_name',
            middle_name = '$db_middle_name',
            last_name = '$db_last_name',
            gender = '$db_gender',
            preffix = '$db_preffix',
            seven_digit = '$db_seven_digit',
            email = '$db_email'
            WHERE id_user = '$id_user'";

        mysqli_query($connections, $query);

        // Generate a random string for encryption and redirect to the updated record view
        $encrypted = md5(rand(1, 9));
        echo "<script>window.location.href='ViewRecord.php?$encrypted&&notify=Record has been updated!';</script>";
    }
}
?>

<style>
    .error {
        color: red;
    }
</style>

<center>
    <br>
    <br>
    <br>
    <form method="POST">
        <table border="0" width="50%">
            <!-- FIRST NAME -->
            <tr>
                <td>
                    <input type="text" name="new_first_name" value="<?php echo $db_first_name; ?>">
                    <span class="error"><?php echo $new_first_nameErr; ?></span>
                </td>
            </tr>
            <!-- MIDDLE NAME -->
            <tr>
                <td>
                    <input type="text" name="new_middle_name" value="<?php echo $db_middle_name; ?>">
                    <span class="error"><?php echo $new_middle_nameErr; ?></span>
                </td>
            </tr>
            <!-- LAST NAME -->
            <tr>
                <td>
                    <input type="text" name="new_last_name" value="<?php echo $db_last_name; ?>">
                    <span class="error"><?php echo $new_last_nameErr; ?></span>
                </td>
            </tr>
            <!-- GENDER -->
            <tr>
                <td>
                    <select name="new_gender">
                        <option value="Male" <?php if ($db_gender == "Male") {
                                                    echo "selected";
                                                } ?>>Male</option>
                        <option value="Female" <?php if ($db_gender == "Female") {
                                                    echo "selected";
                                                } ?>>Female</option>
                    </select>
                    <span class="error"><?php echo $new_genderErr; ?></span>
                </td>
            </tr>
            <!-- PREFIX -->
            <tr>
                <td>
                    <select name="new_preffix">
                        <option value="0813" <?php if ($db_preffix == "0813") {
                                                    echo "selected";
                                                } ?>>0813</option>
                        <option value="0817" <?php if ($db_preffix == "0817") {
                                                    echo "selected";
                                                } ?>>0817</option>
                        <option value="0905" <?php if ($db_preffix == "0905") {
                                                    echo "selected";
                                                } ?>>0905</option>
                        <option value="0906" <?php if ($db_preffix == "0906") {
                                                    echo "selected";
                                                } ?>>0906</option>
                        <option value="0907" <?php if ($db_preffix == "0907") {
                                                    echo "selected";
                                                } ?>>0907</option>
                    </select>
                    <span class="error"><?php echo $new_preffixErr; ?></span>
                    &nbsp;
                    <input type="text" name="new_seven_digit" value="<?php echo $db_seven_digit; ?>">
                    <span class="error"><?php echo $new_seven_digitErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="new_email" value="<?php echo $db_email; ?>">
                    <span class="error"><?php echo $new_emailErr; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="btnUpdate" value="Update" class="btn-primary"></td>
            </tr>
        </table>
    </form>
</center>