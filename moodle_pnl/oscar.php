<?php
		 require_once('/var/www/moodle_pnl/lib/password_compat/lib/password.php');
 

	$password = 'oscarmesa';
	$fasthash = false;
	$options = ($fasthash) ? array('cost' => 4) : array();

    echo $generatedhash = password_hash($password, PASSWORD_DEFAULT, $options);
?>