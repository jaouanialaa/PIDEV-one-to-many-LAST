<?php
/**
 * Created by PhpStorm.
 * User: jaoua
 * Date: 11/02/2018
 * Time: 14:42
 */

namespace GUBundle\Repository;


class UtilisateurRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByRole($role) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->_entityName, 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"' . $role . '"%');
        return $qb->getQuery()->getResult();
    }


    public function findByIdUser($username) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->_entityName, 'u')
            ->where('u.username = :iduser')
            ->setParameter('iduser', $username);
        return $qb->getQuery()->getOneOrNullResult();
    }
}