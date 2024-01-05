<?php


namespace App\Tests\Controller\Home;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function TestIndexHome(ControllerTester $I)
    {
        $I->amOnPage('/');
        $I->seeCurrentRouteIs('app_presentation');
        $I->seeResponseCodeIs(200);
        $I->seeElement('header');
        $I->seeElement('.content');
        $I->seeElement('footer');
    }

    public function TestProfileForAuthenticatedUsers(ControllerTester $I)
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
        $I->amOnPage('/profile');
        $I->seeCurrentRouteIs('app_profile');
        $I->see('Votre profil');
        $identityUser = 'Bonjour, ' . $user->getFirstName() . ' ' . $user->getLastName();
        $I->see($identityUser);
    }
    public function TestLoginForUsers(ControllerTester $I)
    {
        $I->amOnPage('/profile');
        $I->seeCurrentRouteIs('app_login');
        $I->see('Connectez-vous!');
    }
}
