<?php

namespace tests\codeception\unit;

use gsposato\yii2\audit\models\AuditEntry;
use gsposato\yii2\audit\models\AuditJavascript;
use gsposato\yii2\audit\models\AuditJavascriptSearch;
use Codeception\Specify;

/**
 * AuditJavascriptSearchTest
 */
class AuditJavascriptSearchTest extends AuditTestCase
{

    public function testTypeFilterWorks()
    {
        $entry = new AuditJavascriptSearch();
        $entry->entry_id = 1;
        $this->assertEquals(['onerror' => 'onerror'], $entry->typeFilter());
    }

    public function testOriginFilterWorks()
    {
        $entry = new AuditJavascriptSearch();
        $entry->entry_id = 1;
        $this->assertEquals(['file.html' => 'file.html'], $entry->originFilter());
    }

}