<?php
/**
 * Created by PhpStorm.
 * User: dariuszp
 * Date: 09.04.18
 * Time: 01:27
 */

namespace Dariuszp\Paginator\Paginator;

use Dariuszp\Paginator\Data\DataInterface;


/**
 * Class Simple - generates data object
 * @package Dariuszp\Paginator\Data
 */
interface PaginatorInterface
{
    public function getData(): DataInterface;
}