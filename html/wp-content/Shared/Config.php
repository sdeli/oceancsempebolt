<?php
namespace Shared;

class Config 
{
  const PLUGIN_NAME = 'oceancsempebolt';
  
  const ENVIRONMENT_TYPE_LOCAL = 'local';
  const ENVIRONMENT_TYPE_DEV = 'development';
  const ENVIRONMENT_TYPE_PROD = 'production';
  const CONTACT_PAGE_PATH =  '/kapcsolat';
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

  const THREE_D_TILE_CATEG_ID = 2558;
  const BORDUR_CATEG_ID = 2405;
  const DECORS_TILE_CATEG_ID = 2559;
  const WALL_TILE_CATEG_ID = 2314;
  const HEXAGON_TILE_CATEG_ID = 6768;
  const MOSAIC_TILE_CATEG_ID = 2408;
  const FLOOR_TILE_CATEG_ID = 104;

  const TILE_BRANDS_PRODUCT_CATEG_ID = 2787;
  const BRANDS_PRODUCT_CATEG_ID = 2241;
  const DESIGN_BRANDS_PRODUCT_CATEG_ID = 2254;

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

  const EXHIBITED_IN_SHOP_TAG_SLUG = 'boltban-megtekintheto';

  const COLOR_ROOM_TAGS_FILTER_ID = 9152;
  const COLOR_STYLE_TAGS_HANDLE_FILTER_ID = 11714;
  const COLOR_STYLE_TAGS_FILTER_ID = 11960;
  const COLOR_ORIENTATION_TAGS_FILTER_ID = 12014;
  const COLOR_FORM_MATERIAL_TAGS_FILTER_ID = 14568;
  const FORM_LOCATION_TAGS_FILTER_ID = 12347;

  const FILTER_POP_UP_VERSIONS_IDS = [
    9152 => 24844,
    10595 => 24843,
    11714 => 24841,
    11960 => 24840,
    12014 => 24839,
    12347 => 24838,
    14568 => 24836,
  ];

  const CHANGING_PRICES_MESSAGE = '<p style="margin-bottom: 0px;">A honlapon szereplő <strong>árak az ukrajnai háborús helyzet miatt</strong> kialakult ellátási zavarokra tekintettel <strong>tájékoztató jellegűek</strong>, nem minősülnek konkrét árajánlattételnek. Amennyiben valamely termékünk megvásárlása iránt érdeklődnek úgy kérjük, hogy a megrendelést megelőzően az árak egyeztetése érdekében társaságunkkal vegyék fel a kapcsolatot, mert csak így tudunk az árakra kötelezettséget vállalni. Megértésüket köszönjük!</p>';

  const SIDEBAR_FILTER_LINK_CLASS = 'sidebar-filter__link';

  const PALLET_SHIPPING_CLASS_ID = 2410;
  const PALLET_SHIPPING_CLASS_NAME = "Raklapos házhozszállítás";
  const PALLET_SHIPPING_WOO_ID = "flat_rate:7";
  const BOX_SHIPPING_CLASS_NAME = "Dobozos házhozszállítás";
  const BOX_SHIPPING_WOO_ID = "flat_rate:2";
  const PERSONAL_PICKUP_WOO_ID = "free_shipping:8";

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
  const SHOP_PAGE_SLIDER_CATEGORY = 'legszebb-termekek';

  const UKRAINE_WAR_MESSAGE = '<p>A <strong>fehér agyag</strong>, mely a csempe gyártás alapanyaga, Európában szinte csak a háborús <strong>Ukrajnában</strong> fellelhető, valamint a <strong>csempét gázzal égetik ki</strong>, majd kamionon, <strong>benzinnel/dízellel szállítják</strong>, melyek a jelenlegi gazdasági körülmények miatt <strong>napról napra drágulnak</strong>. Ezért az <strong>árak tájékoztató jellegűek</strong>. <i>A pontos árért kérjük hívjanak, megértésüket köszönjük.</i></p>';
  const TILE_EXHIBITED_IN_SHOP_MESSAGE = 'Boltban megtekinthető';
  const EXAMPLE_CAN_BE_REQUEST_MESSAGE = 'Mintalap kérhető';

  const TILE_SQ_FOOT_IN_BOX_META_KEY = '_mcmp_ppu_cust_num_of_units_override';

  const ONE_SQ_FOOT_TILE_WEIGTH_KG = 22;

  const TILE_SHIPPING_COSTS = [
    'trace_palett' => ['max_weigth' => 150, 'price' => 14679],
    'until_medium_palett' => ['max_weigth' => 500, 'price' => 16889],
    'over_medium_palett' => ['max_weigth' => 750, 'price' => 20810],
    'full_palett' => ['max_weigth' => 999, 'price' => 23211],
  ];

  const PALETT_SQUARE_FOOT_CAPACITY = 40;
}