<?php

namespace Dariuszp\Paginator\Render;

use Dariuszp\Paginator\Data\DataInterface;


/**
 * Class Spaghetti
 * @package Dariuszp\Paginator\Render
 */
interface RenderInterface
{
    /**
     * @param DataInterface $data
     * @return string
     */
    public function render(DataInterface $data): string;
}