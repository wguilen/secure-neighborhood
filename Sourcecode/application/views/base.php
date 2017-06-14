<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>BairroSeguro</title>

	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-3.3.6/css/bootstrap.min.css'); ?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/bootstrap-3.3.6/css/bootstrap-theme.min.css'); ?>"/>
	<link rel="stylesheet" href="<?= base_url('assets/bairro-seguro/css/principal.css'); ?>"/>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="container-fluid">
	<?php $menuItem = isset($menuItem) ? $menuItem : '' ?>
	<div class="row">
		<div class="col-xs-12">
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Alternar navegação</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= base_url() ?>">BairroSeguro</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="<?= strcasecmp($menuItem, 'bairros') === 0 ? 'active' : '' ?>"><?= anchor('bairro', 'Bairros') ?></li>
						<li class="dropdown <?= strcasecmp($menuItem, 'ocorrencias') === 0 ? 'active' : '' ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ocorrências <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?= anchor('ocorrencia/tipo', 'Tipos') ?></li>
								<li><?= anchor('ocorrencia', 'Ocorrências') ?></li>
								<li class="divider"></li>
								<li><?= anchor('ocorrencia/relatorio', 'Relatório') ?></li>
							</ul>
						</li>
						<li class="dropdown <?= strcasecmp($menuItem, 'ferramentas') === 0 ? 'active' : '' ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ferramentas <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><?= anchor('ferramenta/exportarKML', 'Exportar KML') ?></li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<?= isset($title) ? ('<h3 class="page-title">' . $title . '</h3>') : '' ?>
			<?= isset($content) ? ('<div class="content">' . $content . '</div>') : '' ?>
		</div>
	</div>

	<script src="<?= base_url('assets/jquery-2.2.4/jquery-2.2.4.min.js') ?>"></script>
	<script src="<?= base_url('assets/bootstrap-3.3.6/js/bootstrap.min.js') ?>"></script>
</body>
</html>