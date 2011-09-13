<?php

	require_once('lib/wiki.php');
	
	$wiki = new Wiki();
	
	echo $wiki->render();