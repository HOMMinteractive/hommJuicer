<?php
/**
 * hommjuicer plugin for Craft CMS 3.x
 *
 * Homm Juicer
 *
 * @link      homm.ch
 * @copyright Copyright (c) 2018 Domenik Hofer
 */

namespace homm\hommjuicer\models;

use homm\hommjuicer\Hommjuicer;

use Craft;
use craft\base\Model;

/**
 * Hommjuicer Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Domenik Hofer
 * @package   Hommjuicer
 * @since     0.0.1
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $juicerURL = 'api/feeds/campingjungfrau';
	public $juicerLength = '15';

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['juicerURL', 'juicerLength'], 'required']
        ];
    }
}
