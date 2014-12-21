<?php
    # you don't display errors on in-use scripts, do you?
    ini_set('display_errors',0);
    error_reporting(E_ALL|E_STRICT);



class webPoll {

    # makes some things more readable later
    const POLL = true;
    const VOTES = false;

    # number of pixels for 1% on display bars
    public $scale = 2;
    
    
    public $question = '';
    public $answers = array();
    private $header = '<form class="webPoll" method="post" action="%src%">
                       <input type="hidden" name="QID" value="%qid%" />
                       <h4>%question%</h4>
                       <fieldset><ul>';
    private $center = '';
    private $footer = "\n</ul></fieldset>%button%\n</form>\n";
    private $button = '<p class="buttons"><button type="submit" class="vote">Vote!</button></p>';
    private $md5 = '';

/**
 * ---
 * Takes an array containing the question and list of answers as an
 * argument. Creates the HTML for either the poll or the results depending
 * on if the user has already voted
 */
public function __construct($params) {
    $this->question = array_shift($params);
    $this->answers = $params;
    $this->md5 = md5($this->question);  
    
    $this->header = str_replace('%src%', $_SERVER['SCRIPT_NAME'], $this->header);
    $this->header = str_replace('%qid%', $this->md5, $this->header);
    $this->header = str_replace('%question%', $this->question, $this->header);
    
    # seperate cookie for each individual poll
    isset($_COOKIE[$this->md5]) ? $this->poll(self::VOTES) : $this->poll(self::POLL);    
}
private function poll($show_poll) {
    $replace = $show_poll ? $this->button : '';
    $this->footer = str_replace('%button%', $replace, $this->footer);
    
    # static function doesn't have access to instance variable
    if(!$show_poll) {
        $results = webPoll::getData($this->md5);
        $votes = array_sum($results);
    }

    for( $x=0; $x<count($this->answers); $x++ ) {
        $this->center .= $show_poll ? $this->pollLine($x) : $this->voteLine($this->answers[$x],$results[$x],$votes);
    }
    
    echo $this->header, $this->center, $this->footer;
}
private function pollLine($x) {
    isset($this->answers[$x+1]) ? $class = 'bordered' : $class = '';
    return "
    <li class='$class'>
            <label class='poll_active'>
            <input type='radio' name='AID' value='$x' />
                {$this->answers[$x]}
            </label>
    </li>
";
}
private function voteLine($answer,$result,$votes) {
    $result = isset($result) ? $result : 0;
    $percent = round(($result/$votes)*100);
    $width = $percent * $this->scale;
    return "
    <li>
            <div class='result' style='width:{$width}px;'>&nbsp;</div>{$percent}%
            <label class='poll_results'>
                $answer
            </label>
    </li>
";
}
/**
 * processes incoming votes. votes are identified in the database by a combination
 * of the question's MD5 hash, and the answer # ( an int 0 or greater ).
 */
static function vote() {
    if(!isset($_POST['QID']) || !isset($_POST['AID']) || isset($_COOKIE[$_POST['QID']])) {
        return;
    }
    
    $dbh = new PDO('sqlite:voting.db');
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    try {
        $sth = $dbh->prepare( "INSERT INTO tally (QID,AID,votes) values (:QID, :AID, 1)" );
        $sth->execute(array($_POST['QID'],$_POST['AID']));
    }
    catch(PDOException $e) {
        # 23000 error code means the key already exists, so UPDATE! 
        if($e->getCode() == 23000) {
            try {
                $sth = $dbh->prepare( "UPDATE tally SET votes = votes+1 WHERE QID=:QID AND AID=:AID");
                $sth->execute(array($_POST['QID'],$_POST['AID']));
            }
            catch(PDOException $e) {
                webPoll::db_error($e->getMessage());
            }
        }
        else {
            webPoll::db_error($e->getMessage());
        }
    }
    
    # entry in $_COOKIE to signify the user has voted, if he has
    if($sth->rowCount() == 1) {
        setcookie($_POST['QID'], 1, time()+60*60*24*365);
        $_COOKIE[$_POST['QID']] = 1;
    }
}
static function getData($question_id) {
    try {
        $dbh = new PDO('sqlite:voting.db');
        $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        
        $STH = $dbh->prepare('SELECT AID, votes FROM tally WHERE QID = ?');
        $STH->execute(array($question_id));
    }
    catch(PDOException $e) {  
        # Error getting data, just send empty data set
        return array(0); 
    }
    
    while($row = $STH->fetch()) {
        $results[$row['AID']] = $row['votes'];   
    }
    
    return $results;
}
/*
 * You can do something with the error message if you like. Email yourself
 * so you know something happened, or make an entry in a log
 */
static function db_error($error) {   
    echo "A database error has occoured. $error";
    exit;
}

}


?>