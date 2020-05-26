<?php

namespace Files;

use Database\Connection;

class File
{

    /** @var int */
    private $id = 0;

    /** @var string */
    private $mime = '';

    /** @var string */
    private $data = '';

    public function setMime(string $mime): File
    {
        $this->mime = $mime;
        return $this;
    }

    public function getMime(): string
    {
        return $this->mime;
    }

    public function setId(int $id): File
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): File
    {
        $this->data = $data;

        return  $this;
    }

    public static function load(Connection $db, int $id): ?File
    {
        $stmt = $db->getPdo()->prepare('SELECT data, mime FROM files WHERE id = ?');
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if (!is_array($item) || !count($item)) {
            return null;
        }

        return (new File())
            ->setMime($item['mime'])
            ->setData($item['data']);
    }

}
