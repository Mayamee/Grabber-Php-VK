<?php

	function curl($url) {
		$ch = curl_init($url);
		curl_setopt ($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt ($ch,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt ($ch,CURLOPT_SSL_VERIFYPEER,false);
		$response = curl_exec($ch);
		curl_close ($ch);
		return $response;
	}
	function get_rand_elem($arr) {
		if(isset($arr) && is_array($arr)) return $arr[mt_rand(0, count($arr) - 1)];
		return null;
	}

	class Grabber
	{
		public function __construct($TOKEN, $OWN_GROUP, $ID_GROUP, $MAX_POST) {
			$this->token = $TOKEN;
			$this->id_group = $OWN_GROUP;
			$this->id_group_grab = $ID_GROUP;
			if($MAX_POST > 100 || $MAX_POST < 1){
				echo "MAX_POST exceeded the limit and will be set to 100";
				$MAX_POST = 100;
			}
			$this->max_post = $MAX_POST;
		}
		public function do()
		{
			$count = rand(0,$this->max_post);
			$req_get1 = "https://api.vk.com/method/wall.get?owner_id=".$this->id_group_grab."&count=100&v=5.131&access_token=".$this->token."";
			$query = curl($req_get1);
			$array_info = json_decode($query, true);
			if(isset($array_info["response"]["items"][$count]["attachments"]))
			{
				foreach ($array_info["response"]["items"][$count]["attachments"] as $key => &$value)
				{
					$type = $array_info["response"]["items"][$count]["attachments"][$key]["type"];
					$attachments .= $type.$array_info["response"]["items"][$count]["attachments"][$key][$type]["owner_id"]."_".$array_info["response"]["items"][$count]["attachments"][$key][$type]["id"].",";
				}
				$attachments = substr($attachments, 0, -1);
				$req_get2 = "https://api.vk.com/method/wall.post?owner_id=".$this->id_group."&from_group=1&message=".urlencode($array_info["response"]["items"][$count]["text"])."&attachments=".$attachments."&v=5.131&access_token=".$this->token."";
				$query = curl($req_get2);
				$array_info = json_decode($query, true);
				print_r($query);
			}
			else
			{
				$req_post = "https://api.vk.com/method/wall.post?owner_id=".$this->id_group."&from_group=1&message=".urlencode($array_info["response"]["items"][$count]["text"])."&v=5.131&access_token=".$this->token."";
				$query = curl($req_post);
				print_r($query);
			}
		}
		public function do_more($N, $delay) {
			if(!isset($N) || !is_numeric($N) || !isset($delay) || !is_numeric($delay)) return NULL;
			for ($iter = 0; $iter < $N; $iter++) { 
					$this->do();
					sleep($delay);
				}
		}
	}
?>