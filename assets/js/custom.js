
//Consoleからの記事削除
$('.delete').click(function(){
    if(!confirm('本当に削除しますか？')){
        /* キャンセルの時の処理 */
        return false;
    }else{
        // /*　OKの時の処理 */
        var articleId = $(this).attr("value");
        console.log('#'+articleId);
        deleteArticle(articleId);//選択された記事をデータベースから削除
         $('#'+articleId).remove();//選択された記事をmanagement.phpから削除//
    }
});



//記事削除
function deleteArticle(articleId){
	$.ajax({
          type: 'POST',
          url: "../controller/article.php",
           data: {
           			"manage": "delete",
                    "articleId": articleId
                },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("ajax通信に失敗しました");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        },
        })
          .done(function(data) {            
            
         }).fail(function(data) {                

         }).always(function(data) {                
            
         });   
}
