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
	
	//direct xmltoarray with search elemnts funtionality
	function search_xml($path, $parentnode, $limit=null, $key = null, $keyword = null)
	{
		// echo $key." AND ". $keyword;
		$result = [];
		$z = new XMLReader;
		$z->open($path);
		$doc = new DOMDocument;
		while ($z->read() && $z->name !== $parentnode);
		while ($z->name === $parentnode)
		{
		    $node = simplexml_import_dom($doc->importNode($z->expand(), true));
		    if (trim($limit) == '') 
		    	{
		    		$node_to_json = json_encode($node);
				$result[] = json_decode($node_to_json, true);
		    	}
		    elseif(trim($keyword) == '' && trim($key) == '')
			{
				$node_to_json = json_encode($node);
				$result[] = json_decode($node_to_json, true);
				if(sizeof($result) > $limit)
				{
					return $result;
					die();
				}
			}
		    elseif(trim($keyword) != '' && trim($key) != '' && strpos(strtolower($node->$key), strtolower($keyword)) !== false) 
			{
				// echo "<pre>";
				// print_r($node);
				$node_to_json = json_encode($node);
				$result[] = json_decode($node_to_json, true);
				if(sizeof($result) > $limit)
				{
					return $result;
					die();
				}
			}
		    $z->next($parentnode);
		}
		if(empty($result)){
			$result[] = "No result found.";
			return $result;
		}else{
			return $result;
		}
	    }
	// if you don't want to search hit using these parameter
	$xml_serach_arr = search_xml("test.xml",'product', '4', 'test', 'name');
	// if you don't want to search hit using these parameter and product is parent node
	$xml_serach_arr = search_xml("test.xml",'product' ,'4');

	print_r($xml_serach_arr);
