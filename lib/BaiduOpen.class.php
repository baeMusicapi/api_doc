<?php
/**
 * 百度开放平台
 * @author zhaojian01
 *
 */
class BaiduOpen{
	public $clientID = 'yNXeNB87IYd414n7MMYfR4b4';
	public $clientSecret = 'ivQaMWOM5sfuWosWmQMQumq6GSxQG9S1';
	
	
	public function getAccessToken(){
		///////////
		$clientID = $this->clientID;
		$clientSecret = $this->clientSecret;
		
		$url = "https://openapi.baidu.com/oauth/2.0/token?grant_type=client_credentials&client_id=Ov6Moy96w6MwfYBB2nQ2bcws&client_secret=DppfSUG8nBjwhLcdSsNDnYhu3YyrKa4U";
		$result = Util_HttpRequest::Get($url);
		$result = json_decode($result,true);
		dump($result);
	}
	
	public function request($url,$param){
		$params = array(
				"session_key" => "9XNNXe66zOlSassjSKD5gry9BiN61IUEi8IpJmjBwvU07RXP0J3c4GnhZR3GKhMHa1A=",
				"timestamp" => "2011-06-21 17:18:09",
				"format" => "json",
				"uid" => $uid,
		);
	}
	
	
	/**
	 * 签名生成算法
	 * @param  array  $params API调用的请求参数集合的关联数组，不包含sign参数
	 * @param  string $secret 签名的密钥即获取access token时返回的session secret
	 * @return string 返回参数签名值
	 */
	function getSignature($params, $secret)
	{
		$str = '';  //待签名字符串
		//先将参数以其参数名的字典序升序进行排序
		ksort($params);
		//遍历排序后的参数数组中的每一个key/value对
		foreach ($params as $k => $v) {
			//为key/value对生成一个key=value格式的字符串，并拼接到待签名字符串后面
			$str .= "$k=$v";
		}
		//将签名密钥拼接到签名字符串最后面
		$str .= $secret;
		//通过md5算法为签名字符串生成一个md5签名，该签名就是我们要追加的sign参数值
		return md5($str);
	}
}