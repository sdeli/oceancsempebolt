<?php

const ENVIRONMENT_TYPE_LOCAL = 'local';
const COLOR_ROOM_TAGS_FILTER_ID = 9152;
const COLOR_STYLE_TAGS_HANDLE_FILTER_ID = 11714;
const COLOR_STYLE_TAGS_FILTER_ID = 11960;
const COLOR_ORIENTATION_TAGS_FILTER_ID = 12014;
const COLOR_FORM_MATERIAL_TAGS_FILTER_ID = 14568;
const FORM_LOCATION_TAGS_FILTER_ID = 12347;

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

const LOOK_COLOR = 'color_look';
const LOOK_TAG = 'tag_look';

const SIDEBAR_FILTER_LINK_CLASS = 'sidebar-filter__link';
const CHECKED_CLASS = '--checked';
const SIDEBAR_FILTER_CIRCLE_CLASS = 'sidebar-filter__circle';

const PALLET_SHIPPING_CLASS_ID = 2410;
const PALLET_SHIPPING_CLASS_NAME = "Raklapos";

const BOX_SHIPPING_CLASS_NAME = "Dobozos Szállítás";

const COMPANY_BANK_ACCOUNT = '11714006-20397245';
const ON_HOLD_PAYMENT_STATUS_NAME = 'on-hold';
const BANK_TRANSFER_LABEL = 'bacs';

const ON_HOLD_ORDER_STATUS = 'on-hold';

const CHANGING_PRICES_MESSAGE = '<p style="margin-bottom: 0px;">A honlapon szereplő árak az ukrajnai háborus helyzet miatt kialakult ellátási zavarokra tekintettel <strong>tájékoztató jellegűek<strong>, nem minősülnek konkrét árajánlattételnek.</p>';

const TEL_NUMBERS = [
  ["06 70 942 5095", "06-70-942-5095", "Pinti István"],
  ["06 30 397 4150", "06-30-397-4150", "Szabó István"],
  ["06 70 601 4600", "06-70-601-4600", "Illés László"]
];

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