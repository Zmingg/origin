<?php
namespace App\Libraries;
use SimpleXMLIterator;

class Tool
{
	private static $_tool;

	public function __construct()
	{
		self::$_tool['ip'] = $this->getip();
	} 

	public static function tool()
	{
		if (!(self::$_tool instanceof self)) {
			self::$_tool = new self;
		}
		return self::$_tool;
	}


	public function getip()
	{
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
			$ip = getenv("REMOTE_ADDR");
		} else  if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = "unknown";
		}
		return $ip;
    }

    public function getcity($ip=null)
    {
    	if ($ip=null) {
    		$ip = self::$_tool['ip'];
    	}
    	
    	$ip_json = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=$ip");
    	$arr = json_decode($ip_json,true);
    	return $arr['city'];
    }

	/*天气信息  Array
	'city':'城市',
	'status1':'白天天气','status2':'夜间天气',
	'figure1':'白天天气拼音','figure2':'夜间天气拼音', 
	'direction1':'白天风向','direction2':'夜间风向',
	'power1':'白天风力','power2':'白天风力',
	'temperature1':'白天温度','temperature2':'白天温度',
	'ssd':'体感指数','tgd1':'白天体感温度','tgd2':'夜间体感温度',
	'zwx':'紫外线指数','ktk':'空调指数','pollution':'污染指数',
	'xcz':'洗车指数','chy':'穿衣指数',
	'chy_shuoming':'穿衣指数说明',
	'pollution_l':'污染概述',
	'zwx_l':'紫外线概述','ssd_l':'体感概述',
	'chy_l':'穿衣概述','ktk_l':'空调概述','xcz_l':'洗车概述',
	'pollution_s':'污染详细说明','zwx_s':'紫外线详细说明',
	'ssd_s':'体感详细说明','ktk_s':'空调详细说明',
	'xcz_s':'洗车详细说明',
	'gm':'感冒指数','gm_l':'感冒概述','gm_s':'感冒详细说明',
	'yd':'运动指数','yd_l':'运动概述','yd_s':'运动详细说明',
	'savedate_weather':'天气数据日期',
	'savedate_life':'生活数据日期',
	'savedate_zhishu':'指数数据日期',
	'udatetime':'数据更新时间'*/
	public function weather($city=null)
	{
		if( $city == null ){
			$city = $this->getcity();
		}
		$city = urlencode(mb_convert_encoding($city,'gb2312'));
		$wea_xml = file_get_contents("http://php.weather.sina.com.cn/xml.php?city=$city&password=DJOYnieT8234jlsK&day=0");
		if (strlen($wea_xml)<200) {
			return '未正确定位到城市';
		}
		$wea_arr = $this->xmlToArr($wea_xml);
		
		if (date('H')>17||date('H')<6) {
			$weather['img'] = "http://php.weather.sina.com.cn/images/yb3/78_78/{$wea_arr['figure2']}_1.png";
			$weather['status'] = $wea_arr['status2'];
		}else{
			$weather['img'] = "http://php.weather.sina.com.cn/images/yb3/78_78/{$wea_arr['figure1']}_0.png";
			$weather['status'] = $wea_arr['status1'];
		}
		$weather['city'] = $wea_arr['city'];
		$weather['temp'] = $wea_arr['temperature2'].' - '.$wea_arr['temperature1'];
		$weather['pollution'] = $wea_arr['pollution_l'];
		return $weather;
	}

	/*简单XML转Arr*/
	private function xmlToArr($xml){
		$xmlIterator = new SimpleXMLIterator($xml);
		for( $xmlIterator->rewind(); $xmlIterator->valid(); $xmlIterator->next() ) {
		    foreach($xmlIterator->getChildren() as $name => $data) {
		    	$arr[$name] = (string)$data;
		    }
		}
		return $arr;
	}



}