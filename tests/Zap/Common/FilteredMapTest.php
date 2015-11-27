<?php

namespace Test\Zap\Common;

use PHPUnit_Framework_TestCase;
use Zap\Common\FilteredMap;

class FilteredMapTest extends PHPUnit_Framework_TestCase
{
    public function testCanCreateEmptyMap()
    {
        $map = new FilteredMap();
        $data = $map->getAll();

        $this->assertEmpty($data);
    }

    public function testCanCreateFromArray()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = FilteredMap::createFromArray($originalData);
        $data = $map->getAll();

        $this->assertSame($data, $originalData);
    }

    public function testCanSetIndividualValuesWithEmptyArray()
    {
        $map = new FilteredMap();
        $map->set('one', 'uno');
        $data = $map->getAll();

        $this->assertSame($data, ['one' => 'uno']);
    }

    public function testCanSetIndividualValuesWithNonEmptyArray()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = FilteredMap::createFromArray($originalData);
        $map->set('three', 'tres');
        $data = $map->getAll();

        $this->assertSame($data, ['one' => 'uno', 'two' => 'dos', 'three' => 'tres']);
    }

    public function testCanSetMultipleValuesWithEmptyArray()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = new FilteredMap();
        $map->setAll($originalData);
        $data = $map->getAll();

        $this->assertSame($data, $originalData);
    }

    public function testCanSetMultipleValuesWithNonEmptyArray()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = FilteredMap::createFromArray($originalData);
        $map->setAll(['three' => 'tres', 'one' => 'ichi']);
        $data = $map->getAll();

        $this->assertSame($data, ['one' => 'ichi', 'two' => 'dos', 'three' => 'tres']);
    }

    public function testCanRemoveExistingEntry()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = FilteredMap::createFromArray($originalData);
        $result = $map->remove('two');
        $data = $map->getAll();

        $this->assertTrue($result);
        $this->assertSame($data, ['one' => 'uno']);
    }

    public function testCanRemoveNonExistingEntry()
    {
        $originalData = ['one' => 'uno', 'two' => 'dos'];
        $map = FilteredMap::createFromArray($originalData);
        $result = $map->remove('three');
        $data = $map->getAll();

        $this->assertFalse($result);
        $this->assertSame($data, $originalData);
    }

    public function testCanGetIntValue()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getInt('one');

        $this->assertSame($data, 1);
    }

    public function testCanGetIntValueWithDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getInt('two', 2);

        $this->assertSame($data, 2);
    }

    public function testCanGetIntValueWithoutDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getInt('two');

        $this->assertSame($data, 0);
    }

    public function testCanGetIntValueCannotConvert()
    {
        $map = FilteredMap::createFromArray(['one' => 'uno']);
        $data = $map->getInt('one');

        $this->assertSame($data, 0);
    }

    public function testCanGetFloat()
    {
        $map = FilteredMap::createFromArray(['one' => '1.2e-1']);
        $data = $map->getFloat('one');

        $this->assertSame($data, 1.2e-1);
    }

    public function testCanGetFloatWithDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getFloat('two', 2.23);

        $this->assertSame($data, 2.23);
    }

    public function testCanGetFloatWithoutDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getFloat('two');

        $this->assertSame($data, 0.0);
    }

    public function testCanGetFloatCannotConvert()
    {
        $map = FilteredMap::createFromArray(['one' => 'uno']);
        $data = $map->getFloat('one');

        $this->assertSame($data, 0.0);
    }

    public function testCanGetString()
    {
        $map = FilteredMap::createFromArray(['one' => 'uno']);
        $data = $map->getString('one');

        $this->assertSame($data, 'uno');
    }

    public function testCanGetStringWithDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getString('two', 'dos');

        $this->assertSame($data, 'dos');
    }

    public function testCanGetStringWithoutDefault()
    {
        $map = FilteredMap::createFromArray(['one' => '1']);
        $data = $map->getString('two');

        $this->assertSame($data, '');
    }

    public function testCanGetStringConverting()
    {
        $map = FilteredMap::createFromArray(['one' => 1]);
        $data = $map->getString('one');

        $this->assertSame($data, '1');
    }
}
