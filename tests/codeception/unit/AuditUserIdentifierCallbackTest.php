<?php

namespace tests\codeception\unit;

use gsposato\yii2\audit\Audit;
use gsposato\yii2\audit\tests\UnitTester;
use Yii;
use gsposato\yii2\audit\models\AuditEntry;
use gsposato\yii2\audit\models\AuditData;
use Codeception\Specify;

/**
 * AuditUserIdentifierCallbackTest
 */
class AuditUserIdentifierCallbackTest extends AuditTestCase
{
    use Specify;

    /**
     * @var UnitTester
     */
    protected $tester;

    public function testUserIdentifierCallbackTest()
    {
        Audit::getInstance()->userIdentifierCallback = ['tests\app\models\User', 'userIdentifierCallback'];
        $this->assertEquals(Audit::getInstance()->getUserIdentifier(1), 'admin');
    }

}