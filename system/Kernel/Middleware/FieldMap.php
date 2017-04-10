<?php namespace Kernel\Middleware;

use Exception;
use App\Libraries\WebServices;

class FieldMap {

    /**
     * Field map 
     *
     * @var object
     */
    private $structure;

    /**
     * Required fields 
     * 
     * @var object
     */
    private $reqFields;

    /**
     *
     *
     */
    private $netFields;

    /**
     * Class constructer 
     *
     * @param  string       $file
     * @return null
     */
    public function __construct($file)
    {
        $this->structure = $this->getMap($file);
        $this->reqFields = $this->getRequiredFields();
        $this->netFields = array();
        $this->compare();
    }

    /**
     * This method adds the standard rules to field. By the way,
     * if the field is the required field, add the required rules 
     * for validating. 
     *
     * @param  string       $name 
     * @param  string       $standardRules
     * @return string
     */
    public function addRule($name, $standardRules)
    {   
        if ($this->structure === false) 
        {
            return $standardRules;
        } 
        
        if (in_array($name, $this->netFields)) 
        {
            // Kural eklenir
            $standardRules .= '|required';
            // Bu alan netFields dizisinden çıkartılır
            $this->netFields = array_diff($this->netFields, [$name]);
        }
        return $standardRules;
    }

    /**
     * This method gets the netFields array 
     * 
     * @return array
     */
    public function getNetFields()
    {
        return $this->netFields;
    }

    /**
     *
     * @return null
     */
    private function compare()
    {
        if (is_array($this->reqFields)) 
        {
            foreach ($this->reqFields as $keyReq => $required) 
            {
                foreach ($this->structure as $sub => $field) 
                {
                    if ($field->editorname == $required->editorname &&
                        $field->index == $required->itemindex) {
                        array_push($this->netFields, $field->name);
                    }
                }
            }
        }
    }

    /**
     * This method gets required fields 
     *
     * @return object
     */
    private function getRequiredFields()
    {
        if ($this->structure !== false)
        {
            $service = new WebServices();
            return json_decode(json_encode($service->getRequiredFields()));
        }
    }

    /**
     * This method gets the map 
     *
     * @param  string       $file 
     * @return object
     */
    private function getMap($file)
    {
        $path = APIPATH.'Maps/Fields/'.$file.'.json';
        if (!file_exists($path))
        {
            return false;
        }
        return json_decode(file_get_contents($path));
    }

}