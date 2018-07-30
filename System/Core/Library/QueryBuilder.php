<?php

/*
 * Mogh PHP Framework
 * Create & Developed By whintz 
 * https://github.com/MoghPHP/Mogh
*/

class QueryBuilder
{	
    public static $config = array();
    private static $db;
    private static $instance = NULL;

    function __construct(array $config)
    {
        self::$config = $config;
        self::$instance = null;
    }

    private function GetInstance()
    {
        if(!isset(self::$instance))
        {
            self::$db = new Database(self::$config);
            self::$instance = new QueryBuilder(self::$config);

        }
        return self::$instance;
    }

    public function from(string $tablename,string $alias = '')
    {

        $a = self::GetInstance();
        $a->declare    = '';
        $a->statement  = '';
        $a->clause     = '';
        $a->table      = '';            
        $a->join       = '';
        $a->where      = ' WHERE 1=1 ';
        $a->clause2    = '';
        $a->groupby    = '';
        $a->orderby    = '';
        $a->table      = ' '. $tablename . (isset($alias) ? ' ' . $alias : '');

        return $a; 
    }
    public function declare(array $data)
    {
        $this->declare .= 'declare @' . $data['Name'] . ' ' . $data['DataType'] .' = ' . '('. $data['Value'] .');';

        return $this;
    }
    public function join(string $from,string $alias = '')
    {
        $this->join .= ' JOIN ' . $from .' ' . $alias;
        return $this;
    }

    public function leftjoin(string $from,string $alias = '')
    {
        $this->join .= 'LEFT JOIN ' . $from .' ' . $alias;
        return $this;
    }

    public function rightjoin(string $from,string $alias = '')
    {
        $this->join .= 'RIGHT JOIN ' . $from .' ' . $alias;
        return $this;
    }

    public function fulljoin(string $from,string $alias = '')
    {
        $this->join .= 'FULL OUTER JOIN ' . $from .' ' . $alias;
        return $this;
    }

    public function on(array $on)
    {
        $this->join .= ' on 1=1 ';
        foreach ($on as $key => $value) 
        {            
            if(!is_array($value))
            {
                $this->join .= ' AND ' . $key . "=". $value ." ";
            }else{  

                $this->join .= ' AND ' ;
                foreach ($value as $key2 => $val) 
                {
                    $this->join .=  $key . " ". $key2 ." '". $val ."'";
                }
            }
        }
        return $this;
    }
    public function where($w1,$w2=null,$w3=null)
    {
        if(is_array($w1))
        {
            foreach ($w1 as $key => $value) 
            {
                if(!is_array($value))
                {
                    $this->where .= ' AND ' . $key . " ='". str_replace("'", "''", $value) ."'";
                }else
                {                
                    $this->where .= ' AND ' ;
                    foreach ($value as $key2 => $val) 
                    {
                        $this->where .=  $key . " ". $key2 ." '". str_replace("'", "''", $val) ."'";
                    }
                }
            }
        }
        if(isset($w1) && !is_array($w1) && !isset($w2) && !isset($w3))
        {
            if(substr_count($w1,"'") %2 !=0) $w1 = '1=1';
            
            $this->where .= ' AND ('. $w1 .')';
        }
        if(!is_array($w1) && isset($w1) && isset($w2) && isset($w3))
        {
            $this->where .= ' AND ' . $w1 . ' ' . $w2 . ' ' . str_replace("'", "''", $w3);
        }
        if(!is_array($w1) && !isset($w3) && isset($w2))
        {
            $this->where .= ' AND ' . $w1 . ' = ';
            switch (gettype($w2)) {
                case 'string':
                    $this->where .= "'" . str_replace("'", "''", $w2) . "'";
                    break;
                
                default:
                    $this->where .= $w2;
                    break;
            }
        }

        return $this;
    }

    public function groupby(string $groupby)
    {
        $this->groupby = ' GROUP BY ' . $groupby;
        return $this;
    }

    public function orderby(string $orderby,string $order = 'ASC')
    {
        $this->orderby = ' ORDER BY ' . $orderby .' '. $order;
        return $this;
    }

    public function ordernext(string $orderby,string $order = 'ASC')
    {
        $this->orderby .= ' ,' . $orderby .' '. $order;
        return $this;
    }
    public function All()
    {
        $this->statement = 'SELECT ' . $this->clause . ' * FROM ';

        $this->clause ='';

        return self::$db->ResultSet(implode(" ", (array)$this));
    }
    public function select(string $select ='*')
    {
        $this->statement = 'SELECT ' . $this->clause . ' ' . $select .' FROM ';
        $this->clause ='';
        
        return self::$db->ResultSet(implode(" ", (array)$this));
    }


    public function selectnew(array $data=null)
    {
        $select = "";
        $comma ="";
        foreach ($data as $key => $value) 
        {
            $select .= $comma . $value . " as " . $key;
            $comma = " , ";
        } 
        if(!isset($data)) $select = "*";       
        $this->statement = 'SELECT ' . $this->clause . ' ' . $select .' FROM ';
        $this->clause ='';

        return self::$db->ResultSet(implode(" ", (array)$this));
    }
    
