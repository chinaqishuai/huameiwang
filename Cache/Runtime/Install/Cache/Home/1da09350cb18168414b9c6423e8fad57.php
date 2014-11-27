<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Easy-Admin - Github</title>
    <link rel="stylesheet" href="/huameiwang/Public/stylesheets/install/install.css" />
</head>
<body>
    <div class="wrap">
        <div class="header">
    <h1 class="logo"><?php echo C('SYSTEM_NAME');?></h1>
    <div class="icon_install">安装向导</div>
    <div class="version">Version <?php echo C('SYSTEM_VERSION');?> by <?php echo C('AUTHOR_NAME');?></div>
</div>

        <div class="section">
            <div class="step">
    <ul>
        <li class="on"><em>1</em>检测环境</li>
        <li class="current"><em>2</em>创建数据</li>
        <li><em>3</em>完成安装</li>
    </ul>
</div>

<form id="J_install_form" action="<?php echo U('Install/installing');?>" method="POST">
    <input type="hidden" name="force" value="0" />
    <div class="server">
        <table width="100%">
            <tr>
                <td class="td1" width="100">数据库信息</td>
                <td class="td1" width="200">&nbsp;</td>
                <td class="td1">&nbsp;</td>
            </tr>
            <tr>
                <td class="tar">数据库服务器：</td>
                <td><input type="text" name="db[host]" id="dbhost" value="127.0.0.1" class="input"></td>
                <td><div id="J_install_tip_db_host"><span class="gray">数据库服务器地址，一般为localhost</span></div></td>
            </tr>
            <tr>
                <td class="tar">数据库端口：</td>
                <td><input type="text" name="db[port]" id="dbport" value="3306" class="input"></td>
                <td><div id="J_install_tip_db_port"><span class="gray">数据库服务器端口，一般为3306</span></div></td>
            </tr>
            <tr>
                <td class="tar">数据库用户名：</td>
                <td><input type="text" name="db[username]" id="dbuser" value="root" class="input"></td>
                <td><div id="J_install_tip_db_username"></div></td>
            </tr>
            <tr>
                <td class="tar">数据库密码：</td>
                <td><input type="text" name="db[password]" id="dbpw" value="" class="input" autoComplete="off" onblur="TestDbPwd()"></td>
                <td><div id="J_install_tip_db_password"></div></td>
            </tr>
            <tr>
                <td class="tar">数据库名：</td>
                <td><input type="text" name="db[name]" id="dbname" value="" class="input"></td>
                <td><div id="J_install_tip_db_name"></div></td>
            </tr>
            <tr>
                <td class="tar">数据库表前缀：</td>
                <td><input type="text" name="db[prefix]" id="dbprefix" value="ea_" class="input"></td>
                <td><div id="J_install_tip_db_prefix"><span class="gray">建议使用默认，同一数据库安装多个通用后台时需修改</span></div></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="td1" width="100">超级管理员信息</td>
                <td class="td1" width="200">&nbsp;</td>
                <td class="td1">&nbsp;</td>
            </tr>
            <tr>
                <td class="tar">登录邮箱：</td>
                <td><input type="text" name="admin[email]" class="input" value=""></td>
                <td><div id="J_install_tip_admin_email"><span class="gray">邮箱地址</span></div></td>
            </tr>
            <tr>
                <td class="tar">登录密码：</td>
                <td><input type="text" name="admin[password]" id="J_manager_pwd" class="input" autoComplete="off"></td>
                <td><div id="J_install_tip_admin_password"></div></td>
            </tr>
            <tr>
                <td class="tar">确认密码：</td>
                <td><input type="text" name="admin[confirm_password]" class="input" autoComplete="off"></td>
                <td><div id="J_install_tip_admin_confirm_password"></div></td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td class="td1" width="100">站点基本信息</td>
                <td class="td1" width="200">&nbsp;</td>
                <td class="td1">&nbsp;</td>
            </tr>
            <tr>
                <td class="tar">网站标题：</td>
                <td><input type="text" name="site[title]" class="input"></td>
                <td><div id="J_install_tip_site_title"></div></td>
            </tr>
            <tr>
                <td class="tar">网站关键字：</td>
                <td><input type="text" name="site[keyword]" class="input"></td>
            </tr>
            <tr>
                <td class="tar">网站描述：</td>
                <td><textarea name="site[description]" cols="30" rows="5" class="input"></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="webPath" value="/" />
        <div id="J_response_tips" style="display:none;"></div>
    </div>
    <div class="bottom tac"> <a href="<?php echo U('CheckEnv/index');?>" class="btn">上一步</a>
        <button type="submit" class="btn btn_submit J_install_btn">创建数据</button>
    </div>
</form>

<div  style="width:0;height:0;overflow:hidden;">
    <img src="/huameiwang/Public/images/install/pop_loading.gif">
</div>

<!-- js -->
<script src="/huameiwang/Public/javascripts/install/jquery.js?v=9.0"></script>
<script src="/huameiwang/Public/javascripts/install/validate.js?v=9.0"></script>
<script src="/huameiwang/Public/javascripts/install/ajaxForm.js?v=9.0"></script>

<script>

/**
 * 异步检测数据库密码是否正确
 * return void
 */
