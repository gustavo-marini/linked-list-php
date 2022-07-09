<?php declare(strict_types=1);

use Secco2112\LinkedList\LinkedList;
use PHPUnit\Framework\TestCase;

final class LinkedListTest extends TestCase
{

    const TOTAL_ITEMS = 1000 * 1000;
    private static $linkedListItems = [];

    public static function setUpBeforeClass(): void
    {
        for($i=0; $i<self::TOTAL_ITEMS; $i++) {
            self::$linkedListItems[] = random_int(1, self::TOTAL_ITEMS);
        }
    }

    public function testCanCreateLinkedList(): void
    {
        $this->assertInstanceOf(
            LinkedList::class,
            new LinkedList
        );

        $this->assertTrue(true);
    }

    public function testCanInsertNodeAtLinkedList(): void
    {
        $linkedList = new LinkedList;
        $linkedList->insert(4)->insert(80);

        $this->assertEquals(
            $linkedList,
            (new LinkedList)->insert(4)->insert(80)
        );
    }

    public function testCanDeleteNodeByValue(): void
    {
        $valueToDelete = 8;

        $originallinkedList = new LinkedList;
        $originallinkedList->insert(1)->insert($valueToDelete)->insert(10)->insert(92)->insert($valueToDelete)->insert(2);
        $originallinkedList->deleteByValue($valueToDelete);

        $this->assertEquals(
            (new LinkedList)->insert(1)->insert(10)->insert(92)->insert(2),
            $originallinkedList
        );
    }

    public function testGenerateOneMillionListItems(): void
    {
        // var_dump($this->items);
    }

}