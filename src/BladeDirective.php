<?php

namespace Laracasts\Cache;

class BladeDirective
{
    /**
     * The doll instance.
     *
     * @var RussianDoll
     */
    protected $doll;

    /**
     * Model keys.
     *
     * @var arary
     */
    protected $keys = [];

    /**
     * Create a new instance.
     *
     * @param RussianDoll $doll
     */
    public function __construct(RussianDoll $doll)
    {
        $this->doll = $doll;
    }

    /**
     * Setup our caching mechanism.
     *
     * @param mixed $model
     */
    public function setUp($model)
    {
        ob_start();

        $this->keys[] = $key = $model->getCacheKey();

        return $this->doll->hasCached($key);
    }

    /**
     * Teardown our cache setup.
     */
    public function tearDown()
    {
        return $this->doll->cache(
            array_pop($this->keys), ob_get_clean()
        );
    }
}

