<?php

namespace Files;

use Database\Connection;

class BasicFileModel
{

    /** @var int */
    private $id = 0;

    public function setId(int $id): BasicFileModel
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param Connection $db
     * @return BasicFileModel[]
     */
    public static function loadAll(Connection $db): array
    {
        $stmt = $db->getPdo()->prepare('SELECT id FROm files ORDER BY time DESC');
        $stmt->execute();

        $files = [];
        foreach ($stmt->fetchAll() as $file) {
            $files[] = (new BasicFileModel())
                ->setId($file['id']);
        }
        return $files;
    }

}
