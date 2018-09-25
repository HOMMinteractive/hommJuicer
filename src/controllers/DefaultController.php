<?php
	/**
 * hommjuicer plugin for Craft CMS 3.x
 *
 * Homm Juicer
 *
 * @link      homm.ch
 * @copyright Copyright (c) 2018 Domenik Hofer
 */

namespace homm\hommjuicer\controllers;

use homm\hommjuicer\Hommjuicer;

use Craft;
use craft\web\Controller;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    Domenik Hofer
 * @package   Hommjuicer
 * @since     0.0.1
 */
class DefaultController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index', 'do-something', 'update-juicer'];

    // Public Methods
    // =========================================================================

    /**
     * Handle a request going to our plugin's index action URL,
     * e.g.: actions/hommjuicer/default
     *
     * @return mixed
     */
    public function actionIndex()
    { 
	
		$external = $_GET['external_id'];
		$action = $_GET['action'];
		
		$entries = \homm\hommjuicer\Hommjuicer::getInstance()->services->adminChange($external, $action);

        return $entries;
    }
	
	 public function actionUpdateJuicer()
    {
        $result = \homm\hommjuicer\Hommjuicer::getInstance()->services->updateJuicer();

        return $result;
    }

    /**
     * Handle a request going to our plugin's actionDoSomething URL,
     * e.g.: actions/hommjuicer/default/do-something
     *
     * @return mixed
     */
	
}