function TestDbPwd() {
    var dbHost = $('#dbhost').val();
    var dbUser = $('#dbuser').val();
    var dbPwd = $('#dbpw').val();
    var dbName = $('#dbname').val();
    var dbPort = $('#dbport').val();
    data = { 'db[host]':dbHost,
             'db[username]':dbUser,
             'db[password]':dbPwd,
             'db[port]':dbPort 
           };
    var url =  "<?php echo U('Install/checkDbConnect');?>";

    $.ajax({
        type: "POST",
        url: url,
        data: data,
        beforeSend: function() { },
        success: function(status) {
            if(!status){
                $('#dbpw').val("");
                $('#J_install_tip_db_password').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配置失败</span>');
            }
        },
        complete: function() {},
        error: function(){
            $('#J_install_tip_db_password').html('<span for="dbname" generated="true" class="tips_error" style="">数据库链接配置失败</span>');
            $('#dbpw').val("");
        }
    });
}

$(function() {
    var map = {
        'db[host]' : 'db_host',
        'db[port]' : 'db_port',
        'db[username]' : 'db_username',
        'db[password]' : 'db_password',
        'db[name]' : 'db_name',
        'db[prefix]' : 'db_prefix',
        'admin[email]' : 'admin_email',
        'admin[password]' : 'admin_password',
        'admin[confirm_password]' : 'admin_confirm_password',
        'site[title]' : 'site_title'
    }

    //聚焦时默认提示
    var focus_tips = {
        'db[host]' : '数据库服务器地址，一般为localhost',
        'db[port]' : '数据库服务器端口，一般为3306',
        'db[username]' : '',
        'db[password]' : '',
        'db[name]' : '',
        'db[prefix]' : '建议使用默认，同一数据库安装多个时需修改',
        'admin[email]' : '管理员登陆邮箱',
        'admin[password]' : '',
        'admin[confirm_password]' : '',
        'site[title]': ''
    };

    var install_form = $("#J_install_form"),
        //用户名表单
        reg_username = $('#J_reg_username'),
        //密码表单
        reg_password = $('#J_reg_password'),
        //密码提示区
        reg_tip_password = $('#J_reg_tip_password'),
        //后端返回提示
        response_tips = $('#J_response_tips');

    //validate插件修改了remote ajax验证返回的response处理方式；增加密码强度提示 passwordRank
    install_form.validate({
        //debug : true,
        //onsubmit : false,
        errorPlacement: function(error, element) {
            //错误提示容器
            $('#J_install_tip_'+ map[element[0].name]).html(error);
        },
        errorElement: 'span',
        //invalidHandler : , 未验证通过 回调
        //ignore : '.ignore' 忽略验证
        //onkeyup : true,
        errorClass: 'tips_error',
        validClass: 'tips_error',
        onkeyup: false,
        focusInvalid: false,
        rules: {
            'db[host]': {
                required: true
            },
            'db[port]': {
                required: true
            },
            'db[username]': {
                required: true
            },
            'db[name]': {
                required: true
            },
            'db[prefix]' : {
                required: true
            },
            'admin[email]': {
                required: true,
                email : true
            },
            'admin[password]': {
                required: true
            },
            'admin[confirm_password]': {
                required: true,
                equalTo : '#J_manager_pwd'
            },
            'site[title]': {
                required: true
            }
        },
        highlight: false,
        unhighlight: function(element, errorClass, validClass) {
            var tip_elem = $('#J_install_tip_'+ map[element.name]);

            tip_elem.html('<span class="'+ validClass +'" data-text="text"><span>');

        },

        // 获取焦点时显示的信息
        onfocusin: function(element){
            var name = element.name;
            $('#J_install_tip_'+ map[name]).html('<span data-text="text">'+ focus_tips[name] +'</span>');
            $('#J_install_tip_'+ name).hide();
            $(element).parents('tr').addClass('current');
        },

        // 
        onfocusout:  function(element){
            var _this = this;
            $(element).parents('tr').removeClass('current');

            if(map[element.name] === 'email') {
                //邮箱匹配点击后，延时处理
                setTimeout(function(){
                    _this.element(element);
                }, 150);
            }else{
                _this.element(element);
            }

        },

        messages: {
            'db[host]': {
                required: '数据库服务器地址不能为空'
            },
            'db[port]': {
                required: '数据库服务器端口不能为空'
            },
            'db[username]': {
                required: '数据库用户名不能为空'
            },
            'db[name]': {
                required: '数据库名不能为空'
            },
            'db[prefix]' : {
                required: '数据库表前缀不能为空'
            },
            'admin[email]': {
                required: '管理员帐号不能为空',
                email: '请输入正确的电子邮箱地址'
            },
            'admin[password]': {
                required: '密码不能为空'
            },
            'admin[confirm_password]': {
                required: '重复密码不能为空',
                equalTo: '两次输入的密码不一致。请重新输入'
            },
            'site[title]': {
                required: '站点标题不能为空'
            }
        },

        submitHandler:function(form) {
            form.submit();
            return true;
        }
    });

    var _data = {};
});
</script>

        </div>
    </div>
    <div class="footer"> &copy; 2014 
    <a href="https://github.com/happen-zhang/easy-admin" target="_blank">Easy-Admin</a>
</div>

</body>
</html>