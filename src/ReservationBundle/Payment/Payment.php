<?php

namespace ReservationBundle\Payment;

use Symfony\Component\HttpFoundation\Request;

class Payment
{
    public function sendingPayment(Request $request)
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
                \Stripe\Stripe::setApiKey("sk_test_cXWRAaUCUZZsxcFVsvRTw5PL");
                $command = $request->getSession()->get("command");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
                $token = $request->get('stripeToken');

        try {
        // Charge the user's card:
                $charge = \Stripe\Charge::create(array(
                    "amount"        => $command->getTotalPrice(),
                    "currency"      => "eur",
                    "description"   => "Musée du Louvre - Paiement de la commande",
                    "source"        => $token,
                ));
        } catch(\Stripe\Error\Card $e) {
            // la carte n'est pas valide
            return false;
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Des paramètres non valides ont été envoyé à l'API Stripe
            return false;
        } catch (\Stripe\Error\Authentication $e) {
            // L'authentification avec Stripe a échoué
            return false;
        } catch (\Stripe\Error\ApiConnection $e) {
            // La communication réseau avec Stripe a échoué
            return false;
        } catch (\Stripe\Error\Base $e) {
            // Affiche une erreur générique à l'utilisateur
            return false;
        } catch (Exception $e) {
            // Une autre chose s'est produite, totalement sans lien avec Stripe
            return false;
        }
        return true;


    }
}


