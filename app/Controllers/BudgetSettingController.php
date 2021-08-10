<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\BudgetHeader;
use App\Models\Department;
use App\Models\Notice;
use App\Models\Position;
use App\Models\UserModel;
use CodeIgniter\Model;

class BudgetSettingController extends BaseController
{
	public function __construct()
	{
		if (session()->get('type') == 2):
			echo view('auth/access_denieda');
			exit;
		endif;
		
		
		$this->department = new Department();
		$this->position = new Position();
		$this->notice = new Notice();
		$this->user = new UserModel();
		$this->budget = new Budget();
		$this->bh = new BudgetHeader();
		$this->bc = new BudgetCategory();
	}
	public function budget_setups()
	{
		
		if($this->request->getMethod() == 'post'):
			$this->validator->setRules( [
				'budget_title'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Enter Budget Title'
					]
				],
				
				'budget_year'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Enter Budget Year'
					]
				]
			]);
			if ($this->validator->withRequest($this->request)->run()):
				if($_POST['budget_status'] == 1):
					$check = $this->budget->where('budget_status', 1)->first();
				
					if(!empty($check)):
						$check['budget_status'] = 0;
					$id = $check['budget_id'];
					unset($check['budget_id']);
						
						
						try {
							$this->budget->where('budget_id', $id)
								->set($check)
								->update();
						} catch (\ReflectionException $e) {
						}
					endif;
				endif;
				
				if($_POST['budget_id']):
					
					$id = $_POST['budget_id'];
					unset($_POST['budget_id']);
					
					
					try {
						$this->budget->where('budget_id', $id)
							->set($_POST)
							->update();
						session()->setFlashData("action","action successful");
						return redirect()->to(base_url('/budget-setups'));
					} catch (\ReflectionException $e) {
						session()->setFlashData("action",$e->getMessage());
						return redirect()->to(base_url('/budget-setups'));
					}
				else:
					
					try {
						$this->budget->save($_POST);
						session()->setFlashData("action","action successful");
						return redirect()->to(base_url('/budget-setups'));
					} catch (\ReflectionException $e) {
						session()->setFlashData("action",$e->getMessage());
						return redirect()->to(base_url('/budget-setups'));
					}
				endif;
				
			else:
				$arr = $this->validator->getErrors();
				session()->setFlashData("errors",$arr);
				return redirect()->to(base_url('budget-setups'));
			
			endif;
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['budgets'] = $this->budget->findAll();
			return view('office/budget/budget', $data);
		endif;
		
		
	}
	
	
	public function budget_setup()
	{
		
		if($this->request->getMethod() == 'post'):
					$this->validator->setRules( [
						'budget_title'=>[
							'rules'=>'required',
							'errors'=>[
								'required'=>'Enter Budget Title'
							]
						],
						
						'budget_year'=>[
							'rules'=>'required',
							'errors'=>[
								'required'=>'Enter Budget Year'
							]
						]
					]);
					if ($this->validator->withRequest($this->request)->run()):
						if($_POST['budget_status'] == 1):
							$check = $this->budget->where('budget_status', 1)->first();
							$check['budget_status'] = 0;
							$this->budget->save($check);
						endif;
						
						$this->budget->save($_POST);
						session()->setFlashData("action","action successful");
						return redirect()->to(base_url('/budget-setups'));
					else:
							$arr = $this->validator->getErrors();
							session()->setFlashData("errors",$arr);
							return redirect()->to(base_url('budget-setups'));
						
					endif;
		
		endif;
		
		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['departments'] = $this->department->findAll();
			return view('office/budget/budget_setup', $data);
		endif;
		
		
	}
	
	public  function view_budget ($budget_id) {
	
		$check_budget = $this->budget->where('budget_id', $budget_id)->first();
		if($check_budget):
			$data['budget'] = $check_budget;
			$data['budget_headers'] = $this->bh->where('bh_budget_id', $budget_id)
												->join('departments', 'budget_headers.bh_office = departments.dpt_id')
												->findAll();
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			return view('office/budget/view_budget', $data);
			
			
			else:
				
				
				
				endif;
	
	}
	
	public function budget_categories(){
		if($this->request->getMethod() == 'post'):
			
			try {
				$this->bc->save($_POST);
				session()->setFlashData("action","action successful");
				return redirect()->to(base_url('/budget-categories'));
			} catch (\ReflectionException $e) {
				session()->setFlashData("action",$e->getMessage());
				return redirect()->to(base_url('/budget-categories'));
			
		}
		
		
		endif;

		if($this->request->getMethod() == 'get'):
			$data['firstTime'] = $this->session->firstTime;
			$data['username'] = $this->session->user_username;
			$data['categories'] = $this->bc->findAll();
			return view('office/budget/budget-category', $data);
		endif;
	}
}
