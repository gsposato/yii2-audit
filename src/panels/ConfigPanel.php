<?php

namespace gsposato\yii2\audit\panels;

use gsposato\yii2\audit\components\panels\DataStoragePanelTrait;
use Yii;

/**
 * ConfigPanel
 * @package gsposato\yii2\audit\panels
 */
class ConfigPanel extends \yii\debug\panels\ConfigPanel
{
    use DataStoragePanelTrait;

    /**
     * @return string
     */
    public function getDetail()
    {
        return Yii::$app->view->render('@yii/debug/views/default/panels/config/detail', [
            'panel' => $this,
        ]);
    }

}