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

    public function add(string $text, string $creator)
    {
        try {
            $this->query('INSERT INTO quotes(text, creator) VALUES(:text, :creator)');
            $this->bind(':text', $text);
            $this->bind(':creator', $creator);
            $this->execute();
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($e).' on line '.$e->getLine().' of '.$e->getFile().': '.$e->getMessage().'</div>';
        }

        if ($this->lastInsertId()) {
            header('Location: index.php');
        }
    }
}