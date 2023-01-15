<?php
function foodota_elementor_all_category()
{
    $category_data = array();
    $data = foodota_get_selected_categories();
if(!empty($data)){
    foreach ($data as $key => $food_names) {
        $category_data[$key] = $food_names['term-name'];
    }
}
    return $category_data;
}

