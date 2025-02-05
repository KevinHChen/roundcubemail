<?php

/*
 +-----------------------------------------------------------------------+
 | This file is part of the Roundcube Webmail client                     |
 |                                                                       |
 | Copyright (C) The Roundcube Dev Team                                  |
 | Copyright (C) Kolab Systems AG                                        |
 |                                                                       |
 | Licensed under the GNU General Public License version 3 or            |
 | any later version with exceptions for skins & plugins.                |
 | See the README file for a full license statement.                     |
 |                                                                       |
 | PURPOSE:                                                              |
 |   Interface class for a spell-checking backend                        |
 +-----------------------------------------------------------------------+
 | Author: Thomas Bruederli <roundcube@gmail.com>                        |
 +-----------------------------------------------------------------------+
*/

/**
 * Interface class for a spell-checking backend
 */
abstract class rcube_spellchecker_engine
{
    public const MAX_SUGGESTIONS = 10;

    protected $lang;
    protected $error;
    protected $dictionary;
    protected $options = [];
    protected $separator = '/[\s\r\n\t\(\)\/\[\]{}<>\\"]+|[:;?!,\.](?=\W|$)/';

    /**
     * Default constructor
     */
    public function __construct($dict, $lang, $options = [])
    {
        $this->dictionary = $dict;
        $this->lang = $lang;
        $this->options = $options;
    }

    /**
     * Return a list of languages supported by this backend
     *
     * @return array Indexed list of language codes
     */
    abstract public function languages();

    /**
     * Set content and check spelling
     *
     * @param string $text Text content for spellchecking
     *
     * @return bool True when no misspelling found, otherwise false
     */
    abstract public function check($text);

    /**
     * Returns suggestions for the specified word
     *
     * @param string $word The word
     *
     * @return array Suggestions list
     */
    abstract public function get_suggestions($word);

    /**
     * Returns misspelled words
     *
     * @param string $text The content for spellchecking. If empty content
     *                     used for check() method will be used.
     *
     * @return array List of misspelled words
     */
    abstract public function get_words($text = null);

    /**
     * Returns error message
     *
     * @return string Error message
     */
    public function error()
    {
        return $this->error;
    }
}
