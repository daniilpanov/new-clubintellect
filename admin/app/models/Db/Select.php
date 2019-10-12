<?php


namespace admin\app\models\Db;


class Select extends Query
{
    public $table;
    public $items = "*";
    public $where = null;
    public $group = null;
    public $limit = null;
    public $order = null;
    public $order_type = "asc";

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function what($items)
    {
        $this->items = $items;
        return $this;
    }

    public function where($col, $value, $op = "=")
    {
        $this->where[] = ['col' => $col, 'val' => $value, 'op' => $op];
        return $this;
    }

    public function wAnd($col, $value, $op = "=")
    {
        $this->where[$col] = ['prefix' => "and", 'col' => $col, 'val' => $value, 'op' => $op];
        return $this;
    }

    public function wOr($col, $value, $op = "=")
    {
        $this->where[$col] = ['prefix' => "or", 'col' => $col, 'val' => $value, 'op' => $op];
        return $this;
    }

    public function order($col, $value = null)
    {
        $this->order[] = ($value !== null) ? (['col' => $col, 'val' => $value]) : (['col' => $col]);
        return $this;
    }

    public function asc()
    {
        $this->order_type = "asc";
        return $this;
    }

    public function desc()
    {
        $this->order_type = "desc";
        return $this;
    }

    public function group($col)
    {
        $this->group[] = $col;
        return $this;
    }

    public function limit($limit, $start = null)
    {
        $this->limit = ($start === null) ? (['limit' => $limit]) : (['start' => $start, 'limit' => $limit]);
        return $this;
    }

    public function getSql($reinit = true)
    {
        if ($reinit)
        {
            $this->sql = "select {$this->items} from {$this->table}";

            if ($this->where !== null)
            {
                $this->sql .= " where";

                foreach ($this->where as $item_value)
                {
                    if (isset($item_value['prefix']))
                        $this->sql .= " " . $item_value['prefix'];

                    $this->sql .= " {$item_value['col']}{$item_value['op']}'{$item_value['val']}'";
                }

                if ($this->group !== null)
                {
                    $this->sql .= " group by ";

                    foreach ($this->group as $col)
                    {
                        $this->sql .= $col . ", ";
                    }

                    $this->sql = substr($this->sql, 0, -2);
                }

                if ($this->order !== null)
                {
                    $this->sql .= " order by ";

                    foreach ($this->order as $col_value)
                    {
                        $this->sql
                            .= (isset($col_value['val'])
                                ? $col_value['col'] . "='" . $col_value['val'] . "'"
                                : $col_value['col']
                            ) . ", ";
                    }

                    $this->sql = substr($this->sql, 0, -2);

                    $this->sql .= " " . $this->order_type;
                }

                if ($this->limit !== null)
                {
                    $this->sql .= " limit ";

                    $this->sql
                        .= (isset($this->limit['start'])
                            ? $this->limit['start'] . ", " . $this->limit['limit']
                            : $this->limit
                    );
                }
            }
        }

        return $this->sql;
    }
}