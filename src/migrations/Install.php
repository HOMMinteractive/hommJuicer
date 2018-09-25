<?php
	/**
		* TestCase plugin for Craft CMS 3.x
		*
		* Test case
		*
		* @link      https://nystudio107.com
		* @copyright Copyright (c) 2017 nystudio107
	*/
	
	namespace homm\hommjuicer\migrations;
	
	use homm\hommjuicer\Hommjuicer;
	
	use Craft;
	use craft\config\DbConfig;
	use craft\db\Migration;
	use craft\db\Query;
	use craft\db\Command;
	
	/**
		* @author    nystudio107
		* @package   TestCase
		* @since     1.0.0
	*/
	class Install extends Migration
	{
		// Public Properties
		// =========================================================================
		
		/**
			* @var string The database driver to use
		*/
		public $driver;
		
		// Public Methods
		// =========================================================================
		
		/**
			* @inheritdoc
		*/
		public function safeUp()
		{
			$this->driver = Craft::$app->getConfig()->getDb()->driver;
			if ($this->createTables()) {
				$this->insertDefaultData();
			}
			
			return true;
		}
		
		/**
			* @inheritdoc
		*/
		public function safeDown()
		{
			$this->driver = Craft::$app->getConfig()->getDb()->driver;
			$this->removeTables();
			return true;
		}
		
		// Protected Methods
		// =========================================================================
		
		/**
			* @return bool
		*/
		protected function createTables()
		{
			$tablesCreated = false;
			
			$tableSchema = Craft::$app->db->schema->getTableSchema('{{%hommjuicer_juicer}}');
			if ($tableSchema === null) {
				$tablesCreated = true;
				$this->createTable(
                '{{%hommjuicer_juicer}}',
                [
				'id' => $this->primaryKey(),
				'date' => $this->dateTime()->notNull(),
				'external_id' => $this->integer()->notNull()->unique(),
				'external_date' => $this->dateTime()->notNull(),
				'image' => $this->string(255)->notNull(),
				'video' => $this->string(255)->notNull(),
				'videoState' => $this->integer(),
				'full_url' => $this->string(255)->notNull(),
				'like_count'  => $this->integer()->notNull(),
				'message' => $this->longText()->notNull(),
				'source' => $this->string(255)->notNull(),
				'source_options' => $this->string(255)->notNull(),
				'hidden' => $this->integer()->notNull(),
				'external_url' => $this->string(255)->notNull(),
				'color' => $this->string(255)->notNull(),
				'showimg' => $this->string(255)->notNull(),
				'dateCreated' => $this->dateTime()->notNull(),
				'dateUpdated' => $this->dateTime()->notNull(),
				'uid' => $this->uid()
                ]
				);
			}
			
			return $tablesCreated;
		}
		
		
		
		
		
		/**
			* @return void
		*/
		protected function insertDefaultData()
		{
			
			/*$rowData = [
			'date' => '2018-09-15 00:00:04',
			'external_id' => '223788218',
			'external_date' => '2018-04-25',
			'image' => 'https://scontent.cdninstagram.com/vp/32ef8370142150e074db2bf51faaf49f/5C232F6A/t51.2885-15/sh0.08/e35/s640x640/31184253_1979926568927435_1869595222384574464_n.jpg',
			'video' => '',
			'videoState' => '0',
			'full_url' => 'https://www.instagram.com/p/BiAgtpenv8o/',
			'like_count' => '15',
			'message' => '<p>Breakthrough! NESSy ZeroE - Let it snow with zero electrical energy #NESSyZeroE #BachlerTopTrack #SwissMade #SwissInnovation #Breakthrough</p>',
			'source' => 'Instagram',
			'source_options' => '',
			'hidden' => '0',
			'external_url' => '',
			'color' => 'color3',
			'showimg' => '0'
			];
			
			$result = \Craft::$app->db->createCommand()
			->insert('{{%hommjuicer_juicer}}', $rowData)
			->execute();*/
		}
		
		/**
			* @return void
		*/
		protected function removeTables()
		{
			$this->dropTableIfExists('{{%hommjuicer_juicer}}');
		}
	}
