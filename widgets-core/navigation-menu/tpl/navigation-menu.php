<?php 
if ($tm_menu_selected) {

  $icon = "";
  if(isset($list_icon['value']) && !empty($list_icon['value'])) {
    $icon = '<i class="tm-nav-arrow-icon '.$list_icon['value'].'"></i>';
  }
  $args = [
    'menu'        => $tm_menu_selected,
    'menu_class'  => implode(' ', array_filter($classes)),
    'fallback_cb' => '__return_empty_string',
    'container'   => false,
    'link_before'   => $icon,
    'echo'        => false,
  ];
  echo '<div class="tm-sc-simple-nav-menu">' . wp_nav_menu($args) . '</div>';
}
?>
