<?php
    session_start();
    require_once('php/classes/Hash.class.php');
    if (isset($_SESSION)) {
        $session = $_SESSION;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HashGenerator</title>
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="js/showsalt.js"></script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>HashGenerator</h1>
            </div>
            <div class="border"></div>
            <div id="formcontainer">
                <form method="POST" action="php/processing/indexProcessing.php">
                    <p>String to hash <input type="text" name="stringToHash" size="46"<?php if (isset($session['stringToHash'])) { echo 'value="' . $session['stringToHash'] . '"'; } ?>></p>
                    <p>Use salt? <input type="checkbox" name="saltCheckbox" value="salt"></p>
                    <div id="salt">
                        <p>Salt <input type="text" name="salt" size="55"></p>
                        <p>Place salt at <input type="radio" name="placeSaltAt" value="beginning" checked>beginning <input type="radio" name="placeSaltAt" value="end">end</p>
                    </div>
                    <div id="algorithm">
                        <p>Hashing algorithm
                            <select name="algorithm">
                                <?php
                                $hashObj = new Hash();
                                $algorithms = $hashObj->getAllArrays();
                                foreach ($algorithms as $algorithm) {
                                    while (list($key, $value) = each($algorithm)) {
                                        if (!isset($session['algorithm']) && $key == $hashObj->getDefaultAlgorithm()) {
                                            echo '<option selected="selected" value="' . $key . '">' . $value . '</option>';
                                        } else if (isset($session['algorithm']) && $key == $session['algorithm']) {
                                            echo '<option selected="selected" value="' . $key . '">' . $value . '</option>';
                                        } else {
                                            echo '<option value="' . $key . '">' . $value . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </p>
                    </div>
                    <div class="button">
                        <p><input type="submit" value="Hash string"></p>
                    </div>
                </form>
            </div>
            <div class="border"></div>
            <div id="result">
                <p>Result</p>
                <?php
                    echo '<textarea>';

                        if(isset($session['hash'])) {
                            echo $session['hash']; 
                        }

                    echo '</textarea>';
                ?>
            </div>
            <div class="border"></div>
            <div id="footer">
                <p>This is an open source project; please visit <a href="https://github.com/dannil/HashGenerator">GitHub</a> for the source code.</p>
            </div>
        </div>
    </body>
</html>
