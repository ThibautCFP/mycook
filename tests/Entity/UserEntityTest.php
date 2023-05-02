<?php

namespace App\Tests\Entity;

use App\Repository\UserRepository;
use App\Tests\Traits\AssertTestTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class UserEntityTest extends KernelTestCase
{
    use AssertTestTrait;

    protected ?AbstractDatabaseTool $databaseTool = null;

    /**
     * Executé avant chaque test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        // On injecte la classs DbToolCollection dans la propriété pour l'utilisateur dans les tests
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testRepositoryCount()
    {
        // On charge les utilisateurs en base
        $users = $this->databaseTool->loadAliceFixture([
            \dirname(__DIR__) . '/Fixtures/UserFixtures.yaml',
        ]);

        // On compte le nombre d'entrée dans la table User
        $users = self::getContainer()->get(UserRepository::class)->count([]);

        // On s'attend à avoir 11 users
        $this->assertEquals(11, $users);
    }
}
