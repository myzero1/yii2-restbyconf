<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

/**
 * ViewProcessing implements the API endpoint for creating a new model from the given data.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
interface ViewProcessing
{
    /**
     * @param mixed $id
     * @return array date will return to create action.
     */
    public function processing($id);

    /**
     * @param  array $savedData saved data
     * @return array
     */
    public function mappingDb2output($savedData);

    /**
     * @param  array $db2outData completed data form database
     * @return array
     */
    public function completeResult($db2outData);

    /**
     * @param mixed $id
     * @return Model the loaded model
     */
    public function findModel($id);
}
