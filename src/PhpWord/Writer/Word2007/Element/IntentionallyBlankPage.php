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

namespace PhpOffice\PhpWord\Writer\Word2007\Element;

/**
 * Intentionally blank page element writer
 *
 * @since 0.18.0
 */
class IntentionallyBlankPage extends Text
{
    // rimane qs per via della old_write
    protected $nTextBreak = 15;

    /**
     * Write intentionally blank page element.
     */
    public function write($nTextBreak = 15)
    {
        //{ IF { =INT({ PAGE } / 2) * 2 } = { PAGE } "true" "false" \*MERGEFORMAT }

        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\IntentionallyBlankPage) {
            return;
        }

        $text = $element->getText();

        $nTextBreak = $element->getNTextBreak();

        $this->startElementP();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();


        //IF
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' IF ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //=INT(
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' =INT(');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //PAGE
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' PAGE ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->writeRaw("<w:r><w:fldChar w:fldCharType=\"separate\"/></w:r><w:r><w:rPr><w:noProof/></w:rPr><w:instrText>1</w:instrText></w:r>");

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        // / 2) * 2
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' / 2) * 2 ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->writeRaw("<w:r><w:fldChar w:fldCharType=\"separate\"/></w:r><w:r><w:rPr><w:noProof/></w:rPr><w:instrText>0</w:instrText></w:r>");

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //=
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' = ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //PAGE
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' PAGE ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->writeRaw("<w:r><w:fldChar w:fldCharType=\"separate\"/></w:r><w:r><w:rPr><w:noProof/></w:rPr><w:instrText>1</w:instrText></w:r>");

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //true
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $xmlWriter->writeRaw(" \"\"");
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //false
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $xmlWriter->writeRaw(" \"");
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP();

        //page break
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:br');
        $xmlWriter->writeAttribute('w:type', 'page');
        $xmlWriter->endElement(); // w:br
        $xmlWriter->endElement(); // w:r
        $xmlWriter->endElement(); // w:p

        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:lastRenderedPageBreak');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //text break
        for ($i=0;$i<$nTextBreak-1;$i++) {
            $xmlWriter->startElement('w:p');
            $xmlWriter->endElement();
        }

        //Text style
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:pPr');
        $xmlWriter->startElement('w:jc');
        $xmlWriter->writeAttribute('w:val', 'center');
        $xmlWriter->endElement();//w:jc
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:b');
        $xmlWriter->endElement();//w:b
        $xmlWriter->startElement('w:bCs');
        $xmlWriter->endElement();//w:bCs
        $xmlWriter->startElement('w:sz');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:sz
        $xmlWriter->startElement('w:szCs');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:szCS
        $xmlWriter->endElement();//w:rPr
        $xmlWriter->endElement();//w:pPr

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:b');
        $xmlWriter->endElement();//w:b
        $xmlWriter->startElement('w:bCs');
        $xmlWriter->endElement();//w:bCs
        $xmlWriter->startElement('w:sz');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:sz
        $xmlWriter->startElement('w:szCs');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:szCS
        $xmlWriter->endElement();//w:rPr

        //Text
        $xmlWriter->startElement('w:instrText');
        $this->writeText($text);
        $xmlWriter->endElement();//w:instrText

        $xmlWriter->endElement();//w:r
        $xmlWriter->endElement();//w:p

        $this->startElementP();

        $xmlWriter->startElement('w:pPr');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:noProof');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->startElement('w:r');
        /*$xmlWriter->startElement('w:lastRenderedPageBreak');
        $xmlWriter->endElement();*/
        $xmlWriter->startElement('w:instrText');
        $this->writeText('"');
        $xmlWriter->endElement();//w:instrText
        $xmlWriter->endElement();//w:r


        //\* MERGEFORMAT
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' \\* MERGEFORMAT ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP(); // w:p
    }


    /**
     * Write intentionally blank page element.
     */
    public function old_write()
    {
        //{ IF { =MOD({ PAGE } ; 2)} = 0 "true" "false" \*MERGEFORMAT }

        $xmlWriter = $this->getXmlWriter();
        $element = $this->getElement();
        if (!$element instanceof \PhpOffice\PhpWord\Element\IntentionallyBlankPage) {
            return;
        }

        $text = $element->getText();

        $this->startElementP();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->startElement('w:r');

        //IF
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' IF ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //=MOD(
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' =MOD(');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //{
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'begin');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //PAGE
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' PAGE ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //;2)
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');

        if (locale_get_default() == 'it_IT') {
            $separator = ';';
        } else {
            $separator = ',';
        }
        $this->writeText(' '.$separator.' 2) ');

        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //=
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' = ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //1
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $this->writeText('1');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //true
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' "');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP();

        //page break
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:br');
        $xmlWriter->writeAttribute('w:type', 'page');
        $xmlWriter->endElement(); // w:br
        $xmlWriter->endElement(); // w:r
        $xmlWriter->endElement(); // w:p

        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:lastRenderedPageBreak');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //text break
        for ($i=0;$i<$this->nTextBreak-1;$i++) {
            $xmlWriter->startElement('w:p');
            $xmlWriter->endElement();
        }

        //Text style
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:pPr');
        $xmlWriter->startElement('w:jc');
        $xmlWriter->writeAttribute('w:val', 'center');
        $xmlWriter->endElement();//w:jc
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:b');
        $xmlWriter->endElement();//w:b
        $xmlWriter->startElement('w:bCs');
        $xmlWriter->endElement();//w:bCs
        $xmlWriter->startElement('w:sz');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:sz
        $xmlWriter->startElement('w:szCs');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:szCS
        $xmlWriter->endElement();//w:rPr
        $xmlWriter->endElement();//w:pPr

        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:b');
        $xmlWriter->endElement();//w:b
        $xmlWriter->startElement('w:bCs');
        $xmlWriter->endElement();//w:bCs
        $xmlWriter->startElement('w:sz');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:sz
        $xmlWriter->startElement('w:szCs');
        $xmlWriter->writeAttribute('w:val', '32');
        $xmlWriter->endElement();//w:szCS
        $xmlWriter->endElement();//w:rPr

        //Text
        $xmlWriter->startElement('w:instrText');
        $this->writeText($text);
        $xmlWriter->endElement();//w:instrText

        $xmlWriter->endElement();//w:r
        $xmlWriter->endElement();//w:p

        /*//page break
        $xmlWriter->startElement('w:p');
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:br');
        $xmlWriter->writeAttribute('w:type', 'page');
        $xmlWriter->endElement(); // w:br
        $xmlWriter->endElement(); // w:r
        $xmlWriter->endElement(); // w:p*/

        $this->startElementP();

        $xmlWriter->startElement('w:pPr');
        $xmlWriter->startElement('w:rPr');
        $xmlWriter->startElement('w:noProof');
        $xmlWriter->endElement();
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $xmlWriter->startElement('w:r');
        /*$xmlWriter->startElement('w:lastRenderedPageBreak');
        $xmlWriter->endElement();*/
        $xmlWriter->startElement('w:instrText');
        $this->writeText('"');
        $xmlWriter->endElement();//w:instrText
        $xmlWriter->endElement();//w:r

        //false
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' ""');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //\* MERGEFORMAT
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:instrText');
        $xmlWriter->writeAttribute('xml:space', 'preserve');
        $this->writeText(' \\* MERGEFORMAT ');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        //}
        $xmlWriter->startElement('w:r');
        $xmlWriter->startElement('w:fldChar');
        $xmlWriter->writeAttribute('w:fldCharType', 'end');
        $xmlWriter->endElement();
        $xmlWriter->endElement();

        $this->endElementP(); // w:p
    }
}
