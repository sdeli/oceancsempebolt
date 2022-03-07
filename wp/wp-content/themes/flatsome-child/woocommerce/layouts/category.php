<div class="row category-page-row">

		<div class="col large-3 hide-for-medium <?php flatsome_sidebar_classes(); ?>">
			<?php flatsome_sticky_column_open( 'category_sticky_sidebar' ); ?>

			<div id="shop-sidebar" class="sidebar-inner col-inner">
				<?php
				  if(is_active_sidebar('shop-sidebar')) {
				  		dynamic_sidebar('shop-sidebar');
				  	} else{ echo '<p>You need to assign Widgets to <strong>"Shop Sidebar"</strong> in <a href="'.get_site_url().'/wp-admin/widgets.php">Appearance > Widgets</a> to show anything here</p>';
				  }
				?>
			</div>

			<?php flatsome_sticky_column_close( 'category_sticky_sidebar' ); ?>
		</div>

		<div class="col large-9">
			<?php
			  global $wp_query;
        $cat = $wp_query->get_queried_object();
        [$current_path] = explode("?", $_SERVER['REQUEST_URI']);

        if (is_shop()) {
          $smartSliderId = 248;
          $categorySpecificFilterId = 10595;
        } else {
          if ($cat->slug === "burkolatok") {
            $smartSliderId = 3;
            $manyItems = true;
          }
  
          if ( strpos($current_path, "burkolatok")) {
            $categorySpecificFilterId = 10595;
          }
  
          if ($cat->slug === "markak") {
            $smartSliderId = 4;	
          }
          
          if ($cat->slug === "argenta") {
            $smartSliderId = 5;	
          }
        
           if ($cat->slug === "anna") {
             $smartSliderId = 6;
           }
        
           if ($cat->slug === "camargue") {
             $smartSliderId = 7;
           }
        
          if ($cat->slug === "atr-termekcsalad") {
            $smartSliderId = 8;	
          }
  
          if ($cat->slug === "gs-termekcsalad") {
            $smartSliderId = 9;	
          }
  
          if ($cat->slug === "martha") {
            $smartSliderId = 10;	
          }
        
          if ($cat->slug === "mary") {
            $smartSliderId = 11;	
          }
        
          if ($cat->slug === "naomi") {
            $smartSliderId = 12;	
          }
        
          if ($cat->slug === "ker-termekcsalad") {
            $smartSliderId = 13;	
          }
        
          if ($cat->slug === "black-white") {
            $smartSliderId = 14;	
          }
          
          if ($cat->slug === "claudia") {
            $smartSliderId = 15;	
          }
        
          if ($cat->slug === "eva") {
            $smartSliderId = 16;	
          }
        
          if ($cat->slug === "rebekah") {
            $smartSliderId = 17;	
          }
        
          if ($cat->slug === "brandtile-burkolatok") {
            $smartSliderId = 18;	
          }
        
          if ($cat->slug === "ruby") {
            $smartSliderId = 19;	
          }
        
          if ($cat->slug === "cerrad") {
            $smartSliderId = 20;	
          }
  
          if ($cat->slug === "mystery-land") {
            $smartSliderId = 21;	
          }
          
          if ($cat->slug === "alaya") {
            $smartSliderId = 22;	
          }
          
          if ($cat->slug === "arno") {
            $smartSliderId = 23;	
          }
        
          if ($cat->slug === "bantu") {
            $smartSliderId = 24;	
          }
          
          if ($cat->slug === "black-and-white") {
            $smartSliderId = 25;	
          }
        
          if ($cat->slug === "concrete-style") {
            $smartSliderId = 26;	
          }
          
          if ($cat->slug === "forest-soul") {
            $smartSliderId = 27;	
          }
        
          if ($cat->slug === "good-look") {
            $smartSliderId = 28;	
          }
        
          if ($cat->slug === "gravity") {
            $smartSliderId = 29;	
          }
        
          if ($cat->slug === "hika") {
            $smartSliderId = 30;	
          }
        
          if ($cat->slug === "indira") {
            $smartSliderId = 31;	
          }
          
          if ($cat->slug === "kavir") {
            $smartSliderId = 32;	
          }
          
          if ($cat->slug === "livi") {
            $smartSliderId = 33;	
          }
          
          if ($cat->slug === "manzila") {
            $smartSliderId = 34;	
          }
          
          if ($cat->slug === "cersanit-burkolatok") {
            $smartSliderId = 35;	
          }
          
          if ($cat->slug === "marble-room") {
            $smartSliderId = 36;	
          }
          
          if ($cat->slug === "marinel") {
            $smartSliderId = 37;	
          }
          
          if ($cat->slug === "markuria") {
            $smartSliderId = 38;	
          }
            
          if ($cat->slug === "mystery-land") {
            $smartSliderId = 39;	
          }
        
          if ($cat->slug === "nanga") {
            $smartSliderId = 40;	
          }
        
          if ($cat->slug === "ondes") {
            $smartSliderId = 41;	
          }
          
          if ($cat->slug === "safari") {
            $smartSliderId = 42;	
          }
        
          if ($cat->slug === "simple-art") {
            $smartSliderId = 43;	
          }
        
          if ($cat->slug === "snowdrops") {
            $smartSliderId = 44;	
          }
        
          if ($cat->slug === "space") {
            $smartSliderId = 45;	
          }
          
          if ($cat->slug === "zambezi") {
            $smartSliderId = 46;	
          }
            
          if ($cat->slug === "kolpa-san") {
            $smartSliderId = 47;	
          }
        
          if ($cat->slug === "accordo") {
            $smartSliderId = 48;	
          }
        
          if ($cat->slug === "aria") {
            $smartSliderId = 49;	
          }
        
          if ($cat->slug === "atlas") {
            $smartSliderId = 50;	
          }
          
          if ($cat->slug === "beatrice") {
            $smartSliderId = 51;	
          }
        
          if ($cat->slug === "calando") {
            $smartSliderId = 52;	
          }
        
          if ($cat->slug === "carmen") {
            $smartSliderId = 53;	
          }
        
          if ($cat->slug === "carol") {
            $smartSliderId = 54;	
          }
        
          if ($cat->slug === "chad") {
            $smartSliderId = 55;	
          }
          
          if ($cat->slug === "destiny") {
            $smartSliderId = 56;	
          }
        
          if ($cat->slug === "evelin") {
            $smartSliderId = 57;	
          }
        
          if ($cat->slug === "flex") {
            $smartSliderId = 58;	
          }
        
          if ($cat->slug === "loco") {
            $smartSliderId = 59;	
          }
        
          if ($cat->slug === "valis") {
            $smartSliderId = 60;	
          }
        
          if ($cat->slug === "virgo-uni") {
            $smartSliderId = 61;	
          }
          
          if ($cat->slug === "zephyr") {
            $smartSliderId = 62;	
          }
          
          if ($cat->slug === "m-acryl") {
            $smartSliderId = 63;	
          }
          
          if ($cat->slug === "sandra") {
            $smartSliderId = 64;	
          }
        
          if ($cat->slug === "marazzi") {
            $smartSliderId = 65;	
          }
        
          if ($cat->slug === "clayline") {
            $smartSliderId = 66;	
          }
        
          if ($cat->slug === "d-segni") {
            $smartSliderId = 67;	
          }
        
          if ($cat->slug === "opoczno") {
            $smartSliderId = 68;	
          }
        
          if ($cat->slug === "break-the-line") {
            $smartSliderId = 69;	
          }
        
          if ($cat->slug === "calm-colors") {
            $smartSliderId = 70;	
          }
        
          if ($cat->slug === "frozen-lake") {
            $smartSliderId = 71;	
          }
          if ($cat->slug === "noisy-grey") {
            $smartSliderId = 72;	
          }
          if ($cat->slug === "selina") {
            $smartSliderId = 73;	
          }
          if ($cat->slug === "porcelanosa") {
            $smartSliderId = 74;	
          }
          if ($cat->slug === "travertino-medici") {
            $smartSliderId = 75;	
          }
          if ($cat->slug === "all-in-white") {
            $smartSliderId = 76;	
          }
          if ($cat->slug === "malena") {
            $smartSliderId = 77;	
          }
          if ($cat->slug === "obsydian") {
            $smartSliderId = 78;	
          }
          if ($cat->slug === "onis") {
            $smartSliderId = 79;	
          }
          if ($cat->slug === "tubadzin") {
            $smartSliderId = 80;	
          }
          if ($cat->slug === "fali-csempe") {
            $smartSliderId = 81;	
          }
          if ($cat->slug === TUBS_SLUG) {
            $smartSliderId = 82;
          }
          
          if ( strpos($current_path, TUBS_SLUG)) {
            $categorySpecificFilterId = COLOR_ORIENTATION_TAGS_FILTER_ID;
          }
  
          if ($cat->slug === "kadkiegeszitok") {
            $smartSliderId = 83;	
          }
          if ($cat->slug === "padlolapok") {
            $smartSliderId = 84;	
          }
          if ($cat->slug === "zuhanykabinok") {
            $smartSliderId = 85;	
          }
          if ($cat->slug === "ribesalbes") {
            $smartSliderId = 86;	
          }
          if ($cat->slug === "el-molino") {
            $smartSliderId = 87;	
          }
          if ($cat->slug === "ascot") {
            $smartSliderId = 88;	
          }
          if ($cat->slug === "dover") {
            $smartSliderId = 89;	
          }
          if ($cat->slug === "manhattan") {
            $smartSliderId = 90;	
          }
          if ($cat->slug === "oxford") {
            $smartSliderId = 91;	
          }
          if ($cat->slug === "park") {
            $smartSliderId = 92;	
          }
          if ($cat->slug === "spiga") {
            $smartSliderId = 93;	
          }
          if ($cat->slug === "stone-ker") {
            $smartSliderId = 94;	
          }
          if ($cat->slug === "csempe") {
            $smartSliderId = 96;	
          }
          if ($cat->slug === "ko-mintas") {
            $smartSliderId = 97;	
          }
  
          if ($cat->slug === "lisztello") {
  // 					$smartSliderId = 96;	
          }
          if ($cat->slug === "mozaik") {
  // 					$smartSliderId = 97;	
          }
          if ($cat->slug === "beige") {
            $smartSliderId = 100;	
          }
          if ($cat->slug === "egyeb") {
            $smartSliderId = 101;	
          }
          if ($cat->slug === "fa-mintas") {
            $smartSliderId = 102;	
          }
          if ($cat->slug === "ko-hatasu") {
            $smartSliderId = 103;	
          }
          if ($cat->slug === "szines") {
            $smartSliderId = 104;	
          }
          if ($cat->slug === "szurke-arnyalatai") {
            $smartSliderId = 105;	
          }
          if ($cat->slug === "furdoszoba-szoba") {
            $smartSliderId = 106;	
          }
          if ($cat->slug === "feher") {
            $smartSliderId = 107;	
          }
          if ($cat->slug === "marvany-hatasu") {
            $smartSliderId = 108;	
          }
          if ($cat->slug === "nappali-szoba") {
            $smartSliderId = 109;	
          }
          if ($cat->slug === "terasz-szoba") {
            $smartSliderId = 110;	
          }
          if ($cat->slug === "notta") {
            $smartSliderId = 110;	
          }
          if ($cat->slug === "safari-porcelanosa") {
            $smartSliderId = 112;	
          }
          if ($cat->slug === "vaker") {
            $smartSliderId = 113;	
          }
          if ($cat->slug === "mondo") {
            $smartSliderId = 114;	
          }
          if ($cat->slug === "fuerta") {
            $smartSliderId = 115;	
          }
          if ($cat->slug === "it-termekcsalad") {
            $smartSliderId = 116;	
          }
          if ($cat->slug === "te-termekcsalad") {
            $smartSliderId = 117;	
          }
          if ($cat->slug === "ek-termekcsalad") {
            $smartSliderId = 118;	
          }
          if ($cat->slug === "allmarble") {
            $smartSliderId = 119;	
          }
          if ($cat->slug === "d-segni-blend") {
            $smartSliderId = 120;	
          }
          if ($cat->slug === "apparel") {
            $smartSliderId = 121;	
          }
          if ($cat->slug === "blend") {
            $smartSliderId = 122;	
          }
          if ($cat->slug === "block") {
            $smartSliderId = 123;	
          }
          if ($cat->slug === "boise") {
            $smartSliderId = 124;	
          }
          if ($cat->slug === "chalk") {
            $smartSliderId = 125;	
          }
          if ($cat->slug === "chroma") {
            $smartSliderId = 126;	
          }
          if ($cat->slug === "clayline") {
            $smartSliderId = 127;	
          }
          if ($cat->slug === "clays") {
            $smartSliderId = 128;	
          }
          if ($cat->slug === "cloud") {
            $smartSliderId = 129;	
          }
          if ($cat->slug === "colorplay") {
            $smartSliderId = 130;	
          }
          if ($cat->slug === "d-segni-blend") {
            $smartSliderId = 131;	
          }
          if ($cat->slug === "eclettica") {
            $smartSliderId = 132;	
          }
          if ($cat->slug === "fabric") {
            $smartSliderId = 133;	
          }
          if ($cat->slug === "fresco") {
            $smartSliderId = 134;	
          }
          if ($cat->slug === "interiors") {
            $smartSliderId = 135;	
          }
          if ($cat->slug === "mystone-basalto") {
            $smartSliderId = 136;	
          }
          if ($cat->slug === "oficina7") {
            $smartSliderId = 137;	
          }
          if ($cat->slug === "pottery") {
            $smartSliderId = 139;	
          }
          if ($cat->slug === "treverkage") {
            $smartSliderId = 140;	
          }
          if ($cat->slug === "treverkcharme") {
            $smartSliderId = 141;	
          }
          if ($cat->slug === "treverkchic") {
            $smartSliderId = 142;	
          }
          if ($cat->slug === "treverkheart") {
            $smartSliderId = 143;	
          }
          if ($cat->slug === "treverkhome") {
            $smartSliderId = 144;	
          }
          if ($cat->slug === "treverkview") {
            $smartSliderId = 145;	
          }
          if ($cat->slug === "visual") {
            $smartSliderId = 146;	
          }
          //
          if ($cat->slug === "cambia") {
            $smartSliderId = 147;	
          }
          if ($cat->slug === "carneval") {
            $smartSliderId = 148;	
          }
          if ($cat->slug === "foggia") {
            $smartSliderId = 149;	
          }
          if ($cat->slug === "color-crush") {
            $smartSliderId = 150;	
          }
          if ($cat->slug === "cosima") {
            $smartSliderId = 151;	
          }
          if ($cat->slug === "love-you-navy-blue") {
            $smartSliderId = 152;	
          }
          if ($cat->slug === "all-in-white") {
            $smartSliderId = 153;	
          }
          if ($cat->slug === "biloba") {
            $smartSliderId = 154;	
          }
          if ($cat->slug === "epoxy") {
            $smartSliderId = 155;	
          }
          if ($cat->slug === "house-of-tones") {
            $smartSliderId = 156;	
          }
          if ($cat->slug === "marmo-doro") {
            $smartSliderId = 157;	
          }
          // if ($cat->slug === "pastel") {
          // 	$smartSliderId = 158;	
          // }
          if ($cat->slug === "palermo") {
            $smartSliderId = 159;	
          }
          if ($cat->slug === "zambezi") {
            $smartSliderId = 160;	
          }
          if ($cat->slug === "zalakeramia") {
            $smartSliderId = 161;	
          }
  
          if ($cat->slug === TAPS_SLUG) {
            $smartSliderId = 162;
            $categorySpecificFilterId = COLOR_STYLE_TAGS_HANDLE_FILTER_ID;
          }
          if ($cat->slug === "asszimetrikus") {
            $smartSliderId = 163;	
          }
          if ($cat->slug === "egyenes") {
            $smartSliderId = 164;	
          }
          if ($cat->slug === "kulonleges") {
            $smartSliderId = 165;	
          }
          if ($cat->slug === "sarok") {
            $smartSliderId = 166;	
          }
          if ($cat->slug === "terben-allo") {
            $smartSliderId = 167;	
          }
          if ($cat->slug === "mosogatok") {
            $smartSliderId = 169;	
          }
          
          if ( strpos($current_path, "mosogatok")) {
            $categorySpecificFilterId = COLOR_FORM_MATERIAL_TAGS_FILTER_ID;
          }
  
          if ($cat->slug === "kludi") {
            $smartSliderId = 171;	
          }
          if ($cat->slug === "zuhanyajto") {
            $smartSliderId = 174;	
          }
          if ($cat->slug === "1926") {
            $smartSliderId = 175;	
          }
          if ($cat->slug === "a-qa") {
            $smartSliderId = 176;	
          }
          if ($cat->slug === "active") {
            $smartSliderId = 177;	
          }
          if ($cat->slug === "amba") {
            $smartSliderId = 178;	
          }
          if ($cat->slug === "ameo") {
            $smartSliderId = 179;	
          }
          if ($cat->slug === "balance") {
            $smartSliderId = 180;	
          }
          if ($cat->slug === "bingo-star") {
            $smartSliderId = 181;	
          }
          if ($cat->slug === "bozz") {
            $smartSliderId = 182;	
          }
          if ($cat->slug === "e-go") {
            $smartSliderId = 183;	
          }
          if ($cat->slug === "e2") {
            $smartSliderId = 185;	
          }
          if ($cat->slug === "fizz") {
            $smartSliderId = 186;	
          }
          if ($cat->slug === "freshline") {
            $smartSliderId = 187;	
          }
          if ($cat->slug === "l-ine") {
            $smartSliderId = 188;	
          }
          if ($cat->slug === "logo") {
            $smartSliderId = 189;	
          }
          if ($cat->slug === "mx") {
            $smartSliderId = 190;	
          }
          if ($cat->slug === "objekta") {
            $smartSliderId = 191;	
          }
          if ($cat->slug === "pure-easy") {
            $smartSliderId = 192;	
          }
          if ($cat->slug === "scope") {
            $smartSliderId = 193;	
          }
          if ($cat->slug === "trendo") {
            $smartSliderId = 194;	
          }
          if ($cat->slug === "zenta") {
            $smartSliderId = 184;	
          }
          if ($cat->slug === "arany") {
            $smartSliderId = 197;	
          }
          if ($cat->slug === "bide-csaptelep") {
            $smartSliderId = 198;	
          }
          if ($cat->slug === "feher-csaptelepek-2") {
            $smartSliderId = 195;	
          }
          if ($cat->slug === "fekete-csaptelepek-2") {
            $smartSliderId = 199;	
          }
          if ($cat->slug === "kad-csaptelep") {
            $smartSliderId = 200;	
          }
          if ($cat->slug === "kezizuhanyok") {
            $smartSliderId = 201;	
          }
          if ($cat->slug === "krom") {
            $smartSliderId = 202;	
          }
          if ($cat->slug === "mosdo-csaptelep") {
            $smartSliderId = 203;	
          }
          if ($cat->slug === "mosogato-csaptelep") {
            $smartSliderId = 204;	
          }
          if ($cat->slug === "zuhany-csaptelep") {
            $smartSliderId = 205;	
          }
          if ($cat->slug === "zuhanyszett") {
            $smartSliderId = 206;	
          }
          if ($cat->slug === "essenza") {
            $smartSliderId = 209;	
          }
          if ($cat->slug === "furo") {
            $smartSliderId = 210;	
          }
          if ($cat->slug === "idea") {
            $smartSliderId = 211;	
          }
          if ($cat->slug === "modo") {
            $smartSliderId = 212;	
          }
          if ($cat->slug === "nes") {
            $smartSliderId = 213;	
          }
          if ($cat->slug === "ako") {
            $smartSliderId = 214;	
          }
          if ($cat->slug === "radaway") {
            $smartSliderId = 215;	
          }
          if ($cat->slug === "marmorin") {
            $smartSliderId = 216;	
          }
          if ($cat->slug === "nero") {
            $smartSliderId = 217;	
          }
          if ($cat->slug === "olwin") {
            $smartSliderId = 218;	
          }
          if ($cat->slug === "laminalt-padlo") {
            $smartSliderId = 219;	
          }
          if ($cat->slug === "egger") {
            $smartSliderId = 220;	
          }
          if ($cat->slug === "bazis") {
            $smartSliderId = 221;	
          }
          if ($cat->slug === "formo") {
            $smartSliderId = 222;	
          }
          if ($cat->slug === "liner") {
            $smartSliderId = 223;	
          }
          if ($cat->slug === "melina") {
            $smartSliderId = 224;	
          }
          if ($cat->slug === "mollis") {
            $smartSliderId = 225;	
          }
          if ($cat->slug === "optic") {
            $smartSliderId = 226;	
          }
          if ($cat->slug === "saval-2-0") {
            $smartSliderId = 227;	
          }
          if ($cat->slug === "alfoldi-markak") {
            $smartSliderId = 228;	
          }
          if ($cat->slug === "csaptelepek") {
            $smartSliderId = 162;	
          }
  
          if ( strpos($current_path, "csaptelepek")) {
            $categorySpecificFilterId = 10595;
          }
  
          if ($cat->slug === "konyha-szoba") {
            $smartSliderId = 230;	
          }
          if ($cat->slug === "zuhanytalcak") {
            $smartSliderId = 232;	
          }
          if ($cat->slug === "zuhanyfal") {
            $smartSliderId = 233;	
          }
  
          if ($cat->slug === "lisztello") {
            $smartSliderId = 235;	
          }
          if ($cat->slug === "mozaik") {
            $smartSliderId = 236;	
          }
          if ($cat->slug === "konyhai-csaptelep") {
            $smartSliderId = 237;	
          }
          if ($cat->slug === BATHROOM_AUXILIARY_SLUG) {
            $smartSliderId = 238;
          }
          
          if ( strpos($current_path, BATHROOM_AUXILIARY_SLUG)) {
            $categorySpecificFilterId = COLOR_STYLE_TAGS_HANDLE_FILTER_ID;
          }
  
  
          if ($cat->slug === SANITARY_SLUG) {
            $smartSliderId = 239;	
          }
          
          if ( strpos($current_path, SANITARY_SLUG)) {
            $categorySpecificFilterId = FORM_LOCATION_TAGS_FILTER_ID;
          }
  
          if ($cat->slug === "bide") {
            $smartSliderId = 240;	
          }
          if ($cat->slug === "mosdo") {
            $smartSliderId = 241;	
          }
          if ($cat->slug === "wc") {
            $smartSliderId = 242;	
          }
          if ($cat->slug === "dekor-csempe") {
            $smartSliderId = 243;	
          }
  
          if ($cat->slug === "mintas") {
            $smartSliderId = 245;	
          }
  
          if ($cat->slug === "3d-csempe") {
            $smartSliderId = 249;	
          }
  
          if ($cat->slug === "nowa-gala") {
            $smartSliderId = 251;	
          }
          
          if ($cat->slug === "my-tones") {
            $smartSliderId = 250;	
          }
          
          if ($cat->slug === "royal-place") {
            $smartSliderId = 252;	
          }
  
          if ($cat->slug === "touch") {
            $smartSliderId = 253;	
          }
  
          if ($cat->slug === "terraform") {
            $smartSliderId = 254;	
          }
  
          if ($cat->slug === "blinds") {
            $smartSliderId = 255;	
          }
  
          if ($cat->slug === "unit-plus") {
            $smartSliderId = 256;	
          }
  
          if ($cat->slug === "platine-plate") {
            $smartSliderId = 257;	
          }
  
          if ($cat->slug === "rock-ceramic") {
            $smartSliderId = 258;
          }
          
          if ($cat->slug === "paradyz") {
            $smartSliderId = 259;
          }
  
          if ($cat->slug === "bliss") {
            $smartSliderId = 260;
          }
  
          if ($cat->slug === "dream") {
            $smartSliderId = 261;
          }
  
          if ($cat->slug === "hexagon") {
            $smartSliderId = 262;
          }
          if ($cat->slug === "aulla") {
            $smartSliderId = 269;
          }
          if ($cat->slug === "brainstorm") {
            $smartSliderId = 268;
          }
          if ($cat->slug === "brave") {
            $smartSliderId = 267;
          }
          if ($cat->slug === "coma") {
            $smartSliderId = 266;
          }
          if ($cat->slug === "dots") {
            $smartSliderId = 265;
          }
          if ($cat->slug === "harmonic") {
            $smartSliderId = 264;
          }
          if ($cat->slug === "horizon-tubadzin") {
            $smartSliderId = 263;
          }
          if ($cat->slug === "horizon") {
            $smartSliderId = 270;
          }
          if ($cat->slug === "massa") {
            $smartSliderId = 274;
          }
          if ($cat->slug === "modern-pearl") {
            $smartSliderId = 275;
          }
          // if ($cat->slug === "mono-pastel") {
          //   $smartSliderId = 272;
          // }
          if ($cat->slug === "integrally") {
            $smartSliderId = 271;
          }
          if ($cat->slug === "aulla") {
            $smartSliderId = 276;
          }
          if ($cat->slug === "budapest") {
            $smartSliderId = 277;
          }
          if ($cat->slug === "reflection") {
            $smartSliderId = 273;
          }
  
          if ($cat->slug === "milan") {
            $smartSliderId = 278;
          }
  
          if ($cat->slug === "vigo-rock-ceramic") {
            $smartSliderId = 279;
          }
  
          if ($cat->slug === "caligula") {
            $smartSliderId = 281;
          }
  
          if ($cat->slug === "monza") {
            $smartSliderId = 282;
          }
  
          if ($cat->slug === "cicero") {
            $smartSliderId = 283;
          }
          if ($cat->slug === "amazonas") {
            $smartSliderId = 284;
          }
          if ($cat->slug === "furdoszobabutorok") {
            $smartSliderId = 285;
          }
          if ($cat->slug === "fly") {
            $smartSliderId = 286;
          }
  
          if ($cat->slug === "shiny-textile") {
            $smartSliderId = 287;
          }
          if ($cat->slug === "touch-me") {
            $smartSliderId = 291;
          }
          if ($cat->slug === "calvano") {
            $smartSliderId = 290;
          }
          if ($cat->slug === "soft-romantic") {
            $smartSliderId = 289;
          }
          if ($cat->slug === "taku") {
            $smartSliderId = 288;
          }
          if ($cat->slug === "cersanit") {
            $smartSliderId = 292;
          }
          if ($cat->slug === "woodskin") {
            $smartSliderId = 294;
          }
          if ($cat->slug === "lume") {
            $smartSliderId = 295;
          }
          if ($cat->slug === "plain-stone-burkolatok") {
            $smartSliderId = 296;
          }
          if ($cat->slug === "inpoint") {
            $smartSliderId = 297;
          }
          if ($cat->slug === "sfumato") {
            $smartSliderId = 299;
          }
          if ($cat->slug === "serenity") {
            $smartSliderId = 300;
          }
          if ($cat->slug === "pastel") {
            $smartSliderId = 301;
          }
          if ($cat->slug === "esenzia") {
            $smartSliderId = 302;
          }
          if ($cat->slug === "muse-kategoria") {
            $smartSliderId = 303;
          }
          if ($cat->slug === "shine-concrete") {
            $smartSliderId = 304;
          }
          if ($cat->slug === "obsydian") {
            $smartSliderId = 305;
          } 
          if ($cat->slug === "calacatta-rock-ceramic") {
            $smartSliderId = 308;
          }           
          if ($cat->slug === "gante") {
            $smartSliderId = 309;
          }           
          if ($cat->slug === "obsydian") {
            $smartSliderId = 310;
          }           
          if ($cat->slug === "obsydian") {
            $smartSliderId = 305;
          }           
          if ($cat->slug === "obsydian") {
            $smartSliderId = 305;
          } 
          if ($cat->slug === "cement") {
            $smartSliderId = 311;
          }
          if ($cat->slug === "denia") {
            $smartSliderId = 315;
          } 
          if ($cat->slug === "kronos") {
            $smartSliderId = 314;
          } 
          if ($cat->slug === "moody") {
            $smartSliderId = 313;
          } 
          if ($cat->slug === "luxor-csalad") {
            $smartSliderId = 312;
          } 
        }

        ?>
      <div class="row">
        <div class="col design-col">
          <?php if (isset($smartSliderId)) { ?>
            <div class="design-slider-container">
              <?php 
                  echo <<<EOD
                  <div class="design-slider-container__placeholder">
                    <div class="design-slider-container__placeholder__message">
                      <p style="color: #ffd075;">Design Tervek</p>
                      <p style="color: #ffd075;">Töltődése Folyamatban</p>
                    </div>
                  </div>      
                  EOD;
              ?>      
            </div>
          <?php } ?>
          <div class="not-fake-slider"></div>
          <div class="fake-slider" style="display: none;">
            <?php 
              $smartSliderHtmlAsString = htmlspecialchars(do_shortcode("[smartslider3 slider=\"$smartSliderId\"]"));
              echo $smartSliderHtmlAsString;
            ?>
          </div>
          
          <div class="sort-disclaimer">
            <p><strong>Rendezés</strong> és <strong>kategóriák</strong> a <strong class="open-mobile-menu-text" onclick="clickHamburgerToOpenMobileSidebar()">menu <i class="icon-menu"></i></strong> iconra kattintva érhetőek el.</p>
          </div>
        
          <?php if (isset($categorySpecificFilterId)) { ?>
            <div class="filter-form <?php if ($manyItems) echo '--many-items'?>">
              <?php echo do_shortcode("[br_filters_group group_id=${categorySpecificFilterId}]"); ?>
            </div>
          <?php } ?>

          <div>
            <?= CHANGING_PRICES_MESSAGE ?>
          </div>

          <?php
            $is_category_page = !is_shop();
            if ($is_category_page) {
              $catalog = get_catalog_for_category($cat);
              if ($catalog) {
                $catalog_name = strtoupper($catalog['name']);
          ?>
          
            <a href="<?= $catalog['url'] ?>" target="_blank" class="catalog-legend">ITT MEGTEKINTHETI A TELJES <span class="color-alert-yellow text-shadow-sharp"><?= $catalog_name ?></span> KATALÓGUST: <span class="color-alert-yellow text-shadow-sharp">KATTINTS IDE</span></a>
          <?php 
              } 
            } 
          ?>
        </div>
      </div>
      
		<?php
		/**
		 * Hook: woocommerce_before_main_content.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20 (FL removed)
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		do_action( 'woocommerce_before_main_content' );

		?>

		<?php
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>

		<?php

		if ( woocommerce_product_loop() ) {

			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked wc_print_notices - 10
			 * @hooked woocommerce_result_count - 20 (FL removed)
			 * @hooked woocommerce_catalog_ordering - 30 (FL removed)
			 */
			do_action( 'woocommerce_before_shop_loop' );

			woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				while ( have_posts() ) {
					the_post();

					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );
				}
			}

			woocommerce_product_loop_end();

			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
			do_action( 'woocommerce_after_shop_loop' );
		} else {
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
			do_action( 'woocommerce_no_products_found' );
		}
		?>

		<?php
			/**
			 * Hook: flatsome_products_after.
			 *
			 * @hooked flatsome_products_footer_content - 10
			 */
			do_action( 'flatsome_products_after' );
			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action( 'woocommerce_after_main_content' );
		?>
		</div>
</div>