<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>HashGenerator</title>
        <link rel="stylesheet" href="css/style.css"/>
    </head>
    <body>
        <?php
        
        function __autoload($classname) {
            require_once('classes/' . $classname . '.class.php');
        }
        
        $ripemd = new HashRIPEMD();
        echo $ripemd->getRIPEMD320Hash("See ya!");
        
        ?>
    </body>
</html>
