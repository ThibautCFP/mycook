<?php

namespace App\Tests\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class FrontControllerTest extends WebTestCase
{
    private ?KernelBrowser $client = null;

    protected ?AbstractDatabaseTool $databaseTool = null;

    /**
     * Executé avant chaque test
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();

        // On injecte la classs DbToolCollection dans la propriété pour l'utilisateur dans les tests
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();

        $this->databaseTool->loadAliceFixture([
            \dirname(\dirname(__DIR__)) . '/Fixtures/UserTestFixtures.yaml',
        ]);
    }

    public function testHomePageResponse()
    {
        // On demande au client d'aller sur l'url de la home page en méthode GET
        $this->client->request('GET', '/');

        // On s'attend  à avoir un code de réponse 200
        $this->assertResponseIsSuccessful();
    }
}
