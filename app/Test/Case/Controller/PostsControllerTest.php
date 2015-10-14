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

	public function setUp() {
		parent::setUp();
		$this->controller = $this->generate('Posts', [
			'components' => ['Paginator', 'Session', 'Auth'],
			'models' => ['Post' => ['save']],
			'methods' => ['redirect']
		]);
		$this->controller->autoRender = false;
	}

	public function testIndexアクションではページングの結果がpostsにセットされること(){
		$data = [
			['Posts'=>['id'=>1,'title'=>'Title1', 'body'=>'Body1']],
		];

		$this->controller->Paginator->expects($this->once())
			->method('paginate')->will($this->returnValue($data));//paginateメソッドが返す値を$dataに設定。

		//テスト実行 testActionはcakephpのメソッド　/user/blogにアクセスする。
		$vars = $this->testAction('/user/blog', ['method'=>'get', 'return' => 'vars']);
		//return => varsのところの補足
		/*
		 vars:set()メソッドを使ってビューに渡された値を返却する、という意味
		 view: レイアウトを覗いた部分のhtmlを返却
		 contents: レイアウトを含めたhtmlを返却
	     result: アクションがhtml描画でなく、returnで終了する場合の戻り値
		 */

		$this->assertEquals($data,$vars['posts']);
	}

}
