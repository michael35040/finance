<?php
    echo "creating database\n";
    
    try {
        $dbh = new PDO('sqlite:voting.db');
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        $dbh->exec('
            CREATE TABLE tally (
            QID varchar(32) NOT NULL,
            AID integer NOT NULL,
            votes integer NOT NULL,
            PRIMARY KEY (QID,AID))
        ');
    }
    catch(PDOException $e) {  
        echo "ERROR!!: $e";
        exit;
    }
    
    echo "db created successfully.";

?>