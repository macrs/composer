<?php

/*
 * This file is part of Composer.
 *
 * (c) Nils Adermann <naderman@naderman.de>
 *     Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Composer\Test\Package\Archiver;

use Composer\Package\Archiver\HgExcludeFilter;
use Composer\Test\TestCase;

class HgExcludeFilterTest extends TestCase
{
    /**
     * @dataProvider providePatterns
     *
     * @param string  $ignore
     * @param mixed[] $expected
     */
    public function testPatternEscape($ignore, $expected)
    {
        $filter = new HgExcludeFilter('/');

        $this->assertEquals($expected, $filter->patternFromRegex($ignore));
    }

    public function providePatterns()
    {
        return array(
            array('.#', array('#.\\##', false, true)),
            array('.\\#', array('#.\\\\\\##', false, true)),
            array('\\.#', array('#\\.\\##', false, true)),
            array('\\\\.\\\\\\\\#', array('#\\\\.\\\\\\\\\\##', false, true)),
            array('.\\\\\\\\\\#', array('#.\\\\\\\\\\\\\\##', false, true)),
        );
    }
}
