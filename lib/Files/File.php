<?php

namespace Files;

use Database\Connection;
use DateTime;

class File extends BasicFileModel
{

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
        $stmt = $db->getPdo()->prepare('SELECT data, mime, time FROM files WHERE id = ?');
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if (!is_array($item) || !count($item)) {
            return null;
        }

        $file = (new File())
            ->setMime($item['mime'])
            ->setData($item['data']);

        try {
            $file->setTime(new DateTime($item['time']));
        } catch (\Exception $e) {
        }
        return $file;
    }

}
