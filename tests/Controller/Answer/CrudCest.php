<?php


namespace App\Tests\Controller\Answer;

use App\Entity\Question;
use App\Factory\AnswerFactory;
use App\Factory\QuestionFactory;
use App\Tests\Support\ControllerTester;
use App\Tests\Support\UsersSetup;

class CrudCest
{
    use UsersSetup;

    private Question $question;
    public function _before(ControllerTester $I): void
    {
        $this->createUsers();

        // création d'un post
        $question = QuestionFactory::createOne(
            [
                'title' => 'Post créé CRUD',
                'description' => 'Description (test) de création de post',
                'isResolved' => false,
                'author' => $this->userBasic,
            ]
        );
        $this->question = $question->object();
    }

    public function TestCreateAnswerOnUnresolvedPost(ControllerTester $I): void
    {
        $I->amLoggedInAs($this->userBasic);

        $I->amOnPage('/question/' . $this->question->getId());
        $I->seeResponseCodeIs(200);
        $I->see($this->question->getTitle());

        // before answer
        $nbLikes = $this->question->countLikes();

        // fill answer[description] field and click on "Répondre"
        $I->fillField('answer[description]', 'Description (test) de création de réponse');
        $I->click('Répondre');
        $I->see('Votre réponse a bien été ajoutée!');
        $I->seeCurrentRouteIs('app_question_show', ['id' => $this->question->getId()]);

        // after answer
        $res = $nbLikes === 0 ? 'réponse' : 'réponses';
        $ans = $nbLikes + 1;
        $I->see($ans . ' ' . $res);
    }

}
