<?php

namespace Laracasts\Cache;

use Illuminate\Contracts\Cache\Repository as Cache;

class RussianDoll
{
    /**
     * The cache repository.
     */
    protected $cache;

    /**
     * Create a new RussianDoll instance.
     *
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Cache the given key and html.
     *
     * @param string $key
     * @param string $html
     */
    public function cache($key, $html)
    {
        if ($key instanceof \Illuminate\Database\Eloquent\Model) {
            $key = $key->getCacheKey();
        }

        return $this->cache
            ->tags('views')
            ->rememberForever($key, function () use ($html) {
                return $html;
            });
    }

    /**
     * Determine if a key has been cached.
     *
     * @param string $key
     */
    public function hasCached($key)
    {
        if ($key instanceof \Illuminate\Database\Eloquent\Model) {
            $key = $key->getCacheKey();
        }

        return $this->cache
            ->tags('views')
            ->has($key);
    }
}
