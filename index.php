<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infopay Phone Search</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
  <body>
    <div class="grid-container">
       <h1>Infopay Phone Search</h1>
        <form action="src/phone_xml.php" method="POST">
            <div class="row">
                <div class="medium-6 columns">
                    <label>Username
                        <input type="text" name="username" value="accucomtest"/>
                    </label>
                </div><div class="medium-6 columns">
                    <label>Password
                        <input type="password" name="password" value="test104"/>
                    </label>
                </div><div class="medium-6 columns">
                    <label>Area Code
                        <input type="text" name="areaCode" value="386"/>
                    </label>
                </div>
                <div class="medium-6 columns">
                    <label>Phone Code
                        <input type="text" name="phoneCode" value="7540455"/>
                    </label>
                </div>
                <div class="medium-6 columns">
                    <label>Phone Number
                        <input type="text" name="phone" placeholder="Enter Phone Number"/>
                    </label>
                </div>

                <div class="medium-6 columns">
                    <label>
                         <input type="submit" value="Search" class="button success big">
                    </label>
                </div>
            </div>
        </form>
    </div>




    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
