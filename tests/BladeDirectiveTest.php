<?php

use Laracasts\Cache\BladeDirective;
use Laracasts\Cache\RussianDoll;

class BladeDirectiveTest extends TestCase
{
    /** @test */
    function it_sets_up_the_opening_cache_directive()
    {
        $blade = $this->createNewDirective();
    
        // On initial setup, nothing should be cached yet.
        $cached = $blade->setUp($this->makePost());
        $this->assertFalse($cached);
    
        // And also output buffering should be turned on.
        echo '<div>fragment here</div>';
    
        // When we teardown, it should cache and return the fragment.
        $cachedFragment = $blade->tearDown();
        $this->assertEquals('<div>fragment here</div>', $cachedFragment);
    }

    public function createNewDirective()
    {
        $cache = new \Illuminate\Cache\Repository(new \Illuminate\Cache\ArrayStore);

        $doll = new RussianDoll($cache);

        return new BladeDirective($doll);
    }

}

