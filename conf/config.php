<?php
use think\Env;

return [
    // 获取环境变量中的场景配置
    // 'app_status'         => \think\Env::get('app_status', 'dev'),
    'app_status'         => \think\Env::get('app_status'),
    'app_debug'          => true,
    'if_redis'           => false,   // 是否开启redis
    'url_route_on'       => true,           // 是否开启路由

    // 默认模块名
    'default_module'        => 'index',

    //验证码
    'captcha'  => [
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY',
        // 验证码字体大小(px)，根据所需进行设置验证码字体大小
        'fontSize' => 30,
        // 是否画混淆曲线
        'useCurve' => true,
        // 验证码图片高度，根据所需进行设置高度
        'imageH'   => '',
        // 验证码图片宽度，根据所需进行设置宽度
        'imageW'   => '',
        // 验证码位数，根据所需设置验证码位数
        'length'   => 4,
        // 验证成功后是否重置
        'reset'    => true
    ],

    'view_replace_str'  => [
        '__CSS__'       => '/static/index/css',
        '__JS__'        => '/static/index/js',
        '__IMG__'       => '/static/index/images',

        '__ACSS__'      => '/static/admin/css',
        '__AJS__'       => '/static/admin/js',
        '__AIMG__'      => '/static/admin/images',

        '__UPLOAD__'    => '/static/upload',
        '__PLUGIN__'    => '/static/plugin',
    ],

    'database' => [
        // 数据库类型
        'type'            => 'mysql',
        // 数据库连接DSN配置
        'dsn'             => '',
        // 服务器地址
        'hostname'        => '47.93.190.11',
        // 数据库名
        'database'        => 'amsth',
        // 数据库用户名
        'username'        => 'amsth',
        // 数据库密码
        'password'        => 'amsth',
        // 数据库连接端口
        'hostport'        => '3306',
        // 数据库连接参数
        'params'          => [],
        // 数据库编码默认采用utf8
        'charset'         => 'utf8',
        // 数据库表前缀
        'prefix'          => '',
        // 数据库调试模式
        'debug'           => true,
        // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        'deploy'          => 0,
        // 数据库读写是否分离 主从式有效
        'rw_separate'     => false,
        // 读写分离后 主服务器数量
        'master_num'      => 1,
        // 指定从服务器序号
        'slave_no'        => '',
        // 是否严格检查字段是否存在
        'fields_strict'   => true,
        // 数据集返回类型
        'resultset_type'  => 'array',
        // 自动写入时间戳字段
        'auto_timestamp'  => false,
        // 时间字段取出后的默认时间格式
        'datetime_format' => 'Y-m-d H:i:s',
        // 是否需要进行SQL性能分析
        'sql_explain'     => false,
    ],

    // 表名称
    'table_name' => [
        'user' => 'user',
    ],

    // 加密方式
    'encrypt_method' => 'md5',  // md5()  password_hash()
];
