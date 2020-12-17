<?php 
function utf8convert($str) {
	if(!$str) return false;
	$utf8 = array(
	'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	'd'=>'đ|Đ',
	'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
	'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	'-'=>',',
	);
	foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
	return $str;
}
function utf8tourl($text){
	$text = strtolower(utf8convert($text));
	$text = str_replace( "ß", "ss", $text);
	$text = str_replace( "%", "", $text);
	$text = preg_replace("/[^_a-zA-Z0-9 -] /", "",$text);
	$text = str_replace(array('%20', ' '), '-', $text);
	$text = str_replace("----","-",$text);
	$text = str_replace("---","-",$text);
	$text = str_replace("--","-",$text);
	
return $text;
}
	if ( ! function_exists( 'dd' ))
{
    /**
     * @param $data
     */
    function dd( $data ) {
        echo '<pre class="sf-dump" style=" color: #222; overflow: auto;">';
        echo '<div>Your IP: ' . $_SERVER['REMOTE_ADDR'] . '</div>';
        $debug_backtrace = debug_backtrace();
        $debug = array_shift($debug_backtrace);
        echo '<div>File: ' . $debug['file'] . '</div>';
        echo '<div>Line: ' . $debug['line'] . '</div>';
        if(is_array($data) || is_object($data)) {
            print_r($data);
        }
        else {
            var_dump($data);
        }
        echo '</pre>';
    }
}

if( ! function_exists('str_slug'))
{
    // convert duong dan than thien
    function str_slug($str,$default = '-') {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/',$default, $str);
        return $str;
    }
}

if ( ! function_exists('formatPrice'))
{
    // dinh dang lai gia tien
    function formatPrice($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return number_format($price, 0,',','.') ;
    }

}
if ( ! function_exists('money'))
{
    // dinh dang lai gia tien
    function money($number , $sale = 0)
    {

        $price = $sale != 0 ? $price = $number*(100 - $sale)/100  : $number;
        return $price;
    }
}

if( ! function_exists( 'baseServerName'))
{
    // duong dan url ban dau
    function baseServerName()
    {
        return 'http://'.$_SERVER["SERVER_NAME"];
    }
}

if ( ! function_exists('redirectUrl'))
{
    function redirectUrl($url = '')
    {
        header("location: ".baseServerName()."{$url}");exit();
    }
}

if ( ! function_exists( 'curPageURL' ))
{
    /**
     * @return string
     * lay duong dan url hien tai
     * VD
     */
    function curPageURL() {
        $pageURL = "http";
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}

function ColorFind($string,$fild)
{
    if($string != '')
    {
        return str_replace($string,"<span style='color:red;font-size:14px'>".$string."</span>",$fild);
    }
    else
    {
        return $fild;
    }
}
if ( ! function_exists( 'createFolder' ))
{
 /**
  *  Ham tao  thuc muc 
  * return 0  => errors
  * return 1  => success
  *  tao moi thu muc
 **/
 function createFolder($path , $name)
 {
  $respons = 
  [
   'code' => 0,
   'message' => ' Thư mục '.$name.' đã tồn tại ' 
  ];
  if(is_dir($path . $name))
  {
   return $respons;
  }
  $check_create = mkdir( $path . $name, 0777); 
  if($check_create)
  {
   $respons['message']  =  ' Tạo thư mục thành công ';
   $respons['code']  =  1;
   return $respons;
  }
  $respons['message']  = ' Lỗi tạo thư mục';
  return $respons;
 }
}

if( ! function_exists( '' ))
{
 /**
  *  xoa thu muc va file tong thu muc do 
  */
 function deleteFolder($dir = null) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
         if ($object != "." && $object != "..")
         {
           if (filetype($dir."/".$object) == "dir") remove_dir($dir."/".$object);
           else unlink($dir."/".$object);
         }
      }
      reset($objects);
      rmdir($dir);
    }
 }
}

