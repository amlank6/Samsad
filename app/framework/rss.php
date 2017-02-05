<?php
class get_rss_feed
{
	function display_feed($feed_url) 
	{
	$content = file_get_contents($feed_url);
	$x = new SimpleXmlElement($content);
	$feed_collect	=	"";
		foreach($x->channel->item as $entry)
		{
		$feed_collect .= 
		"<li><a href='$entry->link' target='_blank' style='font-size:14px'> " . $entry->title."</a></li>
		<p>".$entry->description."</p>
		";
		}
	return $feed_collect;
	}
}
?>