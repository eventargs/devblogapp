<?php
/**
 * ArticleFixture
 *
 */
class ArticleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'body' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'published' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	/*
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'body' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'published' => 1,
			'created' => '2015-10-13 05:49:13',
			'modified' => '2015-10-13 05:49:13'
		),
	);
	*/
	public $records = array(
		array(
			'id' => 1,
			'title' => 'First Article',
			'body' => 'First Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:39:23',
			'updated' => '2007-03-18 10:41:31'
		),
		array(
			'id' => 2,
			'title' => 'Second Article',
			'body' => 'Second Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:41:23',
			'updated' => '2007-03-18 10:43:31'
		),
		array(
			'id' => 3,
			'title' => 'Third Article',
			'body' => 'Third Article Body',
			'published' => '1',
			'created' => '2007-03-18 10:43:23',
			'updated' => '2007-03-18 10:45:31'
		)
	);

}
