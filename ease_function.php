<?php

	//convert xml file to array:  $file = path or name of file
	function xml_to_arr($file)
	{
		$xml=simplexml_load_file($file) or die("Error: Cannot create object");
		$xml_json = json_encode($xml);
		return json_decode($xml_json, true);
	}
	$xml_arr = xml_to_arr("test.xml");
	print_r($xml_arr);

	//serach in associative array: $arr = array to search  in, $key = associative key and $keyword = word to search
	function search($arr, $key, $keyword)
	{
	    foreach ($arr as $data) 
	    {
		if (strpos($data[$key], $keyword) !== false) 
		{
			$result[] = $data;
		}
	    }
	    return empty($result) ? 'No result found' : $result;
	}
	$search_data = search($arr, 'author', 'San Francisco');
	print_r($search_data);
