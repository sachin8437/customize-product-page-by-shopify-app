<?php 

$html = '<link rel="stylesheet" href="https://brandclever.in/shopify/assets/css/customizeProduct.css"><script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js" defer="defer" ></script><script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer="defer"></script>';
$html .='<button id="customizP_popup">Customize Product</button><br><br>';
$html .= '<div class="main-popup by_app">';
    $html .= '<div class="inner-popup">';
        $html .= '<div class="top">';
            $html .= '<div class="selected-popup">';
                $html .= '<button class="custom_pro">Custom Product</button>';
                $html .= '<button class="upload_pro"> Upload Product </button>';
            $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="upload_product">';
            $html .= '<p>Upload Product</p>';
        $html .= '</div>';
        $html .= '<div class="bottom">';
            $html .= '<div class="leftPart">';
                $html .= '<form id="myform">';
                  $html .= '<select id="fs"> ';
                    $html .= '<option value="Arial">Arial</option>';
                    $html .= '<option value="Verdana">Verdana</option>'; 
                    $html .= '<option value="Tahoma">Tahoma</option>';
                    $html .= '<option value="Trebuchet MS">Trebuchet MS</option>';
                    $html .= '<option value="Georgia">Georgia</option>';
                    $html .= '<option value="Times New Roman">Times New Roman</option>';
                    $html .= '<option value="Palatino">Palatino</option>';
                    $html .= '<option value="Courier New">Courier New</option>';
                    $html .= '<option value="Lucida Console">Lucida Console</option>';
                    $html .= '<option value="Helvetica">Helvetica</option>';
                    $html .= '<option value="Arial Black">Arial Black</option>';
                    $html .= '<option value="Impact">Impact</option>';
                    $html .= '<option value="Comic Sans MS">Comic Sans MS</option>';
                    $html .= '<option value="Courier">Courier</option>';
                    $html .= '<option value="Garamond">Garamond</option>';
                    $html .= '<option value="Bookman">Bookman</option>';
                    $html .= '<option value="Copperplate">Copperplate</option>';
                    $html .= '<option value="Brush Script MT">Brush Script MT</option>';
                    $html .= '<option value="Futura">Futura</option>';
                    $html .= '<option value="Century Gothic">Century Gothic</option>';
                    $html .= '<option value="Arial Narrow">Arial Narrow</option>';
                    $html .= '<option value="Franklin Gothic Medium">Franklin Gothic Medium</option>';
                    $html .= '<option value="Optima">Optima</option>';
                  $html .= '</select>';
                  $html .= '<select id="size">';
                    $html .= '<option value="8">8</option>';
                    $html .= '<option value="10">10</option>';
                    $html .= '<option value="12">12</option>';
                    $html .= '<option value="13">13</option>';
                    $html .= '<option value="14">14</option>';
                    $html .= '<option value="16">16</option>';
                    $html .= '<option value="18">18</option>';
                    $html .= '<option value="20">20</option>';
                    $html .= '<option value="22">22</option>';
                    $html .= '<option value="24">24</option>';
                    $html .= '<option value="26">26</option>';
                    $html .= '<option value="28">28</option>';
                    $html .= '<option value="30">30</option>';
                    $html .= '<option value="32">32</option>';
                    $html .= '<option value="36">36</option>';
                    $html .= '<option value="40">40</option>';
                $html .= '</select>';
                $html .= '</form>';
                    $html .= '<div class="custom_product">';
                        $html .= '<label>Add Text</label>';
                        $html .= '<input type="text" placeholder="Enter text"><br>';
                        $html .= '<label>Add Color on text</label>';
                        $html .= '<input class="jscolor " id="textColorPicker" value="ffffff"><br>';
                        $html .= '<label>Colors</label><br>';
                        $html .= '<div id="colorContainer"></div>';
                    $html .= '</div>';
            $html .= '</div>'; // leftPart side close 
            $html .= '<div class="rightPart changeMe">';
                $html .= '<textarea class="changeMe">Text into textarea</textarea>';
                $html .= '<div id="container" class="changeMe">';
                    $html .= '<div id="float">';
                        $html .= '<p> Text into container </p>';
                    $html .= '</div>';
                $html .= '</div>';
                $html .= '<div class="custom_products">';
                    $html .= '<img src="{{ product.featured_image | img_url: "200x200" }}" alt="{{product.featured_image.alt}}" />';
                $html .= '</div>'; 
            $html .= '</div>'; // rightPart side close  
        $html .= '</div>';  // Bottom close 
       $html .= ' <button class="custom_close"> Close </button>';
    $html .= '</div>';  // Inner Popup close 
$html .= '</div>';  // Main Popup close 
$html .= '"{% schema %}{ "name": "Customize Product",  "tag": "section",  "class": "section",  "settings": [],  "presets": [ { "name": "Customize Product" }]} {% endschema %}' ;

// Now $html contains the concatenated HTML strings.
$html_escaped = addslashes($html);
$ch = curl_init();

// Fetch all products
curl_setopt($ch, CURLOPT_URL, 'https://product-customizers.myshopify.com/admin/api/2023-07/themes.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
 
$headers = array();
$headers[] = 'X-Shopify-Access-Token: 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';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$theme_data = json_decode($result, true);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

foreach ($theme_data as $innerValue) {
    foreach ($innerValue as $key => $value) {
        if($value['role'] === 'main'){
          $theme_id = $value['id'];
          $theme_role =  $value['role'];
           
        // create file in snippets folder start  
        $ch1 = curl_init();

        curl_setopt($ch1, CURLOPT_URL, 'https://product-customizers.myshopify.com/admin/api/2023-07/themes/'.$theme_id.'/assets.json');
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'PUT');

        curl_setopt($ch1, CURLOPT_POSTFIELDS, '{
            "asset":{
                "key":"sections/customizeProducts.liquid",
                "value":"'.$html_escaped.'"
            }
        }');

        $headers = array();
        $headers[] = 'X-Shopify-Access-Token: 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';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch1);
        $array = json_decode( $result, true );
        echo "<pre>";
        print_r($array);
 
        if (curl_errno($ch1)) {
            echo 'Error:' . curl_error($ch1);
        }
        curl_close($ch1);

        // snippit file end 
 

        }
  
    }
}

/**************************
 * 
 *  // Get/Post/Put  script_tags files ( Js ) start
 * 
 * *******************/


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://product-customizers.myshopify.com/admin/api/2023-10/script_tags.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'X-Shopify-Access-Token: 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';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$array2 = json_decode( $result, true );
              

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

if (!empty($array2['script_tags'])){
    $fileId = $array2['script_tags'][0]['id'];
    $fileURL = $array2['script_tags'][0]['src'];
   
    if($fileURL == 'https://brandclever.in/shopify/assets/js/customize_product.js'){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://product-customizers.myshopify.com/admin/api/2023-10/script_tags/'.$fileId.'.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
            "script_tag":{
                "event":"onload",
                "id":'.$fileId.',
                "src":"'.$fileURL.'"
            }
        }');

        $headers = array();
        $headers[] = 'X-Shopify-Access-Token: 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';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $array2 = json_decode( $result, true );
         echo "<pre> test14";
                print_r($array2);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

    }

}else{

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://product-customizers.myshopify.com/admin/api/2023-10/script_tags.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        "script_tag":{
            "event":"onload",
            "src":"https://brandclever.in/shopify/assets/js/customize_product.js"
        }
    }');

    $headers = array();
    $headers[] = 'X-Shopify-Access-Token: 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';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);


}

/******************
 * 
 * // Get/Post/Put  script_tags files ( Js ) End
 * 
 * *****************/




die('end of the script');
