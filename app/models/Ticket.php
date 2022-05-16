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
				$param['ticket_url'] = base_url().'a/view_ticket/'.$data['ticket_key'];
				$this->mailer->send('new_ticket', $this->base->get_email(), $param, 'admin');
				return true;
			}
			return true;
		}
		return false;
	}

	function get_tickets()
	{
		$this->db->where('ticket_status', 'open');
		$this->db->or_where('ticket_status', 'customer');
		$this->db->select('*');
		$this->db->from('is_ticket');
		$res = $this->db->get()->result_array();
		return $res;
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
		if($res !== false)
		{
			$res = $this->change_ticket_status($id, $status);
			if($res !== false)
			{
				if($this->mailer->is_active())
				{
					if($this->get_user_name($by) !== false)
					{
						$param['user_name'] = $this->get_user_name($by);
						$email = $this->get_user_email($by);
						$tpl = 'user';
						$param['ticket_url'] = base_url().'u/view_ticket/'.$data['ticket_key'];
					}
					else
					{
						$param['admin_name'] = $this->get_admin_name($by);
						$email = $this->get_admin_email($by);
						$tpl = 'admin';
						$param['ticket_url'] = base_url().'a/view_ticket/'.$data['ticket_key'];
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