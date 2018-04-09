<?php

use Dariuszp\Paginator\Paginator\Simple;
use PHPUnit\Framework\TestCase;

class SimplePaginatorTest extends TestCase
{

    public function testEmptyPagination() {
        $paginator = new Simple('/{page}');
        $data = $paginator->getData();

        $this->assertEquals(0, count($data->getPages()), 'Invalid page amount');
        $this->assertNull($data->getLastPage(), 'Invalid last page');
        $this->assertNull($data->getFirstPage(), 'Invalid first page');
        $this->assertNull($data->getPreviousPage(), 'Invalid previous page');
        $this->assertNull($data->getNextPage(), 'Invalid next page');
    }

    public function testPagesAmount() {
        $paginator = new Simple('/{page}', 999, 1, 10, 1000);
        $data = $paginator->getData();

        $this->assertEquals(100, count($data->getPages()), 'Invalid page amount');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidPage() {
        $paginator = new Simple('/{page}', 0, 0);
    }

    public function testLink() {
        $paginator = new Simple('http://example.com:3000/{page}/{onPage}', 100, 5, 12);
        $data = $paginator->getData();

        $this->assertEquals($data->getPages()[0]->getUrl(), 'http://example.com:3000/3/12', 'Invalid url');
        $this->assertEquals($data->getPages()[0]->getLabel(), '3', 'Invalid label');
        $this->assertEquals($data->getPages()[0]->isCurrent(), false, 'This page should not be current');
    }
}