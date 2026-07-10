<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Prints extends CI_Controller {
  
//============================Print===========================//

//============================Print===========================//
public function stock_statement(){
  $dt = $this->Login_model->login_details();
  $dt['pagename'] = "Print Stock Statement";
  
  if ($this->session->userdata('user_type') == 4) {       /* Dukan Staff Panel */
  
    $dt['ds_id'] = shop_details('district_id');
    $dt['sp_id'] = $this->session->userdata('user_shop');
    $dt['sp_dt'] = $this->input->get('dt');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_stock_report($dt['sp_id'], $dt['sp_dt']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

    $view_page = 'admin_print_daily_stock_report';

  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */
  
    $dt['ds_id'] = $this->session->userdata('user_dist');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_stock_report($dt['sp_id'], $dt['sp_dt']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

    $view_page = 'admin_print_daily_stock_report';

  } else {                                                /* Admin Panel */


    $dt['ds_id'] = $this->input->get('ds');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_stock_report($dt['sp_id'], $dt['sp_dt']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

    $view_page = 'admin_print_daily_stock_report';
  }

  $this->load->view($view_page, $dt);
}


public function company_commission(){

  $dt['f_dt'] = $this->input->get('fd');
  $dt['t_dt'] = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['cm_id'] = $this->input->get('cm');
 /* if($this->input->get('cm')!=''){
    $companies = $this->Main_model->get_company($dt['cm_id']);
  }
  else{
    $companies = $this->Main_model->get_companies_list();
  }
  $dt['dist_list'] = $this->Main_model->get_district_list();
  
  $dt['companies_list'] = $this->Main_model->get_companies_list();

  $com = array(); 
  foreach($companies as $kk=>$company){
    $com[$kk]['company'] = $company;
    $com[$kk]['company_commision'] = $this->Report_model->get_company_commision($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt']);
    // $dt['purchases'] = $this->Main_model->purchase_orders_company_comission($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt']);
    $wines = $this->Main_model->all_wines_company_comission($company->m_company_id);
    $data = array();
    foreach($wines as $k=>$v){
      $data[$k]['wines'] = $v;
      $data[$k]['purchase'] = $this->Main_model->purchase_orders_company_comission($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt'],$v->m_wine_id);
      $data[$k]['company_commision_set'] = $this->User_model->company_commsion_set_wines($dt['ds_id'],$v->m_wine_id);
    }
    $com[$kk]['all_value'] = $data;
  }  
  $dt['all_values'] = $com;
  */

  $dt['f_dt'] = $this->input->get('fd');
  $dt['t_dt'] = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['cm_id'] = $this->input->get('cm');
  if($this->input->get('cm')!=''){
    $companies = $this->Main_model->get_company($dt['cm_id']);
  }
  else{
    $companies = $this->Main_model->get_companies_list();
  }
  $dt['dist_list'] = $this->Main_model->get_district_list();
  
  $dt['companies_list'] = $this->Main_model->get_companies_list();

  $com = array(); 
  foreach($companies as $kk=>$company){
    $com[$kk]['company'] = $company;
    $com[$kk]['company_commision'] = $this->Report_model->get_company_commision($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt']);
    // $dt['purchases'] = $this->Main_model->purchase_orders_company_comission($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt']);
    $wines = $this->Main_model->all_wines_company_comission($company->m_company_id);
    $data = array();
    foreach($wines as $k=>$v){
      $data[$k]['wines'] = $v;
      $data[$k]['purchase'] = $this->Main_model->purchase_orders_company_comission($dt['ds_id'],$company->m_company_id,$dt['f_dt'],$dt['t_dt'],$v->m_wine_id);
      $data[$k]['company_commision_set'] = $this->User_model->company_commsion_set_wines($dt['ds_id'],$v->m_wine_id);
    }
    $com[$kk]['all_value'] = $data;
  }  
  $dt['all_values'] = $com;

  
  $this->load->view('admin_print_company_commission', $dt);
}
public function daily_sheet(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Daily Sheet";
  
  if ($this->session->userdata('user_type') == 4) {       /* Shop Staff Panel */

    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (!empty($dt['sp_id'])){
      $shop_ids = $this->User_model->get_user_shop_ids($this->session->userdata('user_id'));
      if(!in_array($dt['sp_id'], $shop_ids)) $dt['sp_id'] = '';
    }
    
    $dt['shop_list'] = $this->User_model->user_get_shop_list();
    if (empty($dt['sp_id']) && !empty($dt['shop_list']))
      $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;
    else if (empty($dt['sp_id']))
      $dt['sp_id'] = $this->session->userdata('user_shop');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_sheet_report($dt['sp_id'], $dt['sp_dt']);

    $view_page = 'user_print_report_daily_sheet';

  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */

    $dt['ds_id'] = $this->session->userdata('user_dist');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (!empty($dt['sp_id']))
      $dt['sp_id'] = $this->Main_model->is_district_shop($dt['ds_id'], $dt['sp_id']);

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_sheet_report($dt['sp_id'], $dt['sp_dt']);
    $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);

    $view_page = 'duser_print_report_daily_sheet';

  } else {                                                /* Admin Panel */
  
    $dt['ds_id'] = $this->input->get('ds');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->get_daily_sheet_report($dt['sp_id'], $dt['sp_dt']);
    $dt['dist_list'] = $this->Report_model->get_district_list();
    $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);


    $view_page = 'admin_print_report_daily_sheet';
    
  }

  $this->load->view($view_page, $dt);
}

public function print_raid_reports(){
    $dt = $this->Login_model->login_details(97);
    $dt['ds_id'] =  $this->input->get('dist_id');
    $dt['type'] =  $this->input->get('type');
    $dt['pagename'] = "Checking/Raid List";

    // $dt['dist_list'] = $this->Report_model->get_district_list();
    $dt['dist_name'] =   $this->db->select('m_district_id, m_district_name')->where('m_district_id', $dt['ds_id'])->get('master_district_tbl')->row();

    $this->db->select('raid_district');
    $this->db->where('muser_id',$this->session->userdata('user_id'));
    $userdata = $this->db->get('master_users_tbl')->row();    
    $raid_district = $userdata->raid_district;    
    if($raid_district==null){
      $dt['dist_list'] =   array();
    }
    elseif($raid_district=='0'){
      $dt['dist_list'] =   $this->db->select('m_district_id, m_district_name')->order_by('m_district_name', 'ASC')->get('master_district_tbl')->result();
    }
    else{
      $dt['dist_list'] =   $this->db->select('m_district_id, m_district_name')->where('m_district_id', $raid_district)->get('master_district_tbl')->result();
    }


    $dt['all_shop'] = $this->Report_model->all_shop($dt['ds_id']);
    if(!empty($dt['type'])){
      if($dt['type']=='raid'){
        $dt['raid'] = $this->Main_model->admin_get_raid();
      }
      else{
        $dt['raid'] = array();
      }
      if($dt['type']=='checking'){    
        $dt['checking'] = $this->Main_model->admin_get_checking();
      }
      else{
        $dt['checking'] = array();
      }
      if($dt['type']=='shop_checking'){
        $dt['shop_checking'] = $this->Main_model->admin_get_shop_checking();
      }
      else{
        $dt['shop_checking'] = array();
      }
    }
    else{
      $dt['raid'] = $this->Main_model->admin_get_raid();
      $dt['checking'] = $this->Main_model->admin_get_checking();
      $dt['shop_checking'] = $this->Main_model->admin_get_shop_checking();
    }

    $this->load->view('checking_raid_print', $dt);
}


public function shop_to_cashbook(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Transfer Shop To Cashbook";

  $dt['f_dt'] = $this->input->get('fd');
  $dt['t_dt'] = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['td'])) $dt['t_dt'] = date("Y-m-t");
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; 

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
    $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id; 

  $dt['all_value'] = $this->Report_model->admin_get_shop_to_cash_book($dt['sp_id'], $dt['f_dt'], $dt['t_dt']);
  
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);


  $this->load->view('admin_print_report_shop_to_cashbook', $dt);
}

