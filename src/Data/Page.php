<?php

namespace Dariuszp\Paginator\Data;


class Page implements PageInterface
{
    private $url = '/';

    private $label = '1';

    private $current = false;

    /**
     * Page constructor.
     * @param string $url
     * @param string $label
     * @param bool $current
     */
    public function __construct(string $url, string $label, bool $current)
    {
        $this->url = $url;
        $this->label = $label;
        $this->current = $current;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    /**
     * @return bool
     */
    public function isCurrent(): bool
    {
        return $this->current;
    }

    /**
     * @param bool $current
     */
    public function setCurrent(bool $current)
    {
        $this->current = $current;
    }



}