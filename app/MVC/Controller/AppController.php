<?php

namespace emptyProjectSilex\Controller;
use Silex\Application;

/**
 * AppController
 *
 * Controls the starting page of the application after login process
 *
 * @author  Florian Petruschke <florian.petruschke@gmail.com>
 * @date    25.01.16  -  10:06
 * @version 1.0
 */
class AppController
{

    /**
     * showIndex
     *
     * Handles showing the index/mainpage after login process
     *
     * @param Application $app  Silex Application
     * @return mixed            returns template
     */
    public function showIndex(Application $app) {
        //Check if session is already set
        session_start();
        if(!isset($_SESSION['user'])) {
            return $app['twig']->render(
                'auth/login.html.twig',
                array(
                )
            );
        }

        // getting entity manager
        $em = $app['eM'];
        //get all informations for creating a new device right from the starting page
        $repoRoles = $em->getRepository('emptyProjectSilex\Model\Role');
        $roles = $repoRoles->findAll();
        $repoUsers = $em->getRepository('emptyProjectSilex\Model\User');
        $users = $repoUsers->findAll();
        $user = $repoUsers->findOneBy(array('id' => $_SESSION['user']));

        return $app['twig']->render(
            'index.html.twig',
            array(
                'roles'         => $roles,
                'users'         => $users,
                'user'          => $user,
                'sessionUserId' => $_SESSION['user'],
                'sessionUserRole'=> $_SESSION['role']
            )
        );
    }

    public function showAll(Application $app) {
        //Check if session is already set
        session_start();
        if(!isset($_SESSION['user'])) {
            return $app['twig']->render(
                'auth/login.html.twig',
                array(
                )
            );
        }

        // getting entity manager
        $em = $app['eM'];
        //get all informations for creating a new device right from the starting page
        $repoRoles = $em->getRepository('emptyProjectSilex\Model\Role');
        $roles = $repoRoles->findAll();
        $repoUsers = $em->getRepository('emptyProjectSilex\Model\User');
        $users = $repoUsers->findAll();
        $user = $repoUsers->findOneBy(array('id' => $_SESSION['user']));

        /*$qb = $em->createQueryBuilder();
        $qb->select($qb->expr()->count('u.id'));
        $qb->from('emptyProjectSilex\Model\User','u');
        $count = $qb->getQuery()->getResult();*/

        /*$rows = $this->getDoctrine()->getManager()
            ->createQuery(
                'SELECT COUNT(users.id),users.role_id FROM emptyProjectSilex\Model\User users GROUP BY users.role_id;'
            )
            ->getArrayResult();
        $count = count($rows);*/

        $qb = $em->createQueryBuilder();
        $roleSums = $qb->select('COUNT(users.id)')
            ->from('emptyProjectSilex\Model\User', 'users')
            ->groupBy('users.role')
            ->getQuery()->getScalarResult();

        return $app['twig']->render(
            'showAll.html.twig',
            array(
                'roles'         => $roles,
                'roleSums'      => $roleSums,
                'users'         => $users,
                'user'          => $user,
                'sessionUserId' => $_SESSION['user'],
                'sessionUserRole'=> $_SESSION['role']
            )
        );
    }
}
