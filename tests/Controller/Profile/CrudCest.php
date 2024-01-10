<?php


namespace App\Tests\Controller\Profile;

use App\Entity\User;
use App\Tests\Support\ControllerTester;
use App\Tests\Support\UsersSetup;

class CrudCest
{
    use UsersSetup;
    public function _before(ControllerTester $I): void
    {
        $this->createUsers();
    }

    public function TestEditMainInformationsOfUser(ControllerTester $I): void
    {
        // connecté en tant que userBasic
        /* 'firstname' => 'Clément',
            'lastname' => 'Perrot',
            'email' => $uniqueEmailBasic,
            'password' => 'test',
            'roles' => ['ROLE_USER'], */

        $I->amLoggedInAs($this->userBasic);
        $I->amOnPage('/profile');
        $I->seeResponseCodeIs(200);
        $I->seeCurrentRouteIs('app_profile');

        $I->fillField('profile[firstName]', 'Clémentine');
        $I->fillField('profile[pc]', '75000');
        $I->fillField('profile[city]', 'Paris');
        $I->fillField('profile[phone]', '0123456789');
        $I->click('Modifier mes informations');

        $I->see('Votre compte a bien été modifié!');

        // vérifions que les données ont bien été modifiées
        $I->seeInRepository(User::class, [
            'id' => $this->userBasic->getId(),
            'firstName' => 'Clémentine',
            'pc' => '75000',
            'city' => 'Paris',
            'phone' => '0123456789',
        ]);
    }

}
