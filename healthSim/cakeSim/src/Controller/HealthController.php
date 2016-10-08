<?php
namespace App\Controller;

use Cake\Controller\Component\FlashComponent;
use App\Controller\AppController;

class HealthController extends AppController
{
    var $components = array("RequestHandler");

    public function index()
    {
        if($this->request->is('ajax')) 
        {
            $this->set('val','test ok');
        }
    }
}