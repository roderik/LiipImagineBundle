<?php
namespace Liip\ImagineBundle\Events;


use Liip\ImagineBundle\Binary\BinaryInterface;
use Symfony\Component\EventDispatcher\Event;

class CacheStoreEvent extends Event implements CachePathFilterInterface {

    /**
     * the Binary content.
     *
     * @var BinaryInterface
     */
    protected $binary;

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
     * CacheStoreEvent constructor.
     * @param BinaryInterface $binary
     * @param string $path
     * @param string $filter
     */
    public function __construct(BinaryInterface $binary, $path, $filter)
    {
        $this->binary = $binary;
        $this->path = $path;
        $this->filter = $filter;
    }

    /**
     * @return BinaryInterface
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * @param BinaryInterface $binary
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;
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
