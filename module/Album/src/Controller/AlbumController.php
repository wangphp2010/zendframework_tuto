<?php


namespace Album\Controller; #所在文件夹 因为Album在composer.json 里加了 autoload .  "Album\\": "module/Album/src/" 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\AlbumTable ; 

class AlbumController extends AbstractActionController
{
    // Add this property:
    private $table;

    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }


    public function indexAction()
    {
        $albums = $this->table->fetchAll() ;
        
         
         return new ViewModel([
            'albums' => $albums  ,
        ]);
    
    }

    public function addAction()
    {
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}

