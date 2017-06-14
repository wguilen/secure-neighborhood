<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<?= form_open('ocorrencia/tipo/cadastrar') ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="descricao">Descrição</label>
					<input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" required value="<?= set_value('descricao'); ?>"/>
					<?= form_error('descricao'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-right">
				<a href="<?= site_url('ocorrencia/tipo'); ?>" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary">Cadastrar</button>
			</div>
		</div>
	<?= form_close() ?>
</div>