public function duty_purchase_stock_statement(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Per Day Stock Statement";
  
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['su_id'] = $this->input->get('su');
  $dt['sr_dt'] = $this->input->get('dt');
  $dt['pt'] = $this->input->get('pt');

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  $dt['supplier_list'] = $this->User_model->get_dist_supplier_list($dt['ds_id']);

  // $dt['all_value'] = $this->Report_model->get_purchase_duty_stock_statement($dt['ds_id'], $dt['sp_id'], $dt['su_id'], $dt['sr_dt']);
  $dt['all_value'] = $this->Report_model->get_purchase_duty_stock_statement_new($dt['ds_id'], $dt['sp_id'], $dt['su_id'], $dt['sr_dt'], $dt['pt']);
  
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

  $this->load->view('admin_prin_tduty_purchase_stock_statement', $dt);
}

public function new_duty_purchase_stock_statement_print(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Per Day Stock Statement";
  
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['su_id'] = $this->input->get('su');
  $dt['sr_dt'] = $this->input->get('dt');
  $dt['pt'] = $this->input->get('pt');

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  $dt['supplier_list'] = $this->User_model->get_dist_supplier_list($dt['ds_id']);

  //$dt['all_value'] = $this->Report_model->get_purchase_duty_stock_statement($dt['ds_id'], $dt['sp_id'], $dt['su_id'], $dt['sr_dt']);
  $dt['all_value'] = $this->Report_model->get_purchase_duty_stock_statement_new_new($dt['ds_id'], $dt['sp_id'], $dt['su_id'], $dt['sr_dt'], $dt['pt']);
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

  $this->load->view('admin_prin_tduty_purchase_stock_statement_new', $dt);
}

public function district_duty_purchase(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Per Day Stock Statement";
  
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['su_id'] = $this->input->get('su');
  $dt['sr_dt'] = $this->input->get('dt');
  $dt['pt'] = $this->input->get('pt');

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  $dt['supplier_list'] = $this->User_model->get_dist_supplier_list($dt['ds_id']);

  $dt['all_value'] = $this->Report_model->get_district_purchase_duty_shopgroup($dt['ds_id'], $dt['sp_id'], $dt['su_id'], $dt['sr_dt'], $dt['pt']);
  
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  $dt['district_name'] = $this->db->select('m_district_name')->where('m_district_id', $dt['ds_id'])->get('master_district_tbl')->row()->m_district_name;

  $this->load->view('admin_prin_tduty_district_purchase', $dt);
}

public function admin_print_malikan_report(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Malikan Report";

  $dt['f_dt']  = $this->input->get('fd');
  $dt['t_dt']  = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['mk_id'] = $this->input->get('mk');

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; 

  $dt['dist_dt'] = district_details('date', $dt['ds_id']);

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01", strtotime($dt['dist_dt']));
  if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['malikan_list'] = $this->Report_model->get_dist_malikan($dt['ds_id']);
  if(empty($dt['malikan_list'])) $dt['mk_id'] = '';
  $all_value = array();
  foreach($dt['malikan_list'] as $k=>$v){
    $all_value[$k]['malikan'] = $v;
    $all_value[$k]['value'] = $this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $v->m_malikan_id);
  }
  $dt['all_value2']=$all_value;

  $dt['all_value']=$this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $dt['mk_id']);

  // $dt['all_value']=$this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $dt['mk_id']);
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

  //echo "<pre>";print_r($dt['all_value']); echo "</pre>"; exit(0);

  $this->load->view('admin_print_malikan_report', $dt);
}

public function admin_print_district_malikan_report(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Malikan Report";

  $dt['f_dt']  = $this->input->get('fd');
  $dt['t_dt']  = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['mk_id'] = $this->input->get('mk');

  $dt['dist_list'] = $this->Main_model->get_district_list();
  // if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
  //   $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; 

  $dt['dist_dt'] = district_details('date', $dt['ds_id']);

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01", strtotime($dt['dist_dt']));
  if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  // $dt['malikan_list'] = $this->Report_model->get_dist_malikan($dt['ds_id']);
  // if(empty($dt['malikan_list'])) $dt['mk_id'] = '';

  // $dt['all_value']=$this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $dt['mk_id']);
  // if(empty($dt['malikan_list'])) $dt['mk_id'] = '';

  $malikan_list = $this->Report_model->get_dist_malikan($dt['ds_id']);
  $data = array();
  foreach ($malikan_list as $k => $v) {
    $data[$k]['malikan'] = $v;
    $data[$k]['all_value'] = $this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $v->m_malikan_id);
  }
  $dt['all_value'] = $data;
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

  //echo "<pre>";print_r($dt['all_value']); echo "</pre>"; exit(0);

  $this->load->view('admin_print_district_malikan_report', $dt);
}
//===========================/Print===========================//

//============================Print===========================//
public function profit_loss(){
  $dt = $this->Login_model->login_details(49);
  $id = $this->input->get('id');
  if($id!=''){
    $dt['all_value'] = $this->Main_model->get_profit_loss_single($id);
    $view_page = 'admin_print_report_profit_loss';
    $this->load->view($view_page, $dt);
  }
  else{
    return redirect (base_url('Report/profit_loss')); 
  }
}

