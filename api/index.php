<?php
	require './vendor/autoload.php';
	require 'config.php';
	
	//custom libraries
	require 'lib/main.php';

	//app modules
	require 'modules/child.php';
	require 'modules/adopter.php';
	require 'modules/adoption.php';
	require 'modules/department_worker.php';
	require 'modules/sys_admin.php';
	
	//$app = new \Slim\App;
	$app = new \Slim\App(["settings" => $config]);
	
	//test api
	$app->get('/', 'welcome');

	//Child
	$app->post('/child/register', 'registerChild');	
	$app->get('/child', 'getAllChildren');
	$app->get('/child/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getChildById($id);
	});
	$app->post('/child/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateChild($id);
	});
	$app->delete('/child/delete/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return deleteChild($id);
	});

	//Adopter
	$app->post('/adopter/register', 'registerAdopter');	
	$app->get('/adopter', 'getAllAdopters');
	$app->get('/adopter/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getAdopterById($id);
	});
	$app->post('/adopter/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateAdopter($id);
	});
	$app->delete('/adopter/delete/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return deleteAdopter($id);
	});

	//Adoption
	$app->post('/adopt', 'adopt');	
	$app->get('/adoptions', 'getAllAdoptions');
	$app->get('/adoption/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return getAdoptionById($id);
	});
	$app->post('/adoption/update/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return updateAdoption($id);
	});
	$app->delete('/adoption/delete/{id}', function ($request, $response, $args){
		$id=(int)$args['id'];
		return deleteAdoption($id);
	});
	
		//department worker
		$app->post('/department_worker', 'registerDepartmentWorker');	
		$app->get('/department_worker', 'getAllDepartmentWorkers');
		$app->get('/department_worker/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return getDepartmentWorkerById($id);
		});
		$app->post('/department_worker/update/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return updateDepartmentWorker($id);
		});
		$app->delete('/department_worker/delete/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return deleteDepartmentWorker($id);
		});
		
	$app->post('/sys_admin', 'registerSysAdmin');	
	$app->get('/sys_admin/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return getSysAdminById($id);
	});
	$app->post('/sys_admin/update/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return updateSysAdmin($id);
	});
	$app->delete('/sys_admin/delete/{id}', function ($request, $response, $args){
			$id=(int)$args['id'];
			return deleteSysAdmin($id);
		});
	
	


	$app->run();