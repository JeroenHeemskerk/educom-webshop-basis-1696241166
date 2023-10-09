
    <?php

    function  showContactContent(){
        $data = validateContact();
        if (!$data['valid']) { 
            showContactForm($data);
        } else{
            showContactThanks($data);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validateContact() {
        // initate the variables 
        $salutation = $name = $email = $phonenumber = $comm_preference = $message = '';
        $salutationErr = $nameErr = $emailErr = $phonenumberErr = $comm_preferenceErr = $messageErr = '';
        $valid = false;



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // validate for the 'POST' data
            if (empty($_POST["salutation"])) {
                $salutationErr = "*Salutation is required";
            } else {
                $salutation = test_input($_POST["salutation"]);
            }

            if (empty($_POST["name"])) {
                $nameErr = "*Name is required";
            } else {
                $name = test_input($_POST["name"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                    $nameErr = "*Only letters and white space allowed";
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "*Email is required";
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "*Invalid email format";
                }
            }

            if (empty($_POST["phonenumber"])) {
                $phonenumberErr = "*Phonenumber is required";
            } else {
                $phonenumber = test_input($_POST["phonenumber"]);
            }

            if (empty($_POST["comm_preference"])) {
                $comm_preferenceErr = "*Communication preference is required";
            } else {
                $comm_preference = test_input($_POST["comm_preference"]);
            }

            if (empty($_POST["message"])) {
                $messageErr = "*Message is required";
            } else {
                $message = test_input($_POST["message"]);
            }


            if (empty($salutationErr) && empty($nameErr) && empty($emailErr) && empty($phonenumberErr) && empty($comm_preferenceErr) && empty($messageErr)) {
                $valid = true;
            } else {
                $valid = false;
            }
        }
        return ["messageErr"=> $messageErr, "phonenumberErr"=> $phonenumberErr, "emailErr" => $emailErr, "nameErr" => $nameErr,"salutationErr"=> $salutationErr, "valid"=> $valid, "name" => $name, "phonenumber"=> $phonenumber, "email"=> $email];
    }
   
    function showContactForm($data) {
           
           echo '<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>
                <select name="salutation" id="salutation">
                    <option value="mr" <?php if (isset($salutation) && $salutation=="mr") echo "selected";?>Dhr.</option>
                    <option value="mrs" <?php if (isset($salutation) && $salutation=="mrs") echo "selected";?>Mevr.</option>
                </select> </br>
                <span class="error">'; echo $data['salutationErr'] . '</span></br></br>

                <label for="name">Naam:</label>
                <input type="text" name="name" id="name" value="'. $data['name'] . '"></br>
                <span class="error">' . $data['nameErr'] . '</span>
                <br><br>

                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="'. $data['email'] . '"></br>
                <span class="error">' . $data['emailErr'] . '</span>
                <br><br>

                <label for="phonenumber">Telefoonnummer:</label>
                <input type="text" name="phonenumber" id="phonenumber" value="'. $data['phonenumber'] . '"></br></br>
                <span class="error">' . $data['phonenumberErr'] . '</span>
                <br><br>

                <label for="comm_preference">Communicatievoorkeur:</label>
                
                <input type="radio" name="comm_preference" id="communication_email" <?php if (isset($comm_preference) && $comm_preference=="email") echo "checked";?> value="email">
                <label for="email">Email</label>
                
                <input type="radio" name="comm_preference" id="communication_phone" <?php if (isset($comm_preference) && $comm_preference=="phone") echo "checked";?> value="phone">
                <label for="phone">Telefoon</label></br>
                
                <span class="error"> <?php echo $comm_preferenceErr; ?></span></br></br>

                <label for="message">Contact:</label></br>
                <textarea name="message" id="contact" cols="40" rows="5" placeholder="Schrijf hier je bericht">' . $data['messageErr'] . '</textarea></br>
                <span class="error">' . $data['messageErr'] . '</span>
                <br><br>

                <button>Verzenden</button>
            </form>';
    }


 function showContactThanks($data){

    echo ' <p>Bedankt voor uw reactie:</p>
     
     <div>Name: <?php echo $salutation ." ". $name; ?></div>
     <div>Email: <?php echo $email; ?></div>
     <div>Phonenumber: <?php echo $phonenumber; ?></div>
     <div>Communication preference: <?php echo $comm_preference; ?></div>
     <div>Your message: <?php echo $message; ?></div>';
    }
     