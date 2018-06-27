<?php
/**
 * Error handler version for web based modules
 */

namespace gsposato\yii2\audit\components\web;

use gsposato\yii2\audit\components\base\ErrorHandlerTrait;

/**
 * ErrorHandler
 * @package gsposato\yii2\audit\components\web
 */
class ErrorHandler extends \yii\web\ErrorHandler
{
    use ErrorHandlerTrait;
}