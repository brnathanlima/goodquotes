<?php
class Quote extends Database
{
    public function index()
    {
        $this->query('SELECT * FROM quotes ORDER BY create_date DESC');
        $i = 0;
        while ($rows = $this->resultSet()) {
            if ($i < count($rows)) {
                yield $rows[$i];
                $i++;
            } else {
                return count($rows).' quotes listed';
            }
        }
    }
}