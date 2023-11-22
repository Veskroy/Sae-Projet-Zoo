<?php


namespace App\Tests\Controller\Home;

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
}
