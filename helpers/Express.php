<?php
/**
 * Created by PhpStorm.
 * User: chenyi
 * Date: 2015/12/10
 * Time: 10:58
 */
namespace app\helpers;

class Express
{
	static private $express_url = 'http://www.kuaidi100.com/query';

	private static function getContent($url)
	{
		$ch = curl_init();
		$timeout = 10;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);

		return $file_contents;
	}

	private static function json_array($json)
	{
		if ($json) {
			foreach ((array)$json as $k => $v) {
				$data[$k] = !is_string($v) ? self::json_array($v) : $v;
			}
			return $data;
		}
	}

	public static function getExpressName()
	{
		return self::getList();
	}

	public static function getOrder($name, $order)
	{
		$keywords = self::$expressName[$name];
		$url = self::$express_url . '?type=' . $keywords . '&postid=' . $order . '&id=1&temp=' . microtime(true);
		$result = self::getcontent($url);
		$json = json_decode($result, true);
		$data = self::json_array($json);
		return $data;
	}

	/**
	 *获取快递公司代号
	 */
	public static function getList($name = '')
	{
		$cache = \Yii::$app->cache;
		$expressKey = 'logistics_express';
		$expressKey = md5($expressKey);
		$data = $cache->get($expressKey);
		if (!$data) {
			$connection = \Yii::$app->db;
			$command = $connection->createCommand('SELECT * FROM express');
			$result = $command->queryAll();
			$data = [];
			foreach ($result as $k => &$v) {
				$data[$v['name']] = $v['keyword'];
			}
			$cache->set($expressKey, $data, 24 * 3600);
		}
		$data = (empty($name)) ? $data : $data[$name];
		return $data;


	}
}