public function approved_order(){

  $dt = $this->Login_model->login_details(20);
  $dt['pagename'] = "Approved Order";
  $dt['or_id']  = $this->input->get('or');
  $dt['wt_id']  = $this->input->get('wt');
  $dt['wine_types'] = $this->Main_model->get_wine_type();
  $dt['return_link'] = 'Order';
  $dt['a_value'] = $this->Main_model->get_approve_order_details($dt['or_id']);
  // printData($dt['a_value']);

  if(empty($dt['a_value'])) return redirect(site_url($dt['return_link']));
  $dt['part_list'] = $this->Main_model->get_pd_part_list($dt['a_value'][0]->t_odr_duty_part);
  $dt['shop_duty'] = $this->User_model->get_a_part_shop_duty($dt['a_value'][0]->t_order_shop, $dt['part_list'][0]->part);

  $dt['all_value2']= $this->Main_model->get_order_wines_type_dtl($dt['or_id']);
  $dt['all_value'] = $this->Main_model->get_all_order_items2($dt['or_id'], $dt['wt_id']);
  // $dt['duty_pmt'] = $this->Main_model->admin_duty_payment_month_wise_order_direct($dt['a_value'][0]->t_order_shop, $dt['part_list'][0]->part);
  $dt['duty_set_amt'] = $this->Main_model->get_total_duty_set($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['duty_paid_amt'] = $this->Main_model->get_total_duty_paid($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['approve_duty_amt'] = $this->Main_model->get_total_approve_duty($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['get_duty_adjustment'] = $this->db->select('duty_adjustment_value')->where('m_shop_id', $dt['a_value'][0]->t_order_shop)->get('master_shop_tbl')->row()->duty_adjustment_value;
    if($dt['get_duty_adjustment']!=null){
      $dt['adjustment_value'] = $dt['get_duty_adjustment'];
    }else{
      $dt['adjustment_value'] = 0;
    }
  $view_page = 'admin_print_order_approve_details';
  $this->load->view($view_page, $dt);
}


public function vip_approved_order(){

  $dt = $this->Login_model->login_details(20);
  $dt['pagename'] = "Approved Order";
  $dt['or_id']  = $this->input->get('or');
  $dt['wt_id']  = $this->input->get('wt');
  $dt['wine_types'] = $this->Main_model->get_wine_type();
  $dt['return_link'] = 'VipApprove';
  $dt['a_value'] = $this->Main_model->get_vip_approve_order_details($dt['or_id']);
  // printData($dt['a_value']);

  if(empty($dt['a_value'])) return redirect(site_url($dt['return_link']));
  $dt['part_list'] = $this->Main_model->get_pd_part_list($dt['a_value'][0]->t_odr_duty_part);
  $dt['shop_duty'] = $this->User_model->get_a_part_shop_duty($dt['a_value'][0]->t_order_shop, $dt['part_list'][0]->part);

  $dt['all_value2']= $this->Main_model->get_vip_order_wines_type_dtl($dt['or_id']);
  $dt['all_value'] = $this->Main_model->get_all_vip_order_items2($dt['or_id'], $dt['wt_id']);
  // $dt['duty_pmt'] = $this->Main_model->admin_duty_payment_month_wise_order_direct($dt['a_value'][0]->t_order_shop, $dt['part_list'][0]->part);
  $dt['duty_set_amt'] = $this->Main_model->get_total_duty_set($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['duty_paid_amt'] = $this->Main_model->get_vip_total_duty_paid($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['approve_duty_amt'] = $this->Main_model->get_total_approve_vip_duty($dt['a_value'][0]->t_order_shop,$dt['a_value'][0]->t_order_date);
  $dt['get_duty_adjustment'] = $this->db->select('duty_adjustment_value')->where('m_shop_id', $dt['a_value'][0]->t_order_shop)->get('master_shop_tbl')->row()->duty_adjustment_value;
    if($dt['get_duty_adjustment']!=null){
      $dt['adjustment_value'] = $dt['get_duty_adjustment'];
    }else{
      $dt['adjustment_value'] = 0;
    }
  $view_page = 'admin_print_order_vip_approve_details';
  $this->load->view($view_page, $dt);
}

public function purchased_order(){
  $dt = $this->Login_model->login_details(34);
  $dt['pagename'] = "Purchase Details";
  
  $dt['return_link'] = 'Purchase';
  $dt['or_id']  = $this->input->get('or');

  $dt['a_value'] = $this->Main_model->get_order_purchased_details($dt['or_id']);
  if(empty($dt['a_value'])) return redirect(site_url($dt['return_link']));

  $dt['all_value2']= $this->Main_model->get_order_wines_type_dtl($dt['or_id']);

  $dt['suppliers'] = $this->Main_model->get_order_items_supplier($dt['or_id']);
  $dt['all_value'] = $this->Main_model->get_order_purchased_items($dt['or_id']);
  $dt['wine_types']= $this->Main_model->get_wine_type();

  $view_page = 'admin_print_order_purchase_details';

  $this->load->view($view_page, $dt);
}


public function cash_book_summary(){
  $dt = $this->Login_model->login_details(); /* nav_id=4 */
  
  if ($this->session->userdata('user_type') == 4) { /* Shop Staff Panel */

    $dt['is_summary'] = 1;
    $dt['sp_id'] = $this->session->userdata('user_shop');
    $dt['cb_dt'] = shop_details('date');
    $dt['ds_id'] = shop_details('district_id');
    
    if ($dt['is_summary'] == 1) {
    
      if(empty($dt['cb_dt'])){ $dt['cb_dt'] = date("Y-m-d"); }else{
        $dt['cb_dt'] = date("Y-m-d", strtotime('-1 day', strtotime($dt['cb_dt'])));
      }

      $dt['sold_items']    = $this->Main_model->admin_get_shop_sold_wines_dtl($dt['sp_id'], $dt['cb_dt']);
      $dt['brkg_items']    = $this->Main_model->admin_get_shop_breakage_wines_dtl($dt['sp_id'], $dt['cb_dt']);

      $dt['aahata_amt'] = $this->Main_model->admin_get_shop_aahata($dt['sp_id'], $dt['cb_dt']);
      $dt['item_transfer'] = $this->Main_model->admin_get_shop_transfered_list($dt['sp_id'], $dt['cb_dt']);
      $dt['item_receive']  = $this->Main_model->admin_get_shop_tr_received_list($dt['sp_id'], $dt['cb_dt']);
      $dt['free_sale']     = $this->User_model->admin_get_all_free_sale_transaction($dt['sp_id'], $dt['cb_dt']);
      $dt['expense_sum']   = $this->Main_model->admin_get_shop_expense_sum($dt['sp_id'], $dt['cb_dt']);
      $dt['shop_expense']  = $this->Main_model->admin_get_shop_expense2($dt['sp_id'], $dt['cb_dt']);
      $dt['shop_ec']    = $this->User_model->admin_get_shop_all_entry_commision2($dt['sp_id'], $dt['cb_dt']);
      $dt['agent_ec']   = $this->User_model->admin_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);
      $dt['vip_ec']     = $this->User_model->admin_get_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);

      $dt['cash_book']  = $this->Main_model->admin_get_day_cash_book($dt['sp_id'], $dt['cb_dt']);

      $dt['shop_hologram']    = $this->Main_model->admin_get_shop_hologram($dt['sp_id'], $dt['cb_dt']);

      $ser_date = $this->input->get('dt');
      $dt['all_hologram']     = $this->Main_model->get_all_hologram($dt['sp_id'],$ser_date);

      $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
      $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

      $this->load->view('user_print_shop_cashbook_summary', $dt);

    }
    
  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */

      
      $dt['is_summary'] = $this->input->get('sm');
      $dt['ds_id'] = $this->session->userdata('user_dist');
      $dt['sp_id'] = $this->input->get('sp');
      $dt['cb_dt'] = $this->input->get('dt');
      
      $dt['shop_list'] = $this->Main_model->get_district_shop_list($dt['ds_id']);
      if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
        $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;

        $dt['sp_dt'] = ($dt['sp_id'])? shop_details('date', $dt['sp_id']) : '';
    
    if ($dt['is_summary'] == 1) { $dt['pagename'] = "Dukan Cash Book Summary";
    
      if(empty($dt['cb_dt'])){ $dt['cb_dt'] = date("Y-m-d"); }
      else { $dt['cb_dt'] = date("Y-m-d", strtotime($dt['cb_dt'])); }

      $dt['sold_items']    = $this->Main_model->admin_get_shop_sold_wines_dtl($dt['sp_id'], $dt['cb_dt']);
      $dt['brkg_items']    = $this->Main_model->admin_get_shop_breakage_wines_dtl($dt['sp_id'], $dt['cb_dt']);

      $dt['aahata_amt']    = $this->Main_model->admin_get_shop_aahata($dt['sp_id'], $dt['cb_dt']);
      $dt['item_transfer'] = $this->Main_model->admin_get_shop_transfered_list($dt['sp_id'], $dt['cb_dt']);
      $dt['item_receive']  = $this->Main_model->admin_get_shop_tr_received_list($dt['sp_id'], $dt['cb_dt']);
      $dt['free_sale']     = $this->User_model->admin_get_all_free_sale_transaction($dt['sp_id'], $dt['cb_dt']);
      $dt['expense_sum']   = $this->Main_model->admin_get_shop_expense_sum($dt['sp_id'], $dt['cb_dt']);
      $dt['shop_expense']  = $this->Main_model->admin_get_shop_expense2($dt['sp_id'], $dt['cb_dt']);
      $dt['shop_ec']    = $this->User_model->admin_get_shop_all_entry_commision2($dt['sp_id'], $dt['cb_dt']);
      $dt['agent_ec']   = $this->User_model->admin_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);
      $dt['vip_ec']     = $this->User_model->admin_get_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);

      $dt['cash_book']  = $this->Main_model->admin_get_day_cash_book($dt['sp_id'], $dt['cb_dt']);
      $dt['district_hologram']  = $this->Main_model->admin_get_district_hologram($dt['ds_id']);
      
      $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
      $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

      $ser_date = $this->input->get('dt');
      $dt['all_hologram']     = $this->Main_model->get_all_hologram($dt['sp_id'],$ser_date);

      $this->load->view('duser_print_shop_cashbook_summary', $dt);
    }


  } else {                                           /* Admin Panel */
    
    $dt['is_summary'] = $this->input->get('sm');
    $dt['ds_id'] = $this->input->get('ds');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['cb_dt'] = $this->input->get('dt');
    
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
    
    $dt['shop_list'] = $this->Main_model->get_district_shop_list($dt['ds_id']);
    if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
      $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;

      $dt['sp_dt'] = ($dt['sp_id'])? shop_details('date', $dt['sp_id']) : '';
  
  if ($dt['is_summary'] == 1) {
    if(empty($dt['cb_dt'])){ $dt['cb_dt'] = date("Y-m-d"); }
    else { $dt['cb_dt'] = date("Y-m-d", strtotime($dt['cb_dt'])); }

    $dt['sold_items']    = $this->Main_model->admin_get_shop_sold_wines_dtl($dt['sp_id'], $dt['cb_dt']);
    $dt['brkg_items']    = $this->Main_model->admin_get_shop_breakage_wines_dtl($dt['sp_id'], $dt['cb_dt']);
    
    $dt['aahata_amt']    = $this->Main_model->admin_get_shop_aahata($dt['sp_id'], $dt['cb_dt']);
    $dt['item_transfer'] = $this->Main_model->admin_get_shop_transfered_list($dt['sp_id'], $dt['cb_dt']);
    $dt['item_receive']  = $this->Main_model->admin_get_shop_tr_received_list($dt['sp_id'], $dt['cb_dt']);
    $dt['free_sale']     = $this->User_model->admin_get_all_free_sale_transaction($dt['sp_id'], $dt['cb_dt']);
    $dt['expense_sum']   = $this->Main_model->admin_get_shop_expense_sum($dt['sp_id'], $dt['cb_dt']);
    $dt['shop_expense']  = $this->Main_model->admin_get_shop_expense2($dt['sp_id'], $dt['cb_dt']);
    $dt['shop_ec']    = $this->User_model->admin_get_shop_all_entry_commision2($dt['sp_id'], $dt['cb_dt']);
    $dt['agent_ec']   = $this->User_model->admin_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);
    $dt['vip_ec']     = $this->User_model->admin_get_agent_all_entry_commision($dt['sp_id'], $dt['cb_dt']);
    $dt['cash_book']  = $this->Main_model->admin_get_day_cash_book($dt['sp_id'], $dt['cb_dt']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

    $dt['shop_hologram']    = $this->Main_model->admin_get_shop_hologram($dt['sp_id'], $dt['cb_dt']);

    $ser_date = $dt['cb_dt'];
    $dt['all_hologram']     = $this->Main_model->get_all_hologram($dt['sp_id'],$ser_date);

    $this->load->view('admin_print_dashboard_cbook_summary', $dt);

  } }
}

public function dist_cashbook(){
  $dt = $this->Login_model->login_details(); /* nav_id=4 */
  $dt['pagename'] = "Dashboard";
  
  if ($this->session->userdata('user_type') == 4) {       /* Dukan Staff Panel */
    
  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */

    $dt['f_dt'] = $this->input->get('fd');
    $dt['t_dt'] = $this->input->get('td');
    $dt['dist_dt'] = district_details('date');
    $dt['dist_id'] = $this->session->userdata('user_dist');
		$dt['sp_id']     = $this->input->get('sp');
    if(!isset($_GET['fd'])) $dt['f_dt'] = $dt['dist_dt'];
    if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
  
    if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
      if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
    }

    $dt['raid'] = $this->Main_model->duser_get_raid($dt['dist_id'],$dt['f_dt']);
    $dt['checking'] = $this->Main_model->duser_get_checking($dt['dist_id'],$dt['f_dt']);
    $dt['shop_checking'] = $this->Main_model->duser_get_shop_checking($dt['dist_id'],$dt['f_dt']);
    $dt['all_value_subgroup'] = $this->User_model->dist_get_subgroup_payment2($dt['f_dt']);

    // $dt['all_value']    = $this->User_model->dist_get_cash_book_list($dt['f_dt'], $dt['t_dt']);
    $all_value = array();
    $all_shopgroup = $this->Main_model->get_all_shopgroup($dt['dist_id']);
    foreach ($all_shopgroup as $k => $v) {
      $all_value[$k]['shopgroup'] = $v;
      $all_value[$k]['value'] = $this->User_model->dist_get_cash_book_list($v->shopgroup_id, $dt['f_dt'], $dt['t_dt']);
    }
    $dt['all_value'] = $all_value;

    $dt['ds_id'] = $this->session->userdata('user_dist');
    $duty_pmt = array();
    foreach ($all_shopgroup as $k => $v) {
      $duty_pmt[$k]['shopgroup'] = $v;
      $duty_pmt[$k]['value'] = $this->User_model->admin_get_cash_book_duty_payment($dt['ds_id'],$v->shopgroup_id,$dt['f_dt'],$dt['t_dt']);
    }
    $dt['duty_pmts'] = $duty_pmt;
    // $dt['duty_pmts'] = $this->User_model->dist_get_cash_book_duty_payment($dt['f_dt'], $dt['t_dt']);
    $dt['purchase_pmt'] = $this->User_model->dist_cbook_purchase_pmt($dt['f_dt'], $dt['t_dt']);
    $dt['salary_pmt']   = $this->User_model->dist_cbook_salary_pmt($dt['f_dt'], $dt['t_dt']);
    $dt['sgroup_pmt']   = $this->User_model->dist_cbook_sgroup_pmt($dt['f_dt'], $dt['t_dt']);
    $dt['malikan_DR']   = $this->User_model->dist_cbook_malikan_entry($dt['f_dt'], $dt['t_dt'], 'DR');
    $dt['malikan_CR']   = $this->User_model->dist_cbook_malikan_entry($dt['f_dt'], $dt['t_dt'], 'CR');
    // $dt['malikan_DR']   = $this->User_model->dist_cbook_malikan_entry($dt['f_dt'], $dt['t_dt'], 'DR');
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['dist_id']);
    // $dt['dist_id'] = $this->Report_model->get_dist_name_by_id($dt['dist_id']);
    $dt['dist_hologram'] = $this->Main_model->admin_get_district_holograms($dt['dist_id'],$dt['dist_dt']);
    $dt['district_hologram'] = $this->Main_model->get_all_dist_hologram($dt['dist_id']);
    // $dt['vip_ec']   = $this->Report_model->admin_get_agent_all_entry_commision_new($dt['sp_id'], $dt['cb_dt']);
    // $dt['brkg_items']    = $this->Report_model->admin_get_shop_breakage_wines_dtl_new($dt['ds_id'], $dt['sp_dt']);
    // $dt['aahata_amt']    = $this->Main_model->admin_get_shop_aahata($dt['sp_id'], $dt['cb_dt']);

    $shop_list = $this->Main_model->get_shop_list();
    $duty = array();
    foreach($shop_list as $k=>$v){
      $duty[$k]['shop'] = $v;
      $a_value = $this->Main_model->get_last_order_details($v->m_shop_id);
      if(!empty($a_value)){
        $part_list = $this->Main_model->get_pd_part_list(Date('Y-m-d'));
        // $part_list = $this->Main_model->get_pd_part_list($a_value->t_order_date);
        $part = array();
        foreach($part_list as $kk=>$vv){
          $part[$kk]['part'] = $vv;
          // $part[$kk]['duties'] = $this->Main_model->duty_payment_month_wise_order($v->m_shop_id,$vv->part);
          $part[$kk]['duty_set_amt'] = $this->Main_model->get_total_duty_set($v->m_shop_id,$vv->part);
          $part[$kk]['duty_paid_amt'] = $this->Main_model->get_total_duty_paid($v->m_shop_id,$vv->part);
          $part[$kk]['approve_duty_amt'] = $this->Main_model->get_total_approve_duty($v->m_shop_id,$vv->part);
          $part[$kk]['t_order_duty'] = $a_value->t_order_duty;
        }
        $duty[$k]['part_list'] = $part;
      }
      else{
        $duty[$k]['part_list'] = array();
      }
    }
    $dt['duties'] = $duty;
    $shop_balance = "";
    foreach ($shop_list as $ki => $vi) {
      $shop_balance .= $this->Report_model->shop_purchase_balance($vi->m_shop_id,Date('Y-m-d',strtotime($dt['f_dt'].'-1 month')),$dt['f_dt'],$vi->m_shop_name);
    }
    $dt['shop_balance'] = $shop_balance;
	  if($this->input->get('session')!=null){
        $dt['session']     = $this->input->get('session');
    }else{
        $dt['session'] = $this->db->select('session_id')->where('attendance_status', 1)->get('master_session_tbl')->row()->session_id;
    }
    $dt['atn_status'] = $this->User_model->admin_get_attendance_status($dt['ds_id'], $dt['f_dt']);
    $dt['all_values'] = $this->User_model->admin_get_all_shop_users($dt['ds_id'], $dt['sp_id']);
    $dt['all_val_2'] = $this->User_model->admin_get_all_dist_users($dt['ds_id']);
    $dt['date_atns'] = $this->User_model->admin_get_staff_attendance($dt['ds_id'], $dt['f_dt'], $dt['session']);
	
    $dt['company_comission'] = $this->Report_model->get_district_company_comission_details($dt['f_dt'], $dt['t_dt'], $dt['dist_id']);
    $dt['from_district_transfer']   = $this->User_model->from_district_transfer($dt['f_dt'], $dt['t_dt'], 'CR');
    $dt['to_district_transfer']   = $this->User_model->to_district_transfer($dt['f_dt'], $dt['t_dt'], 'CR');
    $this->load->view('duser_print_dist_cashbook', $dt);

  } else {                                                /* Admin Panel */

    
    $dt['f_dt'] = $this->input->get('fd');
    $dt['t_dt'] = $this->input->get('td');
    $dt['ds_id'] = $this->input->get('ds');
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; 

    $dt['dist_dt'] = district_details('date', $dt['ds_id']);

    if(!isset($_GET['fd'])) $dt['f_dt'] = $dt['dist_dt'];
    if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
    
    if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
      if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
    }

    // $dt['all_value']    = $this->User_model->admin_get_cash_book_list($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);

    $all_value = array();
    $all_shopgroup    = $this->Main_model->get_all_shopgroup($dt['ds_id']);
    foreach ($all_shopgroup as $k => $v) {
      $all_value[$k]['shopgroup'] = $v;
      $all_value[$k]['value'] = $this->User_model->admin_get_cash_book_list($dt['ds_id'],$v->shopgroup_id, $dt['f_dt'], $dt['t_dt']);
    }
    $dt['all_value'] = $all_value;
    foreach ($all_shopgroup as $k => $v) {
      $duty_pmt[$k]['shopgroup'] = $v;
      $duty_pmt[$k]['value'] = $this->User_model->admin_get_cash_book_duty_payment($dt['ds_id'],$v->shopgroup_id,$dt['f_dt'],$dt['t_dt']);
    }
    $dt['duty_pmts'] = $duty_pmt;

    // $dt['duty_pmts'] = $this->User_model->admin_get_cash_book_duty_payment($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);
    $dt['purchase_pmt'] = $this->User_model->admin_cbook_purchase_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['salary_pmt']   = $this->User_model->admin_cbook_salary_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['sgroup_pmt']   = $this->User_model->admin_cbook_sgroup_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['malikan_DR'] = $this->User_model->admin_cbook_malikan_entry($dt['ds_id'],$dt['f_dt'],$dt['t_dt'],'DR');
    $dt['malikan_CR'] = $this->User_model->admin_cbook_malikan_entry($dt['ds_id'],$dt['f_dt'],$dt['t_dt'],'CR');

    $dt['from_district_transfer']   = $this->User_model->from_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    $dt['to_district_transfer']   = $this->User_model->to_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    
    
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

    $this->load->view('admin_print_dist_cashbook', $dt);
  }
}

	public function printDistrictCashbook(){
		$dt['f_dt'] = $this->input->get('fd');
		$dt['t_dt'] = $this->input->get('td');
		$dt['dist_dt'] = district_details('date');
		$dt['dist_id'] = $this->session->userdata('user_dist');

		if(!isset($_GET['fd'])) $dt['f_dt'] = $dt['dist_dt'];
		if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
		if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
			if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
		}


		$all_value = array();
		$all_shopgroup = $this->Main_model->get_all_shopgroup($dt['dist_id']);
		foreach ($all_shopgroup as $k => $v) {
		  $all_value[$k]['shopgroup'] = $v;
		  $all_value[$k]['value'] = $this->User_model->dist_get_cash_book_list($v->shopgroup_id, $dt['f_dt'], $dt['t_dt']);
		}
		$dt['all_value'] = $all_value;

		// $dt['all_value']    = $this->User_model->dist_get_cash_book_list($dt['f_dt'], $dt['t_dt']);
		$dt['ds_id'] = $this->session->userdata('user_dist');
		$duty_pmt = array();
		foreach ($all_shopgroup as $k => $v) {
		  $duty_pmt[$k]['shopgroup'] = $v;
		  $duty_pmt[$k]['value'] = $this->User_model->admin_get_cash_book_duty_payment($dt['ds_id'],$v->shopgroup_id,$dt['f_dt'],$dt['t_dt']);
		}
		$dt['duty_pmts'] = $duty_pmt;
		// $dt['duty_pmts']    = $this->User_model->dist_get_cash_book_duty_payment($dt['f_dt'], $dt['t_dt']);

		$dt['purchase_pmt'] = $this->User_model->dist_cbook_purchase_pmt($dt['f_dt'], $dt['t_dt']);

		$dt['salary_pmt']   = $this->User_model->dist_cbook_salary_pmt($dt['f_dt'], $dt['t_dt']);

		$dt['sgroup_pmt']   = $this->User_model->dist_cbook_sgroup_pmt($dt['f_dt'], $dt['t_dt']);

		$dt['malikan_DR']   = $this->User_model->dist_cbook_malikan_entry($dt['f_dt'], $dt['t_dt'], 'DR');

		$dt['malikan_CR']   = $this->User_model->dist_cbook_malikan_entry($dt['f_dt'], $dt['t_dt'], 'CR');

		$dt['all_value_h'] = $this->Main_model->get_hologram_distributions($dt['dist_id']);
		$dt['dist_hologram'] = $this->Main_model->admin_get_district_holograms($dt['dist_id'],$dt['dist_dt']);
		$dt['district_hologram'] = $this->Main_model->get_all_dist_hologram($dt['dist_id']);
		$dt['company_comission'] = $this->Report_model->get_district_company_comission_details($dt['f_dt'], $dt['t_dt'], $dt['dist_id']);

		//  $res = $this->User_model->get_dist_cash_book_amts($dt['dist_id'], $dt['f_dt'], $dt['t_dt']);

	  //  echo "<pre>"; print_r($res); echo "</pre>"; die();
		//$dt['cb_dt'] = shop_details('date');

		$dt['raid'] = $this->Main_model->duser_get_raid($dt['dist_id'],$dt['f_dt']);
		$dt['checking'] = $this->Main_model->duser_get_checking($dt['dist_id'],$dt['f_dt']);
		$dt['shop_checking'] = $this->Main_model->duser_get_shop_checking($dt['dist_id'],$dt['f_dt']);
		$dt['all_value_subgroup'] = $this->User_model->dist_get_subgroup_payment2($dt['f_dt']);

		$shop_list = $this->Main_model->get_shop_list();
		$duty = array();
		foreach($shop_list as $k=>$v){
		  $duty[$k]['shop'] = $v;
		  $a_value = $this->Main_model->get_last_order_details($v->m_shop_id);
		  if(!empty($a_value)){
			$part_list = $this->Main_model->get_pd_part_list(Date('Y-m-d'));
			// $part_list = $this->Main_model->get_pd_part_list($a_value->t_order_date);
			$part = array();
			foreach($part_list as $kk=>$vv){
			  $part[$kk]['part'] = $vv;
			  // $part[$kk]['duties'] = $this->Main_model->duty_payment_month_wise_order($v->m_shop_id,$vv->part);
			  $part[$kk]['duty_set_amt'] = $this->Main_model->get_total_duty_set($v->m_shop_id,$vv->part);
			  $part[$kk]['duty_paid_amt'] = $this->Main_model->get_total_duty_paid($v->m_shop_id,$vv->part);
			  $part[$kk]['approve_duty_amt'] = $this->Main_model->get_total_approve_duty($v->m_shop_id,$vv->part);
			  $part[$kk]['t_order_duty'] = $a_value->t_order_duty;
			}
			$duty[$k]['part_list'] = $part;
		  }
		  else{
			$duty[$k]['part_list'] = array();
		  }
		}
		// f_dt
		$dt['duties'] = $duty;
		$shop_balance = "";
		foreach ($shop_list as $ki => $vi) {
		  $shop_balance .= $this->Report_model->shop_purchase_balance($vi->m_shop_id,Date('Y-m-d',strtotime($dt['f_dt'].'-1 month')),$dt['f_dt'],$vi->m_shop_name);
		}
		$dt['shop_balance'] = $shop_balance;
		// shop_cash
		 $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
		$this->load->view('duser_dashboard_page_prints', $dt);
	}

