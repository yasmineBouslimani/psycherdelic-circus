<?php

namespace App\Controller;

use App\Service\Roulette;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RouletteController extends AbstractController
{
    /**
     * @Route("/roulette", name="roulette")
     */
    public function index(Roulette $roulette)
    {
        //If the form is being posted process it below
        if (isset($_POST['task'])) {
            $moneypot = $_POST['moneypot'];
            $startingpot = $moneypot;
            $wonlast = true;
            $base_bet = $_POST['base_bet'];
            $maximumbet = $_POST['maximumbet'];
            $color = $_POST['color'];
            $numspins = $_POST['numspins'];
            $result_text = "";


            for ($i = 0; $i < $numspins; $i++) {


                if ($color == "random") {
                    //choose a random color (red or black)
                    $myrand = rand(1, 2);
                    $color = "black";
                    if ($myrand == 2) {
                        $color = "red";
                    }
                }

                $current_bet = 100;
                if ($wonlast) {
                    $current_bet = $base_bet;
                } else {
                    if ($current_bet < $maximumbet || $maximumbet == 0) {
                        $current_bet = $current_bet * 2;
                    }
                }

                //make sure there is enough money for bet
                if ($moneypot < $current_bet) {

                    $result_text .= "not enough money left in your pot to place bet of: " . $current_bet;
                    break;
                }

                $result_text .= "your moneypot: " . $moneypot . ". your bet: $" . $current_bet . " on " . $color . " => ";

                if ($roulette->spin($color)) {
                    $wonlast = true;
                    $moneypot += $current_bet;
                    $result_text .= "Winner!<br/>";
                } else {
                    $result_text .= "Loser<br/>";
                    $wonlast = false;
                    $moneypot -= $current_bet;
                }

            }


            return $this->render('roulette.html.twig', [
                'controller_name' => 'RouletteController',
                'startingpot'     => $startingpot,
                'base_bet'        => $base_bet,
                'color'           => $color,
                'maximumbet'    => $maximumbet,
                'numspins' => $numspins,
                'moneypot' => $moneypot,



            ]);


        }
    }




}
