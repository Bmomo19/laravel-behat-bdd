<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use App\Models\User;
use Illuminate\Http\Request;
use Behat\Gherkin\Node\TableNode;
use App\Application\UseCases\CreateUser;

class FeatureContext implements Context
{
    public function __construct()
    {
        // Démarrage manuel de Laravel
        $app = require __DIR__ . '/../../bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
    }

    private ?User $createdUser = null;

    /**
     * @When je crée un utilisateur nommé :name
     */
    public function jeCreeUnUtilisateurNomme($name)
    {
        $useCase = new CreateUser();

        $this->createdUser = $useCase->execute(
            $name,
            strtolower($name).'@test.com'
        );
    }

    /**
     * @Then l'utilisateur :name existe
     */
    public function lUtilisateurExiste($name)
    {
        $user = User::where('name', $name)->first();

        Assert::assertNotNull($user);
    }
}
