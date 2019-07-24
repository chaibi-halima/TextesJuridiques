<?php

// src/Culture/JuridiqueBundle/Entity/TextesRechercheRepository.php

namespace Culture\JuridiqueBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TextesRechercheRepository extends EntityRepository {

    public function findTexteByParametres($data) {

        $query = $this->createQueryBuilder('a')
        /*->leftJoin('CultureJuridiqueBundle:jort', 'j', 'WITH', 'a.jort= j.id')*/;
        
        if ($data['typetexte'] != '' && $data['typetexte'] != 'Choisir Type Texte') {
   
            $query->andWhere('a.typetexte = :typetexte')
                    ->setParameter('typetexte', $data['typetexte']);
        }
        if ($data['annee'] != '') {
        $annee=$data['annee'];
        $query->andWhere("SUBSTRING(a.date, 1, 4) = :annee")
               ->setParameter('annee', $annee);
        
        }
        if ($data['numero'] != '') {

            $query->andWhere('a.numero = :numero')
                    ->setParameter('numero', $data['numero']);
        }
        if ($data['date'] != '') {

            $query->andWhere('a.date = :date')
                    ->setParameter('date', $data['date']);
        }
        if ($data['domaine'] != '' && $data['domaine'] != 'Choisir Domaine Culturel') {

            $query->andWhere('a.domaine = :domaine')
                    ->setParameter('domaine', $data['domaine']);
        }
        
        if ($data['anneejort'] != '') {
        $anneejort=$data['anneejort'];
        $query->andWhere("SUBSTRING(a.date_jort, 1, 4) = :anneejort")
               ->setParameter('anneejort', $anneejort);
        
        }
        
        if ($data['jort'] != '') {

            $query->andWhere('a.jort = :jort')
                    ->setParameter('jort', $data['jort']);
        }
        if ($data['datejort'] != '') {
           
            $query->andWhere('a.date_jort = :datejort')
                   ->setParameter('datejort', $data['datejort']);

        }
                
        return $query->getQuery()->getResult();
    }

}
