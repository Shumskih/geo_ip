<?php

namespace Vendor\Cache;

use Bitrix\Main\Data\Cache;
use Bitrix\Main\Application;
use Bitrix\Main\Data\TaggedCache;

class TagCache
{
    private string $path;
    private string $uniqString;
    private int $ttl;
    private string $tag;
    private Cache $cache;
    private TaggedCache $taggedCache;

    public function __construct(string $path, string $uniqString, int $ttl, string $tag)
    {
        $this->path = $path;
        $this->uniqString = $uniqString;
        $this->ttl = $ttl;
        $this->tag = $tag;
        $this->cache = Cache::createInstance();
        $this->taggedCache = Application::getInstance()->getTaggedCache();
    }

    public function add(mixed $var): bool
    {
        if (!$this->cache->startDataCache()) {
            return false;
        }

        $this->taggedCache->startTagCache($this->path);
        $this->taggedCache->registerTag($this->tag);
        $this->taggedCache->endTagCache();
        $this->cache->endDataCache($var);

        return true;
    }

    public function get(): mixed
    {
        if (!$this->cache->initCache($this->ttl, $this->uniqString, $this->path)) {
            return null;
        }

        return $this->cache->getVars();
    }
}
