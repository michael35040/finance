<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL|E_STRICT);
    
    
    include('webPoll.class.php');
    webPoll::vote();    
?>
<html>
<head>
    <title>Test!</title>
    <link rel="stylesheet" href="poll.css" type="text/css" />
    <!--[if IE]>
    <style> body { behavior: url("res/hover.htc"); } </style>
    <![endif]-->
</head>
<body>
<?php

$a = new webPoll(array(
    'What subjects would you like to learn more about?',
    'HTML & CSS',
    'Javascript',
    'JS Frameworks (Jquery, etc)',
    'Ruby/Ruby on Rails',
    'PHP',
    'mySQL'));

$b = new webPoll(array(
    'What is your question?',
    'Don\'t have one',
    'Why?',
    'When?',
    'Where?'));

$c = new webPoll(array(
    'What should we do?',
    'This',
    'That'));

$d = new webPoll(array(
    'What is your question?',
    'Don\'t have one',
    'Why?',
    'When?',
    'Where?'));

?>
</body>
</html>