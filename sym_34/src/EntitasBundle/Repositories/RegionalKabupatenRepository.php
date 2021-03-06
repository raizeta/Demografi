<?php

namespace EntitasBundle\Repositories;

/**
 * DendaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RegionalKabupatenRepository extends \Doctrine\ORM\EntityRepository
{

    public function findKecamatanByKabId($id)
    {
        $qb = $this->createQueryBuilder('rkab');
        $qb     ->  select('rkab','rkec')
                ->  innerjoin('rkab.kecamatans','rkec')
                ->  where('rkab.id =:id')
                ->  setParameter('id',$id)
                ->  OrderBy('rkab.id');        
        return $qb->getQuery()->getArrayResult();      
    }       
	
}