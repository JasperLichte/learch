<?php

namespace Rendering;

use Request\AppContainer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class ViewRenderer extends Renderer
{

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(AppContainer $middleware)
    {
        parent::__construct($middleware);

        $basePath = realpath(__DIR__ . '/../..');

        $loader = new FilesystemLoader('/', $basePath . '/');
        $loader->addPath($basePath . '/', '__main__');
        $loader->addPath($basePath . '/templates/pages', 'pages');
        $loader->addPath($basePath . '/templates/components', 'components');
        $loader->addPath($basePath . '/templates/components/document', 'document');
        $loader->addPath($basePath . '/templates/components/common', 'common');

        $this->twig = new Environment($loader);
    }

    /**
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(): string
    {
        return $this->twig->render(
            $this->middleware->getTemplate() . '.twig',
            ['model' => $this->middleware->getModel(),]
        );
    }

}
