<?php

namespace Dariuszp\Paginator\Render;

use Dariuszp\Paginator\Data\DataInterface;
use Dariuszp\Paginator\Data\PageInterface;


/**
 * Class Spaghetti
 * @package Dariuszp\Paginator\Render
 */
class Spaghetti implements RenderInterface
{
    const PAGE_PATTERN = '<li class="page-item %s"><a href="%s" class="page-link">%s</a></li>';

    private $activeClass = 'active';

    private $firstPageClass = 'first-page';

    private $lastPageClass = 'last-page';

    private $previousPageClass = 'previous-page';

    private $nextPageClass = 'next-page';

    private $firstPageLabel = 'First';

    private $lastPageLabel = 'Last';

    private $previousPageLabel = 'Previous';

    private $nextPageLabel = 'Next';

    /**
     * Simple constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        foreach($config as $name => $value) {
            if (property_exists(__CLASS__, $name)) {
                $this->$name = strval($value);
            }
        }
    }

    /**
     * @param DataInterface $data
     * @return string
     */
    public function render(DataInterface $data): string {
        $html = <<<HTML
<nav aria-label="Page navigation example">
    <ul class="pagination">
        {$this->getPageHtml($data->getFirstPage(), $this->firstPageClass, $this->firstPageLabel)}            
        {$this->getPageHtml($data->getPreviousPage(), $this->previousPageClass, $this->previousPageLabel)}      
        {$this->getPagesHtml($data)}      
        {$this->getPageHtml($data->getNextPage(), $this->nextPageClass, $this->nextPageLabel)}            
        {$this->getPageHtml($data->getLastPage(), $this->lastPageClass, $this->lastPageLabel)}            
    </ul>
</nav>
HTML;
        return trim($html);
    }

    /**
     * @param DataInterface $data
     * @return string
     */
    private function getPagesHtml(DataInterface $data): string {
        $html = '';
        foreach($data->getPages() as $page) {
            $html .= $this->getPageHtml($page, 'page', $page->getLabel()) . "\n";
        }

        return $html;
    }

    /**
     * @param PageInterface $page
     * @param string $class
     * @param null $label
     * @return string
     */
    private function getPageHtml(PageInterface $page = null, string $class, $label = null): string {
        if ($page === null) {
            return '';
        }

        if ($label === null) {
            $label = $page->getLabel();
        }

        if ($page->isCurrent()) {
            $class = sprintf('%s %s', $class, $this->activeClass);
        }

        return sprintf(self::PAGE_PATTERN, $class, $page->getUrl(), $label);
    }
}