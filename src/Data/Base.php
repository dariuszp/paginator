<?php

namespace Dariuszp\Paginator\Data;


class Base implements DataInterface
{
    /**
     * @var PageInterface[]
     */
    private $pages = [];

    /**
     * @var PageInterface|null
     */
    private $firstPage = null;

    /**
     * @var PageInterface|null
     */
    private $lastPage = null;

    /**
     * @var PageInterface|null
     */
    private $previousPage = null;

    /**
     * @var PageInterface|null
     */
    private $nextPage = null;

    /**
     * @return PageInterface[]
     */
    public function getPages(): array
    {
        return $this->pages;
    }

    /**
     * @param PageInterface[] $pages
     */
    public function setPages(array $pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return PageInterface|null
     */
    public function getFirstPage()
    {
        return $this->firstPage;
    }

    /**
     * @param PageInterface|null $firstPage
     */
    public function setFirstPage(PageInterface $firstPage = null)
    {
        $this->firstPage = $firstPage;
    }

    /**
     * @return PageInterface|null
     */
    public function getLastPage()
    {
        return $this->lastPage;
    }

    /**
     * @param PageInterface|null $lastPage
     */
    public function setLastPage(PageInterface $lastPage = null)
    {
        $this->lastPage = $lastPage;
    }

    /**
     * @return PageInterface|null
     */
    public function getPreviousPage()
    {
        return $this->previousPage;
    }

    /**
     * @param PageInterface|null $previousPage
     */
    public function setPreviousPage(PageInterface $previousPage = null)
    {
        $this->previousPage = $previousPage;
    }

    /**
     * @return PageInterface|null
     */
    public function getNextPage()
    {
        return $this->nextPage;
    }

    /**
     * @param PageInterface|null $nextPage
     */
    public function setNextPage(PageInterface $nextPage = null)
    {
        $this->nextPage = $nextPage;
    }

    
}