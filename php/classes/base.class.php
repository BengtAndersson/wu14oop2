<?php

class Base {

	public function__get($name){
		return $this->{"get_".$name}();
	}

	ublic function__set($name, $val){
		$this->{"set_".$name}($val);
	}
}