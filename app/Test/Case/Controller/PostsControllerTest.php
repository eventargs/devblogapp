<?php
App::uses('PostsController', 'Controller');

/**
 * PostsController Test Case
 *
 */
class PostsControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post'
	);

	public function setUp(){
		parent::setUp();
		$this->controller = $this->generate('Posts',[
			'components' => ['Paginator', 'Session'],
			'models'     => ['Post' => ['save']],
			'methods'    => ['redirect'],
		]);
		$this->controller->autoRender = false;
	}

	public function testIndexアクションではページングの結果がpostsにセットされること(){
		$data = [
			['Posts'=>['id'=>1,'title'=>'Title1', 'body'=>'Body1']],
		];
		$this->controller->Paginator->expects($this->once())->method('paginate')->will($this->returnnValue($data));

		$vars = $this->testAction('/user/blog', ['method'=>'get', 'return' => 'vars']);//テスト実行 testActionはcakephpのメソッド

		$this->assertEquals($data,$vars['posts']);
	}

}
