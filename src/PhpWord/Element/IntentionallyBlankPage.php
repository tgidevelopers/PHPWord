<?php
/**
 * This file is part of PHPWord - A pure PHP library for reading and writing
 * word processing documents.
 *
 * PHPWord is free software distributed under the terms of the GNU Lesser
 * General Public License version 3 as published by the Free Software Foundation.
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code. For the full list of
 * contributors, visit https://github.com/PHPOffice/PHPWord/contributors.
 *
 * @see         https://github.com/PHPOffice/PHPWord
 * @copyright   2010-2018 PHPWord contributors
 * @license     http://www.gnu.org/licenses/lgpl.txt LGPL version 3
 */

namespace PhpOffice\PhpWord\Element;

use PhpOffice\PhpWord\Shared\Text as SharedText;

/**
 * Intentionally blank page element
 */
class IntentionallyBlankPage extends AbstractElement
{
    /**
     * Text content
     *
     * @var string|array
     */
    private $text;

    /**
     * Text style
     *
     * @var string|\PhpOffice\PhpWord\Style\Font
     */
    private $fontStyle;

    /**
     * Paragraph style
     *
     * @var string|\PhpOffice\PhpWord\Style\Paragraph
     */
    private $paragraphStyle;

    /**
     * Text break number
     *
     * @var int
     */
    private $nTextBreak;

    /**
     * Create a new Intentionally blank page Element
     *
     * @param string $text
     * @param int $nTextBreak
     */
    public function __construct($text = null, $nTextBreak = 15)
    {
        $this->setText($text);
        $this->setNTextBreak($nTextBreak);
    }

    /**
     * Set text content
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = SharedText::toUTF8($text);

        return $this;
    }

    /**
     * Get Text content
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text break number
     *
     * @param int $nTextBreak
     * @return self
     */
    public function setNTextBreak($nTextBreak)
    {
        $this->nTextBreak = $nTextBreak;

        return $this;
    }

    /**
     * Get Text break number
     *
     * @return int
     */
    public function getNTextBreak()
    {
        return $this->nTextBreak;
    }
}
