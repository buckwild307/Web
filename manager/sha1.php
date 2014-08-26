<?php

if (php_sapi_name() === 'cli') {
	echo sha1(file_get_contents($argv[1]));
} else {
	echo "This command is meant to be run from the command line"; exit();
}