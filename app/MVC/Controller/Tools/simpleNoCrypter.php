<?php

namespace emptyProjectSilex\Controller\Tools;

/**
 * simpleNoCrypter
 *
 * Class for simple en- and decryption.
 * ONLY FOR DEV PURPOSES SINCE IT'S NOT SAFE ENCRYPTION!
 * Therefore the class name contains "NOcrypter".
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    24.03.16  -  09:00
 * @version 1.0
 *
 */
class simpleNoCrypter
{
    /**
     * enableNoCrypt
     * WARNING: ONLY FOR DEV PURPOSES SINCE IT'S NOT SAFE ENCRYPTION!
     *
     * Encrypts a given string.
     *
     * @param string    $string     String to encrypt
     * @return string               Returns the encrypted string
     */
    public function enableNoCrypt($string)
    {
        $createdNoCrypt = '';
        $strlen = strlen($string);
        for( $i = 0; $i < $strlen; $i++ ) {
            $char = substr( $string, $i, 1 );
            switch($char) {
                case 'a':
                    $createdNoCrypt .= 't';
                    break;
                case 'A':
                    $createdNoCrypt .= 'T';
                    break;
                case 'b':
                    $createdNoCrypt .= 'e';
                    break;
                case 'B':
                    $createdNoCrypt .= 'E';
                    break;
                case 'c':
                    $createdNoCrypt .= 'l';
                    break;
                case 'C':
                    $createdNoCrypt .= 'L';
                    break;
                case 'd':
                    $createdNoCrypt .= 'm';
                    break;
                case 'D':
                    $createdNoCrypt .= 'M';
                    break;
                case 'e':
                    $createdNoCrypt .= 'a';
                    break;
                case 'E':
                    $createdNoCrypt .= 'A';
                    break;
                case 'f':
                    $createdNoCrypt .= 'h';
                    break;
                case 'F':
                    $createdNoCrypt .= 'H';
                    break;
                case 'g':
                    $createdNoCrypt .= 'z';
                    break;
                case 'G':
                    $createdNoCrypt .= 'Z';
                    break;
                case 'h':
                    $createdNoCrypt .= 'y';
                    break;
                case 'H':
                    $createdNoCrypt .= 'Y';
                    break;
                case 'i':
                    $createdNoCrypt .= 'x';
                    break;
                case 'I':
                    $createdNoCrypt .= 'X';
                    break;
                case 'j':
                    $createdNoCrypt .= 'w';
                    break;
                case 'J':
                    $createdNoCrypt .= 'W';
                    break;
                case 'k':
                    $createdNoCrypt .= 'v';
                    break;
                case 'K':
                    $createdNoCrypt .= 'V';
                    break;
                case 'l':
                    $createdNoCrypt .= 'u';
                    break;
                case 'L':
                    $createdNoCrypt .= 'U';
                    break;
                case 'm':
                    $createdNoCrypt .= 's';
                    break;
                case 'M':
                    $createdNoCrypt .= 'S';
                    break;
                case 'n':
                    $createdNoCrypt .= 'r';
                    break;
                case 'N':
                    $createdNoCrypt .= 'R';
                    break;
                case 'o':
                    $createdNoCrypt .= 'q';
                    break;
                case 'O':
                    $createdNoCrypt .= 'Q';
                    break;
                case 'p':
                    $createdNoCrypt .= 'p';
                    break;
                case 'P':
                    $createdNoCrypt .= 'P';
                    break;
                case 'q':
                    $createdNoCrypt .= 'o';
                    break;
                case 'Q':
                    $createdNoCrypt .= 'O';
                    break;
                case 'r':
                    $createdNoCrypt .= 'n';
                    break;
                case 'R':
                    $createdNoCrypt .= 'N';
                    break;
                case 's':
                    $createdNoCrypt .= 'k';
                    break;
                case 'S':
                    $createdNoCrypt .= 'K';
                    break;
                case 't':
                    $createdNoCrypt .= 'j';
                    break;
                case 'T':
                    $createdNoCrypt .= 'J';
                    break;
                case 'u':
                    $createdNoCrypt .= 'i';
                    break;
                case 'U':
                    $createdNoCrypt .= 'I';
                    break;
                case 'v':
                    $createdNoCrypt .= 'g';
                    break;
                case 'V':
                    $createdNoCrypt .= 'G';
                    break;
                case 'w':
                    $createdNoCrypt .= 'f';
                    break;
                case 'W':
                    $createdNoCrypt .= 'F';
                    break;
                case 'x':
                    $createdNoCrypt .= 'd';
                    break;
                case 'X':
                    $createdNoCrypt .= 'D';
                    break;
                case 'y':
                    $createdNoCrypt .= 'c';
                    break;
                case 'Y':
                    $createdNoCrypt .= 'C';
                    break;
                case 'z':
                    $createdNoCrypt .= 'b';
                    break;
                case 'Z':
                    $createdNoCrypt .= 'B';
                    break;
                case '1':
                    $createdNoCrypt .= '0';
                    break;
                case '2':
                    $createdNoCrypt .= '2';
                    break;
                case '3':
                    $createdNoCrypt .= '4';
                    break;
                case '4':
                    $createdNoCrypt .= '6';
                    break;
                case '5':
                    $createdNoCrypt .= '8';
                    break;
                case '6':
                    $createdNoCrypt .= '1';
                    break;
                case '7':
                    $createdNoCrypt .= '3';
                    break;
                case '8':
                    $createdNoCrypt .= '5';
                    break;
                case '9':
                    $createdNoCrypt .= '7';
                    break;
                case '0':
                    $createdNoCrypt .= '9';
                    break;
                case 'ä':
                    $createdNoCrypt .= 'ö';
                    break;
                case 'Ä':
                    $createdNoCrypt .= 'Ö';
                    break;
                case 'ö':
                    $createdNoCrypt .= 'ü';
                    break;
                case 'Ö':
                    $createdNoCrypt .= 'Ü';
                    break;
                case 'ü':
                    $createdNoCrypt .= 'ä';
                    break;
                case 'Ü':
                    $createdNoCrypt .= 'Ä';
                    break;
                default:
                    $createdNoCrypt .= $char;
            }
        }
        return $createdNoCrypt;
    }

