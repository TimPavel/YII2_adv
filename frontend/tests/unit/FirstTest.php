<?php 
namespace frontend\tests;

use frontend\models\ContactForm;

class FirstTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // test
    // $this->assertTrue - сравнении с true
    public function testAssertTrue()
    {
        
        $this->assertTrue(true, 'ошибка в assertTrue');        
    }

    //  $this->assertEquals - равно ожидаемому значению
    public function testAssertEquals()
    {
        $x = 3;
        $this->assertEquals(3, $x, 'ошибка в assertEquals');
    }

    // $this->assertLessThan - меньше ожидаемого значения
    public function testAssertLessThan()
    {
        $x = 3;
        $this->assertLessThan(4, $x, 'ошибка в assertLessThan');    
    }

    // $this->assertAttributeEquals - значение атрибута (свойства) объекта равно ожидаемому значению - создайте экземпляр ContactForm, 
    // заполните аттрибуты и проверьте, можно так тестировать, например массовую загрузку значений атрибутов.
    public function testAssertAttributeEquals()
    {
        $name = 'Vasya';
        $email = 'test@test';
        $subject = 'subject1';
        $body = 'body1'; 
        $model = new ContactForm;
        $model->setAttributes(['name' => $name, 'email' => $email, 'subject' => $subject, 'body' => $body]);

        $this->assertAttributeEquals($name, 'name', $model, 'ошибка в assertAttributeEquals - name');
        $this->assertAttributeEquals($email, 'email', $model, 'ошибка в assertAttributeEquals - email');
        $this->assertAttributeEquals($subject, 'subject', $model, 'ошибка в assertAttributeEquals - subject');
        $this->assertAttributeEquals($body, 'body', $model, 'ошибка в assertAttributeEquals - body');

    }

    // $this->assertArrayHasKey - в массиве есть указанный ключ
    public function testSome()
    {       
        $arr = ['key1' => 'prop1', 'key2' => 'prop2'];
        $this->assertArrayHasKey('key1', $arr, 'ошибка в assertArrayHasKey');
    }   

}