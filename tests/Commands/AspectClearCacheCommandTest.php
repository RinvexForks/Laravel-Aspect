<?php

class AspectClearCacheCommandTest extends \TestCase
{
    /** @var \Ytake\LaravelAop\AspectManager $manager */
    protected $manager;

    /** @var \Ytake\LaravelAop\Console\ClearCacheCommand */
    protected $command;

    protected function setUp()
    {
        parent::setUp();
        $this->manager = new \Ytake\LaravelAop\AspectManager($this->app);
        $this->resolveManager();

        $this->command = new \Ytake\LaravelAop\Console\ClearCacheCommand(
            $this->app['config'],
            $this->app['filesystem']
        );
        $this->command->setLaravel(new MockApplication());
    }

    /**
     * @runInSeparateProcess
     */
    public function testCacheClearFile()
    {
        $cache = new \__Test\AspectCacheable;
        $cache->namedMultipleNameAndKey(1000, 'testing');

        $output = new \Symfony\Component\Console\Output\BufferedOutput();
        $this->command->run(
            new \Symfony\Component\Console\Input\ArrayInput([]),
            $output
        );
        $this->assertSame('aspect/annotation cache clear!', trim($output->fetch()));

        $configure = $this->app['config']->get('ytake-laravel-aop');
        $driverConfig = $configure['aop'][$configure['default']];
        if(isset($driverConfig['cacheDir'])) {
            $this->assertFalse($this->app['filesystem']->exists($driverConfig['cacheDir']));
        }
    }

    /**
     *
     */
    protected function resolveManager()
    {
        $annotation = new \Ytake\LaravelAop\Annotation;
        $annotation->registerAspectAnnotations();
        /** @var \Ytake\LaravelAop\GoAspect $aspect */
        $aspect = $this->manager->driver('go');
        $aspect->register();
    }

    protected function tearDown()
    {

    }
}

class MockApplication extends \Illuminate\Container\Container implements \Illuminate\Contracts\Foundation\Application
{
    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        // TODO: Implement version() method.
    }

    /**
     * Get or check the current application environment.
     *
     * @param  mixed
     * @return string
     */
    public function environment()
    {
        // TODO: Implement environment() method.
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        // TODO: Implement isDownForMaintenance() method.
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        // TODO: Implement registerConfiguredProviders() method.
    }

    /**
     * Register a service provider with the application.
     *
     * @param  \Illuminate\Support\ServiceProvider|string $provider
     * @param  array                                      $options
     * @param  bool                                       $force
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register($provider, $options = [], $force = false)
    {
        // TODO: Implement register() method.
    }

    /**
     * Register a deferred provider and service.
     *
     * @param  string $provider
     * @param  string $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        // TODO: Implement registerDeferredProvider() method.
    }

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }

    /**
     * Register a new boot listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booting($callback)
    {
        // TODO: Implement booting() method.
    }

    /**
     * Register a new "booted" listener.
     *
     * @param  mixed $callback
     * @return void
     */
    public function booted($callback)
    {
        // TODO: Implement booted() method.
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @return string
     */
    public function basePath()
    {
        // TODO: Implement basePath() method.
    }

    /**
     * Get the path to the cached "compiled.php" file.
     *
     * @return string
     */
    public function getCachedCompilePath()
    {
        // TODO: Implement getCachedCompilePath() method.
    }

    /**
     * Get the path to the cached services.json file.
     *
     * @return string
     */
    public function getCachedServicesPath()
    {
        // TODO: Implement getCachedServicesPath() method.
    }
}

function base_path()
{
    return null;
}

function storage_path()
{
    return null;
}