<?php

class RegexGenerator {

	protected $regexExpression = "";

	/**
	 * this will match the given string
	 * 
	 * @param  string $str
	 * @return RegexGenerator
	 */
	public function find($str)
	{
		return $this->concat($this->sanitize($str));
	}

	/**
	 * this will match anything 
	 * 
	 * @return RegexGenerator
	 */
	public function anything()
	{
		return $this->concat(".*");
	}

	/**
	 * @param  string $str
	 * @return RegexGenerator
	 */
	public function maybe($str)
	{
		$str = "(?:" . $this->sanitize($str) . ")?";
		return $this->concat($str);
	}

	public function anythingBut($str)
	{
		$str = "(?!" . $this->sanitize($str) . ").*?";
		return $this->concat($str);
	}

	/**
	 * add slash when needed
	 * 
	 * @param  string $str
	 * @return string
	 */
	protected function sanitize($str)
	{
		return preg_quote($str, '/');
	}

	/**
	 * concat string and create regex rule
	 * 
	 * @param  string $str
	 * @return string 
	 */
	protected function concat($str)
	{
		$this->regexExpression .= $str;

		return $this;
	}

	/**
	 * get regex string
	 * 
	 * @return string
	 */
	public function get()
	{
		return $this->__toString();
	}

	/**
	 * add regex start and end slash
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return '/' . $this->regexExpression . '/';
	}

	/**
	 * test regex against given string
	 * 
	 * @param  string $str
	 * @return bool
	 */
	public function test($str)
	{
		//var_dump($this->get()); @debug
		return (bool) preg_match((string)$this, $str);
	}
}