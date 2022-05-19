<?php
namespace Inc;
use \Inc\Config;

class Utils {
  static function get_catalog_for_category($category) {
    $slug = $category->slug;
    $hasCatalogUrl = isset(Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug]);
    if ($hasCatalogUrl) {
      return Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES[$slug];
    }
    
    $categs_term_id = $category->term_id;
    $parent_category_ids = get_ancestors($categs_term_id, 'product_cat');
    foreach(Config::PDF_CATALOGS_BY_PRODUCT_CATEGORIES as $categ_slug => $catalog_data) { 
      $parent_categ_with_catalog_found = in_array($catalog_data['term_id'], $parent_category_ids);
      if ($parent_categ_with_catalog_found) return $catalog_data;
    }
  
    return false;
  }

  static function get_attributes_by_product_categories(): array {
    global $wpdb;
    $result = $wpdb->get_results ("SELECT * FROM view_attributes_by_product_categories;");
    $attributes_by_categories = [];
  
    foreach ($result as $row) {
      $currentCategorySlug = $row->category_slug;
      $displayName = $row->attribute_value_name;
      $lookOnFrontEnd = $row->attribute_slug === 'pa_szin' ? LOOK_COLOR : LOOK_TAG;
      $filterType = preg_replace('/pa_/i', '', $row->attribute_slug);
      $attributeTemplateValues = [
        'id' => $row->attribute_value_id, 
        'displayName' => $displayName, 
        'slug' => $row->attribute_value_slug, 
        'form' => $lookOnFrontEnd,
        'type' => $filterType
      ];
      
      if ($attributes_by_categories[$currentCategorySlug]) {
        array_push($attributes_by_categories[$currentCategorySlug],$attributeTemplateValues);
      } else {
        $attributes_by_categories[$currentCategorySlug] = [$attributeTemplateValues];
      }
    }
    
    return $attributes_by_categories;
  }

  function get_attribute_filter_icons($categorySlug, $attrFilterTemplateValuesArr = null, $shouldNavigate = false) {
    if (!$attrFilterTemplateValuesArr) return '';
  
    $colorFilterHtml = "<li id=\"{$categorySlug}\" class=\"sidebar-filter--{$categorySlug} sidebar-filter cat-item cat-item-1458 color-filter\"><ul>";
    $attrFilterTemplateValuesArr = self::move_colors_to_front($attrFilterTemplateValuesArr);
  
    foreach($attrFilterTemplateValuesArr as $attrFilterTemplateValues) {
      if ($attrFilterTemplateValues['form'] === LOOK_COLOR) {
        $colorFilterHtml .= self::get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
      } else {
        $colorFilterHtml .= self::get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate);
      }
    };
  
    $colorFilterHtml .= '</ul></li>';
    return $colorFilterHtml;
  }
  
  
  static function move_colors_to_front($attrFilterTemplateValuesArr) {
    $colors = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
      return $templateValues['form'] === LOOK_COLOR;
    });
    
    $tags = array_filter($attrFilterTemplateValuesArr, function($templateValues) {
      return $templateValues['form'] === LOOK_TAG;
    });
    
    return array_merge($colors, $tags);
  }
  
  private static function get_color_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
    $colorFilterId = $attrFilterTemplateValues['id'];
    $displayName = $attrFilterTemplateValues["displayName"];
    $isSidebarFilterLinkClass = "";
    $isCheckedClass = "";
    
    if ($shouldNavigate) {
      $url_base = Config::PRODUCT_CATEG_URL_BASE; 
      $href ="{$url_base}/{$categorySlug}/?filters=szin[{$colorFilterId}]";
      $isSidebarFilterLinkClass = Config::SIDEBAR_FILTER_LINK_CLASS; 
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
  
  private static function get_tag_icon($categorySlug, $attrFilterTemplateValues, $shouldNavigate) {
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
}