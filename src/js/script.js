$(function(){

	//PESSOAS LOGADAS
	const cad_logado = '1';
    var logados = function(){
        $.ajax({
            url:'ajax.php',
            type:'POST',
            data:{cad_logado:cad_logado},
            success:function(data){
                $('.nicks').html(data);
            }
        });
    };

    setInterval(logados, 500);

    //MENSAGENS ENVIADAS
    const getMensagens = '1';
    var logados = function(){
        $.ajax({
            url:'ajax.php',
            type:'POST',
            data:{getMensagens:getMensagens},
            success:function(data){
                $('.chat').html(data);
            }
        });
    };

    setInterval(logados, 500);

    //QUANTIDADE DE USUARIOS LOGADOS
    const qt = 'qt';

    var qtlogados = function(){
        $.ajax({
            url:'ajax.php',
            type:'POST',
            data:{qt:qt},
            success:function(data){
                $('.qt_user').html(data);
            }
        });
    };

    setInterval(qtlogados, 500);

    $(document).on('click', '.btn-enviar', function(e){
    	e.preventDefault();

    	let mensagem = $('#mensagem').val();

    	$.ajax({
            url:'ajax.php',
            type:'POST',
            data:{mensagem:mensagem},
            success:function(data){
                $("#mensagem").val("");
            }
        });
    });
});