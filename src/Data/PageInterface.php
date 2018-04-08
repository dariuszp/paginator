<?php

namespace Dariuszp\Paginator\Data;


interface PageInterface
{
    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     */
    public function setUrl(string $url);

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $label
     */
    public function setLabel(string $label);

    /**
     * @return bool
     */
    public function isCurrent(): bool;

    /**
     * @param bool $current
     */
    public function setCurrent(bool $current);
}