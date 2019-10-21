<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trading_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

function get_info_trading()
  {
    $query = $this->db->get_where("trading",['id_trading'=>1]);
    return $query->row();
  }


  function get_insert($table,$data)
  {
    return $this->db->insert($table,$data);
  }


  function json_profit()
{
  $this->datatables->select("trading_profit.id_trading_profit,
                            DATE_FORMAT(trading_profit.time_add,'%d,%M %Y') AS time_add,
                            trading_profit.persentasi,
                            FORMAT(trading_profit.nominal,0) AS nominal,
                            trading_profit.keterangan,
                            trading_profit.status_bagi,
                            trading_profit.created");
    $this->datatables->from('trading_profit');
    $this->datatables->where("status_bagi","sudah");
    return $this->datatables->generate();
}


function json_dividen()
{
  $this->datatables->select("trading_dividen.id_trading_dividen,
                            trading_dividen.id_trading_profit,
                            trading_dividen.id_person,
                            trading_dividen.jumlah_paper,
                            trading_dividen.persentase,
                            FORMAT(trading_dividen.dividen,0) AS dividen,
                            DATE_FORMAT(trading_profit.time_add,'%d,%M %Y') AS time_add,
                            trading_profit.persentasi,
                            FORMAT(trading_profit.nominal,0) AS nominal,
                            trading_profit.status_bagi");
  $this->datatables->from("trading_dividen");
  $this->datatables->join("trading_profit","trading_profit.id_trading_profit = trading_dividen.id_trading_profit");
  $this->datatables->where("id_person",sess('id_person'));
  $this->datatables->where("status_bagi","sudah");
  return $this->datatables->generate();
}

}
