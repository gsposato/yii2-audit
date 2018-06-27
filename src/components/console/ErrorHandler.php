<?php
/**
 * Console compatible error handler
 */

namespace gsposato\yii2\audit\components\console;

use gsposato\yii2\audit\components\base\ErrorHandlerTrait;

/**
 * ErrorHandler
 * @package gsposato\yii2\audit\components\console
 */
class ErrorHandler extends \yii\console\ErrorHandler
{
    use ErrorHandlerTrait;
}