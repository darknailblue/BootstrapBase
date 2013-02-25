<?php

function ter_navbar_fallback() {
	$args = array(
		'sort_column' => 'menu_order, post_title',
		'menu_class'  => 'menu-primary-container',
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'show_home'   => false,
		'link_before' => '',
		'title_li'	  => '',
		'link_after'  => '',
		'walker' => new TerWalkerPage()
	);
	echo '<ul class="nav">';
		wp_list_pages( $args ); 
	echo '</ul>';
}

class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth ) {

		$indent = str_repeat( "\t", $depth );
		$output	   .= "\n$indent<ul class=\"dropdown-menu\">\n";

	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;


		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ($args->has_children) 	    ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

		if ( !$element )
			return;

		$id_field = $this->db_fields['id'];

		//display this element
		if ( is_array( $args[0] ) ) 
			$args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
		else if ( is_object( $args[0] ) ) 
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

			foreach( $children_elements[ $id ] as $child ){

				if ( !isset($newlevel) ) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge( array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
				unset( $children_elements[ $id ] );
		}

		if ( isset($newlevel) && $newlevel ){
			//end the child delimiter
			$cb_args = array_merge( array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge( array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);

	}

}
class TerWalkerNavMenu extends Walker_Nav_Menu{
	public function start_lvl(&$output,$depth){
		$indent = str_repeat("\t",$depth);
		if($depth < 1) $dropdown_menu = ' dropdown-menu';
		$output .= "\n$indent<ul class=\"sub-menu$dropdown_menu\">\n";
	}
	public function start_el(&$output,$item,$depth,$args){
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t",$depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		if($args->has_children && (integer)$depth < 1) $classes[] = 'dropdown';
		$class_names = join(' ',apply_filters('nav_menu_css_class',array_filter($classes),$item,$args));
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$id = apply_filters('nav_menu_item_id','menu-item-' . $item->ID,$item,$args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$attributes  = ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) .'"' : '';
		$attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) .'"' : '';
		$attributes .= ! empty($item->url) ? ' href="' . esc_attr($item->url) .'"' : '';
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= ($args->has_children && (integer)$depth < 1) ? '<b data-toggle="dropdown" class="caret"></b>' : '';
		$item_output .= $args->after;
		$output .= apply_filters('walker_nav_menu_start_el',$item_output,$item,$depth,$args);
	}
	function display_element($element,&$children_elements,$max_depth,$depth = 0,$args,&$output){
		if(!$element) return;
		$id_field = $this->db_fields['id'];
		if(is_array($args[0])) $args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
		elseif(is_object($args[0]))	$args[0]->has_children = !empty($children_elements[$element->$id_field]); //** Add has_children value, only mod in method **
		$cb_args = array_merge(array(&$output,$element,$depth),$args);
		call_user_func_array(array(&$this,'start_el'),$cb_args);
		$id = $element->$id_field;
		if(($max_depth == 0 || $max_depth > $depth+1) && isset($children_elements[$id])){
			foreach($children_elements[$id] as $child){
				if(!isset($newlevel)){
					$newlevel = true;
					$cb_args = array_merge(array(&$output,$depth),$args);
					call_user_func_array(array(&$this,'start_lvl'),$cb_args);
				}
				$this->display_element($child,$children_elements,$max_depth,$depth + 1,$args,$output);
			}
			unset($children_elements[$id]);
		}
		if(isset($newlevel) && $newlevel){
			$cb_args = array_merge(array(&$output,$depth),$args);
			call_user_func_array(array(&$this,'end_lvl'),$cb_args);
		}
   		$cb_args = array_merge(array(&$output,$element,$depth),$args);
    	call_user_func_array(array(&$this,'end_el'),$cb_args);
	}
}

/* TerWalkerPage
*  Fallback, use with wp_list_pages */
class TerWalkerPage extends Walker_Page{
	function start_lvl(&$output,$depth){
		$indent = str_repeat("\t",$depth);
		if($depth < 1) $dropdown_menu = ' dropdown-menu';
		$output .= "\n$indent<ul class=\"sub-menu$dropdown_menu\">\n";
	}
	function start_el(&$output,$page,$depth,$args,$current_page){
		if($depth) $indent = str_repeat("\t", $depth);
		else $indent = '';
		extract($args, EXTR_SKIP);
		$css_class = array('page_item', 'page-item-'.$page->ID);
		if(!empty($current_page)){
			$_current_page = get_page($current_page);
			_get_post_ancestors($_current_page);
			if(isset($_current_page->ancestors) && in_array($page->ID,(array)$_current_page->ancestors)) $css_class[] = 'current_page_ancestor';
			if($page->ID == $current_page) $css_class[] = 'current_page_item';
			elseif($_current_page && $page->ID == $_current_page->post_parent) $css_class[] = 'current_page_parent';
		}
		elseif($page->ID == get_option('page_for_posts')) $css_class[] = 'current_page_parent';
		if($args['has_children'] && (integer)$depth < 1) $css_class[] = 'dropdown';
		$css_class = implode(' ',apply_filters('page_css_class',$css_class,$page,$depth,$args,$current_page));
		$output .= $indent . '<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $link_before . apply_filters('the_title',$page->post_title,$page->ID ) . $link_after . '</a>';
		if(!empty($show_date)){
			if('modified' == $show_date) $time = $page->post_modified;
			else $time = $page->post_date;
			$output .= " " . mysql2date($date_format,$time);
		}
		if($args['has_children'] && (integer)$depth < 1) $output .= $indent . '<b data-toggle="dropdown" class="caret"></b>';
	}
}

class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
    function start_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth); // don't output children opening tag (`<ul>`)
    }

    function end_lvl(&$output, $depth){
      $indent = str_repeat("\t", $depth); // don't output children closing tag
    }

    function start_el(&$output, $item, $depth, $args){
      // add spacing to the title based on the depth
      $item->title = str_repeat("&nbsp;", $depth * 4).$item->title;

      parent::start_el(&$output, $item, $depth, $args);

      // no point redefining this method too, we just replace the li tag...
      $output = str_replace('<li', '<option', $output);
    }

    function end_el(&$output, $item, $depth){
      $output .= "</option>\n"; // replace closing </li> with the option tag
    }
}

class select_menu_walker extends Walker_Nav_Menu{

	 function start_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}


	function end_lvl(&$output, $depth) {
		$indent = str_repeat("\t", $depth);
		$output .= "";
	}

	 function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		//check if current page is selected page and add selected value to select element  
		  $selc = '';
		  $curr_class = 'current-menu-item';
		  $is_current = strpos($class_names, $curr_class);
		  if($is_current === false){
	 		  $selc = "";
		  }else{
	 		  $selc = "selected ";
		  }

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$sel_val =  ' value="'   . esc_attr( $item->url        ) .'"';

		//check if the menu is a submenu
		switch ($depth){
		  case 0:
			   $dp = "";
			   break;
		  case 1:
			   $dp = "-";
			   break;
		  case 2:
			   $dp = "--";
			   break;
		  case 3:
			   $dp = "---";
			   break;
		  case 4:
			   $dp = "----";
			   break;
		  default:
			   $dp = "";
		}


		$output .= $indent . '<option'. $sel_val . $id . $value . $class_names . $selc . '>'.$dp;

		$item_output = $args->before;
		//$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		//$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el(&$output, $item, $depth) {
		$output .= "</option>\n";
	}

}

?>