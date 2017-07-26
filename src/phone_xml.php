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
foreach ($foundPhone as $r) {

    if ($r->phone == $phone) {
        echo "Found " . $r->firstname . " " . $r->lastname . "<br/>";
        echo "State: " . $r->state . "<br>";
        echo "<hr/>";

        $count++;
    }
}

if ($count === 0) {
    echo "<h1> Could not find any match try again! <h1></h1>";
}
//print_r($xml);


function formatPhone($number)
{
    $number = preg_replace("/[^0-9]/", "", $number);
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $number);
}