<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * les différentes routes du client
 */
$route['default_controller'] = 'Login';
$route['inscription'] = 'register';
//$route['login'] = 'Login';
$route['presentation'] = 'presentation';

$route['home'] = 'Home/Home';
$route['home/(:num)'] = 'Home/Home/index/';
$route['commande'] = 'Commande/Commande';

//suivi de la commande
$route['suivi-commande/(:any)'] = 'Commande/Commande/suivi_com/';
//afficher la liste de commande
$route['allcommande'] = 'Commande/Commande/all_commande';
/**details sur une commande */
$route['details_commande'] = 'Commande/Commande/details_comd';
$route['etat'] = 'Commande/Commande/etat';
$route['deconnexion'] = 'Login/logout';
/**statistique des commandes en fonction de l'entreprise */
$route['stat'] = 'Home/home/filter_en';

//afficher commandes non livrées
$route['get_comEncours'] = 'Commande/Commande/get_comEncours';

//afficher commandes  livrées
$route['comLivre'] = 'Commande/Commande/comLivre';

//afficher commandes  annulées
$route['get_Comannuler'] = 'Commande/Commande/get_comannuler';

// afficher une commande en fonction de l'entreprise
$route['entreprise'] = 'Commande/Commande/entreprise';
//faire la recherche dans l'historique les commandes livrées'
$route['recherchannul'] = 'Commande/Commande/searchHisAnnul';
//faire la recherche dans l'historique les commandes livrées'
$route['recherchli'] = 'Commande/Commande/searchHisLivr';
//faire la recherche dans l'historique les commandes encours'
$route['recherche'] = 'Commande/Commande/searchHistorique';
//afficher commandes non livrées
$route['get_comEncours'] = 'Commande/Commande/get_comEncours';

//afficher commandes  livrées
$route['comLivre'] = 'Commande/Commande/comLivre';
//afficher commandes  livrées
$route['get_Comannuler'] = 'Commande/Commande/get_comannuler';
// afficher une commande en fonction de l'entreprise et de L,etat
$route['filterc'] = 'Commande/Commande/filtercommande';

/**confirmation de la commande */
$route['confirm'] = 'Commande/commande/confirm';
// supprimer une commande
$route['delete_com'] = 'Commande/Commande/delete_com';
/**reception de la commane */
$route['signature'] = 'Commande/commande/signature';
/**Mets  le statut de la commande à 'en cours' après validation de la notification */
$route['update-status'] = 'Commande/commande/update_status';
//affiche les notifications du client
$route['show-notifications'] = 'Commande/commande/get_notifications';

/**
 * 
 * Les routes du livreur 
 */

$route['accueil'] = 'Livreur/Commande';
//pagination des commandes
$route['accueil/(:num)'] = 'Livreur/Commande';
//affiche toutes les commandes du système
$route['commande-livreur'] = 'Livreur/Commande/all_commande';
//details d'une command
$route['details'] =  'Livreur/commande/details';
//ajoute une commande dans l'historique de commande
$route['ajout-commande'] = 'Livreur/commande/add_command';
//affiche les commandes prise en charge par un livreur 
$route['mes-commandes'] = 'Livreur/Commande/my_commande';
$route['get-commande'] = 'Livreur/Commande/get_commande';
$route['prise-en-charge'] = 'Livreur/commande/prise';
//affiche les notifications du livreur 
$route['notifications'] = 'Livreur/commande/notification';

/**
 * 
 * Les routes de l' admin
 */
$route['admin'] = 'Admin/Insert_com';
$route['liste_pro'] = 'Admin/Insert_com/liste';
$route['liste-des-clients'] = 'Admin/Liste';
$route['ajout-client'] = 'Admin/Liste/add';
$route['edit-client/(:num)'] = 'Admin/Liste/edit/$1';

$route['insert'] = 'Admin/Insert_com/insert';
$route['edit_pro/(:any)'] = 'Admin/Insert_com/edit/$1';

$route['prodclient'] = 'Admin/Insert_com/prodclient';
// facture produit client
$route['prodfact/(:any)'] = 'Admin/Insert_com/prodfact/';
$route['prodfac/(:any)'] = 'Admin/Insert_com/prodfact/';

$route['delete_prod/(:any)'] = 'Admin/Insert_com/delete/$1';


$route['update_pro'] = 'Admin/Insert_com/update';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
