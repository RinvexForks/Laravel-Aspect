<?php
/**
 * for test
 */

namespace __Test;

use Ytake\LaravelAspect\Annotation\Transactional;

/**
 * Class AspectTransactional
 * @package Test
 */
class AspectTransactionalString
{
    /**
     * @Transactional
     *
     * @return string
     */
    public function start()
    {
        return 'testing';
    }
}
