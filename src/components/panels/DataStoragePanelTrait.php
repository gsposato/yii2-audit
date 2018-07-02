<?php

namespace gsposato\yii2\audit\components\panels;

/**
 * DataStoragePanelTrait
 * @package gsposato\yii2\audit\components\panels
 */
trait DataStoragePanelTrait
{
    use PanelTrait;

    /**
     * @inheritdoc
     */
    public function hasEntryData($entry)
    {
        $data = $entry->data;
        return isset($data[$this->id]);
	}

	public function getUrl($additionalParams = null)
	{
        $route = [
            '/' . $this->module->id . '/default/view',
            'panel' => $this->id,
            'tag' => $this->tag,
        ];

        if (is_array($additionalParams)){
            $route = ArrayHelper::merge($route, $additionalParams);
        }

        return Url::toRoute($route);
	}
}
