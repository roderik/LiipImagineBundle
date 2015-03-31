<?php
namespace Liip\ImagineBundle\Events;

interface CachePathFilterInterface {

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param string $path
     */
    public function setPath($path);

    /**
     * @return string
     */
    public function getFilter();

    /**
     * @param string $filter
     */
    public function setFilter($filter);

}
