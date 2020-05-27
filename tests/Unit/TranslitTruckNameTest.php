<?php

namespace Tests\Unit;

use App\Http\Controllers\Controller;
use PHPUnit\Framework\TestCase;

class TranslitTruckNameTest extends TestCase
{
    /**
     * Test for function Controller->translit_truck_name($truck_name) with correct values
     *
     * @dataProvider correctProvider
     * @return void
     */
    public function testCorrectTranslit(string $input)
    {
        $controller = new Controller();
        $result = 'AH1111AH';

        $this->assertEquals($result, $controller->translit_truck_name($input) );
    }

    /**
     * Провайдер корректных даных
     * @return array
     */
    public function correctProvider()
    {
        return [
            'latin_uppercase' => ['AH1111AH'],
            'latin_lowercase' => ['ah1111ah'],
            'cyrill_uppercase' => ['АН1111АН'],
            'cyrill_lowercase' => ['ан1111ан'],
            'mix_uppercase' => ['АН1111AH'],
            'mix_lowercase' => ['ан1111ah'],
            'mix_mixcase' => ['Ан1111Ah'],
        ];
    }

    /**
     * Test for function Controller->translit_truck_name($truck_name) with wrong values
     *
     * @dataProvider wrongProvider
     * @return void
     */
    public function testWrongTranslit(string $input)
    {
        $controller = new Controller();
        $result = 'AH1111AH';

        $this->assertNotEquals($result, $controller->translit_truck_name($input) );
    }

    public function wrongProvider()
    {
        return [
            ['AX1111AH'],
            ['ah2111ah'],
            ['1111AHАН'],
            ['1111'],
            ['HН1111AH'],
            ['анahанah'],
            ['Ан1111Ah1'],
        ];
    }
}
