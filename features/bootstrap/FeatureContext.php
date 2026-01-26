<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Tests\Behat\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends TestCase implements Context
{
    private string $message;
    private User $user;


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
            'email' => 'test@example.com',
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

}
