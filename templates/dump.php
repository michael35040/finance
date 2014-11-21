<!DOCTYPE html>

<html>

    <head>
        <title>dump</title>
    </head>
     
    <body>
        <pre><?php 
        echo(var_dump(get_defined_vars())); //dump all variables if i hit error
        print_r($variable); 
        ?></pre>
    </body>

</html>
