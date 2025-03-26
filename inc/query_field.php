<?php

if( function_exists('acf_add_local_field_group') ):

// choices 交给主题选项

$yt = get_field('sx_yt', 'option');
$hy = get_field('sx_hy', 'option');
$lx = get_field('sx_lx', 'option');
$gs = get_field('sx_gs', 'option');

// 处理字符串为数组函数
function convert_string_to_choices($str) {
    if(empty($str)) return array();
    $pairs = explode('|', $str);
    $result = array();
    foreach($pairs as $pair) {
        $item = explode(',', trim($pair));
        if(count($item) == 2) {
            $result[$item[0]] = $item[1];
        }
    }
    return $result;
}

acf_add_local_field_group( array(
    'key' => 'group_62ecdb4be2b79',
    'title' => '筛选条件',
    'fields' => array(
        array(
          'key' => 'field_62ecdb981849a',
          'label' => '用途',
          'name' => 'yongtu',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => convert_string_to_choices($yt),
          'allow_custom' => 0,
          'default_value' => array(),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'label',
          'save_custom' => 0,
        ),

        array(
          'key' => 'field_62ecdbe901cc6',
          'label' => '行业',
          'name' => 'hangye',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => convert_string_to_choices($hy),
          'allow_custom' => 0,
          'default_value' => array(),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'label',
          'save_custom' => 0,
        ),

        array(
          'key' => 'field_62ecdc00bacec',
          'label' => '类型',
          'name' => 'leixing',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => convert_string_to_choices($lx),
          'allow_custom' => 0,
          'default_value' => array(),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'label',
          'save_custom' => 0,
        ),

        array(
          'key' => 'field_62ecdc0ebaced',
          'label' => '格式',
          'name' => 'geshi',
          'type' => 'checkbox',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'choices' => convert_string_to_choices($gs),
          'allow_custom' => 0,
          'default_value' => array(),
          'layout' => 'horizontal',
          'toggle' => 0,
          'return_format' => 'label',
          'save_custom' => 0,
        ),
    ),

    'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'show',
          ),
        ),
    ),

    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    )
);

endif;