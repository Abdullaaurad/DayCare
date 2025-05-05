<?php

namespace Modal;

defined('ROOTPATH') or exit('Access denied');

trait Modal
{
    use Database;

    protected $limit = 10;
    protected $offset = 0;
    protected $order_type = "desc";
    protected $order_column = "id";
    public $errors = [];
    public $values = [];

    public function test()
    {
        $query = "select * from users";
        $result = $this->query($query);
        show($result);
    }

    public function findall()
    {
        $query = "select * from $this->table";
        return $this->query($query);
    }

    public function findall_order($orderBy = null, $direction = "ASC")
    {
        $query = "SELECT * FROM $this->table";

        // Validate sorting direction
        $direction = strtoupper($direction);
        if (!in_array($direction, ["ASC", "DESC"])) {
            $direction = "ASC"; // Default to ASC if invalid input is given
        }

        // Apply ordering if a column is specified
        if ($orderBy) {
            $query .= " ORDER BY $orderBy $direction";
        }

        return $this->query($query);
    }

    public function getSortedData($orderBy = [], $defaultDirection = "ASC")
    {
        $query = "SELECT * FROM $this->table";

        if (is_string($orderBy)) {
            $orderBy = [$orderBy => $defaultDirection];
        }

        // Build ORDER BY clause
        if (!empty($orderBy)) {
            $orderParts = [];

            foreach ($orderBy as $column => $direction) {
                $dir = strtoupper($direction);
                if (!in_array($dir, ["ASC", "DESC"])) {
                    $dir = strtoupper($defaultDirection);
                }
                $orderParts[] = "$column $dir";
            }

            $query .= " ORDER BY " . implode(", ", $orderParts);
        }

        return $this->query($query);
    }


    public function where_norder($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }

        foreach ($keys_not as $key) {
            $query .= $key . "!= :" . $key . " AND ";
        }

        $query = substr($query, 0, strrpos($query, " AND "));

        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function where_order($data, $data_not = [], $order_by = null)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        if (strrpos($query, " AND ") !== false) {
            $query = substr($query, 0, strrpos($query, " AND "));
        }

