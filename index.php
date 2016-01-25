<?php
    session_start();
    require_once('php/classes/Constants.class.php');
    require_once('php/classes/Hash.class.php');
    if (isset($_SESSION)) {
        $session = $_SESSION;
        unset($_SESSION);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HashGenerator</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>HashGenerator</h1>
            </div>
            <div class="border"></div>
            <div id="formcontainer">
                <form method="POST" action="php/processing/indexProcessing.php">
                    <p>String to hash <input type="text" name="stringToHash" size="46"<?php if (isset($session['stringToHash'])) { echo ' value="' . $session['stringToHash'] . '"'; } ?>></p>
                    <div id="algorithm">
                        <p>Hashing algorithm
                            <select name="algorithm">
                                <?php
                                $hashObj = new Hash();
                                $algorithms = $hashObj->getAllowed();
                                foreach ($algorithms as $key => $value) {
                                	if (!isset($session['algorithm']) && $key == $hashObj->getDefaultAlgorithm()) {
                                		echo '<option selected="selected" value="' . $key . '">' . $value . '</option>';
                                	} else if (isset($session['algorithm']) && $key == $session['algorithm']) {
                                		echo '<option selected="selected" value="' . $key . '">' . $value . '</option>';
                                	} else {
                                		echo '<option value="' . $key . '">' . $value . '</option>';
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
                <p>version <?php echo Constants::getVersion(); ?> | <?php echo Constants::getPublishDate(); ?></p>
                <p>This is an open source project; please visit <a href="https://github.com/dannil/HashGenerator">GitHub</a> for the source code.</p>
            </div>
        </div>
    </body>
</html>
