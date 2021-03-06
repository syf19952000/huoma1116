$(function () {
    var project_id = $.url().param('id');
    if(typeof (project_id) == 'undefined'){
        project_id = 0;
    }
    $("#project_id").val(project_id);
    var data = {
        'act':'project_info'
    };
    data.id = project_id;
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/zhantai-edit-"+data.id+".html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            $("#title").val(res.detail.title);
            $("#cat_id").html(res.cate);
            if(res.detail.thumb!=''){
                $("#face").show().attr('src',res.detail.thumb);
            }
            $("#yuyan").val(res.detail.yuyan);
            $("#chajian").val(res.detail.chajian);
            $("#huanjing").val(res.detail.huanjing);
            $("#size").val(res.detail.size);
            $("#xingzhi").val(res.detail.xingzhi);
            $("#gurl").val(res.detail.gurl);
            $("#infourl").val(res.detail.infourl);
            $("#desc").val(res.detail.desc);
            $("#seo_keywords").val(res.detail.seo_keywords);
            $("#content").val(res.detail.content);
        },
        error: function (res) {
        }
    });

});
$(pageInit);
var editor;
function pageInit()
{
    var plugins={
        Code:{c:'btnCode',t:'插入代码',h:1,e:function(){
            var _this=this;
            var htmlCode='<div><select id="xheCodeType"><option value="html">HTML/XML</option><option value="js">Javascript</option><option value="css">CSS</option><option value="php">PHP</option><option value="java">Java</option><option value="py">Python</option><option value="pl">Perl</option><option value="rb">Ruby</option><option value="cs">C#</option><option value="c">C++/C</option><option value="vb">VB/ASP</option><option value="">其它</option></select></div><div><textarea id="xheCodeValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>';
            var jCode=$(htmlCode),jType=$('#xheCodeType',jCode),jValue=$('#xheCodeValue',jCode),jSave=$('#xheSave',jCode);
            jSave.click(function(){
                _this.loadBookmark();
                _this.pasteHTML('<pre class="prettyprint lang-'+jType.val()+'">'+_this.domEncode(jValue.val())+'</pre>');
                _this.hidePanel();
                return false;
            });
            _this.saveBookmark();
            _this.showDialog(jCode);
        }}
    };
    editor=$('#content').xheditor({
        upLinkUrl:LOCAL_URL+'/upload.php',
        upImgUrl:LOCAL_URL+'/upload.php',
        upFlashUrl:LOCAL_URL+'/upload.php',
        upMediaUrl:LOCAL_URL+'/upload.php',
        localUrlTest:/^https?:\/\/[^\/]*?(wordhuo\.com)\//i,
        remoteImgSaveUrl:LOCAL_URL+'/saveremoteimg.php',
        tools:'Bold,Italic,Underline,Strikethrough,|,Align,List,|,Link,Img,Code',
        plugins:plugins
    });
}

function submit_form(){
    if($('#title').val() == ''){
         $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入标题！</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
        return;
    }
    var data = new FormData($('#member_form')[0]);
    data.append("data[content]",$("#content").val());
    var project_id = $("#project_id").val();
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/zhantai-edit-"+project_id+".html",
        data: data,
        processData : false,
        contentType : false,
        dataType: 'JSON',
        success: function (res) {
            if(res.error == 0){
                window.location.href="member_project.html";
            }else{
                alert(res.message);
            }
        },
        error: function (res) {
        }
    });
}