        if ($order_by) {
            $query .= " ORDER BY " . $order_by . " ASC";
        }

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }

    public function where_order_desc($data, $data_not = [], $order_by = null)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";

        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . " != :" . $key . " AND ";
        }

        // Remove the last "AND"
        if (strrpos($query, " AND ") !== false) {
            $query = substr($query, 0, strrpos($query, " AND "));
        }

        // Ensure $order_by is a valid string
        if (!empty($order_by) && is_string($order_by)) {
            $query .= " ORDER BY " . $order_by . " DESC";  // Change ASC to DESC
        }

        $data = array_merge($data, $data_not);

        return $this->query($query, $data);
    }


    public function where($data, $data_not = [])
    {

        // $data = [
        //     'name' => 'John',
        //     'email' => 'john@example.com',
        //     'age' => 30
        // ];
        // $keys = ['name', 'email', 'age'];

        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " AND ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . "!=:" . $key . " AND ";
        }

        $query = rtrim($query, " AND ");
        $query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        //In this query, :id is a named placeholder or parameter marker used in prepared statements.

        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "select * from $this->table where ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " && ";
        }
        foreach ($keys_not as $key) {
            $query .= $key . "!=:" . $key . " && ";
        }

        $query = trim($query, " && ");
        $query .= " limit $this->limit offset $this->offset";

        $data = array_merge($data, $data_not);
        // ! can use the below
        // return $this->get_row($query, $data, $data_not);

        //! or this
        $result = $this->query($query, $data, $data_not);
        if ($result) {
            return $result[0];
        }
        return false;
    }

    public function insert($data)
    {
        // Filter to include only allowed columns
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        $keys = array_keys($data);
        $placeholders = array_map(fn($key) => ":$key", $keys);
        $query = "INSERT INTO $this->table (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $this->query($query, $data);

        return false; // Optional return
    }

    //$id_column specifies the columns name we are going to use
    public function update_withid($id, $data, $id_column = 'id')
    {
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                };
            };
        };
        $keys = array_keys($data);
        $query = "update $this->table set ";
        foreach ($keys as $key) {
            $query .= $key . " = :" . $key . " , ";
        }

        $query = trim($query, ", ");
        $query .= " where $id_column = :$id_column";
        // var_dump($query);
        // exit();
        $data[$id_column] = $id;
        return ($this->query($query, $data));
    }

    public function delete($id, $id_column = 'id')
    {

        $data[$id_column] = $id;
        $query = "delete from $this->table where $id_column = :$id_column";
        $this->query($query, $data);
    }

    public function update($condition, $data)
    {
        // Initialize arrays for the condition part of the query
        $conditionKeys = [];
        $conditionValues = [];

        // Loop through the conditions and prepare the WHERE clause
        foreach ($condition as $key => $value) {
            $conditionKeys[] = "$key = :$key"; // Add each condition column
            $conditionValues[":$key"] = $value; // Bind the values for conditions
        }

        // Filter allowed columns for data (to prevent SQL injection)
        if (!empty($this->allowedColumns)) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]); // Remove data that is not in allowed columns
                }
            }
        }
        if(empty($data)) {
            return false; // No data to update
        }

        // Prepare the SET clause for the query
        $setClauses = [];
        foreach ($data as $key => $value) {
            $setClauses[] = "$key = :$key"; // Construct the SET part for each column
            $conditionValues[":$key"] = $value; // Add the data to the parameters
        }

        // Construct the full query
        $query = "UPDATE $this->table SET " . implode(", ", $setClauses);
        $query .= " WHERE " . implode(" AND ", $conditionKeys); // Join the conditions with AND
        // Execute the query with the combined data and conditions

        return $this->query($query, $conditionValues);
    }

    public function findFutureDates($firstdate, $lastdate, $column = 'Date')
    {
        // Convert DateTime objects to strings
        if ($firstdate instanceof \DateTime) {
            $firstdate = $firstdate->format('Y-m-d');
        }
        if ($lastdate instanceof \DateTime) {
            $lastdate = $lastdate->format('Y-m-d');
        }

        // Validate date strings
        if (!strtotime($firstdate) || !strtotime($lastdate)) {
            return false;
        }

        // Sanitize column name to prevent SQL injection (only allow certain characters)
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
            return false;
        }

        // Build the query with the dynamic column
        $query = "SELECT * FROM $this->table WHERE `$column` >= :firstdate AND `$column` <= :lastdate";
        $params = ['firstdate' => $firstdate, 'lastdate' => $lastdate];
        return $this->query($query, $params);
    }

    public function findFutureDatesWithConditions($firstdate, $lastdate, $where = [], $column = 'Date')
    {
        // Convert DateTime objects to strings
        if ($firstdate instanceof \DateTime) {
            $firstdate = $firstdate->format('Y-m-d');
        }
        if ($lastdate instanceof \DateTime) {
            $lastdate = $lastdate->format('Y-m-d');
        }

        // Validate date strings
        if (!strtotime($firstdate) || !strtotime($lastdate)) {
            return false;
        }

        // Sanitize column name to prevent SQL injection
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $column)) {
            return false;
        }

        // Start building WHERE clause
        $whereClause = "`$column` >= :firstdate AND `$column` <= :lastdate";
        $params = [
            'firstdate' => $firstdate,
            'lastdate' => $lastdate
        ];

        // Add additional WHERE conditions
        foreach ($where as $key => $value) {
            if (preg_match('/^[a-zA-Z0-9_]+$/', $key)) {
                $whereClause .= " AND `$key` = :$key";
                $params[$key] = $value;
            }
        }

        // Build the final query with ORDER BY
        $query = "SELECT * FROM $this->table WHERE $whereClause ORDER BY `$column` ASC";

        return $this->query($query, $params);
    }

    public function groupByCount($columnToCount, $groupByColumn, $where = [])
    {
        // Sanitize allowed columns
        if (!empty($this->allowedColumns)) {
            if (!in_array($columnToCount, $this->allowedColumns) || !in_array($groupByColumn, $this->allowedColumns)) {
                return false;
            }
        }

        // Prepare WHERE clause
        $whereClause = "";
        $params = [];

        if (!empty($where)) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts[] = "`$key` = :$key";
                $params[$key] = $value;
            }
            $whereClause = "WHERE " . implode(" AND ", $whereParts);
        }

        // Build query without HAVING
        $query = "SELECT {$this->table}.*, COUNT(`$columnToCount`) as count 
                        FROM $this->table 
                        $whereClause 
                        GROUP BY `$groupByColumn`";

        return $this->query($query, $params);
    }

    public function countGroupBy($columnToCount, $groupByColumn, $havingOperator = '>', $havingCount = 0, $where = [])
    {
        // Sanitize allowed columns
        if (!empty($this->allowedColumns)) {
            if (!in_array($columnToCount, $this->allowedColumns) || !in_array($groupByColumn, $this->allowedColumns)) {
                return false;
            }
        }

        // Validate operator
        $validOperators = ['=', '>', '<', '>=', '<=', '!='];
        if (!in_array($havingOperator, $validOperators)) {
            $havingOperator = '>'; // Default to '>'
        }

        // Prepare WHERE clause
        $whereClause = "";
        $params = [];

        if (!empty($where)) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $whereParts[] = "`$key` = :$key";
                $params[$key] = $value;
            }
            $whereClause = "WHERE " . implode(" AND ", $whereParts);
        }

        $query = "SELECT {$this->table}.*, COUNT(`$columnToCount`) as count 
                        FROM $this->table 
                        $whereClause 
                        GROUP BY `$groupByColumn`
                        HAVING count $havingOperator :havingCount";

        $params['havingCount'] = $havingCount;
        return $this->query($query, $params);
    }

    public function countGroupByJoin(
        $columnToCount,
        $groupByColumn,
        $havingOperator = '>',
        $havingCount = 0,
        $join, // [ 'table' => 'users', 'on' => 'users.UserID = reservations.UserID' ]
        $where = []
    ) {
        // Sanitize allowed columns if needed
        if (!empty($this->allowedColumns)) {
            if (!in_array($columnToCount, $this->allowedColumns) || !in_array($groupByColumn, $this->allowedColumns)) {
                return false;
            }
        }

        // Validate HAVING operator
        $validOperators = ['=', '>', '<', '>=', '<=', '!='];
        if (!in_array($havingOperator, $validOperators)) {
            $havingOperator = '>';
        }

        // Prepare JOIN clause
        $joinClause = '';
        if ($join && isset($join['table'], $join['on'])) {
            $joinClause = "JOIN {$join['table']} ON {$join['on']}";
        }

        // Prepare WHERE clause
        $whereClause = '';
        $params = [];

        if (!empty($where)) {
            $whereParts = [];
            foreach ($where as $key => $value) {
                $paramKey = str_replace('.', '_', $key); // Prevent issues with aliases in param keys
                $whereParts[] = "`$key` = :$paramKey";
                $params[$paramKey] = $value;
            }
            $whereClause = "WHERE " . implode(" AND ", $whereParts);
        }

        // Final SQL query
        $query = "SELECT {$this->table}.* , COUNT(`$columnToCount`) as count
                        FROM $this->table
                        $joinClause
                        $whereClause
                        GROUP BY `$groupByColumn`
                        HAVING count $havingOperator :havingCount";

        $params['havingCount'] = $havingCount;
        return $this->query($query, $params);
    }

    }
