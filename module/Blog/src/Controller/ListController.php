<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Model\PostRepositoryInterface;
use Blog\Model\PostRepository ;
class ListController  extends  AbstractActionController
{

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
 
   
}
