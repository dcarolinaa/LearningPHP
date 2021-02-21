<?php
namespace Test\Unit\models;

use PHPUnit\Framework\TestCase;
use App\models\Preference;
use \Faker\Factory as FakerFactory;
final class PreferenceTest extends TestCase {
    
    public function testCreate() {
        $faker = FakerFactory::create();
        $shortName = $faker->word;
        $preference = new Preference();
        $preference->fill([
            'short_name' => $shortName,
            'name' => 'name'
        ]);
        $this->assertNull($preference->getId());
        $preference->save();
        $this->assertIsNumeric($preference->getId());
        return $preference;
    }

    /**
     * @depends testCreate
     */
    public function testUpdate($preference) {
        $faker = FakerFactory::create();
        $originalShortName = $preference->getShortName();
        $newShortName = sprintf('%s-%s', $faker->word, time());
        $preference->setShortName($newShortName);
        $preference->save();
        $this->assertNotSame($originalShortName, $newShortName);
    }
}