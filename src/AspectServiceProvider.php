<?php

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 *
 * Copyright (c) 2015-2016 Yuuki Takezawa
 *
 */
namespace Ytake\LaravelAspect;

use Illuminate\Support\ServiceProvider;

/**
 * Class AspectServiceProvider
 */
class AspectServiceProvider extends ServiceProvider
{
    /** @var bool */
    protected $defer = false;

    /**
     * boot aspect kernel
     */
    public function boot()
    {
        $this->app['aspect.manager']->weave();
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        /**
         * for package configure
         */
        $configPath = __DIR__ . '/config/ytake-laravel-aop.php';
        $this->mergeConfigFrom($configPath, 'ytake-laravel-aop');
        $this->publishes([$configPath => config_path('ytake-laravel-aop.php')], 'aspect');

        $this->app->singleton('aspect.manager', function ($app) {
            $annotationConfiguration = new AnnotationConfiguration(
                $app['config']->get('ytake-laravel-aop.annotation')
            );
            $annotationConfiguration->ignoredAnnotations();

            // register annotation
            return new AspectManager($app);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function provides()
    {
        return [
            'aspect.manager',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function compiles()
    {
        return [
            base_path() . '/vendor/ytake/laravel-aspect/src/AspectServiceProvider.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/ConsoleServiceProvider.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/AspectBind.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/AspectDriverInterface.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/NullAspectKernel.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/RayAspectKernel.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/CacheablePointCut.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/CacheEvictPointCut.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/CachePutPointCut.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/LoggablePointCut.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/PointCutable.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/PointCut/TransactionalPointCut.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Modules/CacheableModule.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Modules/CacheEvictModule.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Modules/CachePutModule.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Modules/LoggableModule.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Modules/TransactionalModule.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Interceptor/CacheableInterceptor.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Interceptor/CacheEvictInterceptor.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Interceptor/CachePutInterceptor.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Interceptor/LoggableInterceptor.php',
            base_path() . '/vendor/ytake/laravel-aspect/src/Interceptor/TransactionalInterceptor.php',
        ];
    }
}
