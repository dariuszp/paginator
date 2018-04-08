<?php

namespace Dariuszp\Paginator\Paginator;

use Dariuszp\Paginator\Data\Page;
use Dariuszp\Paginator\Data\Base;
use Dariuszp\Paginator\Data\DataInterface;
use Dariuszp\Paginator\Data\PageInterface;

/**
 * Class Simple - generates data object
 * @package Dariuszp\Paginator\Data
 */
class Simple implements PaginatorInterface
{
    const PAGE_PARAMETER = '{page}';

    const ON_PAGE_PARAMETER = '{onPage}';

    /**
     * Url pattern for pagination, require {page} and optional {onPage} parameters
     * @var string
     */
    private $pattern;

    /**
     * Total amount of items to paginate
     * @var int
     */
    private $totalAmount = 0;

    /**
     * Amount of links on the left and on the right of the current page
     * @var int
     */
    private $paginationRange = 2;

    /**
     * Current page number, cannot go below 1
     * @var int
     */
    private $page = 1;

    /**
     * Amount of items on page
     * @var int
     */
    private $onPage = 10;

    /**
     * Show first page link
     * @var bool
     */
    private $firstPage = true;

    /**
     * Show last page link
     * @var bool
     */
    private $lastPage = true;

    /**
     * Show previous page link
     * @var bool
     */
    private $previousPage = true;

    /**
     * Show next page link
     * @var bool
     */
    private $nextPage = true;

    /**
     * Simple constructor.
     * @param string $pattern
     * @param int $totalAmount
     * @param int $page
     * @param int $onPage
     * @param int $paginationRange
     * @param bool $previousPage
     * @param bool $nextPage
     * @param bool $firstPage
     * @param bool $lastPage
     */
    public function __construct(string $pattern, int $totalAmount = 0, int $page = 1, int $onPage = 10, int $paginationRange = 2, bool $previousPage = true, bool $nextPage = true, bool $firstPage = true, bool $lastPage = true)
    {
        $this->setPattern($pattern);
        $this->setTotalAmount($totalAmount);
        $this->setPage($page);
        $this->setOnPage($onPage);
        $this->setPaginationRange($paginationRange);
        $this->setPreviousPage($previousPage);
        $this->setNextPage($nextPage);
        $this->setFirstPage($firstPage);
        $this->setLastPage($lastPage);
    }


    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern(string $pattern)
    {
        if (strpos($pattern, self::PAGE_PARAMETER) === false) {
            throw new \InvalidArgumentException(sprintf('Missing "%s" in url pattern', self::PAGE_PARAMETER));
        }
        $this->pattern = $pattern;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return $this->totalAmount;
    }

    /**
     * @param int $totalAmount
     */
    public function setTotalAmount(int $totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return int
     */
    public function getPaginationRange(): int
    {
        return $this->paginationRange;
    }

    /**
     * @param int $paginationRange
     */
    public function setPaginationRange(int $paginationRange)
    {
        if ($paginationRange < 1) {
            throw new \InvalidArgumentException('Pagination range must be above 0');
        }
        $this->paginationRange = $paginationRange;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        if ($page < 1) {
            throw new \InvalidArgumentException('Page cannot go below 1');
        }
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getOnPage(): int
    {
        return $this->onPage;
    }

    /**
     * @param int $onPage
     */
    public function setOnPage(int $onPage)
    {
        if ($onPage < 1) {
            throw new \InvalidArgumentException('You need at least 1 element on page');
        }
        $this->onPage = $onPage;
    }

    /**
     * @return bool
     */
    public function isFirstPage(): bool
    {
        return $this->firstPage;
    }

    /**
     * @param bool $firstPage
     */
    public function setFirstPage(bool $firstPage)
    {
        $this->firstPage = $firstPage;
    }

    /**
     * @return bool
     */
    public function isLastPage(): bool
    {
        return $this->lastPage;
    }

    /**
     * @param bool $lastPage
     */
    public function setLastPage(bool $lastPage)
    {
        $this->lastPage = $lastPage;
    }

    /**
     * @return bool
     */
    public function isPreviousPage(): bool
    {
        return $this->previousPage;
    }

    /**
     * @param bool $previousPage
     */
    public function setPreviousPage(bool $previousPage)
    {
        $this->previousPage = $previousPage;
    }

    /**
     * @return bool
     */
    public function isNextPage(): bool
    {
        return $this->nextPage;
    }

    /**
     * @param bool $nextPage
     */
    public function setNextPage(bool $nextPage)
    {
        $this->nextPage = $nextPage;
    }

    public function getData(): DataInterface {

        $page = $this->getPage();
        $pageAmount = $this->getPageAmount();
        $paginationRange = $this->getPaginationRange();

        // Generate previous page
        $previousPage = null;
        $number = $page - 1;
        if ($this->isPreviousPage() && $pageAmount && $number > 0) {
            $previousPage = $this->createPage($number, $number === $page);
        }

        // Generate next page
        $nextPage = null;
        $number = $page + 1;
        if ($this->isNextPage() && $pageAmount && $number <= $pageAmount) {
            $nextPage = $this->createPage($number, $number === $page);
        }

        // Generate first page
        $firstPage = null;
        if ($this->isFirstPage() && $pageAmount > 1) {
            $firstPage = $this->createPage(1, 1 === $page);
        }

        // Generate last page
        $lastPage = null;
        if ($this->isLastPage() && $pageAmount > 1) {
            $lastPage = $this->createPage($pageAmount, $pageAmount === $page);
        }

        $pages = $this->generatePages($page, $pageAmount, $paginationRange);

        $data = new Base();
        $data->setPreviousPage($previousPage);
        $data->setNextPage($nextPage);
        $data->setFirstPage($firstPage);
        $data->setLastPage($lastPage);
        $data->setPages($pages);

        return $data;
    }

    /**
     * @param int $number
     * @param bool $current
     * @return PageInterface
     */
    private function createPage(int $number = 1, bool $current = false): PageInterface {
        return new Page($this->createUrl($number, $this->getOnPage()), $number, $current);
    }

    private function createUrl(int $page, int $onPage = null): string {
        if ($onPage === null) {
            $onPage = $this->getOnPage();
        }

        $url = $this->getPattern();
        $url = str_replace(self::PAGE_PARAMETER, $page, $url);
        $url = str_replace(self::ON_PAGE_PARAMETER, $onPage, $url);

        return $url;
    }

    private function getPageAmount(): int {
        return ceil($this->getTotalAmount() / $this->getOnPage());
    }

    private function generatePages(int $page, int $pageAmount, int $paginationRange): array {
        $minPageRange = $page - $paginationRange;
        if ($minPageRange < 1) {
            $minPageRange = 1;
        }

        $maxPageRange = $page + $paginationRange;
        if ($maxPageRange > $pageAmount) {
            $maxPageRange = $pageAmount;
        }

        $pages = [];
        for ($i = $minPageRange; $i <= $maxPageRange; $i++) {
            $pages[] = $this->createPage($i, $i === $page);
        }

        return $pages;
    }
}