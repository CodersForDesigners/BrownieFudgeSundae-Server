<?php

?>

<!DOCTYPE html>
<html>

<head>

	<title>Dev</title>

	<style type="text/css">

		:root::before,
		:root,
		:root::after {
			box-sizing: border-box;
		}

		*::before,
		*,
		*::after {
			box-sizing: inherit;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: monospace;
		}

		.js_hidden {
			display: none;
		}

		.container-root {
			display: flex;
			height: 100vh;
			justify-content: center;
			align-items: center;
		}

		.layout-dashboard {
			/*display: grid;*/
			display: flex;
			width: 36vw;
			border: 1px dotted #272316;
			border-top: none;
			border-left: none;
			padding: 2rem;
			/*grid-template-columns: auto auto;*/
			/*grid-gap: 5rem;*/
			align-items: center;
			justify-content: space-between;
		}

		.page-heading {
			max-width: 150px;
			text-align: center;
		}

		.project_deploy {
			display: grid;
			/*width: 25vw;*/
			grid-template-columns: auto auto;
			grid-gap: 1rem;
		}

		.project_deploy label {
			text-align: right;
		}
		.project_deploy input {
			text-align: left;
		}

		.deploy-project {
			grid-column-start: 2;
			letter-spacing: 1px;
		}

	</style>

</head>

<body>

<div class="container-root">


	<div class="layout-dashboard">

		<h1 class="page-heading">Deploy Project</h1>

		<form class="project_deploy js_project_deploy">
			<label for="input_project_name">Project</label>
			<div class="container-input">
				<input id="input_project_name" type="text" name="project_name" placeholder='defaults to "html"'>
			</div>
			<label for="input_project_repository">Repository</label>
			<div class="container-input">
				<input id="input_project_repository" type="text" name="project_repository">
			</div>
			<label for="input_project_commit_hash">Commit</label>
			<div class="container-input">
				<input id="input_project_commit_hash" type="text" name="project_commit_hash" placeholder='defaults to "master"'>
			</div>
			<button class="deploy-project js_deploy_project_trigger" type="submit">Deploy</button>
		</form>

	</div>




</div>


	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">

		$( ".js_project_deploy" ).on( "submit", function ( event ) {

			event.preventDefault();

			var $form = $( event.target );

			// Extract values from form
			var name = $form.find( "[ name = project_name ]" ).val();
			var repository = $form.find( "[ name = project_repository ]" ).val();
			var commit = $form.find( "[ name = project_commit_hash ]" ).val();
			var data = {
				name,
				repository,
				commit
			};


			/* -----
			 * Make the request to the server
			 ----- */
			// Disable form inputs
			$form.find( "input, button" ).prop( "disabled", true );
			$form.find( ".js_deploy_project_trigger" ).text( "Deploying..." );
			$.ajax( {
				url: "project-deploy.php",
				method: "POST",
				data: data
			} )
				.done( function ( response ) {
					console.log( response );
					alert( response );
				} )
				.always( function () {
					$form.find( ".js_deploy_project_trigger" ).text( "Deploy" );
					$form.find( "input, button" ).prop( "disabled", false );
				} )

		} );

	</script>

</body>

</html>
