<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<?= form_open("ocorrencia/tipo/$tipo->id/editar") ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="descricao">Nome</label>
					<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" required value="<?= set_value('descricao', $tipo->descricao); ?>"/>
					<?= form_error('descricao'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-right">
				<a href="<?= site_url('ocorrencia/tipo'); ?>" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary">Atualizar</button>
			</div>
		</div>
	<?= form_close() ?>
</div>