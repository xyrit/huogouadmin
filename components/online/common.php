<?php
header ( 'Content-type:text/html;charset=utf-8' );
include_once (__DIR__ . '/log.class.php');
include_once (__DIR__ . '/SDKConfig.php');
include_once (__DIR__ . '/secureUtil.php');
// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );

/**
 * 字符串转换为 数组
 *
 * @param unknown_type $str        	
 * @return multitype:unknown
 */
function convertStringToArray($str) {
	$result = array ();
	
	if (! empty ( $str )) {
		$temp = preg_split ( '/&/', $str );
		if (! empty ( $temp )) {
			foreach ( $temp as $key => $val ) {
				$arr = preg_split ( '/=/', $val, 2 );
				if (! empty ( $arr )) {
					$k = $arr ['0'];
					$v = $arr ['1'];
					$result [$k] = $v;
				}
			}
		}
	}
	return $result;
}

/**
 * 压缩文件 对应java deflate
 *
 * @param unknown_type $params        	
 */
function deflate_file(&$params) {
	global $log;
	foreach ( $_FILES as $file ) {
		$log->LogInfo ( "---------处理文件---------" );
		if (file_exists ( $file ['tmp_name'] )) {
			$params ['fileName'] = $file ['name'];
			
			$file_content = file_get_contents ( $file ['tmp_name'] );
			$file_content_deflate = gzcompress ( $file_content );
			
			$params ['fileContent'] = base64_encode ( $file_content_deflate );
			$log->LogInfo ( "压缩后文件内容为>" . base64_encode ( $file_content_deflate ) );
		} else {
			$log->LogInfo ( ">>>>文件上传失败<<<<<" );
		}
	}
}

/**
 * 处理报文中的文件
 *
 * @param unknown_type $params        	
 */
function deal_file($params, $fileName="") {
	global $log;
	if (isset ( $params ['fileContent'] )) {
		$log->LogInfo ( "---------处理后台报文返回的文件---------" );
		$fileContent = $params ['fileContent'];
		
		if (empty ( $fileContent )) {
			$log->LogInfo ( '文件内容为空' );
			return false;
		} else {
			// 文件内容 解压缩
			$content = gzuncompress ( base64_decode ( $fileContent ) );
			$root = SDK_FILE_DOWN_PATH;
			$filePath = null;
			if (empty ( $params ['fileName'] )) {
				$log->LogInfo ( "文件名为空" );
				$filePath = $root . $fileName; 
			} else {
				$filePath = $root . $params ['fileName'];
			}
			$handle = fopen ( $filePath, "w+" );
			if (! is_writable ( $filePath )) {
				$log->LogInfo ( "文件:" . $filePath . "不可写，请检查！" );
				return false;
			} else {
				file_put_contents ( $filePath, $content );
				$log->LogInfo ( "文件位置 >:" . $filePath );
			}
			fclose ( $handle );
		}
		return true;
	} else {
		return false;
	}
}

/**
 * 构造自动提交表单
 *
 * @param unknown_type $params        	
 * @param unknown_type $action        	
 * @return string
 */
function create_html($params, $action) {
	// <body onload="javascript:document.pay_form.submit();">
	$encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
	$html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$action}" method="post">
	
eot;
	foreach ( $params as $key => $value ) {
		$html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
	}
	$html .= <<<eot
   <!-- <input type="submit" type="hidden">-->
    </form>
</body>
</html>
eot;
	return $html;
}

/**
 * map转换string
 *
 * @param
 *        	$customerInfo
 */
function getCustomerInfoStr($customerInfo) {
  if($customerInfo == null || count($customerInfo) == 0 )
  	return "";
	return base64_encode ( "{" . createLinkString ( $customerInfo, false, false ) . "}" );
}

/**
 * map转换string，按新规范加密
 *
 * @param
 *        	$customerInfo
 */
function getCustomerInfoStrNew($customerInfo) {
  if($customerInfo == null || count($customerInfo) == 0 )
  	return "";
	$encryptedInfo = array();
	foreach ( $customerInfo as $key => $value ) {
		if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired' ) {
		//if ($key == 'phoneNo' || $key == 'cvn2' || $key == 'expired' || $key == 'certifTp' || $key == 'certifId') {
			$encryptedInfo [$key] = $customerInfo [$key];
			unset ( $customerInfo [$key] );
		}
	}
	if( count ($encryptedInfo) > 0 ){
		$encryptedInfo = createLinkString ( $encryptedInfo, false, false );
		$encryptedInfo = encryptData ( $encryptedInfo, SDK_ENCRYPT_CERT_PATH );
		$customerInfo ['encryptedInfo'] = $encryptedInfo;
	}
	return base64_encode ( "{" . createLinkString ( $customerInfo, false, false ) . "}" );
}

/**
 * 讲数组转换为string
 *
 * @param $para 数组        	
 * @param $sort 是否需要排序        	
 * @param $encode 是否需要URL编码        	
 * @return string
 */
function createLinkString($para, $sort, $encode) {
	$linkString = "";
	if ($sort) {
		$para = argSort ( $para );
	}
	while ( list ( $key, $value ) = each ( $para ) ) {
		if ($encode) {
			$value = urlencode ( $value );
		}
		$linkString .= $key . "=" . $value . "&";
	}
	// 去掉最后一个&字符
	$linkString = substr ( $linkString, 0, count ( $linkString ) - 2 );
	
	return $linkString;
}

/**
 * 对数组排序
 *
 * @param $para 排序前的数组
 *        	return 排序后的数组
 */
function argSort($para) {
	ksort ( $para );
	reset ( $para );
	return $para;
}

/**
 * 后台交易 HttpClient通信
 *
 * @param unknown_type $params        	
 * @param unknown_type $url        	
 * @return mixed
 */
function post($params, $url, &$errmsg) {
	$opts = createLinkString ( $params, false, true );
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false ); // 不验证证书
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false ); // 不验证HOST
	curl_setopt ( $ch, CURLOPT_SSLVERSION, 3 );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
			'Content-type:application/x-www-form-urlencoded;charset=UTF-8' 
	) );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $opts );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	$html = curl_exec ( $ch );
	if(curl_errno($ch)){
		$errmsg = curl_error($ch);
		curl_close ( $ch );
		return false;
	}
    if( curl_getinfo($ch, CURLINFO_HTTP_CODE) != "200"){
		$errmsg = "http状态=" . curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close ( $ch );
		return false;
    }
	curl_close ( $ch );
	return $html;
}

/**
 * 打印请求应答
 *
 * @param
 *        	$url
 * @param
 *        	$req
 * @param
 *        	$resp
 */
function printResult($url, $req, $resp) {
	echo "=============<br>\n";
	echo "地址：" . $url . "<br>\n";
	echo "请求：" . str_replace ( "\n", "\n<br>", htmlentities ( createLinkString ( $req, false, true ) ) ) . "<br>\n";
	echo "应答：" . str_replace ( "\n", "\n<br>", htmlentities ( $resp ) ) . "<br>\n";
	echo "=============<br>\n";
}
?>