<?php
	function __autoload($class_name){
		require_once 'classes/' . $class_name . '.php';
	}
?>

<!DOCTYPE HTML>
<html land="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
   <title>CDRU OO</title>
  <meta name="description" content="PHP OO" />
  <meta name="robots" content="index, follow" />
   <meta name="author" content="Andrew Esteves"/>
   <link rel="stylesheet" href="css/bootstrap.css" />
  <link rel="stylesheet" />
  <!--[if lt IE 9]>
      <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
   <![endif]-->
</head>
<body>

	<div class="container">

		
		<header class="masthead">
			<h1 class="muted">Crud OO</h1>
			<nav class="navbar">
				<div class="navbar-inner">
					<div class="container">
						<ul class="nav">
							<li class="active"><a href="index.php">NOVO!</a></li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		
		<?php
		/***
		 * Primeiro bloco de codigos é para o Inserir
		 * esta separado pelas tags de php para ficar de facil entendimento,
		 * sei que é errado realizar esta forma de identação mas mas que fique
		 * de melhor entendimento optei por este tipo de identação.
		 */
		$usuario = new Usuarios();

		if(isset($_POST['cadastrar'])):

			$nome  = $_POST['nome'];
				if ($nome == "" or $nome ==" " ) {
					echo "O nome não pode ser em Branco.";
					die();
				}
		
			$email = $_POST['email'];
				if ($email == "" or $email==" ") {
					echo "O email nao pode ser em branco";
					die();
				}
			
			$msg = $_POST['msg'];
				if ($msg == "" or $email==" ") {
					echo "Mensagem nao pode ser em branco";
					die();
				}

			$usuario->setNome($nome);
			$usuario->setEmail($email);
			$usuario->setMsg($msg);

			# Insert
			if ($usuario->validaemail($email) !="1") {
				echo "Email Invalido!";
				die();
			} else {($usuario->insert());
					echo "Inserido com sucesso!";
			}
			

		endif;
		?>

		<?php 
		/***
		 * Segundo bloco de codigos, este pe para a ação atualizar
		 * ou editar.
		 */
		if(isset($_POST['atualizar'])):

			$id = $_POST['id'];
			$nome = $_POST['nome'];
				if ($nome == "" or $nome ==" ") {
					echo "O nome não pode ser em Branco.";
					die();
				}
			$email = $_POST['email'];
				if ($email == "" or $email==" ") {
					echo "O email nao pode ser em branco";
					die();
				}
			$msg = $_POST['msg'];
				if ($msg == "" or $msg==" ") {
					echo "Mensagem nao pode ser em branco";
					die();
				}

			$usuario->setNome($nome);
			$usuario->setEmail($email);
			$usuario->setMsg($msg);

			if ($usuario->validaemail($email) !="1") {
				echo "Email Invalido!";
				die();
			}else {($usuario->update($id));
				echo "Atualizado com sucesso!";
			}

		endif;
		?>

		<?php
		/***
		 * Ação deletar.
		 */
		if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):

			$id = (int)$_GET['id'];
			if($usuario->delete($id)){
				echo "Deletado com sucesso!";
			}

		endif;
		?>

		<?php
		/***
		 * Ação editar.
		 */
		if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

			$id = (int)$_GET['id'];
			$resultado = $usuario->find($id);
		?>

		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="msg" value="<?php echo $resultado->msg; ?>" placeholder="Mensagem:" />
			</div>
			<input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
			<br />
			<input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">					
		</form>

		<?php }else{ ?>


		<form method="post" action="">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
				<input type="text" name="nome" placeholder="Nome:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="email" placeholder="E-mail:" />
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
				<input type="text" name="msg" placeholder="Mensagem:" />
			</div>
			<br />
			<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">					
		</form>

		<?php } ?>

		<table class="table table-hover">
			
			<thead>
				<tr>
					<th>#</th>
					<th>Nome:</th>
					<th>E-mail:</th>
					<th>Mensagem:</th>
					<th>Ações:</th>
					
				</tr>
			</thead>
			
			<?php foreach($usuario->findAll() as $key => $value): ?>

			<tbody>
				<tr>
					<td><?php echo $value->id; ?></td>
					<td><?php echo $value->nome; ?></td>
					<td><?php echo $value->email; ?></td>
					<td><?php echo $value->msg; ?></td>
					<td>
						<?php echo "<a href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>
						<?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "'>Excluir</a>"; ?>
					</td>
				</tr>
			</tbody>

			<?php endforeach; ?>

		</table>

	</div>

<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>