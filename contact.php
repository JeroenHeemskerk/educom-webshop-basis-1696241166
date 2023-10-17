
<?php

function getContactData()
{
    // initate the variables 
    $contactData = ["page" => "contact", "salutation" => " ", "name" => "", "email" => "", "phonenumber" => "", "comm_preference" => "", "message" => "", "salutationErr" => "", "nameErr" => "", "emailErr" => "", "phonenumberErr" => "", "comm_preferenceErr" => "", "messageErr" => "", "valid" => false];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $contactData = validateContact($contactData);
    }
    return $contactData;
}

function showContactContent($pageData)
{
    if (!$pageData['valid']) {
        showContactForm($pageData);
    } else {
        showContactThanks($pageData);
    }
}

function showContactForm($contactData)
{
    echo '<form method="POST" action="index.php">
                <select name="salutation" id="salutation">
                    <option value="mr"';
    if (isset($contactData['salutation']) && $contactData['salutation'] == "mr") echo "selected";
    echo '>' . 'Dhr.</option>
                    <option value="mrs"';
    if (isset($contactData['salutation']) && $contactData['salutation'] == "mrs") echo "selected";
    echo '>' . 'Mevr.</option>
                </select> </br>
                <span class="error">';
    echo $contactData['salutationErr'] . '</span></br></br>

                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="' . $contactData['name'] . '"></br>
                <span class="error">' . $contactData['nameErr'] . '</span>
                <br><br>

                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="' . $contactData['email'] . '"></br>
                <span class="error">' . $contactData['emailErr'] . '</span>
                <br><br>

                <label for="phonenumber">Phonenumber:</label>
                <input type="text" name="phonenumber" id="phonenumber" value="' . $contactData['phonenumber'] . '"></br></br>
                <span class="error">' . $contactData['phonenumberErr'] . '</span>
                <br><br>

                <label for="comm_preference">Communication preference:</label>
                
                <input type="radio" name="comm_preference" id="communication_email"';
    if (isset($contactData['comm_preference']) && $contactData['comm_preference'] == "email") echo "checked";
    echo ' value="email">
                <label for="email">Email</label>
                
                <input type="radio" name="comm_preference" id="communication_phone"';
    if (isset($contactData['comm_preference']) && $contactData['comm_preference'] == "phone") echo "checked";
    echo ' value="phone">
                <label for="phone">Phone</label></br>
                
                <span class="error">';
    echo $contactData['comm_preferenceErr'] . '</span></br></br>

                <label for="message">Message:</label></br>
                <textarea name="message" id="contact" cols="40" rows="5" placeholder="Type your message here">' . $contactData['message'] . '</textarea></br>
                <span class="error">' . $contactData['messageErr'] . '</span>
                <br><br>

                <input hidden name="page" value="contact"></input>

                <button type="submit">Submit</button>
            </form>';
}


function showContactThanks($contactData)
{

    echo ' <p>Bedankt voor uw reactie:</p>
     
     <div>Name:' . $contactData['salutation'] . " " . $contactData['name'] . '</div>
     <div>Email:' . $contactData['email'] . '</div>
     <div>Phonenumber:' . $contactData['phonenumber'] . '</div>
     <div>Communication preference:' . $contactData['comm_preference'] . '</div>
     <div>Your message:' . $contactData['message'] . '</div>';
}
