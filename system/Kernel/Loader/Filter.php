<?php namespace Kernel\Loader;

use Debug;

class Filter implements LoaderInterface {

    /**
     * This method is the trigger method that is called by 
     * the decorator class
     *
     * @return null
     */
    public function trigger()
    {
        list($request, $response) = func_get_args();
        $filter = $request->getFilter();
        if (class_exists($filter))
        {
            Debug::add("debug::filter", "Response filtresi çağırılıyor.");
            $filter = new $filter();
            if (get_parent_class($filter) === 'Kernel\Filter')
            {
                $response->data($filter->run($response));
            }
        }
    }
    
}