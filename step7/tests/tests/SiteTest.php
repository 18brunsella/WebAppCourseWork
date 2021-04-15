<?php


class SiteTest extends \PHPUnit\Framework\TestCase
{
    public function testGettersSetters(){
        $site = new \Felis\Site();
        $site->dbConfigure("msu", "brunsell", "test", "prefix");
        $this->assertEquals("prefix", $site->getTablePrefix());
        $site->setEmail("test@gmail.com");
        $this->assertEquals("test@gmail.com", $site->getEmail());
        $site->setRoot("hello");
        $this->assertEquals("hello", $site->getRoot());
    }

    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test_', $site->getTablePrefix());
    }
}