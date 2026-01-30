<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use App\Models\User;
use Illuminate\Http\Request;
use Behat\Gherkin\Node\TableNode;


class FeatureContext implements Context
{
    private string $message;
    private ?User $user = null;
    private $response;

    public function __construct()
    {
        // Démarrage manuel de Laravel
        $app = require __DIR__ . '/../../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    }

    /**
     * @Given je dis bonjour
     */
    public function jeDisBonjour()
    {
        $this->message = 'bonjour';
    }

    /**
     * @Then je vois bonjour
     */
    public function jeVoisBonjour()
    {
        Assert::assertEquals('bonjour', $this->message);
    }

    /**
     * @Given un utilisateur existe en base
     */
    public function unUtilisateurExisteEnBase()
    {
        $this->user = User::factory()->create([
            'email' => random_bytes(5) . '@example.com'
        ]);
    }

    /**
     * @Then il est bien enregistré
     */
    public function ilEstBienEnregistre()
    {
        $found = User::where('email', 'test@example.com')->first();
        Assert::assertNotNull($found);
    }

    // /**
    //  * @When j'appelle la route :url
    //  */
    // public function jAppelleLaRoute($url)
    // {
    //     $request = Request::create($url, 'GET');
    //     $this->response = app()->handle($request);
    // }

    // /**
    //  * @Then la réponse contient :texte
    //  */
    // public function laReponseContient($texte)
    // {
    //     Assert::assertStringContainsString(
    //         $texte,
    //         $this->response->getContent()
    //     );
    // }
    
    /**
     * @When j'envoie une requête POST sur :url avec le JSON:
     */
    public function jEnvoieUneRequetePostAvecLeJson($url, TableNode $table)
    {
        $data = $table->getRowsHash();

        $request = Request::create(
            $url,
            'POST',
            [],
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );

        $this->response = app()->handle($request);
    }

    /**
     * @Then la réponse contient :texte
     */
    public function laReponseContient($texte)
    {
        Assert::assertStringContainsString(
            $texte,
            $this->response->getContent()
        );
    }

}
