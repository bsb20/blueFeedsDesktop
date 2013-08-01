<?php
	/* Updates the xml file within /desktop/bluefeedsTest.xml */
	/* Takes the following values: title, link, date, description */
	session_start();
	$filepath = "/var/www/blueFeedsTest.xml";

	if (file_exists($filepath)) {
 		$title=$_POST["title"];
		$link=$_POST["link"];
		$date=$_POST["date"];		
		$desc=$_POST["description"]; 	

		$rss = file_get_contents($filepath);
		$dom = new DOMDocument();	
		$dom->loadXML($rss);

		$channelList = $dom->getElementsByTagName('channel');
		$channel = $channelList->item(0);		
		$item = $dom->createElement('item');
		$item->appendChild($dom->createElement('title', $title));		
		$item->appendChild($dom->createElement('link', $link));		
		$item->appendChild($dom->createElement('date', $date));	
		$item->appendChild($dom->createElement('description', $desc));		
		$channel->appendChild($item);

		$rss = $dom->saveXML();	
		$bytes = file_put_contents($filepath, $rss);
		if($bytes)
		{
                echo "true";
                
			header('Location: newsfeed.php');			
		}
		else
		{
		//	header('Location: http://bluefeeds.cs.duke.edu/home/htdocs/desktop/RSS Feeds.php?failure=' . $bytes);				
		}
	}
	else
	{
		echo "File missing";
	}
?>