public function cashbook_expense(){
  $dt = $this->Login_model->login_details();
  $dt['pagename'] = "Dashboard";
  
  if ($this->session->userdata('user_type') == 4) {       /* Dukan Staff Panel */
    
  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */

  } else {                                                /* Admin Panel */

    $dt['is_summary'] = $this->input->get('sm');
    $dt['f_dt']  = $this->input->get('fd');
    $dt['t_dt']  = $this->input->get('td');
    $dt['ds_id'] = $this->input->get('ds');
    $dt['pt_id'] = $this->input->get('pt');

    $dt['gp_id'] = $this->input->get('gp');
    $dt['sg_id'] = $this->input->get('sg');

    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; 

    $dt['dist_dt'] = district_details('date', $dt['ds_id']);

    if(!isset($_GET['pt'])) $dt['pt_id'] = 'A';

    if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01", strtotime($dt['dist_dt']));
    if(!isset($_GET['td'])) $dt['t_dt'] = $dt['dist_dt'];
    
    if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
      if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
    }

  //  $dt['expense_type'] = $this->User_model->cash_book_expense_type();
    
    if($dt['pt_id'] == "P" || $dt['pt_id'] == "A"){
      
  $dt['purchase_pmt'] = $this->User_model->admin_cbook_exp_purchase_pmt($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);

    }
    
    if($dt['pt_id'] == "D" || $dt['pt_id'] == "A"){
      
  $dt['duty_pmts'] = $this->User_model->admin_cbook_exp_duty_payment($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);

    }
    
    if($dt['pt_id'] == "S" || $dt['pt_id'] == "A"){
      
  $dt['salary_pmt']   = $this->User_model->admin_cbook_exp_salary_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);

    }
    
    if($dt['pt_id'] == "G" || $dt['pt_id'] == "A"){

      if($dt['pt_id'] == "G"){
        $dt['group_list'] = $this->Main_model->get_dist_group_list($dt['ds_id']);
        $dt['sub_g_list'] = $this->Main_model->get_group_sub_groups($dt['gp_id']);
      }else{ $dt['gp_id'] = ''; $dt['sg_id'] = ''; }
  $dt['sgroup_pmt']   = $this->User_model->admin_cbook_exp_sgroup_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $dt['gp_id'], $dt['sg_id']);

    }
    
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    
    $this->load->view('admin_print_report_cashbook_expense', $dt);
  }
}

