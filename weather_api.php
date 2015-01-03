<?
	header('Content-type: application/json; charset=utf-8');
	function json_encode2($data) {
	switch (gettype($data)) {
		case 'boolean':
	    	return $data?'true':'false';
		case 'integer':
		case 'double':
	    	return $data;
		case 'string':
	    	return '"'.strtr($data, array('\\'=>'\\\\','"'=>'\\"')).'"';
		case 'array':
		$rel = false; // relative array?
		$key = array_keys($data);
	    	foreach ($key as $v) {
        		if (!is_int($v)) {
            		$rel = true;
	            	break;
	        	}
	    	}
		$arr = array();
		foreach ($data as $k=>$v) {
		$arr[] = ($rel?'"'.strtr($k, array('\\'=>'\\\\','"'=>'\\"')).'":':'').json_encode2($v);
		}
		return $rel?'{'.join(',', $arr).'}':'['.join(',', $arr).']';
		default:
		return '""';
		}
	}

	include_once("simple_html_dom.php");
	$year = $_GET["year"];
	$month = $_GET["month"];
	$getday = $_GET["day"];
	if ($month < 10) {
		$month = "0" . $month;
	}
	
	$citys["강화"] = "201"; //서울, 경기도
	$citys["동두천"] = "098";
	$citys["문산"] = "099";
	$citys["서울"] = "108";
	$citys["수원"] = "119";
	$citys["양평"] = "202";
	$citys["이천"] = "203";
	$citys["인천"] = "112";
	
	$citys["백령도"] = "102"; //서해 5도

	$citys["강릉"] = "105"; // 강원도
	$citys["대관령"] = "100";
	$citys["동해"] = "106";
	$citys["속초"] = "090";
	$citys["영월"] = "121";
	$citys["원주"] = "114";
	$citys["인제"] = "211";
	$citys["철원"] = "095";
	$citys["춘천"] = "101";
	$citys["태백"] = "216";
	$citys["홍천"] = "212";

	$citys["보은"] = "226"; //충청북도
	$citys["제천"] = "221";
	$citys["청주"] = "131";
	$citys["추풍령"] = "135";
	$citys["충주"] = "127";

	$citys["금산"] = "238"; //충청남도
	$citys["대전"] = "133";
	$citys["보령"] = "235";
	$citys["부여"] = "236";
	$citys["서산"] = "129";
	$citys["천안"] = "232";

	$citys["군산"] = "140"; //전라북도
	$citys["남원"] = "237";
	$citys["부안"] = "243";
	$citys["임실"] = "244";
	$citys["장수"] = "248";
	$citys["전주"] = "146";
	$citys["정읍"] = "245";

	$citys["고흥"] = "262"; //전라남도
	$citys["광주"] = "156";
	$citys["목포"] = "165";
	$citys["순천"] = "256";
	$citys["여수"] = "168";
	$citys["완도"] = "170";
	$citys["장흥"] = "260";
	$citys["해남"] = "261";
	$citys["흑산도"] = "169";
	$citys["진도"] = "175";

	$citys["구미"] = "279"; //경상북도
	$citys["대구"] = "143";
	$citys["문경"] = "273";
	$citys["상주"] = "137";
	$citys["울릉도"] = "115";
	$citys["안동"] = "136";
	$citys["영덕"] = "277";
	$citys["영주"] = "272";
	$citys["영천"] = "281";
	$citys["울진"] = "130";
	$citys["의성"] = "278";
	$citys["춘양"] = "271";
	$citys["포항"] = "138";

	$citys["거제"] = "294"; //경상남도
	$citys["거창"] = "284";
	$citys["남해"] = "295";
	$citys["창원"] = "155";
	$citys["밀양"] = "288";
	$citys["부산"] = "159";
	$citys["산청"] = "289";
	$citys["울산"] = "152";
	$citys["진주"] = "192";
	$citys["통영"] = "162";
	$citys["합천"] = "285";

	$citys["고산"] = "185"; //제주도
	$citys["서귀포"] = "189";
	$citys["성산포"] = "265";
	$citys["제주"] = "184";
	$area = $_GET["area"];
	$code = $citys[$area]; // city code converter

	if (empty($year) || empty($month)  || empty($area)) {
		$usage["usage"] = "GET /weather.php?year=2014&month=12&day=25&area=서울";
		$usage["required"] = "year, month, area";
		$usage["option"] = "day, ex) day=14";
		echo json_encode2($usage);
		exit();
	} 

	$html = file_get_html("http://weather.media.daum.net/weather.action?pageId=901&area=".$code."&year=". $year."&month=$month");
	$count = 1;

	foreach($html->find("div.fast_weather") as $test) {
		$status = $test->find("p.title",0)->plaintext;
		$content = $test->find("p.contents",0)->plaintext;
		$temp = explode(":", $content);
		$minexp2 = $temp[1];
		$min = explode("℃",$minexp2);
		$mins = $min[0];
		$maxexp2 = $temp[2];
		$max = explode("℃", $maxexp2);
		$maxs = $max[0];
		$day[$count]["min"] = $mins;
		$day[$count]["max"] = $maxs;
		$day[$count]["status"] = $status;
		$count = $count + 1;
	}

		if (empty($getday)) {
			echo json_encode2($day);
		} else {
			echo json_encode2($day[$getday]);		
		}
		


?>
