<?php

use Dariuszp\Paginator\Paginator\Simple;
use PHPUnit\Framework\TestCase;

class SimplePaginatorTest extends TestCase
{

    public function testEmptyPagination() {
        $paginator = new Simple('/');
        $data = $paginator->getData();

        $this->assertEquals(0, count($data->getPages()), 'Invalid page amount');
        $this->assertNull($data->getLastPage(), 'Invalid last page');
        $this->assertNull($data->getFirstPage(), 'Invalid first page');
        $this->assertNull($data->getPreviousPage(), 'Invalid previous page');
        $this->assertNull($data->getNextPage(), 'Invalid next page');
    }

    public function testPagesAmount() {
        $paginator = new Simple('/', 999, 1, 10, 1000);
        $data = $paginator->getData();

        $this->assertEquals(100, count($data->getPages()), 'Invalid page amount');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidPage() {
        $paginator = new Simple('/', 0, 0);
    }

}