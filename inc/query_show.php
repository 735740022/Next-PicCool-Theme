<?php

//准备一个筛选数据的数组。

function ds_get_sift_array(){

  //字段绑定 已预设 query_field.php 字段 取 choices
  $yt_field = get_field_object('field_62ecdb981849a'); //用途
  $hy_field = get_field_object('field_62ecdbe901cc6'); //行业
  $lx_field = get_field_object('field_62ecdc00bacec'); //类型
  $gs_field = get_field_object('field_62ecdc0ebaced'); //格式

  //通过字段列出参数
  $sift_array = array(
    'yongtu'  => $yt_field['choices'],
    'hangye'  => $hy_field['choices'],
    'leixing' => $lx_field['choices'],
    'geshi'   => $gs_field['choices'],
  );

  return $sift_array;
}


//筛选参数
function ds_add_query_vars($public_query_vars) {
  $public_query_vars[] = 'yongtu';
  $public_query_vars[] = 'hangye';
  $public_query_vars[] = 'leixing';
  $public_query_vars[] = 'geshi';
  return $public_query_vars;
}
add_action('query_vars', 'ds_add_query_vars');


//文章筛选代码
add_action('pre_get_posts','ds_sift_posts_per_page');
function ds_sift_posts_per_page($query){
  if(is_archive() && $query->is_main_query() && !is_admin()){
    $sift_array = ds_get_sift_array();
    $yongtu_keys = array_keys( $sift_array['yongtu'] );
    $hangye_keys = array_keys( $sift_array['hangye'] );
    $leixing_keys = array_keys( $sift_array['leixing'] );
    $geshi_keys = array_keys( $sift_array['geshi'] );
    $relation = 0;
    $sift_vars = array();
    $sift_vars['yongtu'] = get_query_var('yongtu');
    $sift_vars['hangye'] = get_query_var('hangye');
    $sift_vars['leixing'] = get_query_var('leixing');
    $sift_vars['geshi'] = get_query_var('geshi');
    $meta_query = array(
      'relation' => 'OR',
    );
    if( in_array( $sift_vars['yongtu'], $yongtu_keys ) ){
      $meta_query[] = array(
        'key'=>'yongtu',
        'value'=> $sift_vars['yongtu'],
        'compare'=>'LIKE',
      );
      $relation++;
    }
    if( in_array( $sift_vars['hangye'], $hangye_keys ) ){
      $meta_query[] = array(
        'key'=>'hangye',
        'value'=> $sift_vars['hangye'],
        'compare'=>'LIKE',
      );
      $relation++;
    }
    if( in_array( $sift_vars['leixing'], $leixing_keys ) ){
      $meta_query[] = array(
        'key'=>'leixing',
        'value'=> $sift_vars['leixing'],
        'compare'=>'LIKE',
      );
      $relation++;
    }
    if( in_array( $sift_vars['geshi'], $geshi_keys ) ){
      $meta_query[] = array(
        'key'=>'geshi',
        'value'=> $sift_vars['geshi'],
        'compare'=>'LIKE',
      );
      $relation++;
    }
    if($relation){
      if($relation>=2){
        $meta_query['relation'] = 'AND';
      }
      $query->set('meta_query',$meta_query);
    }
  }
}

getdata();