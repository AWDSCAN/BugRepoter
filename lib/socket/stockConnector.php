<?php
class stockConnector
{
	  public static $instance = null;
	  public $conn;

	  public function __construct($ip, $port)
	  {
		  set_time_limit(0);
		  $errno  = 0;
		  $errstr = '';
		  $this->conn = fsockopen($ip, intval($port), $errno, $errstr, 10);
		  if (!$this->conn) {
				throw new Exception("fsockopen() 失败: [{$errno}] {$errstr}");
		  }
		  // 设置读取超时 3 秒
		  stream_set_timeout($this->conn, 3);
	  }

	  public static function getInstance()
	  {
			if (is_null(self::$instance)) {
				self::$instance = new stockConnector;
			}
			return self::$instance;
	  }

	  public function sendMsg($msg)
	  {
			fwrite($this->conn, $msg);
	  }

	  public function getMsg()
	  {
			$data = '';
			while (!feof($this->conn)) {
				$buf = fread($this->conn, 1024);
				if ($buf === false || $buf === '') {
					// 超时或无数据
					break;
				}
				$data .= $buf;
				$info = stream_get_meta_data($this->conn);
				if ($info['timed_out']) {
					break;
				}
				// 收到完整 JSON 即可退出
				if (json_decode($data) !== null) {
					break;
				}
			}
			fclose($this->conn);
			return $data;
	  }
}

?>