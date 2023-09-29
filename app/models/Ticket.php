<?php 

class Ticket extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('mailer');
	}

	function create_ticket($subject, $content)
	{
		$data['ticket_subject'] = $subject;
		$data['ticket_content'] = $content;
		$data['ticket_status'] = 'open';
		$data['ticket_time'] = time();
		$data['ticket_for'] = $this->user->get_key();
		$data['ticket_key'] = char8(implode(':', $data));
		$res = $this->db->insert('is_ticket', $data);
		if($res !== false)
		{
			if($this->mailer->is_active())
			{
				$param['user_name'] = $this->user->get_name();
				$param['ticket_id'] = $data['ticket_key'];
				$param['ticket_url'] = base_url().'admin/ticket/view/'.$data['ticket_key'];
				$this->mailer->send('new_ticket', $this->base->get_email(), $param, 'admin');
				return true;
			}
			return true;
		}
		return false;
	}

	function get_count($status = 'open')
	{
		$res = $this->base->fetch('is_ticket', ['status' => $status], 'ticket_');
		return count($res);
	}

	function get_tickets($count = 0)
	{
		$this->db->where('ticket_status', 'open');
		$this->db->or_where('ticket_status', 'customer');
		$this->db->select('*');
		$this->db->from('is_ticket');
		$res = $this->db->get()->result_array();
		$list = [];
		if($count == 0)
		{
			$count = 0;
		}
		else
		{
			$count = $count * $this->base->rpp();
		}
		for ($i = $count; $i < count($res); $i++) { 
			if($i >= $count + $this->base->rpp())
			{
				break;
			}
			else
			{
				$list[] = $res[$i];
			}
		}
		return $list;
	}

	function list_count()
	{
		$this->db->where('ticket_status', 'open');
		$this->db->or_where('ticket_status', 'customer');
		$this->db->select('*');
		$this->db->from('is_ticket');
		$res = $this->db->get()->result_array();
		return count($res);
	}

	function get_user_tickets()
	{
		if($this->user->is_logged())
		{
			$key = $this->user->get_key();
			$res = $this->fetch('is_ticket', ['for' => $key]);
			return $res;
		}
		return false;
	}

	function view_ticket($id)
	{
		$res = $this->fetch('is_ticket', ['key' => $id]);
		if(count($res)>0)
		{
			return $res[0];
		}
		return false;
	}

	function view_user_ticket($id)
	{
		$key = $this->user->get_key();
		$res = $this->fetch('is_ticket', ['for' => $key, 'key' => $id]);
		if(count($res)>0)
		{
			return $res[0];
		}
		return false;
	}

	function add_reply($id, $content, $by, $status)
	{
		$data['reply_content'] = $content;
		$data['reply_for'] = $id;
		$data['reply_time'] = time();
		$data['reply_by'] = $by;
		$res = $this->db->insert('is_reply', $data);
		$data['ticket_key'] = $id;
		if($res !== false)
		{
			$res = $this->change_ticket_status($id, $status);
			if($res !== false)
			{
				if($this->mailer->is_active())
				{
					if($this->get_user_name($by) !== false)
					{
						$param['admin_name'] = $this->base->get_hostname();
						$email = $this->base->get_email();
						$tpl = 'admin';
						$param['ticket_url'] = base_url().'admin/ticket/view/'.$data['ticket_key'];
					}
					else
					{
						$except_key = $this->fetch_user_except($by, $id);
						$param['user_name'] = $this->get_user_name($except_key);
						$email = $this->get_user_email($except_key);
						$tpl = 'user';
						$param['ticket_url'] = base_url().'ticket/view/'.$data['ticket_key'];
					}
					$param['ticket_id'] = $data['ticket_key'];
					$this->mailer->send('reply_ticket', $email, $param, $tpl);
					return true;
				}
				return true;
			}
			return false;
		}
		return false;
	}

	function get_ticket_reply($id)
	{
		$res = $this->fetch('is_reply', ['for' => $id], 'reply_');
		return $res;
	}

	function get_user_name($key)
	{
		$res = $this->fetch('is_user', ['key' => $key], 'user_', 'user_name');
		if(count($res)>0)
		{
			return $res[0]['user_name'];
		}
		return false;
	}

	function get_admin_email($key)
	{
		$res = $this->fetch('is_admin', ['key' => $key], 'admin_', 'admin_email');
		if(count($res)>0)
		{
			return $res[0]['admin_email'];
		}
		return false;
	}

	function get_user_email($key)
	{
		$res = $this->fetch('is_user', ['key' => $key], 'user_', 'user_email');
		if(count($res)>0)
		{
			return $res[0]['user_email'];
		}
		return false;
	}

	function get_admin_name($key)
	{
		$res = $this->fetch('is_admin', ['key' => $key], 'admin_', 'admin_name');
		if(count($res)>0)
		{
			return $res[0]['admin_name'];
		}
		return false;
	}

	function change_ticket_status($id, $status)
	{
		$res = $this->fetch('is_ticket', ['key' => $id], 'ticket_', 'ticket_status');
		if(count($res)>0)
		{
			if($res[0]['ticket_status'] !== $status)
			{
				$res = $this->update(['status' => $status], ['key'  => $id]);
				if($res !== false)
				{
					return true;
				}
				return false;
			}
			return false;
		}
		return false;
	}

	function update($data, $where)
	{
		$res = $this->base->update(
			$data,
			$where,
			'is_ticket',
			'ticket_'
		);
		if($res)
		{
			return true;
		}
		return false;
	}

	function fetch_user_except($key, $id)
	{
		$res = $this->get_ticket_reply($id);
		if(count($res)>0)
		{
			foreach ($res as $value) {
				if($value['reply_by'] !== $key)
				{
					return $value['reply_by'];
				}
			}
			return false;
		}
		return false;
	}

	function fetch($table, $where = [], $prefix = 'ticket_', $data = '*')
	{
		$res = $this->base->fetch(
			$table,
			$where,
			$prefix
		);
		return $res;
	}
}

?>