public function attendance(){
  $dt = $this->Login_model->login_details();
  $dt['pagename'] = "Attendance";
  
  if ($this->session->userdata('user_type') == 4) {       /* Dukan Staff Panel */
    
  } else if($this->session->userdata('user_type') == 5) { /* Dist Staff Panel */
    $dt['ds_id'] = $this->session->userdata('user_dist');

    $dt['sp_id']     = $this->input->get('sp');
    $dt['at_dt']     = $this->input->get('dt');
    if(empty($dt['at_dt']))
      $dt['at_dt'] = $this->User_model->dist_get_attendance_date();  // Y-m-d

    $dt['atn_status'] = $this->User_model->dist_get_attendance_status($dt['at_dt']);
    if ($dt['atn_status'] != 1) user_go_back();
    // admin_get_staff_attendance
    $dt['all_value'] = $this->User_model->district_get_all_shop_users($dt['sp_id']);
    $dt['all_val_2'] = $this->User_model->district_get_all_dist_users();
    $dt['date_atns'] = $this->User_model->dist_get_staff_attendance($dt['at_dt']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    
    $this->load->view('duser_print_attendance_view_page', $dt);

  } else {                                                /* Admin Panel */

    $dt['ds_id']     = $this->input->get('ds');
    $dt['sp_id']     = $this->input->get('sp');
    $dt['at_dt']     = $this->input->get('dt');

    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
    if(empty($dt['at_dt']))
      $dt['at_dt'] = $this->User_model->admin_get_attendance_date($dt['ds_id']);  // Y-m-d
      if($this->input->get('session')!=null){
        $dt['session']     = $this->input->get('session');
      }else{
        $dt['session'] = $this->db->select('session_id')->where('attendance_status', 1)->get('master_session_tbl')->row()->session_id;
      }
    $dt['atn_status'] = $this->User_model->admin_get_attendance_status($dt['ds_id'], $dt['at_dt']);
    if ($dt['atn_status'] != 1) user_go_back();

    $dt['all_value'] = $this->User_model->admin_get_all_shop_users($dt['ds_id'], $dt['sp_id']);
    $dt['all_val_2'] = $this->User_model->admin_get_all_dist_users($dt['ds_id']);
    $dt['date_atns'] = $this->User_model->admin_get_staff_attendance($dt['ds_id'], $dt['at_dt'], $dt['session']);
    // admin_get_staff_attendance
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

    $this->load->view('admin_print_attendance_view', $dt);
  }
}
//===========================/Print===========================//

//============================Print===========================//
public function agent_sales(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Paikar Sales Report - Day - "; 

  $dt['f_dt']  = $this->input->get('fd');
  $dt['t_dt']  = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['ag_id'] = $this->input->get('ag');

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['td'])) $dt['t_dt'] = date("Y-m-t");

  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
    $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;

  $dt['agent_list'] = $this->User_model->get_agent_list_by_shop($dt['sp_id']);
  

  $dt['all_value'] = $this->Report_model->get_agent_sales($dt['f_dt'], $dt['t_dt'], $dt['ds_id'], $dt['sp_id'], $dt['ag_id']);

  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

  $this->load->view('admin_print_agent_sales_report', $dt);
}
//============================Print===========================//
public function agent_sales_day(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Paikar Sales Report Item - "; 

  $dt['f_dt']  = $this->input->get('fd');
  $dt['t_dt']  = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['ag_id'] = $this->input->get('ag');

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['td'])) $dt['t_dt'] = date("Y-m-t");

  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
    $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;

  $dt['agent_list'] = $this->User_model->get_agent_list_by_shop($dt['sp_id']);
  

  $dt['all_value'] = $this->Report_model->get_agent_sales_by_item($dt['f_dt'], $dt['t_dt'], $dt['ds_id'], $dt['sp_id'], $dt['ag_id']);

  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

  $this->load->view('admin_print_agent_sales_report_day', $dt);
}
public function print_sales_reports(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Agent Sales Report"; 

  $dt['f_dt']  = $this->input->get('fd');
  $dt['t_dt']  = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['ag_id'] = $this->input->get('ag');

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['td'])) $dt['t_dt'] = date("Y-m-t");

  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Main_model->get_district_list();
  if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
    $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;

  $dt['agent_list'] = $this->User_model->get_agent_list_by_shop($dt['sp_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  

  $dt['all_value'] = $this->Report_model->get_agent_sales($dt['f_dt'], $dt['t_dt'], $dt['ds_id'], $dt['sp_id'], $dt['ag_id']);

  $this->load->view('admin_print_sales_reports', $dt);
}
public function print_purchase_reports(){
  $dt = $this->Login_model->login_details(49);
  $dt['ds_id'] =  $this->input->get('ds');
  $dt['pagename'] = "Purchase Report";
  $dt['all_value']  = $this->Report_model->get_purchase_report(); 
  $dt['supplier_list']  = $this->Report_model->get_dist_all_supplier_list($dt['ds_id']);
  $dt['dist_list'] = $this->Report_model->get_district_list();
  $dt['all_shop']             = $this->Report_model->all_shop($dt['ds_id']);
  //echo "<pre>"; print_r($dt['get_purchase_report']); echo "<pre>";exit();

  $this->load->view('admin_print_purchase_report', $dt);
}
public function print_attendance_report(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Attendance Report";
  
  if($this->session->userdata('user_type') == 4) {

    $view_page = 'default_view_page';
  }else if($this->session->userdata('user_type') == 5) {
    /** district attendance report */
    $dt['ds_id'] = $this->input->get('ds');
    $dt['at_dt'] = $this->input->get('dt');
    $dt['ur_id'] = $this->input->get('ur');
    if(empty($dt['at_dt'])) $dt['at_dt'] = date("Y-m");
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
    $dt['ds_atn_dt'] = $this->User_model->admin_get_attendance_date($dt['ds_id']);  // Y-m-d
    $dt['all_value'] = $this->Report_model->admin_get_dist_all_users($dt['ds_id'], $dt['ur_id']);
    $dt['month_atns']= $this->Report_model->admin_get_all_attendance($dt['at_dt'], $dt['ds_id'], $dt['ur_id']);
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $view_page = 'print_district_attendance_report';
  }else {
  
    $dt['ds_id'] = $this->input->get('ds');
    $dt['at_dt'] = $this->input->get('dt');
    $dt['ur_id'] = $this->input->get('ur');
    if(empty($dt['at_dt'])) $dt['at_dt'] = date("Y-m");
    
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
      
    $dt['ds_atn_dt'] = $this->User_model->admin_get_attendance_date($dt['ds_id']);  // Y-m-d

    $dt['all_value'] = $this->Report_model->admin_get_dist_all_users($dt['ds_id'], $dt['ur_id']);
    $dt['month_atns']= $this->Report_model->admin_get_all_attendance($dt['at_dt'], $dt['ds_id'], $dt['ur_id']);

    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

    $view_page = 'print_attendance_report';
  }
  $this->load->view($view_page, $dt);
}
public function print_attendance_report_new(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Attendance Report";
  
  if($this->session->userdata('user_type') == 4) {

    $view_page = 'default_view_page';
  }else if($this->session->userdata('user_type') == 5) {

    $view_page = 'default_view_page';
  }else {
  
    $dt['ds_id'] = $this->input->get('ds');
    $dt['at_dt'] = $this->input->get('dt');
    $dt['ur_id'] = $this->input->get('ur');
    $dt['f_dt'] = $this->input->get('f_dt');
    $dt['t_dt'] = $this->input->get('t_dt');

    if(empty($dt['at_dt'])) $dt['at_dt'] = date("Y-m");
    
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
      
    $all_user = $this->Report_model->admin_get_dist_all_users($dt['ds_id'], $dt['ur_id']);
    $data = array();
    if(!empty($dt['ds_id'])){
      foreach($all_user as $k=>$v){
        $data[$k]['user'] = $v;
        $data[$k]['opening'] = $this->Report_model->opening_salary($v->muser_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['salary'] = $this->Report_model->total_salary($v->muser_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['received'] = $this->Report_model->salary_recived($v->muser_id,$dt['f_dt'],$dt['t_dt']);
      }
    }
    $dt['all_value'] = $data;
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

    $view_page = 'print_attendance_report_new';
  }
  $this->load->view($view_page, $dt);
}
public function print_staff_summary(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Attendance Report";
  
  if($this->session->userdata('user_type') == 4) {

    $view_page = 'default_view_page';
  }else if($this->session->userdata('user_type') == 5) {

    $view_page = 'default_view_page';
  }else {
  
    $dt['ds_id'] = $this->input->get('ds');
    $dt['at_dt'] = $this->input->get('dt');
    $dt['ur_id'] = $this->input->get('ur');
    $dt['f_dt'] = $this->input->get('f_dt');
    $dt['t_dt'] = $this->input->get('t_dt');

    if(empty($dt['at_dt'])) $dt['at_dt'] = date("Y-m");
    
    $dt['dist_list'] = $this->Main_model->get_district_list();
    if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
      $dt['ds_id'] = $dt['dist_list'][0]->m_district_id;
      
    $all_user = $this->Report_model->admin_get_dist_all_users($dt['ds_id'], $dt['ur_id']);
    $data = array();
    if(!empty($dt['ds_id'])){
      foreach($all_user as $k=>$v){
        $data[$k]['user'] = $v;
        $data[$k]['opening'] = $this->Report_model->opening_salary($v->muser_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['salary'] = $this->Report_model->total_salary($v->muser_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['received'] = $this->Report_model->salary_recived($v->muser_id,$dt['f_dt'],$dt['t_dt']);
      }
    }
    $dt['all_value'] = $data;
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);

    $view_page = 'print_staff_summary';
  }
  $this->load->view($view_page, $dt);
}
public function print_balance_sheet_new(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Balance Sheet Report New";
  
  if($this->session->userdata('user_type') == 4) {

    $view_page = 'default_view_page';
  }else if($this->session->userdata('user_type') == 5) {
    /** distrcit user */
		$dt['ds_id'] = $this->input->get('ds');
    $dt['f_dt'] = $this->input->get('f_dt');
    $dt['t_dt'] = $this->input->get('t_dt');
    $dt['ur_id'] = $this->input->get('ur');
    $dt['dist_list'] = $this->Main_model->get_district_list();
   
    $all_shop = $this->Report_model->get_district_dukan_list($dt['ds_id']);
    $data = array();
    if(!empty($dt['ds_id'])){
      foreach($all_shop as $k=>$v){
        $data[$k]['shop'] = $v;
        $data[$k]['sale'] = $this->Main_model->admin_get_sale_balancesheet($v->m_shop_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['cashbook'] = $this->Main_model->admin_get_current_cash_book($v->m_shop_id);
      }
    }
    $dt['all_value'] = $data;

    $malikan_list = $this->Report_model->get_dist_malikan($dt['ds_id']);
    // if(empty($dt['malikan_list'])) $dt['mk_id'] = '';
    $data = array();
    foreach ($malikan_list as $k => $v) {
      $data[$k]['malikan'] = $v;
      $data[$k]['all_value'] = $this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $v->m_malikan_id);
    }
    $dt['all_malikan'] = $data;
    $dt['purchase_pmt'] = $this->User_model->admin_cbook_exp_purchase_pmt($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);
    $dt['duty_pmts'] = $this->User_model->admin_cbook_exp_duty_payment($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);
    $dt['salary_pmt']   = $this->User_model->admin_cbook_exp_salary_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['sgroup_pmt']   = $this->User_model->admin_balance_sheet_group_payments($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
	  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['company_commission_amount']   = $this->User_model->get_company_commission_amount($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['from_district_transfer']   = $this->User_model->from_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    $dt['to_district_transfer']   = $this->User_model->to_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    $view_page = 'print_balance_sheet_new_district';
		
    // $view_page = 'default_view_page';
  }else {
  
    $dt['ds_id'] = $this->input->get('ds');
    $dt['f_dt'] = $this->input->get('f_dt');
    $dt['t_dt'] = $this->input->get('t_dt');
    $dt['ur_id'] = $this->input->get('ur');
    $dt['dist_list'] = $this->Main_model->get_district_list();
   
    $all_shop = $this->Report_model->get_district_dukan_list($dt['ds_id']);
    $data = array();
    if(!empty($dt['ds_id'])){
      foreach($all_shop as $k=>$v){
        $data[$k]['shop'] = $v;
        $data[$k]['sale'] = $this->Main_model->admin_get_sale_balancesheet($v->m_shop_id,$dt['f_dt'],$dt['t_dt']);
        $data[$k]['cashbook'] = $this->Main_model->admin_get_current_cash_book($v->m_shop_id);
      }
    }
    $dt['all_value'] = $data;

    $malikan_list = $this->Report_model->get_dist_malikan($dt['ds_id']);
    // if(empty($dt['malikan_list'])) $dt['mk_id'] = '';
    $data = array();
    foreach ($malikan_list as $k => $v) {
      $data[$k]['malikan'] = $v;
      $data[$k]['all_value'] = $this->Report_model->get_malikan_report($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], $v->m_malikan_id);
    }
    $dt['all_malikan'] = $data;
    $dt['purchase_pmt'] = $this->User_model->admin_cbook_exp_purchase_pmt($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);
    $dt['duty_pmts'] = $this->User_model->admin_cbook_exp_duty_payment($dt['ds_id'],$dt['f_dt'],$dt['t_dt']);
    $dt['salary_pmt']   = $this->User_model->admin_cbook_exp_salary_pmt($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['sgroup_pmt']   = $this->User_model->admin_balance_sheet_group_payments($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
    $dt['company_commission_amount']   = $this->User_model->get_company_commission_amount($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $dt['from_district_transfer']   = $this->User_model->from_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    $dt['to_district_transfer']   = $this->User_model->to_district_transfer_admin($dt['ds_id'], $dt['f_dt'], $dt['t_dt'], 'CR');
    $dt['sgroup_pmt_for_admin']   = $this->User_model->admin_cbook_sgroup_pmt_for_balance_sheet($dt['ds_id'], $dt['f_dt'], $dt['t_dt']);
    $view_page = 'print_balance_sheet_new';
  }
  
  $this->load->view($view_page, $dt);
}
public function print_shop_agent(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Shop Agent Report";
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] =  $this->input->get('shop_name');
  $dt['agent_id'] =  $this->input->get('agent_name');
  $dt['f_dt'] =  $this->input->get('from_date');
  $dt['t_dt'] =  $this->input->get('to_date');

  $dt['all_shop']        = $this->Report_model->all_shop($dt['sp_id']);
  $dt['dukan_person']      = $this->Report_model->dukan_person();
  $dt['get_shop_agent_com'] = $this->Report_model->get_shop_agent_com();
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  $dt['agent_name'] = $this->Report_model->get_agent_name_by_id($dt['agent_id']);
  $dt['dist_list'] = $this->Report_model->get_district_list();
  $this->load->view('print_shop_agent_report', $dt);
}
public function print_shop_expense(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Shop Expense Report";
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] =  $this->input->get('shop_name');
  $dt['agent_id'] =  $this->input->get('agent_name');
  $dt['f_dt'] =  $this->input->get('from_date');
  $dt['t_dt'] =  $this->input->get('to_date');
  $dt['all_shop']          = $this->Report_model->all_shop($dt['sp_id']);
  $dt['get_shop_expenses'] = $this->Report_model->get_shop_expenses();
  $dt['dist_list'] = $this->Report_model->get_district_list();
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  //echo "<pre>"; print_r($dt['get_shop_agent_com']); echo "</pre>";
  $this->load->view('print_shop_expense', $dt);
}
public function print_breakage_enrty(){
  $dt = $this->Login_model->login_details(49);
  $dt['pagename'] = "Breakage Entry Report"; 
  $dt['ds_id'] =  $this->input->get('ds');
  $dt['sp_id'] =  $this->input->get('shop_name');
  $dt['f_dt'] =  $this->input->get('from_date');
  $dt['t_dt'] =  $this->input->get('to_date');
  $dt['all_shop']   = $this->Report_model->all_shop($dt['sp_id']);
  $dt['get_breakage_report']  = $this->Report_model->get_breakage_report();
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  $dt['dist_list'] = $this->Report_model->get_district_list();
 // echo "<pre>"; print_r($dt['get_breakage_report']); echo "</pre>";

  $this->load->view('print_breakage_report', $dt);
}
public function print_hologram(){
  $dt['pagename'] = "Hologram Report";

  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['f_dt'] =  $this->input->get('from_date');
  $dt['t_dt'] =  $this->input->get('to_date');
  //$dt['sp_dt'] = $this->input->get('dt');

  if(!isset($_GET['from_date'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['to_date'])) $dt['t_dt'] = date("Y-m-t");
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Report_model->get_district_list();
  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);

  $dt['all_value'] = $this->Report_model->get_hologram_report($dt['ds_id'], $dt['sp_id'], $dt['f_dt'],$dt['t_dt']);
  $dt['dist_name'] = $this->Report_model->get_dist_name_by_id($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  
  $this->load->view('print_hologram_report', $dt);
}
public function print_hologram_distribution(){
  $dt['pagename'] = "Hologram Distribution Report";

  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');
  $dt['f_dt'] =  $this->input->get('from_date');
  $dt['t_dt'] =  $this->input->get('to_date');
  //$dt['sp_dt'] = $this->input->get('dt');

  if(!isset($_GET['from_date'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['to_date'])) $dt['t_dt'] = date("Y-m-t");
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Report_model->get_district_list();
  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);

  $dt['all_value'] = $this->Report_model->get_hologram_distribution_report($dt['ds_id'], $dt['sp_id']);
  
  $this->load->view('print_hologram_distribution', $dt);
}
public function print_counter_sales(){
  $dt['pagename'] = "Hologram Report";
  $dt['ds_id'] = $this->input->get('ds');
    $dt['sp_id'] = $this->input->get('sp');
    $dt['sp_dt'] = $this->input->get('dt');

    if (empty($dt['sp_dt']) && !empty($dt['sp_id']))
      $dt['sp_dt'] = shop_details('date', $dt['sp_id']); //Y-m-d
    else if (empty($dt['sp_dt'])) $dt['sp_dt'] = date("Y-m-d");

    $dt['all_value'] = $this->Report_model->admin_get_counter_sales_report($dt['sp_id'], $dt['sp_dt']);
    $dt['dist_list'] = $this->Report_model->get_district_list();
    $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
    $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  
  $this->load->view('print_counter_sale_reports', $dt);
  
}
public function print_shop_duty(){
  $dt = $this->Login_model->login_details(49);
  $dt['ds_id'] = $this->session->userdata('user_dist');
  $dt['pagename'] = "Shop Duty";
  $dt['f_dt'] = $this->input->get('fd');
  $dt['t_dt'] = $this->input->get('td');
  $dt['ds_id'] = $this->input->get('ds');
  $dt['sp_id'] = $this->input->get('sp');

  if(!isset($_GET['fd'])) $dt['f_dt'] = date("Y-m-01");
  if(!isset($_GET['td'])) $dt['t_dt'] = date("Y-m-t");
  
  if ((!empty($dt['f_dt'])) && (!empty($dt['t_dt']))) {
    if ($dt['f_dt'] > $dt['t_dt']) $dt['f_dt'] = $dt['t_dt'];
  }

  $dt['dist_list'] = $this->Main_model->get_district_list();
  /*if(empty($dt['ds_id']) && !empty($dt['dist_list'])) 
    $dt['ds_id'] = $dt['dist_list'][0]->m_district_id; */

  $dt['shop_list'] = $this->Report_model->get_district_dukan_list($dt['ds_id']);
  /*if(empty($dt['sp_id']) && !empty($dt['shop_list'])) 
    $dt['sp_id'] = $dt['shop_list'][0]->m_shop_id;*/

  //$dt['all_value'] = $this->User_model->get_all_shop_duty($dt['ds_id'],$dt['sp_id'], $dt['f_dt'], $dt['t_dt']);
  $dt['all_value'] = $this->User_model->get_all_shop_duty_new($dt['ds_id'],$dt['sp_id'], $dt['f_dt'], $dt['t_dt']);
  $dt['all_shop']             = $this->Report_model->all_shop($dt['sp_id']);
  $dt['shop_name'] = $this->Report_model->get_shop_name_by_id($dt['sp_id']);
  //echo "<pre>"; print_r($dt['get_purchase_report']); echo "<pre>";exit();

  $this->load->view('admin_print_shop_duty', $dt);
}
//===========================/Print===========================//

public function cashbook_purchased_order_peti_details(){
  $dt = $this->Login_model->login_details(34);
  $dt['pagename'] = "Purchase Details";
  
  $dt['return_link'] = 'Purchase';
  $dt['or_id']  = $this->input->get('or');

  $dt['a_value'] = $this->Main_model->get_order_purchased_details($dt['or_id']);
  if(empty($dt['a_value'])) return redirect(site_url($dt['return_link']));

  $dt['all_value2']= $this->Main_model->get_order_wines_type_dtl($dt['or_id']);

  $dt['suppliers'] = $this->Main_model->get_order_items_supplier($dt['or_id']);
  $dt['all_value'] = $this->Main_model->get_order_purchased_items($dt['or_id']);
  $dt['wine_types']= $this->Main_model->get_wine_type();

  $view_page = 'admin_cashbook_purchase_details_peti';

  $this->load->view($view_page, $dt);
}




//===========================/Print===========================// admin_cashbook_purchase_details_peti
} ?>