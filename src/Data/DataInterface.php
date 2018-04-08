<?php

namespace Dariuszp\Paginator\Data;


interface DataInterface
{
    /**
     * @return PageInterface[]
     */
    public function getPages(): array;

    /**
     * @param PageInterface[] $pages
     */
    public function setPages(array $pages);

    /**
     * @return PageInterface|null
     */
    public function getFirstPage();

    /**
     * @param PageInterface|null $firstPage
     */
    public function setFirstPage(PageInterface $firstPage);

    /**
     * @return PageInterface|null
     */
    public function getLastPage();

    /**
     * @param PageInterface|null $lastPage
     */
    public function setLastPage(PageInterface $lastPage);

    /**
     * @return PageInterface|null
     */
    public function getPreviousPage();

    /**
     * @param PageInterface|null $previousPage
     */
    public function setPreviousPage(PageInterface $previousPage);

    /**
     * @return PageInterface|null
     */
    public function getNextPage();

    /**
     * @param PageInterface|null $nextPage
     */
    public function setNextPage(PageInterface $nextPage);
}