<?php

/*
将输出的伙购字样改成夺宝
@$name string
*/
namespace app\helpers;

class Rename
{

	public static function duobao($from,$content)
	{
		//$from = Brower::whereFrom();
		if ($from==2) {
			return static::replaceText($content);
		}
		return $content;
	}


	public static function replaceText($content)
	{
		if (is_string($content)) {
			$content = str_replace('400-000-5000', '400-006-7060', $content);
			$content = str_replace('huogou.com', 'dddb.com', $content);
			$content = str_replace('5ykd.com', 'dddb.co', $content);
			$content = str_replace('伙购网盘', '夺宝网盘', $content);
			$content = str_replace('伙购网', '滴滴夺宝', $content);
			$content = str_replace('伙购币', '夺宝币', $content);
			$content = str_replace('我的伙购', '我的夺宝', $content);
			$content = str_replace('伙购', '夺宝', $content);
			$content = str_replace('伙够', '夺宝', $content);
			$content = str_replace('伙狗', '夺宝', $content);
			$content = str_replace('火购', '夺宝', $content);
			$content = str_replace('火够', '夺宝', $content);
			$content = str_replace('火狗', '夺宝', $content);
			$content = str_replace('火购', '夺宝', $content);
			$content = str_replace('亻火贝勾', '夺宝', $content);
		}
		return $content;
	}

}

?>