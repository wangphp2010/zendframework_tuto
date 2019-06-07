<?php


namespace Album\Controller; #所在文件夹 因为Album在composer.json 里加了 autoload .  "Album\\": "module/Album/src/" 

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Album\Model\AlbumTable;

use Album\Form\AlbumForm;
use Album\Model\Album;

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
        // Grab the paginator from the AlbumTable:
        $paginator = $this->table->fetchAll(true);
        $pagename ='pg' ;
        // Set the current page to what has been passed in query string,
        // or to 1 if none is set, or the page is invalid:
        $page = (int)$this->params()->fromQuery( $pagename , 1);
        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);
        $paginator->setPageRange(5);
        // Set the number of items per page to 10:
        $paginator->setItemCountPerPage(10);

        return new ViewModel(['paginator' => $paginator , "pagename" => $pagename  ] );
    }


    public function addAction()
    {

        $form = new AlbumForm();

        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($album->getInputFilter()); # 获得 $album->getInputFilter() 里的过滤条件 , 然后执行 看看是否符合过滤调教
        $form->setData($request->getPost()); #把post的来的数据 $request->getPost()  放到表格里

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData()); #把数据传给$ablum 
        $this->table->saveAlbum($album); #把$album里的数据插入数据库
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0); # 获得route 的里的id  否则为0

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $album = $this->table->getAlbum($id); # 如果这个id 找不到数据 
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album); # 绑定$album 当form获得数据 则$album也会获得数据
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($album->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $this->table->saveAlbum($album);

        // Redirect to album list
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int)$this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();

        /*   echo  $this->params()->fromQuery('del') . ' 1 '; # Get 的数据 或这这样写 $request->getQuery('del'); 因为没有 getGET()方法 而是getQuery()
        echo $this->params()->fromPost('del'). ' 2 ';# Post 的数据 
         */

        if ($request->isPost()) {
            $del = $request->getPost('del', 'No'); # 获得del值 如果空 则=no


            if ($del == 'Yes') {
                $id = (int)$request->getPost('id');
                // $this->table->deleteAlbum($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('album');
        }


        #等同于   return new ViewModel([  'id'    => $id,  'albums' => $albums,  ]);
        return [
            'id'    => $id,
            'album' => $this->table->getAlbum($id), # 这两个变量$id , $album 将在delet.phtml里使用
        ];
    }
}
