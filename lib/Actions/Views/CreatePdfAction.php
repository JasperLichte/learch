<?php

namespace Actions\Views;

use Api\Action;
use Config\EnvNotSetException;
use DateTime;
use Spiritix\HtmlToPdf\Converter;
use Spiritix\HtmlToPdf\Input\UrlInput;
use Spiritix\HtmlToPdf\Output\StringOutput;
use Util\Url;

class CreatePdfAction extends Action
{

    public function run(): void
    {
        if (!$this->req->issetGet('path')) {
            $this->res->setStatus(400)->setMessage('param path empty');
            return;
        }

        try {
            $fileUrl = $this->createPdf($this->req->getGet('path'));
            $this->res->setData([
                'url' => (string)$fileUrl,
            ]);
        } catch (EnvNotSetException $e) {
            $this->res->setStatus(500);
        }
    }

    /**
     * @param string $path
     * @return Url
     * @throws EnvNotSetException
     */
    private function createPdf(string $path): Url
    {
        $input = new UrlInput();
        $input->setUrl((string)Url::to($path));

        $converter = new Converter($input, new StringOutput());
        $converter->setOptions([
            'title' => 'Briefing ' . (new DateTime())->format('F jS, Y H:i'),
        ]);
        $output = $converter->convert();

        return $this->storePdf($output->get());
    }

    /**
     * @param string $pdfData
     * @return Url
     * @throws EnvNotSetException
     */
    private function storePdf(string $pdfData): Url
    {
        $stmt = $this->db->getPdo()->prepare('INSERT INTO files (data, mime, time) VALUES (?, ?, NOW())');
        $stmt->execute([$pdfData, 'application/pdf']);
        $id = $this->db->getPdo()->lastInsertId();
        return Url::to('/file/' . $id);
    }
}
