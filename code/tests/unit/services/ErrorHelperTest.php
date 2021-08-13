<?php

namespace Tests\unit\services;

use App\services\ErrorHelper;
use PHPUnit\Framework\TestCase;

class ErrorHelperTest extends TestCase
{

    private $expetedArray = [
        '_errors' => [
            'testField' => [
                'testError' => "message test",
                'testError2' => "message test 2"
            ],
            'testField2' => [
                'testError' => "message test"
            ]
        ]
    ];

    public function testKeyErrorExistsAndIsEmpty()
    {
        $sessionMock = [];
        $errorHelper = new ErrorHelper($sessionMock);

        $this->assertArrayHasKey('_errors', $sessionMock);
        $this->assertEmpty($sessionMock['_errors']);

        return [
            'sessionMock' => &$sessionMock,
            'errorHelper' => $errorHelper
        ];
    }

    /**
     * @depends testKeyErrorExistsAndIsEmpty
     */
    public function testSetErrors($stack)
    {
        $errorHelper = $stack['errorHelper'];
        $sessionMock = &$stack['sessionMock'];

        $this->setErrors($errorHelper);

        $this->assertSame(json_encode($this->expetedArray), json_encode($sessionMock));

        return [
            'sessionMock' => &$sessionMock,
            'errorHelper' => $errorHelper
        ];
    }

    /**
     * @depends testSetErrors
     */
    public function testGetErrors($stack)
    {
        $errorHelper = $stack['errorHelper'];
        $sessionMock = &$stack['sessionMock'];
        $error = $errorHelper->get('testField');

        $errorExpeted = [
            'testError' => "message test",
            'testError2' => "message test 2"
        ];

        $this->assertSame($errorExpeted, $error);
        $error = $errorHelper->get('testField');
        $this->assertNull($error);

        return [
            'sessionMock' => &$sessionMock,
            'errorHelper' => $errorHelper
        ];
    }

    /**
     * @depends testGetErrors
     */
    public function testGetAll($stack)
    {
        $errorHelper = $stack['errorHelper'];
        $sessionMock = &$stack['sessionMock'];

        $errorHelper->get('testField2');
        $this->setErrors($errorHelper);
        $allErrors = $errorHelper->getAll();

        $this->assertSame($this->expetedArray['_errors'], $allErrors);

    }

    private function setErrors(ErrorHelper $errorHelper)
    {
        $errorHelper->set('testField', 'testError', "message test");
        $errorHelper->set('testField', 'testError2', "message test 2");
        $errorHelper->set('testField2', 'testError', "message test");
    }
}
