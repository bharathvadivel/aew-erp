<?php
return [
    'prevent_pattern' => "/([%\$#<>.,\*]+)/",
	'prevent_pattern_texteditor' => "<script>",
	'prevent_date_match' => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",
	'supported_image' => array('jpg','jpeg','png'),
	'imgsize' => 1024000, // 1 MB 
	'status_check' => array('Enable',"Disable"),
];
    ?>