<?php

namespace App\Extensions;

use App\Models\LanguageModel;
use Illuminate\Database\Schema\Blueprint;

class TranslateBlueprint
{
	private $blueprint;


	public function __construct(Blueprint $blueprint)
	{
		$this->blueprint = $blueprint;
	}

	public function __call($method, $params)
	{
		if(method_exists($this->blueprint, $method))
		{
            $langs = LanguageModel::get()->toArray();
            foreach($langs as $lang){
                $copy = $params;
                $copy[0] = $copy[0].'_'.$lang['slug'];
			    $return = call_user_func_array([$this->blueprint, $method], $copy);
                $return->nullable();
            }
        }
	}

	public function getBlueprint()
	{
		return $this->blueprint;
	}
}
