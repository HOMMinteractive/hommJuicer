<?php
	/**
		* hommjuicer plugin for Craft CMS 3.x
		*
		* Homm Juicer
		*
		* @link      homm.ch
		* @copyright Copyright (c) 2018 Domenik Hofer
	*/
	
	namespace homm\hommjuicer\services;
	
	use homm\hommjuicer\Hommjuicer;
	
	use Craft;
	use craft\base\Component;
	use craft\db\Query;
	use craft\web\View;
	
	/**
		* HommjuicerService Service
		*
		* All of your plugin’s business logic should go in services, including saving data,
		* retrieving data, etc. They provide APIs that your controllers, template variables,
		* and other plugins can interact with.
		*
		* https://craftcms.com/docs/plugins/services
		*
		* @author    Domenik Hofer
		* @package   Hommjuicer
		* @since     0.0.1
	*/
	class HommjuicerService extends Component
	{
		// Public Methods
		// =========================================================================
		
		/**
			* This function can literally be anything you want, and you can have as many service
			* functions as you want
			*
			* From any other plugin file, call it like this:
			*
			*     Hommjuicer::$plugin->hommjuicerService->exampleService()
			*
			* @return mixed
		*/
		
		public function renderTemplate($results)
		{
			
			$view = Craft::$app->getView();
			$oldTemplateMode = $view->getTemplateMode();			
			$view->setTemplateMode($view::TEMPLATE_MODE_CP);
			$html = $view->renderTemplate('hommjuicer/juicer', ['entries' => $results, 'admin' => true]);			
			$view->setTemplateMode($oldTemplateMode);
			
			return $html;
			
		}
		
		public function getData()
		{
			$juicerLength = \homm\hommjuicer\Hommjuicer::getInstance()->getSettings()->juicerLength;
			
			
			$results = (new Query()) 
			->select(['*']) 
			->from(['{{%hommjuicer_juicer}}'])
			->limit($juicerLength)
			->all();
			
			return $results;
			
		}
		
		public function adminChange($external_id, $action){
			
			
			
			
			if(is_numeric($external_id)){			
				if($action == 'kill'){
					$updateParam = ['hidden' => '1'];
				}		
				if($action == 'show'){
					$updateParam = ['hidden' => '0'];	
				}
				if($action == 'color1'){
					$updateParam = ['color' => 'color1'];	
				}
				if($action == 'color2'){
					$updateParam = ['color' => 'color2'];	
				}
				if($action == 'color3'){
					$updateParam = ['color' => 'color3'];	
				}
				if($action == 'killimg'){
					$updateParam = ['showimg' => '1'];	
				}
				if($action == 'showimg'){
					$updateParam = ['showimg' => '0'];	
				}
				
				
				
				$result = \Craft::$app->db->createCommand()
				->update('{{%hommjuicer_juicer}}',$updateParam, 'external_id = :external_id', [':external_id' => $external_id])
				->execute();
				
				
				header('Location: '.$_SERVER['HTTP_REFERER']);
				return $result;
				}else{
				header('Location: '.$_SERVER['HTTP_REFERER']);
			}	
			
			
			
			
			return $external.' - '.$action;
		}	
		
		
		public function getEntries()
		{
			
			$data = $this->getData();
			return $this->renderTemplate($data);
			
			
		}
		
		public function updateJuicer()
		{		
			$juicerURL = \homm\hommjuicer\Hommjuicer::getInstance()->getSettings()->juicerURL;
			
			$ch = curl_init(); 	
			curl_setopt($ch, CURLOPT_URL, "https://www.juicer.io/".$juicerURL); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$output = curl_exec($ch); 
			$jfo = json_decode($output);
			curl_close($ch);      
			$a = array($jfo->posts->items);
			foreach($a as $val){
				$num = count($val);
			}
			
			
			for ($i = 0; $i <= ($num-1); $i++){	
				$video = '';
				$external_id 		= $jfo->posts->items[$i]->id;
				$external_date		= $jfo->posts->items[$i]->external_created_at;
				$external_date_sql	= date('Y-m-d',strtotime($external_date));
				$image 				= ($jfo->posts->items[$i]->image ?: '' );
				$video 				= (isset($jfo->posts->items[$i]->video) ? $jfo->posts->items[$i]->video : '') ;		
				$external_url 		= ($jfo->posts->items[$i]->external ?: '');		
				$full_url 			= $jfo->posts->items[$i]->full_url;
				$like_count 		= $jfo->posts->items[$i]->like_count;
				$message 			= $jfo->posts->items[$i]->message;
				$source				= $jfo->posts->items[$i]->source->source;
				$source_options		= $jfo->posts->items[$i]->source->options;
				$showImg			= ($image == '' ? 1 : 0);
				
				$vid = curl_init($video);
				curl_setopt($vid, CURLOPT_NOBODY, true);
				curl_exec($vid);
				$checkV = curl_getinfo($vid, CURLINFO_HTTP_CODE);
				curl_close($vid);
				if($checkV != 200){
					$video = '';
				}
				$videoState = $checkV;
				
				
				$result = \Craft::$app->db->createCommand()
				->upsert('{{%hommjuicer_juicer}}',
				[
				'external_id' => $external_id,
				'external_date' => $external_date_sql,
				'image' => $image,
				'full_url' => $full_url,
				'like_count' => $like_count,
				'message' => $message,
				'source' => $source,
				'source_options' => $source_options,
				'video' => $video,
				'videoState' => $videoState,
				'external_url' => $external_url,
				'showimg' => $showImg
				])
				->execute();
				
			}
			return 'Update abgeschlossen!';
			
		}
		
	}
