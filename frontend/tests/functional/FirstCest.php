<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class FirstCest
{
    public function _before(FunctionalTester $I)
    {
    }

    
    /**
    * @dataProvider pageProvider
    */
    public function tryRun(FunctionalTester $I, \Codeception\Example $data)
    {
    	$I->amOnPage($data['url']);
        $I->see($data['needle'], 'li.active');

    }


    protected function pageProvider() 
    {
        return [
            ['url'=>"/", 'needle'=>"Home"],
            ['url'=>"site/index", 'needle'=>"Home"],
            ['url'=>"site/about", 'needle'=>"About"],
            ['url'=>"site/contact", 'needle'=>"Contact"],
            ['url'=>"site/signup", 'needle'=>"Signup"],
            ['url'=>"site/login", 'needle'=>"Login"],
            
        ];
    }
}
