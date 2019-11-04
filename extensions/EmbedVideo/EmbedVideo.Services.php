<?php

// Build services list (may be augmented in LocalSettings.php)
$wgEmbedVideoServiceList = array(
	'bing' => array(
		'extern' => '<iframe style="overflow: hidden;" src="//hub.video.msn.com/embed/$2" width="$3" height="$4" frameborder="0" scrolling="no" noscroll></iframe>'
	),
	'bingvideo' => array(
		'extern' => '<iframe style="overflow: hidden;" src="//hub.video.msn.com/embed/$2" width="$3" height="$4" frameborder="0" scrolling="no" noscroll></iframe>'
	),
	'dailymotion' => array(
		'url' => '//www.dailymotion.com/swf/$1'
	),
	'divshare' => array(
		'url' => '//www.divshare.com/flash/video2?myId=$1',
	),
	'edutopia' => array(
		'extern' =>
			'<object id="flashObj" width="$3" height="$4">' .
				'<param name="movie" value="//c.brightcove.com/services/viewer/federated_f9?isVid=1&isUI=1" />' .
				'<param name="flashVars" value="videoId=$2&playerID=85476225001&domain=embed&dynamicStreaming=true" />' .
				'<param name="base" value="//admin.brightcove.com" />' .
				'<param name="allowScriptAccess" value="always" />' .
				'<embed src="//c.brightcove.com/services/viewer/federated_f9?isVid=1&isUI=1" ' .
					'flashVars="videoId=$2&playerID=85476225001&domain=embed&dynamicStreaming=true" '.
					'base="//admin.brightcove.com" name="flashObj" width="$3" height="$4" '.
					'seamlesstabbing="false" type="application/x-shockwave-flash" allowFullScreen="true" ' .
					'allowScriptAccess="always" swLiveConnect="true" ' .
					'pluginspage="//www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash">' .
				'</embed>' .
			'</object>',
		'default_width' => 326,
		'default_ratio' => 326/399,
	),
	'funnyordie' => array(
		'url' =>
			'//www.funnyordie.com/v1/flvideo/fodplayer.swf?file='.
			'//funnyordie.vo.llnwd.net/o16/$1.flv&autoStart=false'
	),
    'google' => array(
        'id_pattern'=>'%[^0-9\\-]%',
        'url' => '//video.google.com/googleplayer.swf?docId=$1'
    ),
	'googlevideo' => array(
		'id_pattern'=>'%[^0-9\\-]%',
		'url' => '//video.google.com/googleplayer.swf?docId=$1'
	),
	'interiavideo' => array(
		'url' => '//video.interia.pl/i/players/iVideoPlayer.05.swf?vid=$1',
	),
	'interia' => array(
		'url' => '//video.interia.pl/i/players/iVideoPlayer.05.swf?vid=$1',
	),
	'metacafe' => array(
		'url' => '//www.metacafe.com/fplayer/$1.swf'
	),
	'msn' => array(
		'extern' => '<iframe style="overflow: hidden;" src="//hub.video.msn.com/embed/$2" width="$3" height="$4" frameborder="0" scrolling="no" noscroll></iframe>'
	),
	'msnvideo' => array(
		'extern' => '<iframe style="overflow: hidden;" src="//hub.video.msn.com/embed/$2" width="$3" height="$4" frameborder="0" scrolling="no" noscroll></iframe>'
	),
	'revver' => array(
		'url' => '//flash.revver.com/player/1.0/player.swf?mediaId=$1'
	),
	'rutube' => array(
		'url' => ''
	),
	'sevenload' => array(
		'url' => '//page.sevenload.com/swf/en_GB/player.swf?id=$1'
	),
	'teachertube' => array(
		'extern' =>
			'<embed src="//www.teachertube.com/embed/player.swf" ' .
				'width="$3" ' .
				'height="$4" ' .
				'bgcolor="undefined" ' .
				'allowscriptaccess="always" ' .
				'allowfullscreen="true" ' .
				'flashvars="file=//www.teachertube.com/embedFLV.php?pg=video_$2' .
					'&menu=false' .
					'&frontcolor=ffffff&lightcolor=FF0000' .
					'&logo=//www.teachertube.com/www3/images/greylogo.swf' .
					'&skin=//www.teachertube.com/embed/overlay.swf volume=80' .
					'&controlbar=over&displayclick=link' .
					'&viral.link=//www.teachertube.com/viewVideo.php?video_id=$2' .
					'&stretching=exactfit&plugins=viral-2' .
					'&viral.callout=none&viral.onpause=false' .
				'"' .
			'/>',
	),
	'yahoo' => array(
		'extern' => '<iframe src="//d.yimg.com/nl/vyc/site/player.html#vid=$2" width="$3" height="$4" frameborder="0"></iframe>'
	),
	'yahoovideo' => array(
		'extern' => '<iframe src="//d.yimg.com/nl/vyc/site/player.html#vid=$2" width="$3" height="$4" frameborder="0"></iframe>'
	),
	'yahooscreen' => array(
		'extern' => '<iframe src="//d.yimg.com/nl/vyc/site/player.html#vid=$2" width="$3" height="$4" frameborder="0"></iframe>'
	),
	'yandex' => array(
		'extern' => '$5'
	),
	'yandexvideo' => array(
		'extern' => '$5'
	),
	'youtube' => array(
        'extern' =>
        '<iframe src="//www.youtube.com/embed/$2"'.
        (((strstr($_SERVER['HTTP_USER_AGENT'],'iPhone'))
            || (strstr($_SERVER['HTTP_USER_AGENT'],'iPod'))
            || (strstr($_SERVER['HTTP_USER_AGENT'],'iPad'))) ?
                ' ' : '?showsearch=0&amp;modestbranding=1" '
            .'width="$3" height="$4" ').'frameborder="0" allowfullscreen="true"></iframe>',
    ),
	'youtubehd' => array(
		'extern' =>
			'<iframe src="//www.youtube.com/embed/$2?showsearch=0&amp;modestbranding=1&amp;hd=1" ' .
				'width="$3" height="$4" ' .
				'frameborder="0" allowfullscreen="true"></iframe>',
		'default_ratio' => 16 / 9
	),
	'youtubeplaylist' => array(
		'extern' =>
			'<iframe src="//www.youtube.com/embed/videoseries?showsearch=0&amp;modestbranding=1&amp;list=$2" ' .
				'width="$3" height="$4" ' .
				'frameborder="0" allowfullscreen="true"></iframe>',
		'default_ratio' => 16 / 9
	),
	'vimeo' => array(
		'url'=>'//vimeo.com/moogaloop.swf?clip_id=$1&;server=vimeo.com&fullscreen=0&show_title=1&show_byline=1&show_portrait=0'
	)
);