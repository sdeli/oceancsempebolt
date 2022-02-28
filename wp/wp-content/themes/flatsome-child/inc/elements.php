<?php

function get_attribute_filter_icons($categorySlug, $attrFilterTemplateValuesArr = null, $shouldNavigate = false) {
  if (!$attrFilterTemplateValuesArr) return '';

  $colorFilterHtml = "<li id=\"{$categorySlug}\" class=\"sidebar-filter--{$categorySlug} sidebar-filter cat-item cat-item-1458 color-filter\"><ul>";
  $attrFilterTemplateValuesArr = move_colors_to_front($attrFilterTemplateValuesArr);

  foreach($attrFilterTemplateValuesArr as $attrFilterTemplateValues) {
    if ($attrFilterTemplateValues['form'] === LOOK_COLOR) {
      $colorFilterHtml .= get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
    } else {
      $colorFilterHtml .= get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
    }
  };

  $colorFilterHtml .= '</ul></li>';
  return $colorFilterHtml;
}


function move_colors_to_front($attrFilterTemplateValuesArr) {
  $colors = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
    return $templateValues['form'] === LOOK_COLOR;
  });
  
  $tags = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
    return $templateValues['form'] === LOOK_TAG;
  });
  
  return array_merge($colors, $tags);
}

function get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
  $colorFilterId = $attrFilterTemplateValues['id'];
  $displayName = $attrFilterTemplateValues["displayName"];
  
  if ($shouldNavigate) {
    $href ="/{$categorySlug}/?filters=szin[{$colorFilterId}]";
    $isSidebarFilterLinkClass = SIDEBAR_FILTER_LINK_CLASS; 
  } else {
    $href = "javascript:activateColorFilter('$categorySlug', {$colorFilterId})";
    $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
    $isCheckedClass = str_contains($currentFilters, $colorFilterId) ? CHECKED_CLASS : "";
  }
  
  return ''
  ."<li class=\"sidebar-filter__circle {$isCheckedClass} {$isSidebarFilterLinkClass} sidebar__filter-{$colorFilterId}\" title='$displayName'>"
    ."<a href=\"{$href}\">{$displayName}</a>"
  ."</li>";
}

function get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
  $attributeFilterId = $attrFilterTemplateValues['id'];
  $displayName = $attrFilterTemplateValues["displayName"];
  $filterType = $attrFilterTemplateValues["type"];
  
  if ($shouldNavigate) {
    $href ="/{$categorySlug}/?filters={$filterType}[{$attributeFilterId}]";
    $isSidebarFilterLinkClass = SIDEBAR_FILTER_LINK_CLASS;
  } else {
    $href = "javascript:activateAttributeFilter('$categorySlug', {$attributeFilterId})";
    $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
    $isCheckedClass = str_contains($currentFilters, $attributeFilterId) ? CHECKED_CLASS : "";
  }
  
  return ''
  ."<li class=\"sidebar-filter__tag {$isCheckedClass} {$isSidebarFilterLinkClass} sidebar__filter-{$attributeFilterId}\">"
    ."<a href=\"{$href}\">{$displayName}</a>"
  ."</li>";
}

// function get_color_filter_icons($categorySlug, $colorTemplateValuesObjArr = null, $shouldNavigate = false) {
  //   // echo '<br>majom ========<br>';
  //   if (!$colorTemplateValuesObjArr) return '';
  //   $colorFilterHtml = "<li id=\"{$categorySlug}\" class=\"sidebar-filter cat-item cat-item-1458 color-filter\"><ul>";
//   foreach($colorTemplateValuesObjArr as $colorTemplateValues) {
//     // echo '<br>majom 2 ========<br>';
//     // echo 'main '.$categorySlug;
//     print_r($colorTemplateValues);
//     $colorFilterId = $colorTemplateValues->id;
//     if ($shouldNavigate) {
//       $href ="/{$categorySlug}/?filters=szin[{$colorFilterId}]";
//     } else {
//       $href = "javascript:activateColorFilter({$colorFilterId})";
//       $currentFilters = $_GET['filters'] ? $_GET['filters'] : "";
//       $isCheckedClass = str_contains($currentFilters, $colorFilterId) ? "sidebar-filter__circle--checked" : "";
//     }
    
//     $colorFilterHtml .= 
//     "<li class=\"sidebar-filter__circle sidebar-filter__circle--{$colorTemplateValues->slug} {$isCheckedClass} sidebar__filter-{$colorFilterId}\">"
//       ."<a href=\"{$href}\"></a>"
//       ."<label>{$colorTemplateValues->displayName}</label>"
//     ."</li>";
//   };

//   $colorFilterHtml .= '</ul></li>';
//   return $colorFilterHtml;
// }