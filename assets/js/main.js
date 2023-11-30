$(document).ready(function(){
    //check
    if($("a.delete").length){
        $("a.delete").click(function(e){
            e.preeventDefault();
            if(confirm("Are you sure want to delete this item")){
                window.location.href = $(this).attr("href");
            }
        })
    }
});