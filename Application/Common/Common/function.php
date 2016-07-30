<?php

function p($str)
{
	echo '<pre>';
	print_r($str);
	echo '</pre>';
	die();
}

function alert_go($info, $url)
{
	header("Content-type: text/html; charset=utf-8");
	$href = U($url);
	echo '<script>window.alert("'.$info.'");window.location.href="'.$href.'"</script>';
	exit();
}

function alert_back($info)
{
	header("Content-type: text/html; charset=utf-8");
	echo '<script>window.alert("'.$info.'");window.location=document.referrer;</script>';
	exit();
}

function makeIndex(&$arr, $key)
{
	if ($arr == false) return array();

	$index 	= array();
	foreach ($arr as $val) {
		$_m_key = $val["{$key}"];
		$index["{$_m_key}"] = $val;
	}

	return $index;
}

function makeImplode(&$array, $key, $glue=',')
{
	if ( $array == false || empty($array) ) return NULL;

	$value	= array();
	$idx	= array();

	foreach ( $array as $val ) {
		$v	= $val["{$key}"];
		if (! isset($idx["{$v}"])) {
			$value[] = "{$v}";
		}

		$idx["{$v}"] = true;
	}

	unset($idx);

	return implode($glue, $value);
}

function get_ip_address($convert=false)
{
	$ip = "";
	foreach ( array('HTTP_CLIENT_IP',
		'HTTP_X_FORWARDED_FOR',
		'HTTP_X_FORWARDED',
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED',
		'REMOTE_ADDR') as $e ) {
		if ( getenv($e) ) {
			$ip = getenv($e);
			break;
		}
	}

	if ( ($comma=strpos($ip, ',')) !== false ) $ip = substr($ip, 0, $comma);
	if ($convert ) $ip = sprintf("%u", ip2long($ip));

	return $ip;
}
