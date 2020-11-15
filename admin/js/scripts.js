$(document).ready(function(){

    // CKeditor - ADD POST/EDIT POST
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
        console.error( error );
    });


    // CHECKBOXS - VIEW ALL POST
    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }else{
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
    
});

var div_box = "<div id='load-screen'><div id='loading'></div></div>";
$("body").prepend(div_box);

$('#load-screen').delay(700).fadeOut(600, function(){
    $(this).remove();
});


// USERS ONLINE
function loadUsersOnline() {


	$.get("functions.php?onlineusers=result", function(data){

		$(".usersonline").text(data);


	});



}


setInterval(function(){

	loadUsersOnline();


},500);