<?php

namespace Tests\unit\services;

use App\services\AddProfileToUser;
use App\services\GetDBConnection;
use PHPUnit\Framework\TestCase;
use App\models\User;
use PDOStatement;
use Exception;
use PDO;

class AddProfileToUserTest extends TestCase
{
    private $mockGetDBConnection;
    private $mockPDOStatement;
    private $mockPDO;
    private $user;
    private $addProfileToUser;

    public function setUp(): void
    {
        $this->mockPDOStatement = $this->getMockBuilder(PDOStatement::class)->getMock();

        $this->mockPDO = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockPDO->method('prepare')->will($this->returnCallback(function ($sql) {
            $this->assertStringContainsString('Insert into user_roles', $sql);
            return $this->mockPDOStatement;
        }));
        /** @var GetDBConnection $mockGetDBConnection */
        $this->mockGetDBConnection = $this->getMockBuilder(GetDBConnection::class)->getMock();
        $this->mockGetDBConnection->method('__invoke')->willReturn($this->mockPDO);
        $this->user = new User();
        $this->user->setId(1);
        $this->addProfileToUser = new AddProfileToUser($this->mockGetDBConnection);
    }

    public function testFailAddProfileToUserWhenExecuteQuery()
    {
        $this->expectException(Exception::class);
        $this->mockPDOStatement->method('execute')->will(
            $this->throwException(new Exception)
        );
        $this->addProfileToUser->__invoke($this->user, User::ROLE_ADMIN);
    }

    public function testFailAddProfileToUser()
    {
        $this->expectException(Exception::class);
        $this->mockPDOStatement->method('execute')->willReturn(false);
        $result = $this->addProfileToUser->__invoke($this->user, User::ROLE_ADMIN);
    }

    public function testAddProfileToUser(): void
    {
        $this->mockPDOStatement->method('execute')
            ->will(
                $this->returnCallback(
                    function ($parameters) {
                        $this->assertArrayHasKey(':id_user', $parameters);
                        $this->assertArrayHasKey(':id_rol', $parameters);
                        $this->assertSame($this->user->getId(), $parameters[':id_user']);

                        return true;
                    }
                )
            );
        $result = $this->addProfileToUser->__invoke($this->user, User::ROLE_ADMIN);
        $this->assertTrue($result);
    }
}