if (!function_exists('get_start_and_time'))
{
    function get_start_and_time($date_range, $config=[])
    {
        $dates = explode(' - ', $date_range);

        $start_date = date('Y-m-d', strtotime($dates[0]));
        $end_date = date('Y-m-d', strtotime($dates[1]));

        return [
            'start' => $start_date,
            'end' => $end_date
        ];
    }
}
	/**
	 * gan session kiem tra view
	 */
	function insertview($string,$id,$time,$table)
	{
		if(! isset($_COOKIE[$string.$id]))
		{
			$_COOKIE[$string.$id] = 1;
			setcookie($string.$id,'setcookie',time()+$time);
			return true;
		}
		else
		{
			return false;
		}
	}
	/**
	 * post input
	 */
	function _debug($data)
	{
		echo '<pre style="background: #000; color: #fff; width: 100%; overflow: auto">';
		echo '<div>Your IP: '. $_SERVER['REMOTE_ADDR']. '</div>';

		$debug_backtrace = debug_backtrace();
		$debug = array_shift($debug_backtrace);

		echo '<div>File: ' . $debug['file'] . '</div>';
		echo '<div>Line: ' . $debug['line'] . '</div>';

		if(is_array($data) || is_object($data)){
			print_r($data);
		}
		else
		{
			var_dump($data);
		}
		echo '</pre>';
	}
	function to_slug($str){
		$str= trim(mb_strtolower($str));
		$str= preg_replace('/(à|á|ạ|ả|ã|â|ấ|ầ|ậ|ẩ|ẫ|ă|ắ|ằ|ặ|ẳ|ẵ)/', 'a', $str);
		$str= preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ)/', 'e', $str);
		$str= preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str= preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str= preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str= preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str= preg_replace('/(đ)/', 'd', $str);
		$str= preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str= preg_replace('/([\s]+)/', '-', $str);
		return $str;
	}
	function clean_sql_injection($str){
		$str= trim(mb_strtolower($str));
		$str= preg_replace('/(à|á|ạ|ả|ã|â|ấ|ầ|ậ|ẩ|ẫ|ă|ắ|ằ|ặ|ẳ|ẵ)/', 'a', $str);
		$str= preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ế|ề|ệ|ể|ễ)/', 'e', $str);
		$str= preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
		$str= preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
		$str= preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
		$str= preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
		$str= preg_replace('/(đ)/', 'd', $str);
		$str= preg_replace('/[^a-z0-9-\s]/', '', $str);
		$str= preg_replace('/([\s]+)/', ' ', $str);
		return $str;
	}
	if(! function_exists('xss_clean')){
		function xss_clean($data)
		{
			$data=str_replace(array('&amp;','&lt;','&gt;'),array('&amp;amp','&amp;lt;','&amp;gt;'), $data);
			$data=preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
			$data=preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
			$data=html_entity_decode($data,ENT_COMPAT,'UTF-8');

			$data= preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu','$1>' , $data);

			$data= preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu','$1=$2nojavascrip...', $data);
			$data= preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu','$1=$2novbscrip...', $data);	
			$data= preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u','$1=$2nomozbiding...', $data);	

			$data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>',$data);

			$data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>',$data);

			$data=preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>',$data);
			$data=preg_replace('#</*\w+:\w[^>]*+>#i', '',$data);
			do{
				$old_data=$data;
				$data=preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|1(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '',$data);
			}while($old_data !== $data);
			
			return $data;
		}
	}
	function getInput($string)
	{
		return isset($_GET[$string]) ? $_GET[$string] : '';
	}
	function postInput($string)
	{
		return isset($_POST[$string]) ? $_POST[$string] : '';
	}
	function base_url()
	{
		return $url = "http://localhost/BaoDay.tk/";
	}
	function base_admin()
	{
		return base_url() . "public/admin/";
	}
	function base_frontend()
	{
		return base_url() . "public/frontend/";
	}
	function modules($url)
	{
		return base_url() . "admin/modules/" .$url ;
	}
	function uploads()
	{
		return base_url() . "public/uploads/";
	}

	if( ! function_exists('redirectStyle'))
	{
		function redirectStyle($url="")
		{
			header("location: ".base_url()."{$url}");exit();
		}
	}

	if( ! function_exists('redirectAdmin'))
	{
		function redirectAdmin($url="")
		{
			header("location: ".base_url()."http://baoday.000webhostapp.com/{$url}");exit();
		}
	}

	if( ! function_exists('redirect'))
	{
		function redirect($url="")
		{
			header("location: ".base_url().$url);exit();
		}
	}

	function formatPrice($number)
	{
		$number = intval($number);

		return $number = number_format($number,0,',','.');
	}
	function formatpricesale($number,$sale)
	{
		$number = intval($number);
		$sale = intval($sale);
		$price = $number*(100-$sale)/100;
		return formatPrice($price);
	}
 ?>