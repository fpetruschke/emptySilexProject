<?php
namespace emptyProjectSilex\Controller;

/**
 * iniParser
 *
 * Simple iniParser class for extracting information from an .ini-file.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    24.03.16  -  06:11
 * @version 1.0
 */
class iniParser
{
    /**
     * getArrayedIniFile
     *
     * Returns an array with parameters as keys and their values as values belonging to this key.
     *
     * Expects a readable .ini-File with following format:
     *
     * Each line has structure: <parameter name> : <value>
     * Linebreaks terminate dataset of key and its value.
     * ';' at the line beginning comments the line out
     * ':' separates params from value each line
     *
     * @param $pathToFile   string      absolute path to the .ini-file
     * @return array                    returns an array with the result set
     *                                  returns an array on failure with structure:
     *                                  array('Error' => 'Message');
     */
    public function getArrayedIniFile($pathToFile) {

        if('ini' == pathinfo($pathToFile, PATHINFO_EXTENSION)) {
            if('text/plain' == mime_content_type($pathToFile)) {
                $handle = fopen($pathToFile, "r");
                $keys = array();
                $values = array();

                if ($handle) {
                    while(($line = fgets($handle)) !== false) {
                        if ($line[0] != ';'){
                            $keys [] = str_replace(' ', '', rtrim(preg_match('/.*:/', $line), ':'));
                            $values []= str_replace(' ', '', trim(preg_match('/:+.*/', $line),':'));
                        }
                    }
                    fclose($handle);
                    return array_combine($keys, $values);
                } else {
                    return array('Error' => 'Could not open file.');
                }
            } else {
                return array('Error' => 'Wrong MIME type.');
            }
        } else {
            return array('Error' => 'Wrong file extension.');
        }
    }
}
