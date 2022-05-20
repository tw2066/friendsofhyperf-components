<?php

declare(strict_types=1);
/**
 * This file is part of model-observer.
 *
 * @link     https://github.com/friendsofhyperf/model-observer
 * @document https://github.com/friendsofhyperf/model-observer/blob/main/README.md
 * @contact  huangdijia@gmail.com
 */
namespace FriendsOfHyperf\ModelObserver\Annotation;

use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class Observer extends AbstractAnnotation
{
    /**
     * @var string
     */
    public $model;

    /**
     * @var int
     */
    public $priority = 0;

    public function __construct($value = null)
    {
        if (isset($value['value'])) {
            parent::__construct($value);
            $this->bindMainProperty('model', $value);
        } elseif (is_array($value)) {
            if (isset($value['model']) && is_string($value['model'])) {
                $this->model = $value['model'];
            }

            if (isset($value['priority']) && is_numeric($value['priority'])) {
                $this->priority = $value['priority'];
            }
        }
    }
}
