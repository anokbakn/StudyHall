<?php

class mathModel{

	public function insert($operation,$a,$b,$result)
	{
		$pdo = KITE::getInstance('pdo');
		$time_stamp = date("Y:m:d H:i:s");
		$pdo->exec("INSERT INTO maths(operation,a,b,result,time_stamp) VALUES('$operation',$a,$b,$result,'$time_stamp')");
		
	}
	
	public function log()
	{
		$pdo = KITE::getInstance('pdo');
		$stmt = $pdo->query("SELECT * from maths");
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$basket = KITE::getInstance('basket');
		foreach($result as $key =>$value)
			$basket->set('a'.$key,$value);
	}	

}

?>