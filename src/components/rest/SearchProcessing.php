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
interface SearchProcessing
{
    /**
     * @return array date will return to create action.
     */
    public function processing();

    /**
     * @param  array $input from the request body
     * @return array
     */
    public function inputValidate($input);

    /**
     * Get the date form data
     *
     * @param  array $validatedInput
     * @return array
     */
    public function getResult($validatedInput);

    /**
     * @param  array $resultData from the request params
     * @return array
     */
    public function mappingDb2output($resultData);

    /**
     * @param  array $db2outData mapped data form input
     * @return array
     */
    public function completeResult($db2outData);

    /**
     * @param  array $validatedInput
     * @return array
     */
    public function getSort($validatedInput);

    /**
     * @param  array $validatedInput
     * @return array
     */
    public function getPagination($validatedInput);

    /**
     * @param  array $validatedInput
     * @return string
     */
    public function getQuery($validatedInput);

}
