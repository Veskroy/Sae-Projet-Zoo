<?php


namespace App\Tests\Controller\FAQController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function TestIndexFaq(ControllerTester $I)
    {
        $user = UserFactory::CreateOne([
            'firstname' => 'Clément',
            'lastname' => 'Perrot',
            'email' => 'clementperrot@example.com',
            'password' => 'test',
            'roles' => ['ROLE_ADMIN'],
        ]);
        $realUser = $user->object();

        $I->amLoggedInAs($realUser);

        $I->amOnPage('/faq');
        $I->seeCurrentRouteIs('app_faq');
        $I->see('Foire aux questions du Zoo de la Palmyre');
    }
}
