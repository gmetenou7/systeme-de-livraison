<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require dirname(__DIR__).'\..\vendor\autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

class Server extends CI_Controller 
{
    public function index()
    {
        $this->load->library('Chat');
        if (!is_cli()) 
            die('Impossible de lancer le serveur');
        
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8080
        );
    
        $server->run();
    }
}