    /**
     * disableNoCrypt
     * WARNING: ONLY FOR DEV PURPOSES SINCE IT'S NOT SAFE ENCRYPTION!
     *
     * Decrypts strings that were encrypted with simpleNoCrypters' enableNoCript function
     *
     * @param string    $string     String to decrypt (must have been encrypted by enableNoCript)
     * @return string               Returns the decrypted string
     */
    public function disableNoCrypt($string)
    {
        $decryptedNoCrypt = '';
        $strlen = strlen($string);
        for( $i = 0; $i < $strlen; $i++ ) {
            $char = substr( $string, $i, 1 );
            switch($char) {
                case 'a':
                    $decryptedNoCrypt .= 'e';
                    break;
                case 'A':
                    $decryptedNoCrypt .= 'E';
                    break;
                case 'b':
                    $decryptedNoCrypt .= 'z';
                    break;
                case 'B':
                    $decryptedNoCrypt .= 'Z';
                    break;
                case 'c':
                    $decryptedNoCrypt .= 'y';
                    break;
                case 'C':
                    $decryptedNoCrypt .= 'Y';
                    break;
                case 'd':
                    $decryptedNoCrypt .= 'x';
                    break;
                case 'D':
                    $decryptedNoCrypt .= 'X';
                    break;
                case 'e':
                    $decryptedNoCrypt .= 'b';
                    break;
                case 'E':
                    $decryptedNoCrypt .= 'B';
                    break;
                case 'f':
                    $decryptedNoCrypt .= 'w';
                    break;
                case 'F':
                    $decryptedNoCrypt .= 'W';
                    break;
                case 'g':
                    $decryptedNoCrypt .= 'v';
                    break;
                case 'G':
                    $decryptedNoCrypt .= 'V';
                    break;
                case 'h':
                    $decryptedNoCrypt .= 'f';
                    break;
                case 'H':
                    $decryptedNoCrypt .= 'F';
                    break;
                case 'i':
                    $decryptedNoCrypt .= 'u';
                    break;
                case 'I':
                    $decryptedNoCrypt .= 'U';
                    break;
                case 'j':
                    $decryptedNoCrypt .= 't';
                    break;
                case 'J':
                    $decryptedNoCrypt .= 'T';
                    break;
                case 'k':
                    $decryptedNoCrypt .= 's';
                    break;
                case 'K':
                    $decryptedNoCrypt .= 'S';
                    break;
                case 'l':
                    $decryptedNoCrypt .= 'c';
                    break;
                case 'L':
                    $decryptedNoCrypt .= 'C';
                    break;
                case 'm':
                    $decryptedNoCrypt .= 'd';
                    break;
                case 'M':
                    $decryptedNoCrypt .= 'D';
                    break;
                case 'n':
                    $decryptedNoCrypt .= 'r';
                    break;
                case 'N':
                    $decryptedNoCrypt .= 'R';
                    break;
                case 'o':
                    $decryptedNoCrypt .= 'q';
                    break;
                case 'O':
                    $decryptedNoCrypt .= 'Q';
                    break;
                case 'p':
                    $decryptedNoCrypt .= 'p';
                    break;
                case 'P':
                    $decryptedNoCrypt .= 'P';
                    break;
                case 'q':
                    $decryptedNoCrypt .= 'o';
                    break;
                case 'Q':
                    $decryptedNoCrypt .= 'O';
                    break;
                case 'r':
                    $decryptedNoCrypt .= 'n';
                    break;
                case 'R':
                    $decryptedNoCrypt .= 'N';
                    break;
                case 's':
                    $decryptedNoCrypt .= 'm';
                    break;
                case 'S':
                    $decryptedNoCrypt .= 'M';
                    break;
                case 't':
                    $decryptedNoCrypt .= 'a';
                    break;
                case 'T':
                    $decryptedNoCrypt .= 'A';
                    break;
                case 'u':
                    $decryptedNoCrypt .= 'l';
                    break;
                case 'U':
                    $decryptedNoCrypt .= 'L';
                    break;
                case 'v':
                    $decryptedNoCrypt .= 'k';
                    break;
                case 'V':
                    $decryptedNoCrypt .= 'K';
                    break;
                case 'w':
                    $decryptedNoCrypt .= 'j';
                    break;
                case 'W':
                    $decryptedNoCrypt .= 'J';
                    break;
                case 'x':
                    $decryptedNoCrypt .= 'i';
                    break;
                case 'X':
                    $decryptedNoCrypt .= 'I';
                    break;
                case 'y':
                    $decryptedNoCrypt .= 'h';
                    break;
                case 'Y':
                    $decryptedNoCrypt .= 'H';
                    break;
                case 'z':
                    $decryptedNoCrypt .= 'g';
                    break;
                case 'Z':
                    $decryptedNoCrypt .= 'G';
                    break;
                case '1':
                    $decryptedNoCrypt .= '6';
                    break;
                case '2':
                    $decryptedNoCrypt .= '2';
                    break;
                case '3':
                    $decryptedNoCrypt .= '7';
                    break;
                case '4':
                    $decryptedNoCrypt .= '3';
                    break;
                case '5':
                    $decryptedNoCrypt .= '8';
                    break;
                case '6':
                    $decryptedNoCrypt .= '4';
                    break;
                case '7':
                    $decryptedNoCrypt .= '9';
                    break;
                case '8':
                    $decryptedNoCrypt .= '5';
                    break;
                case '9':
                    $decryptedNoCrypt .= '0';
                    break;
                case '0':
                    $decryptedNoCrypt .= '1';
                    break;
                case 'ü':
                    $decryptedNoCrypt .= 'ö';
                    break;
                case 'Ü':
                    $decryptedNoCrypt .= 'Ö';
                    break;
                case 'ö':
                    $decryptedNoCrypt .= 'ä';
                    break;
                case 'Ö':
                    $decryptedNoCrypt .= 'Ä';
                    break;
                case 'ä':
                    $decryptedNoCrypt .= 'ü';
                    break;
                case 'Ä':
                    $decryptedNoCrypt .= 'Ü';
                    break;
                default:
                    $decryptedNoCrypt .= $char;
            }
        }
        return $decryptedNoCrypt;
    }
}
