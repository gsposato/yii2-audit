<?php

namespace gsposato\yii2\audit\panels;

use gsposato\yii2\audit\components\panels\Panel;
use gsposato\yii2\audit\models\AuditTrail;
use gsposato\yii2\audit\models\AuditTrailSearch;
use Yii;
use yii\grid\GridViewAsset;

/**
 * TrailPanel
 * @package gsposato\yii2\audit\panels
 */
class TrailPanel extends Panel
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return \Yii::t('audit', 'Trails');
    }

    /**
     * @inheritdoc
     */
    public function hasEntryData($entry)
    {
        return count($entry->trails) > 0;
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->_model->trails) . ')</small>';
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $searchModel = new AuditTrailSearch();
        $params = \Yii::$app->request->getQueryParams();
        $params['AuditTrailSearch']['entry_id'] = $params['id'];
        $dataProvider = $searchModel->search($params);

        return \Yii::$app->view->render('panels/trail/detail', [
            'panel' => $this,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getIndexUrl()
    {
        return ['trail/index'];
    }

    /**
     * @inheritdoc
     */
    public function getChart()
    {
        return \Yii::$app->view->render('panels/trail/chart', [
            'panel' => $this,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function registerAssets($view)
    {
        GridViewAsset::register($view);
    }

    /**
     * @inheritdoc
     */
    public function cleanup($maxAge = null)
    {
        $maxAge = $maxAge !== null ? $maxAge : $this->maxAge;
        if ($maxAge === null)
            return false;
        return AuditTrail::deleteAll([
            '<=', 'created', date('Y-m-d 23:59:59', strtotime("-$maxAge days"))
        ]);
    }

}