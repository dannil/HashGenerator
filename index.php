<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HashGenerator</title>
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('input[type="checkbox"]').click(function(){
                    if($(this).attr("value")=="salt"){
                        $(".salt").toggle();
                    }
                });
            });
        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1>Hash Generator</h1>
            </div>
            <div class="border"></div>
            <div id="contentcontainer">
                <form method="POST">
                    <p>String to hash <input type="text" name="stringToHashField" size="46"></p>
                    <p>Use salt? <input type="checkbox" name="saltField" value="salt"></p>
                    <div class="salt">
                        <p>Salt <input type="text" name="salt" size="55"></p>
                        <p>Place salt at <input type="radio" name="placeSaltAt" value="beginning" checked>beginning 
                                         <input type="radio" name="placeSaltAt" value="end">end
                    </div>
                    <div class="button">
                        <p><input type="submit" value="Hash string"></p>
                    </div>
                </form>
                
                <?php

                function __autoload($classname) {
                    require_once('classes/' . $classname . '.class.php');
                }

                $ripemd = new HashRIPEMD();
                //echo "<p>" . $ripemd->getRIPEMD320Hash("See ya!") . "</p>";

                ?>
            </div>

        </div>
       
        
    </body>
</html>
