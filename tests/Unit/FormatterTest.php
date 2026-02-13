<?php


use FaresNassar\ApiVault\Formatter;


beforeEach(function(){


        $this->formatter = new Formatter();


});

it('can chain methods and return the object', function () {

    
    expect($this->formatter->success(true))->toBeInstanceOf(Formatter::class)
        ->and($this->formatter->message('Hello'))->toBeInstanceOf(Formatter::class);
});



it('can retrieve an empty response ', function () {

    $response = $this->formatter->send();

    $data = $response->getData(true);


    expect($data)
    ->toHaveKey('code',200)
    ->and($data['data'])->toBeEmpty();
    

});
 
    test('data method works',function(){

    
    $response =  $this->formatter
    ->data(['name' => 'Fares Nassar', 'age' => 22, 'address' => 'Egypt/Giza'])
    ->send(); 

    $data = $response->getData(true)['data'];


    expect($data)
    ->toBeArray() 
    ->and($data)->toHaveCount(3)
    ->and($data)->toHaveKey('age',22)
    ->and($data)->toHaveKey('address','Egypt/Giza')
    ->and($data)->toHaveKey('name','Fares Nassar');
   


 });     
   

 test('success method works',function(){

    
    $response =  $this->formatter
    ->success(true) // i hope you all be succcessful in your life
    ->send();

    $status = $response->getData(true);


    expect($status)->toHaveKey('success',true);


 }); 


  test('message method works',function(){

    
    $response =  $this->formatter
    ->message('be ready the chance is getting ready for you')
    ->send();

    $status = $response->getData(true);


    expect($status)->toHaveKey('message','be ready the chance is getting ready for you');


 }); 



   test('code method works',function(){

    
    $response =  $this->formatter
    ->code(200)
    ->send();

    $status = $response->getData(true);


    expect($status)->toHaveKey('code',200);
    expect($response->getStatusCode())->toBe(200);

 }); 

     test('headers method works',function(){

    
    $response =  $this->formatter
    ->headers([

        'X-Request-ID'    => 'req-123',
        'X-API-Version'   => 'v1.0',
        'X-Response-Time' => '50ms'

    ]) ->send(); 

    $headers = $response->headers;

        expect($headers->get('X-Request-ID'))->toBe('req-123')
        ->and($headers->get('X-API-Version'))->toBe('v1.0')
        ->and($headers->get('X-Response-Time'))->toBe('50ms');


 }); 

   test('jsonOptions method works',function(){

    $arabicName = ['name' => 'فارس']; //yeah it's my real name F A R E S
    
    $response =  $this->formatter
    ->data($arabicName)
    ->jsonOptions(JSON_UNESCAPED_UNICODE)
    ->send();

    $rawJson = $response->getContent();

    expect($rawJson)->toContain('فارس');
    expect($rawJson)->not->toContain('\u0641');

 }); 

    test('additional method works',function(){

        $myDreams = [

            'first' => 'be a better vesion of me',
            'second' => 'travel to everywhere',
            'third' => 'get a car',
            'four' => 'help people are in need',
        ];


    
    $response =  $this->formatter
    ->data([
        'mail_subject' => 'apply on scholarship',
        'mail_body' => 'hello i was applying on this scholarship for long time and i really need it ',
        'address' => 'Egypt/Giza'])
        ->additional($myDreams)
    ->send(); 

    $data = $response->getData(true)['additional'];


    expect($data)
    ->toBeArray() 
    ->and($data)->toHaveCount(4)
    ->and($data)->toHaveKey('first','be a better vesion of me')
    ->and($data)->toHaveKey('second','travel to everywhere')
    ->and($data)->toHaveKey('third','get a car')
    ->and($data)->toHaveKey('four','help people are in need');
   


 });     
   

     test('callback method works',function(){


    $fakeUsers = collect([
        ['id' => 1, 'name' => 'jhon'], // i don't know him is it spell john ?
        ['id' => 2, 'name' => 'adam'], // even that
    ]);    


    $response =  $this->formatter
    ->callback(fn() => $fakeUsers)
    ->send(); 

        $data = $response->getData(true)['data'];

        expect($data)->toHaveCount(2)
        ->and($data[0]['name'])->toBe('jhon');


 });    



 it(' returns the full package structure in one chain', function () {
    $response = $this->formatter
        ->success(true)
        ->message('Everything is Awesome')
        ->data(['id' => 7])
        ->additional(['meta' => 'data'])
        ->code(201)
        ->headers(['X-Custom' => 'open your eyes see the world'])
        ->send();

    $content = $response->getData(true);

    expect($response->getStatusCode())->toBe(201)
        ->and($content['success'])->toBeTrue()
        ->and($content['message'])->toBe('Everything is Awesome')
        ->and($content['data']['id'])->toBe(7)
        ->and($content['additional']['meta'])->toBe('data')
        ->and($response->headers->get('X-Custom'))->toBe('open your eyes see the world');
});