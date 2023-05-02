<?php

namespace App\Tests\Panther;

use Facebook\WebDriver\WebDriverBy;
use Symfony\Component\Panther\PantherTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class RegisterUserPantherTest extends PantherTestCase
{
    protected $client;
    protected $databaseTool;

    protected function setUp(): void
    {
        /* Création du client Panther */
        $this->client = self::createPantherClient();
        $this->databaseTool = self::getContainer()->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadAliceFixture([
            \dirname(__DIR__) . '/Fixtures/UserTestFixtures.yaml',
        ]);
    }

    public function testRegisterButton()
    {
        $crawler = $this->client->request('GET', '/');

        $this->client->waitFor('.btn-endtoend');

        $this->client->findElement(WebDriverBy::cssSelector('.btn-endtoend'))->click();

        $crawler = $this->client->refreshCrawler();
    }
}
