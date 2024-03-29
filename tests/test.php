<?php
namespace PMVC\PlugIn\mbstring;

use PMVC\TestCase;

const MULTIBYTE_STRING='或許會成功';

class MbstringTest extends TestCase
{
    private $_plug = 'mbstring';
    function testPlugin()
    {
        ob_start();
        print_r(\PMVC\plug($this->_plug));
        $output = ob_get_contents();
        ob_end_clean();
        $this->haveString($this->_plug,$output);
    }

    function testSubstr()
    {
      $p = \PMVC\plug($this->_plug);
      $acture = $p->substr(MULTIBYTE_STRING, 0, 1);
      $this->assertEquals('或', $acture);
      $this->assertEquals(3, strlen($acture));
    }

    function testInternalEncoding()
    {
      $p = \PMVC\plug($this->_plug);
      $old = $p->internalEncoding();
      mb_internal_encoding("big-5");
      $acture = $p->internalEncoding();
      $this->assertEquals('BIG-5', $acture);
      $p->internalEncoding($old);
      $this->assertEquals($old, $p->internalEncoding());
    }
}
