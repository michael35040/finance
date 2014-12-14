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

/*
 * voting
 * uid (unique vote id)
 * symbol
 * question
 * date
 * status (open or closed)
 *
 * votes
 * uid
 * voteuid (same as voting uid)
 * symbol
 * userid
 * count (number of shares)
 * vote (yes or no)
 * date
 *
 */


//if owner, create vote option

//if vote open and in vote table show vote
//if voted, show results
//if not voted, show poll.


?>