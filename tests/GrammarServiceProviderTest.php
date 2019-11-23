<?php

namespace Djunehor\Grammar\Test;

use Djunehor\Grammar\GrammarServiceProvider;
use Djunehor\Grammar\Word;
use Mockery as m;

class GrammarServiceProviderTest extends TestCase
{
    /**
     * @var MockInterface
     */
    protected $mockApp;

    /**
     * @var GrammarServiceProvider
     */
    protected $provider;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockApp = m::mock('\Illuminate\Contracts\Foundation\Application');
        $this->provider = new GrammarServiceProvider($this->mockApp);
    }

    /**
     * Test that it registers the correct service name with Identity.
     */
    public function testRegister()
    {
        $this->mockApp->shouldReceive('bind')
            ->once()
            ->andReturnUsing(function ($name, $closure) {
                $this->assertEquals('laravel-grammar', $name);
                $this->assertInstanceOf(Word::class, $closure());
            });

        $this->provider->register();
    }

    /**
     * Test that it provides the correct service name.
     */
    public function testProvides()
    {
        $expected = ['laravel-grammar'];
        $actual = $this->provider->provides();

        $this->assertEquals($expected, $actual);
    }
}
