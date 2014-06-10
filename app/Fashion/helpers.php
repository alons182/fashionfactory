<?php

function errors_for($attribute, $errors)
{
	return $errors->first($attribute,'<span class="error label label-warning">:message</span>');
}

function get_depth($depth)
{
   
   return str_repeat('<span class="depth">—</span>', $depth);

  
}
function dir_photos_path($dir)
{
    return public_path() . '/images_store/'. $dir .'/';
}

function photos_path($dir)
{
    return '/images_store/'. $dir .'/';
}

function set_active($path, $active = 'active' )
{
    return Request::is($path) ? $active : '';
}

function money($amount, $symbol = '$')
{
  return (!$symbol) ? number_format($amount, 0, ".", ",") : $symbol . number_format($amount, 0, ".", ",");
}
function number($amount)
{
  return preg_replace("/([^0-9\\.])/i", "", $amount);
}
function porcent($amount, $symbol = '%')
{
  return $symbol . number_format($amount, 0, ".", ",");
}

function existDataArray($data, $index)
{
	if(isset($data[$index]))
	{
		$array = array_where($data[$index], function($key, $value)
		{
			if(trim($value) != "")
		    	return $value;
		});
		
	}else
	{
		$array = [];
	}
	
	return $array;
}

