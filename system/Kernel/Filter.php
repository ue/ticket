<?php namespace Kernel;

use Kernel\Exceptions\ArgumentException;

/**
 * Filter
 *
 * Oluşturulan tüm Response verileri, bir filtreden 
 * geçirilmektedir. Bu şekilde istenmeyen verilerin 
 * karşıya gönderilmesi engellenir. 
 * 
 * @author    Özgür Adem Işıklı           <ozgur@polisoft.com.tr>
 * @copyright Polisoft Yazılım               
 * @license   http://www.polisoft.com.tr
 * @since     Release 1.0.0
 * @see       App/Filters/Auth/Login
 */
abstract class Filter extends Connector {

    /**
     * This method must be for validation. 
     *
     * @return array
     */
    abstract public function getHideArray();

    /**
     * This method allows the array that was defined 
     *
     * @return array
     */
    public function getAllowedArray()
    {
        return false;
    }

    /**
     * This method gets all phone fields 
     *
     * @return array
     */
    public function getPhoneFields()
    {
        return [];
    }

    /**
     * This method gets the locked fields 
     *
     * @return array
     */
    public function getLockedFields()
    {
        return [];
    }

    /**
     * This method runs the validation parameters 
     *
     * @param  object       $response
     * @return null
     */
    public function run($response)
    {
        $allowed = $this->getAllowedArray();
        $datas = $response->getData();
        $response->setLockedFields($this->getLockedFields());

        foreach ($this->getPhoneFields() as $key => $field) 
        {
            if (isset($datas->{$field}) && 
                substr($datas->{$field}, 1) !== false &&
                strlen($datas->{$field}) === 11 &&
                substr($datas->{$field}, 0, 1) == 0)
            {
                $datas->{$field} = substr($datas->{$field}, 1);
            }
        }

        if ($allowed !== false) {
            if (is_array($datas))
            {
                return $this->allowByArray($datas, $allowed);
            }
            return $this->allowByObject($datas, $allowed);
        }

        if (is_array($datas))
        {
            return $this->filterByArray($datas);
        }
        return $this->filterByObject($datas);
    }

    /**
     * This method filters all array datas by hidden array  
     *
     * @param  array        $datas 
     * @param  array        $allowed
     * @return array
     */
    private function allowByArray($datas, $allowed)
    {
        foreach ($datas as $index => $row) 
        {
            $datas[$index] = $this->allowByObject($row, $allowed);
        }
        return $datas;
    }

    /**
     * This method filters all object by hidden array 
     *
     * @param  object       $data 
     * @param  array        $allowed
     * @return object
     */
    private function allowByObject($data, $allowed)
    {
        foreach ($data as $key => $item) 
        {
            if (!in_array($key, $allowed))
            {
                unset($data->{$key});
            }
        }
        return $data;
    }    

    /**
     * This method filters all array datas by hidden array  
     *
     * @param  array        $datas 
     * @return array
     */
    private function filterByArray($datas)
    {
        foreach ($datas as $index => $row) 
        {
            $datas[$index] = $this->filterByObject($row);
        }
        return $datas;
    }

    /**
     * This method filters all object by hidden array 
     *
     * @param  object       $data 
     * @return object
     */
    private function filterByObject($data)
    {
        foreach ($this->getHideArray() as $sub => $hidden) 
        {
            if (isset($data->{$hidden}))
            {
                unset($data->{$hidden});
            }
        }
        return $data;
    }

}