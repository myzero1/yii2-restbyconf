<?php
/**
 * @link https://github.com/myzero1
 * @copyright Copyright (c) 2019- My zero one
 * @license https://github.com/myzero1/yii2-restbyconf/blob/master/LICENSE
 */

namespace myzero1\restbyconf\components\rest;

/**
 * CreateProcessing implements the API endpoint for creating a new model from the given data.
 *
 * For more details and usage information on CreateAction, see the [guide article](https://github.com/myzero1/yii2-restbyconf).
 *
 * @author Myzero1 <myzero1@sina.com>
 * @since 0.0
 */
interface ApiActionProcessing
{
    /**
     * @param  mixed $params
     * @return array the action data.
     */
    public function processing($params = null);

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
    public function handling($completedData);

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
     * @return array
     */
    public function egOutputData();
}
