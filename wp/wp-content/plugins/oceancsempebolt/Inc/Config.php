<?php
namespace Inc;

class Config 
{
  const ENVIRONMENT_TYPE_LOCAL = 'local';
  const ENVIRONMENT_TYPE_DEV = 'development';
  const ENVIRONMENT_TYPE_PROD = 'production';
  // const WP_ENVIRONMENT_TYPE = ENVIRONMENT_TYPE_PROD;
  // const WP_ENVIRONMENT_TYPE = self::ENVIRONMENT_TYPE_DEV;
  const WP_ENVIRONMENT_TYPE = self::ENVIRONMENT_TYPE_LOCAL;

  const PDF_CATALOGS_BY_PRODUCT_CATEGORIES = [
    'rock-ceramic' => [ 'term_id' => 4116, 'url' => "/rock-ceramic-katalogus/", 'name' => 'rock ceramic'],
    'marazzi' => [ 'term_id' => 2399, 'url' => "/marazzi-kollekcio/", 'name' => 'Marazzi'],
    'porcelanosa' => [ 'term_id' => 2227, 'url' => "/porcelanosa-kollekcio/", 'name' => 'Porcelanosa'],
    'opoczno' => [ 'term_id' => 230, 'url' => "/opoczno-katalogus/", 'name' => 'Opoczno'],
    'paradyz' => [ 'term_id' => 5605, 'url' => "/paradyz-kollekcio/", 'name' => 'Paradyz'],
    'ribesalbes' => [ 'term_id' => 2228, 'url' => "/ribesalbes-katalogus/", 'name' => 'Ribesalbes'],
    'cerrad' => [ 'term_id' => 2223, 'url' => "/cerrad-katalogus/", 'name' => 'Cerrad'],
    'mainzu' => [ 'term_id' => 3735, 'url' => "/mainzu-katalogus/", 'name' => 'Mainzu'],
    'del-conca' => [ 'term_id' => 320, 'url' => "/del-conca-katalogus/", 'name' => 'Del Conca'],
    'argenta' => [ 'term_id' => 2128, 'url' => "/argenta-katalogus/", 'name' => 'Argenta'],
    'tubadzin' => [ 'term_id' => 2230, 'url' => "/tubadzin-katalogus/", 'name' => 'Tubadzin'],
  ];

  const GET_LAST_BE_ROCKET_ROOM_FILTER_ID_REGEX = '/szoba.*[\[-](\d+)*\]/';
  const BE_ROCKET_FILTERS_QUERY_VAR_NAME = 'filters';

  const LIVING_ROOM_AND_MORE_ID = 3651;
  const KITCHEN_ID = 3650;
  const BATHROOM_ID = 3649;

  const BATHROOM_TAP_SLUG = 'furdoszobai-csaptelep';
  const TILES_SLUG = 'burkolatok';
  const BATHROOM_AUXILIARY_SLUG = 'furdoszoba-kiegeszitok';
  const TUBS_SLUG = 'kadak';
  const TAPS_SLUG = 'csaptelepek';
  const SINK_SLUG = 'mosogatok';
  const SANITARY_SLUG = 'szaniterek';
  const SHOWER_DOOR_SLUG = 'zuhanyajto';
  const SHOWER_WALL_SLUG = 'zuhanyfal';
  const SHOWER_CABIN_SLUG = 'zuhanykabinok';
  const SHOWER_TRAY_SLUG = 'zuhanytalcak';

  const COLOR_ROOM_TAGS_FILTER_ID = 9152;
  const COLOR_STYLE_TAGS_HANDLE_FILTER_ID = 11714;
  const COLOR_STYLE_TAGS_FILTER_ID = 11960;
  const COLOR_ORIENTATION_TAGS_FILTER_ID = 12014;
  const COLOR_FORM_MATERIAL_TAGS_FILTER_ID = 14568;
  const FORM_LOCATION_TAGS_FILTER_ID = 12347;

  const CHANGING_PRICES_MESSAGE = '<p style="margin-bottom: 0px;">A honlapon szereplő <strong>árak az ukrajnai háborús helyzet miatt</strong> kialakult ellátási zavarokra tekintettel <strong>tájékoztató jellegűek</strong>, nem minősülnek konkrét árajánlattételnek. Amennyiben valamely termékünk megvásárlása iránt érdeklődnek úgy kérjük, hogy a megrendelést megelőzően az árak egyeztetése érdekében társaságunkkal vegyék fel a kapcsolatot, mert csak így tudunk az árakra kötelezettséget vállalni. Megértésüket köszönjük!</p>';

  const SIDEBAR_FILTER_LINK_CLASS = 'sidebar-filter__link';

  const PALLET_SHIPPING_CLASS_ID = 2410;
  const PALLET_SHIPPING_CLASS_NAME = "Raklapos házhozszállítás";
  const BOX_SHIPPING_CLASS_NAME = "Dobozos házhozszállítás";

  const TEL_NUMBERS = [
    ["06 70 942 5095", "06-70-942-5095", "Pinti István"],
    ["06 30 397 4150", "06-30-397-4150", "Szabó István"],
    ["06 70 601 4600", "06-70-601-4600", "Illés László"]
  ];

  const OCEAN_PHONE_CALL_LINK_CLASS = 'ocean-phone-call';

  const BANK_TRANSFER_LABEL = 'bacs';
  const ON_HOLD_ORDER_STATUS = 'on-hold';

  const LOOK_COLOR = 'color_look';
  const LOOK_TAG = 'tag_look';
  const CHECKED_CLASS = '--checked';

  const COMPANY_BANK_ACCOUNT = '11714006-20397245';

  const BURKOLATOK_CATEG_SLUG = 'burkolatok';
}