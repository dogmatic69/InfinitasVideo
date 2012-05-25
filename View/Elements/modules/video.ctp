<?php
	list($video, $size) = explode('=', $config['id']);
	try {
		$video = ClassRegistry::init('Videos.InfinitasVideo')->find('video', $video);
	}
	catch(Exception $e) {}
	
	if(empty($video)) {
		return false;
	}
	
	$size = explode('x', $size);
	
	switch(true) {
		case strstr($video['InfinitasVideo']['url'], 'youtube'):
			$url = parse_url($video['InfinitasVideo']['url']);
			parse_str($url['query'], $url);

			$videoHtml = sprintf('<iframe width="%d" height="%d" src="http://www.youtube.com/embed/%s" frameborder="0" allowfullscreen=""></iframe>', $size[0], $size[1], $url['v']);
			break;
		
		case strstr($video['InfinitasVideo']['url'], 'vimeo'):
			$url = explode('/', $video['InfinitasVideo']['url']);
			$url = array_pop($url);
			$videoHtml = sprintf(
				'<iframe src="http://player.vimeo.com/video/%s?title=0&amp;byline=0&amp;portrait=0" width="%d" height="%d" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>',
				$url, $size[0], $size[1]
			);
			break;
		
		default:
			throw new Exception('Unknown video source');
			break;
	}
	
	$grid = 6;
	if($this->layout == 'full_width') {
		$grid += 2;
	}
?>
<div class="top_left grid_<?php echo $grid; ?> alpha">
    <div class="inner play">
        <div class="video"><?php echo $videoHtml; ?></div>
		<div class="image">
			<?php 
				echo $this->Html->image($video['InfinitasVideo']['content_image_path_full'], array('width' => $size[0], 'height' => $size[1] + 1)); 
			?>
			<div class="description">
				<h2 class="white">Video</h2>
				<h2><?php echo $video['InfinitasVideo']['name']; ?></h2>
			</div>
		</div>
    </div>
    <div class="breadcrumb">
        <a href="#"><?php echo $video['InfinitasVideo']['name']; ?></a>
    </div>
</div>