<?php

session_start();


ob_start();		//output buffer


if(isset($_SESSION['bla'])) echo 'session was '.$_SESSION['bla'].'<br/>';


$_SESSION['bla'] = rand();			//magwel





ob_flush();

echo 'changed session to '.$_SESSION['bla'].'<br/>';

?>