    public function first(string $select ='*')
    {
        $this->statement = 'SELECT ' . $this->clause . ' ' . $select .' FROM ';
        $this->clause ='';

        return self::$db->First(implode(" ", (array)$this));
    }
    public function firstnew(array $data=null)
    { 
        $select = "";
        $comma ="";
        foreach ($data as $key => $value) 
        {
            $select .= $comma . $value . " as " . $key;
            $comma = " , ";
        } 
        if(!isset($data)) $select = "*";       
        $this->statement = 'SELECT ' . $this->clause . ' ' . $select .' FROM ';
        $this->clause ='';

        return self::$db->First(implode(" ", (array)$this));
    }
    public function take(int $count=0)
    {
        if(strtolower(self::$config["DB_DRIVER"]) == 'sqlsrv') 
            $this->clause = 'TOP ' . $count;
        if(strtolower(self::$config["DB_DRIVER"]) == 'mysql') 
            $this->clause2 = 'LIMIT ' . $count;
        if(strtolower(self::$config["DB_DRIVER"]) == 'oci') 
            $this->clause2 = 'WHERE ROWNUM <= ' . $count;
       
        return $this;
    }
    public function count(string $columnname ='*')
    {
        $this->statement = 'SELECT COUNT(' . $columnname . ') FROM';

        return self::$db->GetSingle(implode(" ", (array)$this));
    }
    public function Any()
    {
        $this->statement = 'SELECT COUNT(*) FROM';

        return self::$db->GetSingle(implode(" ", (array)$this)) > 0;
    }
    public function distinct(string $columnname ='0')
    {
        $this->statement = 'SELECT DISTINCT(' . $columnname . ') FROM';

        return self::$db->ResultSet(implode(" ", (array)$this));
    }
    public function average(string $columnname ='0')
    {
        $this->statement = 'SELECT AVG(' . $columnname . ') FROM';

        return self::$db->GetSingle(implode(" ", (array)$this));
    }
    public function min(string $columnname ='0')
    {
        $this->statement = 'SELECT MIN(' . $columnname . ') FROM';

        return self::$db->GetSingle(implode(" ", (array)$this));
    }
    public function max(string $columnname ='0')
    {
        $this->statement = 'SELECT MAX(' . $columnname . ') FROM';

        return self::$db->GetSingle(implode(" ", (array)$this));
    }
    public function sum(string $columnname ='0')
    {
        $this->statement = 'SELECT ISNULL(sum(' . $columnname . '),0) FROM';

        return self::$db->GetSingle(implode(" ", (array)$this));
    }
    public function delete()
    {
        $this->statement = 'DELETE FROM ';
        $stmt = self::$db->prepare(implode(" ", (array)$this));
        return $stmt->execute();
    }
    public function insert(array $data)
    {
        $this->statement = 'INSERT INTO ' . $this->table . ' ( ';
        $comma = "";
        foreach ($data as $key => $value) {
            $this->statement .= $comma . $key ;
            $comma = ' , ';
        }
        $this->statement .= ' ) VALUES (' ;
        $comma ="";
        foreach ($data as $key => $value) {
            $this->statement .= $comma;
            if(is_array($value))
            {
                $this->statement .= $value[0];
            }else{
                switch (gettype($value)) {
                    case 'int':
                    case 'double':
                    case 'float':
                        $this->statement .= $value;
                        break;
                    case 'boolean' :
                        $this->statement .= ($value ? 1 : 0);
                        break;
                    default:
                        $this->statement .= "N'". $value . "'";
                        break;
                }
            }
            $comma = ' , ';
        }
        $this->statement .= ')';
        $this->table ="";
        $this->where ="";

        
        $stmt = self::$db->prepare(implode(" ", (array)$this));
       
        return $stmt->execute();
    }
    public function insertCustom(array $data,$prepared = true)
    {
        $this->statement = 'INSERT INTO ' . $this->table . ' ( ';
        $comma = "";
        foreach ($data as $key => $value) {
            $this->statement .= $comma . $key ;
            $comma = ' , ';
        }
        $this->statement .= ' ) VALUES (' ;
        $comma ="";
        foreach ($data as $key => $value) {
            $this->statement .= $comma . ':' . $key;
            $comma = ' , ';
        }
        $this->statement .= ')';

        $this->table ="";
        $this->where ="";

        
        $stmt = self::$db->prepare(implode(" ", (array)$this));
        foreach ($data as $key => $value) {
            # code...
           
            if(is_array($value))
            { 
                //write(array_keys($value));
               // write($value[0] .'_' . $value[1]);
                $stmt->bindParam($key, $value[1], $value[0]);
            }    
        }
        return $stmt->execute();
    }
    public function update(array $data)
    {
        $this->statement = 'UPDATE '. $this->table  .' SET ';
        $this->table ='';
        $comma ="";
        foreach ($data as $key => $value) 
        {
            $this->statement .= $comma . $key . "=:". $key ."";
            $comma =' , ';
            
            $data[':'.$key] = $data[$key];
            unset($data[$key]);
        }
       

        $stmt = self::$db->prepare(implode(" ", (array)$this));
        $stmt->execute($data);

        return true;
    }

    public function execute($query)
    {
        $stmt = self::GetInstance()->db->prepare($query);

        return $stmt->execute();
    }
}
