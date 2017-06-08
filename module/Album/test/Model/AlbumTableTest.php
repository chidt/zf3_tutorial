<?php
/**
 * Created by PhpStorm.
 * User: Chi-DT
 * Date: 31/05/2017
 * Time: 16:23
 */

namespace AlbumTest\Model;

use Album\Model\AlbumTable;
use Album\Model\Album;
use PHPUnit_Framework_TestCase as TestCase;
use RuntimeException;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\TableGateway\TableGatewayInterface;


class AlbumTableTest extends TestCase
{
    protected function setUp()
    {
        $this->tableGateway = $this->prophesize(TableGatewayInterface::class);
        $this->albumTable = new AlbumTable($this->tableGateway->reveal());
    }

    public function testFetchAllReturnsAllAlbums()
    {
        $resultSet = $this->prophesize(ResultSetInterface::class)->reveal();
        $this->tableGateway->select()->willReturn($resultSet);

        $this->assertSame($resultSet, $this->albumTable->fetchAll());
    }

    public function testCanDeleteAnAlbumByItsId()
    {
        $this->tableGateway->delete(['id' => 123])->shouldBeCalled();
        $this->albumTable->deleteAlbum(123);
    }

    public function testSaveAlbumWillInsertNewAlbumsIfTheyDontAlreadyHaveAnId()
    {
        $albumData = [
            'artist' => 'The Milltary Wives',
            'title' => 'In My Dreams'
        ];

        $album = new Album();
        $album->exchangeArray($albumData);

        $this->tableGateway->insert($albumData)->shouldBeCalled();
        $this->albumTable->saveAlbum($album);
    }

    public function testSaveAlbumWillUpdateExistingAlbumsIfTheyAlreadyHaveAnId()
    {
        $albumData = [
            'id' => 123,
            'artist' => 'The Milltary Wives',
            'title' => 'In My Dreams',
        ];
        $album = new ALbum();
        $album->exchangeArray($albumData);

        $resultSet = $this->prophesize(ResultSetInterface::class);
        $resultSet->current()->willReturn($album);

        $this->tableGateway->select(['id' => 123])->willReturn($resultSet->reveal());
        $this->tableGateway->update(array_filter($albumData, function ($key) {
            return in_array($key, ['artist', 'title']);
        }, ARRAY_FILTER_USE_KEY), ['id' => 123])->shouldBeCalled();
        $this->albumTable->saveAlbum($album);
    }

    public function testExceptionIsThrowWhenGettingNonExistentAlbum()
    {
        $resultSet = $this->prophesize(ResultSetInterface::class);
        $resultSet->current()->willReturn(null);

        $this->tableGateway->select(['id' => 123])->willReturn($resultSet->reveal());

        $this->setExpectedException(
            RuntimeException::class, 'Could not find row with identifier 123'
        );

        $this->albumTable->getAlbum(123);
    }
}