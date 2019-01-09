<pre>
<?php

$subs = fread(fopen('Intouchables.srt', r), filesize('Intouchables.srt'));

$GLOBALS['i'] = isset($_GET['i']) ? intval($_GET['i']) : 0;

$d = str_replace(',','.',$_GET['d']);
$GLOBALS['d'] = intval(floatval($d)*1000);

$subs =		preg_replace_callback("|(.*)-->(.*)|",
		function ($matches) {
			
			$date1 = explode(',', trim($matches[1]));
			$date1[0] = explode(':',$date1[0]);

			$date2 = explode(',', trim($matches[2]));
			$date2[0] = explode(':',$date2[0]);

			$date1 = intval($date1[0][0])*3600000+intval($date1[0][1])*60000+intval($date1[0][2])*1000+intval($date1[1])+$GLOBALS['d'];
			$date2 = intval($date2[0][0])*3600000+intval($date2[0][1])*60000+intval($date2[0][2])*1000+intval($date2[1])+$GLOBALS['d'];

			$hours = floor($date1/3600000);
			$hours = ($hours<10) ? "0$hours" : $hours;
			$date1 -= $hours*3600000;
			$minutes = floor($date1/60000);
			$minutes = ($minutes<10) ? "0$minutes" : $minutes;
			$date1 -= $minutes*60000;
			$seconds = floor($date1/1000);
			$seconds = ($seconds<10) ? "0$seconds" : $seconds;
			$millis = $date1-$seconds*1000;
			if ($millis>99) { $millis = "$millis"; }
			if ($millis>9 && $millis<100) { $millis = "0$millis"; }
			if ($millis<10) { $millis = "00$millis"; }
			

			$date1 = "$hours:$minutes:$seconds,$millis";

			$hours = floor($date2/3600000);
			$hours = ($hours<10) ? "0$hours" : $hours;
			$date2 -= $hours*3600000;
			$minutes = floor($date2/60000);
			$minutes = ($minutes<10) ? "0$minutes" : $minutes;
			$date2 -= $minutes*60000;
			$seconds = floor($date2/1000);
			$seconds = ($seconds<10) ? "0$seconds" : $seconds;
			$millis = intval($date2-$seconds*1000);

			$date2 = "$hours:$minutes:$seconds,$millis";

			return $date1 . ' --> ' . $date2;
		},
		$subs);

$subs =		preg_replace_callback("|[\r]?[0-9]+[\n]|",
		function ($matches) {
			for ($i=0;$i<sizeof($matches);$i++)
			{
				return intval($matches[$i])+$GLOBALS['i']."\n";
			}
		},
		$subs);

//$subs = preg_replace("/[\n][\r][\n]/", "\r", $subs);

print_r($subs);

exit;

?>
</pre>