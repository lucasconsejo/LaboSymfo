<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlayersController extends AbstractController {
    public function getPlayers() {

        $repo =  $this->getDoctrine()->getRepository('App:Player');
        $players = $repo->findAll();

        return $this->render('players.html.twig', [
            'players' => $players
        ]);
    }

    public function addTeam() {

        $em = $this->getDoctrine()->getManager();
        $newTeam = new Team();
        $newTeam->setName('COB-YNOV Rubgy');

        $em->persist($newTeam);
        $em->flush();

        return $this->render('teams.html.twig', [
            'team_created' => $newTeam
        ]);
    }

    public function addPlayerTotTeam(){
        $em = $this->getDoctrine()->getManager();
        $repoPlayer =  $this->getDoctrine()->getRepository('App:Player');
        $repoTeam =  $this->getDoctrine()->getRepository('App:Team');

        $player = $repoPlayer->find(1);
        $team = $repoTeam->find(1);

        $player->setTeamId($team);

        $em->persist($player);
        $em->flush();

        return new \Symfony\Component\HttpFoundation\Response('OK');
    }

    public function addPlayerTotTeamTwo($idPlayer, $idTeam){
        $em = $this->getDoctrine()->getManager();
        $repoPlayer =  $this->getDoctrine()->getRepository('App:Player');
        $repoTeam =  $this->getDoctrine()->getRepository('App:Team');

        $player = $repoPlayer->find($idPlayer);
        $team = $repoTeam->find($idTeam);

        $player->setTeamId($team);

        $em->persist($player);
        $em->flush();

        return new \Symfony\Component\HttpFoundation\Response('OK');
    }

}