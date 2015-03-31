<?php
namespace Liip\ImagineBundle\Events;

use Symfony\Component\EventDispatcher\Event;

class CacheIsStoredEvent extends Event implements CachePathFilterInterface {

    /**
     * Resource path.
     *
     * @var string
     */
    protected $path;

    /**
     * Filter name.
     *
     * @var string
     */
    protected $filter;

    /**
     * CacheIsStoredEvent constructor.
     * @param string $path
     * @param string $filter
     */
    public function __construct($path, $filter)
    {
        $this->path = $path;
        $this->filter = $filter;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param string $filter
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;
    }


}
