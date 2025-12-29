<?php

trait Model
{
    use Database;
    
    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];

    public function distinct($column)
    {
        $query = "SELECT DISTINCT $column FROM $this->table ORDER BY $this->order_column $this->order_type limit $this->limit offset $this->offset";
        
        return $this->query($query);
    }
    public function find_all()
    {
        $query = "SELECT * FROM $this->table ORDER BY $this->order_column $this->order_type limit $this->limit offset $this->offset";
        
        return $this->query($query);
    }
    public function where($data, $data_not = [])
    {
        // we get the values separately to avoid confusion in the query
        // lastly we merge them before executing the query

        $keys = array_keys($data); // get the keys of the data array
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " ORDER BY $this->order_column $this->order_type limit $this->limit offset $this->offset";
//        echo $query;
        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " && ";
        }
        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";
//        echo $query;
        $data = array_merge($data, $data_not);

        $result = $this->query($query, $data);
        if ($result) {
            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        $keys = array_keys($data); // get the keys of the data array
        $query = "INSERT INTO $this->table (". implode(",", $keys) .") VALUES (:". implode(",:", $keys) .")";
        $this->query($query, $data);
        
        return false;
    }

    public function update($id, $data, $id_column = 'id')
    {
        // filter the data to only allowed columns
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data); // get the keys of the data array
        $query = "UPDATE $this->table SET  ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . ", ";
        }
        
        $query = trim($query, ", ");
        $query .= " WHERE $id_column = :$id_column ";
        $data[$id_column] = $id;
        
        echo $query;
        $this->query($query, $data);
        return false;
    }

    public function delete($id, $id_column = 'id')
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column ";

        echo $query;
        $this->query($query, $data);
        return false;
    }

}