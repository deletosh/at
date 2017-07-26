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


// Setup PDO Connection


?>
<h1>Search Results....</h1>
<table border="1px">
    <thead>
    <tr>
        <th width="200">Full Name</th>
        <th width="150">State</th>
    </tr>
    </thead>

    <tbody>


    <?php
    foreach ($foundPhone

             as $r) { ?>
        <tr>
            <?php

            if ($r->phone == $phone) {
                echo "<td><a class='more'  href=" . $search2URL . "?username=" . $username
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
                    . ">"
                    . $r->firstname . " " . $r->lastname . "</a></td>";
                echo "<td>" . $r->state . "</td>";


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
if ($count === 1) {
    echo "<h2>We found only 1 Match</h2>";
}
?>

<div class="results">
    <hr/>
    <h3>More details...</h3>
    <p>Some data</p>
</div>
<?php


function formatPhone($number)
{
    $number = preg_replace("/[^0-9]/", "", $number);
    return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $number);
}

?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
    $(function () {

        $('.results').hide();

        $('.more').click(function (e) {
            $('.results').hide();
            $('.results .appended').remove();

            e.preventDefault();
            var requestUrl = $(this).attr('href');

            $.ajax({
                'url': requestUrl,
                'type': 'GET',
                beforeSend: function () {
                    console.log('sending');
                },
                error: function () {
                    console.log('Error -- nothing to get');
                },
                'success': function (data) {
                    $('.results').append("<div class='appended'>" + data + "</div>");
                    $('.results').slideDown();
                }
            });
        });
    });
</script>
