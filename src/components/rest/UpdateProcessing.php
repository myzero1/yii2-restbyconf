<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

/**
 * UpdateProcessing implements the API endpoint for creating a new model from the given data.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
interface UpdateProcessing
{
    /**
     * @param mixed $id
     * @return array date will return to create action.
     */
    public function processing($id);

    /**
     * @param  array $input from the request body
     * @return array
     */
    public function inputValidate($input);

    /**
     * @param  array $validatedInput validated data
     * @return array
     */
    public function mappingInput2db($validatedInput);

    /**
     * @param  array $in2dbData mapped data form input
     * @return array
     */
    public function completeData($in2dbData);

    /**
     * @param  array $completedData completed data
     * @return array
     */
    public function save($id, $completedData);

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
