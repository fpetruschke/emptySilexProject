<?php

namespace emptyProjectSilex\Controller;
use Silex\Application;
use Doctrine\Common\Collections\Criteria;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\Security\Acl\Exception\Exception;
use emptyProjectSilex\Controller\Tools\simpleNoCrypter;

/**
 * UserController
 *
 * Is meant to handle the user auth actions.
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    04.02.16  -  08:21
 * @version 1.0
 */
class UserController
{

    /**
     * login
     *
     * default action when visiting inventory
     *
     * @param Application $app  Silex Application
     * @return mixed            Renders template
     */
    public function login(Application $app)
    {
        return $app['twig']->render(
            'auth/login.html.twig',
            array()
        );
    }

    /**
     * loginCheck
     *
     * checks given parameters for authentification
     *
     * @param Application $app  Silex Application
     * @return bool             Returns login state
     */
    public function loginCheck(Application $app) {
        session_start();
        $success = false;
        try {
            $userdata = json_decode($_POST['request'], true);
            $user = $userdata['user'];
            $password = $userdata['pwd'];

            $em = $app['eM'];
            $activeUser = $em->getRepository('emptyProjectSilex\Model\User')->findOneBy(array('username' => $user));
            $noCrypt = new simpleNoCrypter();
            if (!empty($activeUser)) {
                $activePwd = $activeUser->getPassword();
                if (sha1($password) == $activePwd) {
                    $_SESSION['user'] = $activeUser->getId();
                    $_SESSION['role'] = $activeUser->getRole()->getName();
                    $success = true;
                    echo ('Login');
                    $app['log']->write('AUTH', '[LOGIN] [UNAM: '. $user .'] [PWD: ' . $noCrypt->enableNoCrypt($password) .']');
                    exit();
                } else {
                    $app['log']->write('AUTH', '[AUTH FAILURE] [UNAM: '. $user .'] [PWD: ' . $noCrypt->enableNoCrypt($password). ']');
                }
            } else {
                $app['log']->write('AUTH', '[NAME FAILURE] [UNAM: '. $user .'] [PWD: ' . $noCrypt->enableNoCrypt($password) . ']');
            }
            return $success;
        } catch (Exception $e) {
            return $success;
        }
    }

    /**
     * logout
     *
     * Method for logging the user out
     *
     * @param Application $app  Silex Application
     * @return bool             Returns true after execution
     */
    public function logout(Application $app) {
        session_start();
        $user = $_SESSION['user'];
        session_destroy();
        $app['log']->write('AUTH', '[LOGOUT] [UID: '. $user . ']');
        return true;
    }
}
