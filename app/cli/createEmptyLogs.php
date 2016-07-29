<?php
/**
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    26.05.16  -  17:07
 * @version 1.0
 */

/**
 * Class EmptyLogs
 *
 * Creates the log directory with the necessary empty .log-files inside
 * so you don't have to manually add them.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    26.05.16  -  17:07
 * @version 1.0
 */
class EmptyLogs {

    protected $createDirInPath = "../logs/";
    protected $logFiles = array("AUTH.log");

    protected $invalidParamter;
    protected $helpText;
    protected $errorDir;
    protected $errorFile;
    protected $allCreated;

    public function __construct($params)
    {

        $this->setTexts();
        if(count($params) > 1) {
            if('-h' != $params[1] and '-s' != $params[1] and '-ss' != $params[1]) {
                $this->msgAndExit($this->invalidParamter);
            }
        }
        if (isset($params[1]) && '-h' == $params[1]) {
            $this->msgAndExit($this->helpText);
        } else {
            $dirCreated = true;
            if(!is_dir($this->createDirInPath)) {
                $dirCreated = mkdir($this->createDirInPath, 0755, true);
            }
            $filesCreated = array();
            foreach ($this->logFiles as $log) {
                if(!is_file(dirname($this->createDirInPath.$log))) {
                    $filesCreated[] = true; //mkdir(dirname($this->createDirInPath.$log), 0755, true); // $path is a file
                    $fh = fopen($this->createDirInPath.$log, 'w') or $filesCreated[] = false;
                    fclose($fh);
                }
            }

            if(isset($params[1]) && '-s' == $params[1]) {
                if(!$dirCreated) {
                    $this->msgAndExit(1);
                } elseif (in_array(false, $filesCreated)) {
                    $this->msgAndExit(1);
                } else {
                    $this->msgAndExit(0);
                }
            } elseif (isset($params[1]) && '-ss' == $params[1]) {
                $this->msgAndExit("");
            } else {
                if(!$dirCreated) {
                    $this->msgAndExit($this->errorDir);
                } elseif (in_array(false, $filesCreated)) {
                    $this->msgAndExit($this->errorFile);
                } else {
                    $this->msgAndExit($this->allCreated);
                }
            }
        }
    }

    /**
     * msgAndExit
     *
     * Clears the console, echos the given message and exits the program afterwards.
     *
     * @param $msg  String  Text of the message to echo
     */
    protected function msgAndExit($msg) {
        passthru('clear');
        echo $msg;
        exit;
    }

    protected function setTexts() {

        $this->invalidParamter = "\n---------------------------------------------------------------\n" .
            "                            ERROR\n" .
            "---------------------------------------------------------------\n" .
            "Invalid parameter.\n";

        $this->helpText = "\n---------------------------------------------------------------\n" .
            "                            HELP\n" .
            "---------------------------------------------------------------\n" .
            "Creates the necessary log folder and empty log files.\n" .
            "---------------------------------------------------------------\n" .
            "Usage: php createLogs.php [Option]\n" .
            "\n" .
            "Options:\n" .
            " -h  (help)            Show help menu\n" .
            " -s  (silent)          Only get status codes as console output\n" .
            " -ss (super silent)    Completely suppress console output\n" .
            "\n" .
            "---------------------------------------------------------------\n" .
            "Structure of created files inside the project: \n".
            "---------------------------------------------------------------\n" .
            " d     app/\n" .
            " d     |  logs/\n";

        foreach($this->logFiles as $log) {
            $this->helpText .= " f     |  |  ".$log."\n";
        }
        $this->helpText .= "---------------------------------------------------------------\n";

        $this->errorDir = "\n---------------------------------------------------------------\n" .
            "                            ERROR\n" .
            "---------------------------------------------------------------\n" .
            "Could not create directory.\n";

        $this->errorFile = "\n---------------------------------------------------------------\n" .
            "                            ERROR\n" .
            "---------------------------------------------------------------\n" .
            "Could not create one or more log files.\n";

        $this->allCreated = "\n---------------------------------------------------------------\n" .
            "                            SUCCESS\n" .
            "---------------------------------------------------------------\n" .
            "Created log directory and empty log files.\n";
    }

}

if(!defined("STDIN")) {
    define("STDIN", fopen('php://stdin','r'));
}
new EmptyLogs($_SERVER['argv']);