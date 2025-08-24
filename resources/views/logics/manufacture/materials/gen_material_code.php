<?php
$host = '167.71.226.93'; // e.g., localhost
$dbname = 'suku_portal_data';
$username = 'tGaUfvcE7Q5xqNrzP2XpC3yYjsZMeDBd';
$password = 'XQDZ7vGy2m96Vce5LwnuzTaFP4YJ3BAN';

$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Database connection failed: " . $mysqli->connect_error);
}

$groupid = $_POST['selectedType'];

try {
    // Fetch all rows from the 'users' table
    $query = "SELECT * FROM `tblitems` WHERE `group_id`='$groupid' ORDER BY id DESC LIMIT 1";
    $result = $mysqli->query($query);
    // Do something with the fetched data (e.g., display it)
    $row = $result->fetch_assoc();

    // Check if the query was successful
    if ($result) {

        $currentCCode = $row['commodity_code'];
        //echo $currentCCode;

        // Split the string using the '-' character as the delimiter
        $alphabetseries = explode('-', $currentCCode);

        $groupcode =  isset($alphabetseries[0]) ? $alphabetseries[0] : null;
        //echo nl2br("\n".$groupcode);

        // Get the first letter after the '-' character
        $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;
        //echo nl2br("\n".$getalphabetseries);

        // Get the last 3 digits from the $currentCCode
        $last4Digits = substr($currentCCode, -3);
        //echo nl2br("\nLast 3 Digits: ".$last4Digits);

        // Check if the last 3 digits are "999"
        if ($last4Digits === '999') {

            $alphabet = isset($alphabetseries[1]) ? $alphabetseries[1][0] : '';
            //echo nl2br("\nAlphabet: ".$alphabet);

            // Increment the alphabet to the next one
            if (preg_match('/^[A-Z]+$/', $alphabet)) {
                // Convert the alphabet to an array of characters
                $characters = str_split($alphabet);

                // Find the index of the first non-'Z' character from the right
                $index = count($characters) - 1;
                while ($index >= 0 && $characters[$index] === 'Z') {
                    $characters[$index] = 'A';
                    $index--;
                }

                // If all characters are 'Z', prepend 'A'
                if ($index === -1) {
                    array_unshift($characters, 'A');
                } else {
                    // Increment the first non-'Z' character
                    $characters[$index] = ++$characters[$index];
                }

                // Convert the array of characters back to a string
                $nextAlphabet = implode('', $characters);

                // Replace the alphabet in the $currentCCode with the next alphabet
                // Prepare the updated CCode by combining the prefix, alphabet, and incremented number
                $updatedCCode = $groupcode . '-' . $nextAlphabet . '001';
                
                echo $updatedCCode;

            } else {
                echo "Invalid format of CCode after '-'.";
            }
        } else {
        
            $groupcode = isset($alphabetseries[0]) ? $alphabetseries[0] : null;
            //echo nl2br("\n".$groupcode);

            // Get the first letter after the '-' character
            $getalphabetseries = isset($alphabetseries[1]) ? $alphabetseries[1][0] : null;
            //echo nl2br("\n".$getalphabetseries);

            // Extract the numeric part from the end of the string (last 3 digits)
            $last4Digits = substr($currentCCode, -3);
            //echo nl2br("\n".$last4Digits);

            // Convert the numeric part to an integer and increment by 1
            $incrementedNumber = (int)$last4Digits + 1;
            //echo nl2br("\n".$incrementedNumber);

            // Pad the incremented number with leading zeros to maintain the 4-digit format
            $paddedIncrementedNumber = str_pad($incrementedNumber, 3, '0', STR_PAD_LEFT);
            //echo nl2br("\n".$paddedIncrementedNumber);

            // Prepare the updated CCode by combining the prefix, alphabet, and incremented number
            $updatedCCode = $groupcode . '-' . $getalphabetseries . $paddedIncrementedNumber;

            // Display the updated CCode
            echo $updatedCCode;
        }

        // Free the result set
        $result->free();
    } else {
        echo "Error executing the query: " . $mysqli->error;
    }
} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>