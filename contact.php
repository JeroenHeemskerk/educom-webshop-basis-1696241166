
<?php

include('common-functions.php');

    function  showContactContent(){
        $data = validateContact();
        if (!$data['valid']) { 
            showContactForm($data);
        } else{
            showContactThanks($data);
        }
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
        return ["comm_preferenceErr"=> $comm_preferenceErr, "messageErr"=> $messageErr, "phonenumberErr"=> $phonenumberErr, "emailErr" => $emailErr, "nameErr" => $nameErr,"comm_preference"=> $comm_preference, "salutationErr"=> $salutationErr, "valid"=> $valid, "name" => $name, "phonenumber"=> $phonenumber, "email"=> $email, "salutation"=> $salutation, "message"=> $message];
    }
   
    function showContactForm($data) {
           echo '<form method="POST" action="index.php">
                <select name="salutation" id="salutation">
                    <option value="mr"'; if (isset($data['salutation']) && $data['salutation']=="mr") echo "selected"; echo '>' . 'Dhr.</option>
                    <option value="mrs"'; if (isset($data['salutation']) && $data['salutation']=="mrs") echo "selected"; echo '>' . 'Mevr.</option>
                </select> </br>
                <span class="error">'; echo $data['salutationErr'] . '</span></br></br>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="'. $data['name'] . '"></br>
                <span class="error">' . $data['nameErr'] . '</span>
                <br><br>

                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="'. $data['email'] . '"></br>
                <span class="error">' . $data['emailErr'] . '</span>
                <br><br>

                <label for="phonenumber">Phonenumber:</label>
                <input type="text" name="phonenumber" id="phonenumber" value="'. $data['phonenumber'] . '"></br></br>
                <span class="error">' . $data['phonenumberErr'] . '</span>
                <br><br>

                <label for="comm_preference">Communication preference:</label>
                
                <input type="radio" name="comm_preference" id="communication_email"' ; if (isset($data['comm_preference']) && $data['comm_preference']=="email") echo "checked"; echo ' value="email">
                <label for="email">Email</label>
                
                <input type="radio" name="comm_preference" id="communication_phone"'; if (isset($data['comm_preference']) && $data['comm_preference']=="phone") echo "checked"; echo' value="phone">
                <label for="phone">Phone</label></br>
                
                <span class="error">'; echo $data['comm_preferenceErr'] . '</span></br></br>

                <label for="message">Message:</label></br>
                <textarea name="message" id="contact" cols="40" rows="5" placeholder="Type your message here">' . $data['message'] . '</textarea></br>
                <span class="error">' . $data['messageErr'] . '</span>
                <br><br>

                <input hidden name="page" value="contact"></input>

                <button type="submit">Submit</button>
            </form>';
    }


 function showContactThanks($data){

    echo ' <p>Bedankt voor uw reactie:</p>
     
     <div>Name:' . $data['salutation'] ." ". $data['name'] . '</div>
     <div>Email:' . $data['email'] .'</div>
     <div>Phonenumber:' . $data['phonenumber'] . '</div>
     <div>Communication preference:' . $data['comm_preference'] . '</div>
     <div>Your message:' . $data['message'] .'</div>';
    }
     