<?php
$first_name = $middle_name = $last_name = $gender = $preffix = $seven_digit = $email = "";

$first_nameErr = $middle_nameErr = $last_nameErr = $genderErr = $preffixErr = $seven_digitErr = $emailErr = "";

if (isset($_POST["btnRegister"])) {

    if (empty($_POST["first_name"])) {
        $first_nameErr = "First Name is required";
    } else {
        $first_name = $_POST["first_name"];
        
    }

    if (empty($_POST["middle_name"])) {
        $middle_nameErr = "Middle Name is required";
    } else {
        $middle_name = $_POST["middle_name"];
    }

    if (empty($_POST["last_name"])) {
        $last_nameErr = "Last Name is required";
    } else {
        $last_name = $_POST["last_name"];
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = $_POST["gender"];
    }

    if (empty($_POST["preffix"])) {
        $preffixErr = "Preffix is required";
    } else {
        $preffix = $_POST["preffix"];
    }

    if (empty($_POST["seven_digit"])) {
        $seven_digitErr = "Last Name is required";
    } else {
        $seven_digit = $_POST["seven_digit"];
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
    }

    if ($first_name && $middle_name && $last_name && $gender && $preffix && $seven_digit && $email) {

        if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
            $first_nameErr = "Letra lang at space ang kailangan wag kang jejemon!";
        } else {

            $count_first_name_string = strlen($first_name);

            if ($count_first_name_string < 2) {
                $first_nameErr = "Masyadong maiksi ang first name mo kapatid.";
            } else {
                $count_middle_name_string  = strlen($middle_name);

                if ($count_middle_name_string < 2) {
                    $middle_nameErr = "Masyadong maiksi ang  middle name mo kapatid";
                } else {
                    $count_last_name_string = strlen($last_name);

                    if ($count_last_name_string < 2) {
                        $last_nameErr = "Masyadong maiksi ang last name mo kapatid";
                    } else {
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        } else {
                            $count_seven_digit_string = strlen ($seven_digit);
                            if ($count_seven_digit_string < 7) {
                                $seven_digitErr = "brad kulang ana seven digit number mo.";
                            } else {
                                 function random_password ( $length = 5) {
                                    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890";
                                    $shuffled = substr ( str_shuffle ($str) , 0, $length);
                                    return $shuffled;
                                 }
                                 $password = random_password(8);
                                 #Connection
                                 include("connections.php");
                                 mysqli_query($connections, "INSERT INTO tbl_user(first_name, middle_name, last_name, gender, preffix, seven_digit, email, password) 
                                 
                                 VALUES ( '$first_name', '$middle_name','$last_name', '$gender', '$preffix','$seven_digit', '$email', '$password') ");

                                 echo "<script>window.location.href='success.php';</script>";
                            }
                        }
                    }
                }
            }
        }
    }
}


?>

<style>
    .error {
        color: red;
    }
</style>

<script type="application/javascript"> 
    function isNumberKey(evt) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

        return true;
    }
    
</script>

<form method="POST">
    <center>
        <table border="0" width="50%">
            <!--NAME-->
            <tr>
                <td><input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"><span class="error"><?php echo $first_nameErr; ?></span></td>
            </tr>
            <tr>
                <td><input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"><span class="error"><?php echo $middle_nameErr; ?></span></td>
            </tr>
            <tr>
                <td><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"><span class="error"><?php echo $last_nameErr ?></span></td>
            </tr>

            <!--GENDER-->
            <tr>
                <td>
                    <select name="gender">
                        <option name="gender" value="">Select Gender</option>
                        <option name="gender" value="M1ale" <?php if ($gender == "Male") { echo "selected"; } ?>>Male</option>
                        <option name="gender" value="Female" <?php if ($gender == "Female") { echo "selected"; } ?>>Female</option>
                    </select>
                </td>
            </tr>

            <!--Network Provider-->
            <tr>
                <td>
                    <select name="preffix">
                        <option name="preffix" id="preffix" value=""> Network Provided (Globe, Smart, Sun, TNT, TM)</option>

                        <option name="preffix" id="preffix" value="0813" <?php if ($preffix == "0813") { echo "selected"; } ?>> 0813</option>
                        <option name="preffix" id="preffix" value=" 0817" <?php if ($preffix == "0817") {  echo "selected";  } ?>> 0817</option>
                        <option name="preffix" id="preffix" value="0905" <?php if ($preffix == "0905") {  echo "selected"; } ?>> 0905</option>
                        <option name="preffix" id="preffix" value="0906" <?php if ($preffix == "0906") { echo "selected"; } ?>> 0906</option>s
                        <option name="preffix" id="preffix" value="0907" <?php if ($preffix == "0907") {echo "selected";} ?>> 0907</option>

                    </select><span class="error"><?php echo $preffixErr; ?></span>

                    <input type="text" name="seven_digit" value="<?php echo $seven_digit; ?>" maxlength="7" placeholder="Other Seven Digit" onkeypress='return  isNumberKey(event)'><span class="error"><?php echo $seven_digitErr; ?>

                </td>
            </tr>

            <tr>
                <td>
                    <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email"> <span class="error"><?php echo $emailErr; ?></span>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" name="btnRegister" value="Register">
                </td>
            </tr>


        </table>
    </center>

</form>