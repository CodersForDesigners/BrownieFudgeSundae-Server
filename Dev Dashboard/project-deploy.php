<?php

/*
 *
 * This script deploys a project.
 *
 */

// Extract values from user input
$name = ! empty( $_POST[ 'name' ] ) ? $_POST[ 'name' ] : 'html';
if ( empty( $_POST[ 'repository' ] ) ) {
	die( 'Please provide a repository.' );
}
$repository = $_POST[ 'repository' ];
$commit = ! empty( $_POST[ 'commit' ] ) ? $_POST[ 'commit' ] : 'master';


// Construct command
$bash_command = "sudo ./project-deploy.sh ${name} ${repository} ${commit}";
// Execute the command
$command_output_last_line = exec( $bash_command );

// Respond back to user
if ( $command_output_last_line == 'okay doke.' ) {
	die( 'all good.' );
} else {
	die( 'something wen\'t wrong \n' );
}
