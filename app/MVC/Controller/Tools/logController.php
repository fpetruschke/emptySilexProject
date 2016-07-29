<?php

namespace emptyProjectSilex\Controller\Tools;

/**
 * LogController
 *
 * The LogController can be used for logging events.
 *
 * The LogManager can read, write and clear log files.
 * When writing, the LogManager first checks, whether the
 * preconfigured filesize is reached or not. It will clear
 * the log according to the settings below.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    21.03.16  -  10:20
 * @version 1.0
 */
class logController {

    /**
     * @var int     Maximal size of the log file in MegaBytes (1MB = 1024 * 1024 = 1048576Bytes)
     */
    private $maxLogFileSize = 5;

    /**
     * @var int     Amount of lines the log file should keep after being cut
     *              If NEGATIVE = last X lines will be kept
     *              If POSITIVE = first X lines will be kept
     */
    private $amountOfRemainingLines = -100;

    /**
     * @var array   Contains all possible log file names and types
     */
    public $logTypes = array(
        'AUTH',     // logging authentication process
        'CREATE',   // logging every type of creation (e.g. device, user)
        'EDIT',     // logging every update
        'DELETE',   // logging every deletion
        'BASE'      // logging actions concerning base data informations
    );

    public $type;

    public $basepath;

    /**
     * LogManager constructor
     *
     * Setting of path to the logfiles' root
     *
     * @param string $basepath Is the basepath to the logfile
     */
    public function __construct($basepath) {
        $this->basepath = $basepath;
    }

    /**
     * @param $logType  String  Name of the LogType. Can be anything, that's inside $logtypes
     * @param $text     String  Text for logfile. Will be embedded into a preconfigured "template"
     */
    public function write($logType, $text)
    {
        if(in_array($logType, $this->logTypes)) {
            // Check for filesize and cut it - fitting the above requirements
            $logfilepath = $this->basepath . '/' . $logType .'.log';
            if (file_exists($logfilepath)) {
                $fileroot = realpath($logfilepath);

                if ((filesize($fileroot)/(1048576)) >= $this->maxLogFileSize) {
                    $file = file($logfilepath);
                    array_splice($file, $this->amountOfRemainingLines);
                }
                // check for datatype and convert
                if (is_object($text)) {
                    $text = json_encode($text);
                }
                if (is_array($text)) {
                    $text = implode($text);
                }

                date_default_timezone_set('Europe/Berlin');
                file_put_contents($logfilepath, "[". date('l d.m.Y H:i:s') . "] " . $text . "\n", FILE_APPEND);
            }
        }
    }



    /**
     * getFileContent
     *
     * Is used for getting the content of the logfile
     *
     * @param $logType String Contains a string from the $logTypes-array above
     * @return array    Gets the content of the logfile stored in "$this->pathToFile"
     */
    public function getFileContent($logType) {
        $logfilepath = $this->basepath . '/' . $logType .'.log';
        if(in_array($logType, $this->logTypes)) {
            return file($logfilepath);
        }
        return false;
    }

    /**
     * clearFile
     *
     * Method for clearing the logfile manually.
     * Please notice that you can configure when the LogManager will
     * automatically clean the file (see method "saveToFile" and the
     * doc blocs above that method)
     *
     * @return bool     Returns true on success.
     *                  False on Failure.
     *                  Fails when the file is bigger than before clearing.
     */
    public function clearFile($logType) {

        if(in_array($logType, $this->logTypes)) {
            // count lines at the beginning
            $linecountInit = 1;
            $handle = fopen($this->basepath . '/' . $logType .'.log', "r");
            while (!feof($handle)) {
                $line = fgets($handle);
                $linecountInit++;
            }
            fclose($handle);

            // clear log file
            $fileroot = realpath($this->basepath);
            exec('cd ' . $fileroot . ' && > ' . $logType .'.log');

            // count lines after clearing
            $linecountAfter = 0;
            $handle = fopen($this->basepath . '/' . $logType .'.log', "r");
            while (!feof($handle)) {
                $line = fgets($handle);
                $linecountAfter++;
            }
            fclose($handle);

            if($linecountInit > $linecountAfter) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
