<?php
App::uses('PostsController', 'Controller');
App::uses('Fabricate', 'Fabricate.Lib');

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
//		$data = [
//			['Posts'=>['id'=>1,'title'=>'Title1', 'body'=>'Body1']],
//		];
		$post = Fabricate::build('Post');

		$this->controller->Paginator->expects($this->once())//8
			->method('paginate')->will($this->returnValue($post->data));//paginateメソッドが返す値を$dataに設定。

		//テスト実行 testActionはcakephpのメソッド　/user/blogにアクセスする。/hoge/fugaでもいい。te
		$vars = $this->testAction('/user/blog', ['method'=>'get', 'return' => 'vars']);//9


		//return => varsのところの補足
		/*
		 vars:set()メソッドを使ってビューに渡された値を返却する、という意味
		 view: レイアウトを覗いた部分のhtmlを返却
		 contents: レイアウトを含めたhtmlを返却
	     result: アクションがhtml描画でなく、returnで終了する場合の戻り値
		 */

		$this->assertEquals($post->data,$vars['posts']);
	}

	public function testAddアクションで保存が失敗したときメッセージがセットされること(){
		/**
		->expects($this->◯◯) 呼ばれうる回数
		->method(◯◯メソッド) 対象メソッド名
		->will($this->returnValue(期待値)) テスト中に◯◯メソッドが呼ばれた時の戻り値を定義。
		 */
		$this->controller->Post->expects($this->once())//10
			->method('save')->will($this->returnValue(false));//この後呼ばれるコントローラーのアクションでPost->saveが書いてある。
		//そのsaveの結果をfalseにする、という意味。

		$this->controller->Session->expects($this->once())//11
			->method('setFlash')->with($this->equalTo('記事の投稿に失敗しました。入力内容を確認して再度投稿してください。'));
		//この後呼ばれるコントローラーのアクションでSession->setFlashメソッドを使って、エラーメッセージを出力している、
		//そのエラーメッセージが、ここで指定したものと同じであることを withメソッドで指定している。

		$this->testAction('/blogs/new', ['method'=>'post', 'data'=>
			['title'=>'title1','body'=>'body1']]);

	}

	public function testAddアクションで保存が成功した時はメッセージがセットされ一覧表示にリダイレクトされること(){
		$this->controller->Post->expects($this->once())//12
			->method('save')->will($this->returnValue(true));//保存成功モック

		$this->controller->Session->expects($this->once())
			->method('setFlash')->with($this->equalTo('新しい記事を受け付けました'));//setFlashの文言指定モック

		$this->controller->expects($this->once())
			->method('redirect')->with($this->equalTo(['action'=>'index']));//リダイレクトモック indexにリダイレクト

		$this->testAction('/blogs/new', ['method'=>'post','data'=>['title'=>'title1','body'=>'Body1']]);//post/addにアクセス

	}

}
