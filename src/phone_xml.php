<?php
/**
 * XML Database and Search
 *
 * User: deletosh
 * Date: 7/25/17
 * Time: 8:57 PM
 */

/**
 * Build the params
 */
$searchURL = "http://www.infopay.com/phptest_phone_xml.php";
$search2URL = "http://www.infopay.com/phptest.php";

$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);
$areaCode = htmlspecialchars($_POST['areaCode']);
$phoneCode = htmlspecialchars($_POST['phoneCode']);
$phone = formatPhone(htmlspecialchars($_POST['phone']));


$xmlURL = $searchURL . "?username=" . $username . "&password=" . $password . "&areacode=" . $areaCode
    . "&phone=" . $phoneCode;


$xml = simplexml_load_file($xmlURL);

if (!$xml) {
    die("We had an issue loading the URL. Please try again later");
}
$foundPhone = $xml->xpath("/Response/record");

$count = 0;
?>
    <h1>Search Results....</h1>
    <table border="1px">
        <thead>
        <tr>
            <th width="200">Full Name</th>
            <th width="150">State</th>
            <th width="150">View More...</th>
        </tr>
        </thead>

        <tbody>


        <?php
        foreach ($foundPhone

                 as $r) { ?>
            <tr>
                <?php

                if ($r->phone == $phone) {
                    echo "<td>" . $r->firstname . " " . $r->lastname . "</td>";
                    echo "<td>" . $r->state . "</td>";
                    echo "<td><a href=" . $search2URL . "?username=" . $username
                        . "&password=" . $password
                        . "&firstname=" . $r->firstname
                        . "&middle_initials="
                        . "&lastname=" . $r->lastname
                        . "&city="
                        . "&state=" . $r->state
                        . "&client_reference"
                        . "&phone=" . $r->phone
                        . "&housenumber="
                        . "&streetname="
                        . ">details</a></td>";

                    $count++;
                }

                ?>
            <tr/>
            <?php
        }

        if ($count === 0) {
            echo "<tr><strong> Could not find any match  for: <strong>" . $phone . "</strong> try again!</strong></tr>";
        }

        ?>

        </tbody>
    </table>

<?php


function formatPhone($number)
{
    $number = preg_replace("/[^0-9]/", "", $number);
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $number);
}