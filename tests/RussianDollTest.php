<?php

use Laracasts\Cache\RussianDoll;

class RussianDollTest extends TestCase
{
    protected $doll;

    public function setUp()
    {
        parent::setUp();

        $cache = new \Illuminate\Cache\Repository(new \Illuminate\Cache\ArrayStore);
        
        $this->doll = new RussianDoll($cache);
    }

    /** @test */
    function it_caches_the_given_key()
    {
        $post = $this->makePost();

        $this->doll->cache($post, '<div>html things</div>');
    
        // We should be able to check by key or model instance.
        $this->assertTrue($this->doll->hasCached($post->getCacheKey()));
        $this->assertTrue($this->doll->hasCached($post));
    }
}
