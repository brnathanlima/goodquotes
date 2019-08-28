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
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }

        if ($this->lastInsertId()) {
            header('Location: index.php');
        }
    }

    public function getSingle(int $id): array
    {
        try {
            $this->query('SELECT * FROM quotes WHERE id=:id');
            $this->bind(':id', $id);
            $row = $this->single();
            return $row;
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
    }

    public function update(int $id, string $text, string $creator)
    {
        try {
            $this->query('UPDATE quotes SET text=:text, creator=:creator WHERE id=:id');
            $this->bind(':text', $text);
            $this->bind(':creator', $creator);
            $this->bind(':id', $id);
            $this->execute();
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        }
        header('Location: index.php');
    }

    public function remove(int $id)
    {
        try {
            $this->query('DELETE FROM quotes WHERE id=:id');
            $this->bind(':id', $id);
            $this->execute();
        } catch (\Throwable $th) {
            echo '<div class="alert alert-danger">'.get_class($th).' on line '.$th->getLine().' of '.$th->getFile().': '.$th->getMessage().'</div>';
        } finally {
            header('Location: index.php');
        }
    }
}