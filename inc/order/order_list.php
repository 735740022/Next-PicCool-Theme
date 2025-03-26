<?php
if (!defined('ABSPATH')) {die;} // Cannot access directly.
date_default_timezone_set('Asia/Shanghai');

$shiTable = new RiPlus_List_Table();
$shiTable->prepare_items();
?>


<div class="wrap">
    <h2>订单列表管理</h2>
    <hr class="wp-header-end">
    <div id="post-body-content">
        <div class="meta-box-sortables ui-sortable">
            <form method="get">
                <?php $shiTable->search_box('根据用户ID搜索', 'user_id'); ?>
                <input type="hidden" name="page" value="<?php echo $_GET['page']?>">
                <?php $shiTable->display(); ?>
            </form>
        </div>
    </div>
    <br class="clear">
</div>


<?php
// WP_List_Table is not loaded automatically so we need to load it in our application
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class RiPlus_List_Table extends WP_List_Table
{

    public function __construct()
    {
        global $status, $page;

        parent::__construct(array(
            'singular'  => 'wp_list_event',
            'plural'    => 'wp_list_events',
            'ajax'      => false
        ));
    }



    public function no_items() {
      _e( '没有找到相关数据' );
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $per_page     = 10;
        $current_page = $this->get_pagenum();
        $total_items  = $this->get_pagenum();


        $this->set_pagination_args( array(
            'total_items' => $this->table_data_count(),
            'per_page'    => $per_page
        ) );

        $this->_column_headers = array($columns, $hidden, $sortable);

        $this->items = $this->table_data($per_page,$current_page);
        $this->process_bulk_action();
    }

    public function get_columns()
    {
       $columns = [
            'cb'                => '<input type="checkbox" />',
            'order_trade_no'    => '本地订单号',
            'post_id'           => '商品名称',
            'user_id'           => '购买用户',
            'order_price'       => '订单价格',
            'create_time'       => '创建时间',
            'pay_type'          => '支付方式',
            'pay_time'          => '支付时间',
            'pay_trade_no'      => '支付订单号',
            'status'            => '支付状态',
        ];

        return $columns;
    }

    public function column_default( $item, $column_name )
    {
        switch ( $column_name ) {
            case 'featured_image':
                $post_featured_image = _get_post_thumbnail_url($item['post_id']);
                return '<img src="' . get_tim_img_szie($post_featured_image,50,50) . '" />';
                break;
            case 'user_id':
                if ($item[$column_name]>0) {
                    return '<span><img alt="" src="'.get_avatar_url($item[$column_name]).'" class="r-avatar" height="25" width="25"></span>'.get_user_by('id',$item[$column_name])->user_login;
                }else{
                    return '游客';
                }
            case 'post_id':
                if ($item[$column_name]>0) {
                    return '<a target="_blank" href='.get_permalink($item[$column_name]).'>'.get_the_title($item[$column_name]).'</a>';
                }else{
                    return '网站VIP会员';
                }
            case 'order_price':
                return '<span class="badge badge-info badge-pill">￥'.$item[$column_name].'</span>';
            case 'create_time':
                return date('Y-m-d H:i:s',$item[$column_name]);
            case 'pay_type':
                return _riplus_get_pay_type_text($item[$column_name]);
            case 'pay_time':
                if (!empty($item[$column_name])) {
                    return date('Y-m-d H:i:s',$item[$column_name]);
                }else{
                    return 'N/A';
                }

            case 'pay_trade_no':
                if (!empty($item[$column_name])) {
                    return $item[$column_name];
                }else{
                    return 'N/A';
                }
            case 'status':
                if ($item[$column_name]==1) {
                    return '<span class="badge badge-warning">已支付</span>';
                }else{
                    return '<span class="badge badge-secondary">未支付</span>';
                }
            default:
              return $item[ $column_name ];
        }
    }

    public function get_hidden_columns()
    {
        return array();
    }

    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'id' => array( 'id', true ),
            'create_time' => array( 'post_id', true ),
            'pay_time' => array( 'pay_time', true ),
            'order_price' => array( 'order_price', true ),
        );

        return $sortable_columns;
    }

    public function display_tablenav( $which )
    {
        ?>
        <div class="tablenav <?php echo esc_attr( $which ); ?>">

            <div class="alignleft actions">
                <?php $this->bulk_actions(); ?>
            </div>
            <?php
            $this->extra_tablenav( $which );
            $this->pagination( $which );
            ?>
            <br class="clear" />
        </div>
        <?php
    }

    public function extra_tablenav( $which ) {
        global $wpdb, $testiURL, $tablename, $tablet;
        if ( $which == "top" ){
            ?>
            <div class="alignleft actions bulkactions">
            <?php
            $filter = [
                ['title'=>'未支付','id'=>'0'],
                ['title'=>'已支付','id'=>'1'],

            ];
            if( $filter ){
                ?>
                <select name="status" class="ewc-filter-status">
                    <option selected="selected" value="">支付状态</option>
                    <?php foreach( $filter as $item ){
                        $selected = '';
                        $_REQUEST['status'] = (!empty($_REQUEST['status'])) ? $_REQUEST['status'] : null ;
                        if( $_REQUEST['status'] == $item['id'] ){
                            $selected = ' selected = "selected"';
                        }
                        echo '<option value="'.$item['id'].'"'.$selected.'>'.$item['title'].'</option>';
                    }?>
                </select>

                <button type="submit" id="post-query-submit" class="button">筛选</button>
                <?php
            }
            ?>
            </div>
            <?php
        }
        if ( $which == "bottom" ){
        }
    }


    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            $this->_args['singular'],
            $item['id']
        );
    }

    public function get_bulk_actions()
    {
        $actions = array(
            'delete'    => '删除',
        );
        return $actions;
    }

    public function process_bulk_action() {

        if ('delete' === $this->current_action()) {
            $delete_ids = (!empty($_REQUEST['wp_list_event'])) ? esc_sql( $_REQUEST['wp_list_event'] ) : null ;

            if ($delete_ids) {
                foreach ($_REQUEST['wp_list_event'] as $event) {
                    $this->delete_table_data($event);
                }
                $_url = remove_query_arg(['action','wp_list_event','action2']);
                echo "<script type='text/javascript'>window.location.href='$_url';</script>";
            }

        }

    }


    private function table_data($per_page = 5, $page_number = 1 )
    {
        global $wpdb,$order_table_name,$aff_table_name,$down_table_name;

        $sql = "SELECT * FROM $order_table_name WHERE post_id>0 AND order_type=1";
        //根据用户查询
        if ( ! empty( $_REQUEST['s'] ) ) {
            $user_id = 0;
            if (is_numeric($_REQUEST['s'])) {
                $user_id = absint($_REQUEST['s']);
            } else {
                $author_obj = get_user_by('login', $_REQUEST['s']);
                if (!empty($author_obj)) {
                    $user_id    = $author_obj->ID;
                }
            }
            $sql .= ' AND user_id=' . esc_sql($user_id);
        }
        //状态查询
        if ( isset( $_REQUEST['status'] ) && $_REQUEST['status']!='' ) {
            $status = absint($_REQUEST['status']);
            $sql .= ' AND status=' . esc_sql($status);
        }
        //订单类型 1文章 2会员
        if ( ! empty( $_REQUEST['order_type'] ) ) {
            $order_type = absint($_REQUEST['order_type']);
            $sql .= ' AND order_type=' . esc_sql($order_type);
        }
        $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'create_time' ;
        if ( ! empty( $orderby ) ) {
            $sql .= ' ORDER BY ' . esc_sql( $orderby );
            $sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' DESC';
        }

        $sql .= " LIMIT $per_page";
        $sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


        $result = $wpdb->get_results( $sql, 'ARRAY_A' );

        return $result;
    }

    private function table_data_count() {
        global $wpdb,$order_table_name,$aff_table_name,$down_table_name;

        $sql = "SELECT COUNT(*) FROM $order_table_name WHERE post_id>0 AND order_type=1";
        //根据用户查询
        if ( ! empty( $_REQUEST['s'] ) ) {
            $user_id = 0;
            if (is_numeric($_REQUEST['s'])) {
                $user_id = absint($_REQUEST['s']);
            } else {
                $author_obj = get_user_by('login', $_REQUEST['s']);
                if (!empty($author_obj)) {
                    $user_id    = $author_obj->ID;
                }
            }
            $sql .= ' AND user_id=' . esc_sql($user_id);
        }
        //状态查询
        if ( isset( $_REQUEST['status'] ) && $_REQUEST['status']!='' ) {
            $status = absint($_REQUEST['status']);
            $sql .= ' AND status=' . esc_sql($status);
        }
        //订单类型 1文章 2会员
        if ( ! empty( $_REQUEST['order_type'] ) ) {
            $order_type = absint($_REQUEST['order_type']);
            $sql .= ' AND order_type=' . esc_sql($order_type);
        }

        return $wpdb->get_var( $sql );
    }

    private function delete_table_data( $id ) {
        global $wpdb,$order_table_name,$aff_table_name,$down_table_name;
        $wpdb->delete(
            "$order_table_name",
            [ 'id' => $id ],
            [ '%d' ]
        );
    }

}