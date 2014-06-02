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
/*
class ItemsTreeViewHelper {

    private $items;

    public function __construct($items) {
      $this->items = $items;

    }

    public function htmlList() {
      return $this->htmlFromArray($this->itemArray());
    }

    private function itemArray() {
      $result = array();
      foreach($this->items as $item) {
        if ($item->parent_id == 0) {
          $result[$item->name] = $this->itemWithChildren($item);
        }
      }
      return $result;
    }

    private function childrenOf($item) {
      $result = array();
      foreach($this->items as $i) {
        if ($i->parent_id == $item->id) {
          $result[] = $i;
        }
      }
      return $result;
    }

    private function itemWithChildren($item) {
      $result = array();
      $children = $this->childrenOf($item);
      foreach ($children as $child) {
        $result[$child->name] = $this->itemWithChildren($child);
      }
      return $result;
    }

    private function htmlFromArray($array, $class = "parent") {
      //dd($array);
      // return $array;
      $html = '';
      foreach($array as $k=>$v) {
        $html .= "<ul>";
        $html .= "<li class='". $class."'>".$k."</li>";
        if(count($v) > 0) {
        	$class ="child";
            $html .= $this->htmlFromArray($v, $class);
        }
        $html .= "</ul>";
      }
      return $html;
    }

   
  }
*/