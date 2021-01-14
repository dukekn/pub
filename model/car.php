<?php
namespace App\Model;

require CORE.DIRECTORY_SEPARATOR.'DataEngine'.DIRECTORY_SEPARATOR.'Database_PDO.php';

class CarModel
{
    private $dbh;

    public function __construct()
    {
        $this->db = new \App\Core\DataEngine\Database_PDO(DB_ENGINE);
    }

    public function getCars(int $offset ,int  $limit):array
    {
        $this->db->query('select * from car where is_visible = 1 LIMIT :offset , :limit');
        $this->db->bind(':offset', $offset);
        $this->db->bind(':limit', $limit);
        return $this->db->getArray();
    }

    public function getCarsCount()
    {
        $this->db->query('select count(id) as count from car where is_visible = 1');
        return $this->db->getSingle();
    }

    public function deleteSingle(int $id): bool
    {
        $this->db->query('UPDATE  car SET is_visible = 0 where id = :id');
        $this->db->bind(':id', $id);
        return ( $this->db->execute())? true : false;
    }

    public function deleteMultiple(string $array_str)
    {
        $qry = 'UPDATE  car SET is_visible = 0 where ';
        $arr = explode(',', $array_str);
        foreach ($arr as $key => $id)
        {
            if($key == 0)
            {
                $qry .= 'id='.$id;
            }else{
                $qry .= ' OR id='.$id;
            }
        }
        $this->db->query($qry);
        $this->db->execute();
    }

    public  function  create($array)
    {
        $columns = implode(',', array_keys($array));
        $values = '\''. implode('\',\'', array_values($array)) . '\'';
        $qry = 'INSERT INTO car('.$columns.')VALUES('.$values.')';

        $this->db->query($qry);
        $this->db->execute();
    }

    public  function  setCar($array , $id)
    {
        $qry = 'UPDATE car SET ';
        $i = 1;
        foreach ($array as $column => $value)
        {
            $qry .= $column .'=\''. $value .'\'';

            if($i < count($array))
            {
                $qry .= ',';
            }
            $i++;
        }

        $qry .= ' where id = :id';
        $this->db->query($qry);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    public  function  getSingle($id)
    {
       $qry = 'select
       c.is_hybrid,
       c.is_4x4,
       c.is_automatic,
       c.manufacturer,
       c.model,
       c.year,
       c.engine,
       c.fuel,
       c.email
       from car as c
       where c.id = :id';

        $this->db->query($qry);
        $this->db->bind(':id', $id);
        return $this->db->getSingle();

    }

}