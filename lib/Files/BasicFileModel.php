<?php

namespace Files;

use Database\Connection;
use DateTime;

class BasicFileModel
{

    /** @var int */
    private $id = 0;

    /** @var DateTime */
    private $time = null;

    public function setId(int $id): BasicFileModel
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setTime(DateTime $time): BasicFileModel
    {
        $this->time = $time;
        return $this;
    }

    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @param Connection $db
     * @return BasicFileModel[]
     */
    public static function loadAll(Connection $db): array
    {
        $stmt = $db->getPdo()->prepare('SELECT id, time FROm files ORDER BY time DESC');
        $stmt->execute();

        $files = [];
        foreach ($stmt->fetchAll() as $file) {
            try {
                $files[] = (new BasicFileModel())
                    ->setId($file['id'])
                    ->setTime(new DateTime($file['time']));
            } catch (\Exception $e) {
            }
        }
        return $files;
    }

}
