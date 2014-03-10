<?php
if(isset($params['usr_function'])){
	$usr_params = array();
	if(isset($params['params']))
	{
		if(is_array($params['params']))
		{
			$usr_params = array($params['params']);
		}
		else
		{
			$usr_params = explode(',', $params['params']);
		}
	}
	echo call_user_func_array(array($this, $params['usr_function']), $usr_params);
	exit;
}
?>