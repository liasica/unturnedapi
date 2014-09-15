<?php

/**
 * functions
 */

// 读取目录函数
function getFiles($dir) {
  $fileArray[]=NULL;
  if (false != ($handle = opendir($dir))) {
    $i = 0;
    while ( false !== ($file = readdir($handle)) ) {
      //去掉"“.”、“..”以及带“.xxx”后缀的文件
      if ($file != "." && $file != ".."&&strpos($file,".")) {
        $fileArray[$i] = $file;
        $i++;
      }
    }
    //关闭句柄
    closedir($handle);
  }
  return $fileArray;
}

// 输出var_dump
function p($arr) {
  echo "<pre>";
  var_dump($arr);
  echo "</pre>";
}

//删除空格
function trimall($str){
  $qian=array(" ","　","\t","\n","\r");$hou=array("","","","","");
  return str_replace($qian,$hou,$str);
}

/**
 * 读取文件
 */
function alexReadFile($file) {
	$handle = fopen($file, 'r');
	$contents = fread($handle, $length = filesize($file));
	fclose($handle);
	return $contents;
}

/**
 * 创建类和对象
 */
class UConfig {
	private $option;
	private $res;

	public function withOption($option) {
		$this->option = $option;
		return $this;
	}

	public function withRes($res) {
		$this->res = $res;
		return $this;
	}
}

function createUConfig($name) {
	return new $name();
}


/**
 * 读取配置
 */
function readConfig($contents) {
	$output = array();
	foreach ($contents as $content) {
		if (!empty($content)) {
			if (strstr($content, '[') && strstr($content, ']')) {
				// 去除配置文件中的[]符号
				$str = preg_replace('/[[]+/i', '', $content);
				$str = preg_replace('/[]]+/i', '', $str);
				// 当前配置
				$output[$str]['name'] = $str;
			} else {
				$option = explode('=', $content)[0]; // 配置的选项
				$res = explode('=', $content)[1]; // 配置的值
				$output[$str][$option] = $res;
			}
		}
	}
	return $output;
}

/**
 * 深度查找
 * [deep_in_array description]
 * @param  [type]  $value            [description]
 * @param  [type]  $array            [description]
 * @param  boolean $case_insensitive [description]
 * @return [type]                    [description]
 */
function deep_in_array($value, $array, $case_insensitive = false){
	foreach($array as $item){
		if (is_array($item))
			$ret = deep_in_array($value, $item, $case_insensitive);
		else
			$ret = ($case_insensitive) ? strtolower($item)==$value : $item==$value;
		if($ret)
			return $ret;
	}
	return false;
}
