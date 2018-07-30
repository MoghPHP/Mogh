<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class Query 
{
	
    public $db;
    public $config;
	function __construct(array $config)
	{
        self::$config = $config;
        self::$instance = null;
        
        $this->declare    = '';
        $this->statement  = '';
        $this->clause     = '';
        $this->table      = '';            
        $this->join       = '';
        $this->where      = ' WHERE 1=1 ';
        $this->clause2    = '';
        $this->groupby    = '';
        $this->orderby    = '';
        $this->table      = '';
	}
	function Table($tablename,$alias)
	{
		$this->table      = $tablename . (isset($alias) ? ' ' . $alias : '');
		return $this;
	}
	function Find($pk = "0")
	{

		return self::$db->First(implode(" ", (array)$this));
	}
	function First($select = "*")
	{

		return self::$db->First(implode(" ", (array)$this));
	}
	function FirstNew($select = "*")
	{

		return self::$db->First(implode(" ", (array)$this));
	}
	function Select($select = "*")
	{
		$this->statement 	= 'SELECT ' . $select . ' FROM ';
		return $this;// self::$db->ResultSet(implode(" ", (array)$this));
	}
	function SelectNew($select = "*")
	{

		return self::$db->ResultSet(implode(" ", (array)$this));
	}
	function All()
	{
		return self::$db->ResultSet(implode(" ", (array)$this));
	}
	function Join($tablename,$alias)
	{

	}
	function On($p1,$p2)
	{

	}
	function Where($w1,$w2,$w3)
	{
		if(is_array($w1))
        {
            foreach ($w1 as $key => $value) 
            {
                if(!is_array($value))
                {
                    $this->where .= ' AND ' . $key . " ='". $value ."'";
                }else
                {                
                    $this->where .= ' AND ' ;
                    foreach ($value as $key2 => $val) 
                    {
                        $this->where .=  $key . " ". $key2 ." '". $val ."'";
                    }
                }
            }
        }
        if(isset($w1) && !is_array($w1) && !isset($w2) && !isset($w3))
        {
            $this->where .= ' AND ('. $w1 .')';
        }
        if(!is_array($w1) && isset($w1) && isset($w2) && isset($w3))
        {
            $this->where .= ' AND ' . $w1 . ' ' . $w2 . ' ' . $w3;
        }
        if(!is_array($w1) && !isset($w3) && isset($w2))
        {
            $this->where .= ' AND ' . $w1 . ' = ';
            switch (gettype($w2)) {
                case 'string':
                    $this->where .= "'" . $w2 . "'";
                    break;
                
                default:
                    $this->where .= $w2;
                    break;
            }
        }
		return $this;
	}
	function Take(int $count=9)
	{

		return $this;
	}
}

/**
 * 
 */
class Home
{
	
	function __construct()
	{
		Query::Table('Accounts')->All();

	}
}