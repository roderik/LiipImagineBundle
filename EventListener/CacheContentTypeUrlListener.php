<?php
namespace Liip\ImagineBundle\EventListener;

use Liip\ImagineBundle\Events\CacheIsStoredEvent;
use Liip\ImagineBundle\Events\CachePathFilterInterface;
use Liip\ImagineBundle\Events\CacheResolveEvent;
use Liip\ImagineBundle\Events\CacheStoreEvent;
use Liip\ImagineBundle\Imagine\Filter\FilterConfiguration;
use Psr\Log\LoggerInterface;
use Symfony\Component\Routing\RouterInterface;

class CacheContentTypeUrlListener {

    /**
     * @var FilterConfiguration
     */
    protected $filterConfig;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructs the cache manager to handle Resolvers based on the provided FilterConfiguration.
     *
     * @param FilterConfiguration $filterConfig
     * @param RouterInterface $router
     * @param LoggerInterface $logger
     */
    public function __construct(
        FilterConfiguration $filterConfig,
        RouterInterface $router,
        LoggerInterface $logger = null
    ) {
        $this->filterConfig = $filterConfig;
        $this->router = $router;
        $this->logger = $logger;
    }

    /**
     * @param CacheIsStoredEvent $event
     */
    public function handlePreIsStored(CacheIsStoredEvent $event){
        $this->modifyPath($event);
        $this->logDebug('CacheContentTypeUrlListener::handlePreIsStored', array(
            'path'      => $event->getPath(),
            'filter'    => $event->getFilter()
        ));
    }

    /**
     * @param CacheStoreEvent $event
     */
    public function handlePreStore(CacheStoreEvent $event){
        $this->modifyPath($event);
        $this->logDebug('CacheContentTypeUrlListener::handlePreStore', array(
            'path'      => $event->getPath(),
            'filter'    => $event->getFilter()
        ));
    }

    /**
     * @param CacheResolveEvent $event
     */
    public function handlePreResolve(CacheResolveEvent $event){
        $this->modifyPath($event);
        $this->logDebug('CacheContentTypeUrlListener::handlePreResolve', array(
            'path'      => $event->getPath(),
            'filter'    => $event->getFilter()
        ));
    }

    /**
     * @param CacheResolveEvent $event
     */
    public function handlePostResolve(CacheResolveEvent $event){
        $this->modifyPath($event);
        $this->logDebug('CacheContentTypeUrlListener::handlePostResolve', array(
            'path'      => $event->getPath(),
            'filter'    => $event->getFilter()
        ));
        $params = array(
            'path' => $event->getPath(),
            'filter' => $event->getFilter(),
        );
        $filterUrl = $this->router->generate('liip_imagine_filter', $params, true);
        $event->setUrl($filterUrl);

    }

    /**
     * @param CachePathFilterInterface $event
     */
    protected function modifyPath(CachePathFilterInterface $event){
        $filterConf = $this->filterConfig->get($event->getFilter());
        $info = pathinfo(ltrim($event->getPath(), '/'));
        $ext_arr = array_reverse(explode("/", $filterConf["format"]));
        $ext = $ext_arr[0];
        $path = $info['dirname'] . DIRECTORY_SEPARATOR . $info["filename"].".".$ext;
        $event->setPath($path);
    }

    /**
     * @param mixed $message
     * @param array $context
     */
    protected function logDebug($message, array $context = array())
    {
        if ($this->logger) {
            $this->logger->debug($message, $context);
        }
    }
}
