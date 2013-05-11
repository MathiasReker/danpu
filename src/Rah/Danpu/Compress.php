<?php

/*!
 * Danpu - Database backup library
 * https://github.com/gocom/danpu
 *
 * Copyright (C) 2013 Jukka Svahn
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Creates a gzip file from the backup.
 *
 * @example
 */

class Rah_Danpu_Compress
{
    /**
     * Compresses files.
     *
     * @param string $from
     * @param string $to
     */

    public function pack($from, $to)
    {
        if (($gzip = gzopen($to, 'wb')) === false)
        {
            throw new Exception('Unable create compressed file.');
        }

        if (($source = fopen($from, 'rb')) === false)
        {
            throw new Exception('Unable open the compression source file.');
        }

        while (!feof($source))
        {
            $content = fread($source, 4096);
            gzwrite($gzip, $content, strlen($content));
        }

        gzclose($gzip);
        fclose($source);
    }

    /**
     * Uncompresses a file.
     *
     * @param string $from
     * @param string $to
     */

    public function unpack($from, $to)
    {
        if (($gzip = gzopen($from, 'rb')) === false)
        {
            throw new Exception('Unable to read compressed file.');
        }

        if (($target = fopen($to, 'w')) === false)
        {
            throw new Exception('Unable to open the target.');
        }

        while ($string = gzread($zip, 4096))
        {
            fwrite($target, $string, strlen($string));
        }

        gzclose($gzip);
        fclose($target);
    }
}