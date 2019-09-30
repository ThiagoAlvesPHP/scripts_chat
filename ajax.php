<?php
require 'autoload.php';
$sql = new Chat();
$nicks = $sql->getUser();
$mensagens = $sql->getMensagens();

if (!empty($_POST['mensagem'])) {
	$post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$post['id_nick'] = $_SESSION['user']['id'];

	$sql->setMensagem($post);
	echo json_encode(true);
}

if (!empty($_POST['cad_logado'])): ?>
	<?php foreach($nicks as $n): ?>
		<?php $imgs = $sql->getImg($n['sexo']); ?>
		<img style="width: 40px;" src="<?=$imgs['img']; ?>" class="img-responsive">
		<i style="float: left;"><?=htmlspecialchars($n['nick']); ?></i>
		<hr>
	<?php endforeach; ?>
<?php endif; ?>
<!-- MENSAGENS ENVIADAS -->
<?php if (!empty($_POST['getMensagens'])): ?>
	<?php foreach($mensagens as $n): ?>
		<?php $imgs = $sql->getImg($n['sexo']); ?>
		<?php if($n['id_nick'] == $_SESSION['user']['id']): ?>
			<div class="row alert-danger">
		<?php else: ?>
			<div class="row">
		<?php endif; ?>
		<div class="col-sm-2">
					<img style="width: 30px;" src="<?=$imgs['img']; ?>" class="img-responsive">
					<i style="float: left;"><?=htmlspecialchars($n['nick']); ?></i>
				</div>
				<div class="col-sm-10">
					<textarea class="form-control" readonly=""><?=htmlspecialchars($n['mensagem']); ?></textarea>
				</div>
			</div>
		<hr>
	<?php endforeach; ?>
<?php endif; ?>

<?php if(!empty($_POST['qt'])): ?>
	<?=$nicks[0]['qt']; if($nicks[0]['qt'] == 1): echo ' Usuário'; else: echo ' Usuários'; endif; ?>
<?php endif; ?>