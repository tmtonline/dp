<?php
Class Leave_model extends CI_Model
{
	
	function product_autocomplete($name, $limit)
	{
		return	$this->db->like('name', $name)->get('products', $limit)->result();
	}
	
	function leaves($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			echo 'no data?';
			//if nothing is provided return the whole shabang
			$this->get_all_leaves();
		}
		else
		{			
			//grab the limit
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			//grab the offset
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
			
			if(!empty($data['calendar']))
			{
				$this->db->select('CONCAT(admin.lastname, " ", admin.firstname) as title, leave_record.datefrom as start, leave_record.dateto as end', false);
			}
			
			$this->db->join('admin', 'admin.id=leave_record.applicants', 'left');
						
			//do we order by something other than category_id?
			if(!empty($data['order_by']))
			{
				//if we have an order_by then we must have a direction otherwise KABOOM
				$this->db->order_by($data['order_by'], $data['sort_order']);			
			}else{
				$this->db->order_by('application_date', 'DESC');
				$this->db->order_by('id', 'DESC');
			}
			
			if(isset($data['access'])&&$data['auth_id']):
				if(!$data['access']) :
					$this->db->where('leave_record.applicants', $data['auth_id']);
				endif;
			endif;
			
			if(isset($data['status']) && !empty($data['status'])):
				$this->db->where('leave_record.status', $data['status']);
			endif;
			
			
			//do we have a search submitted?
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				//if we are searching dig through some basic fields
				if(!empty($search->term))
				{
					$this->db->like('admin.firstname', $search->term);
					$this->db->or_like('admin.lastname', $search->term);
					$this->db->or_like('admin.email', $search->term);
					$this->db->or_like('admin.employeeID', $search->term);					
				}								
			}
			
			if($return_count)
			{
				return $this->db->count_all_results('leave_record');
			}
			else
			{
				$this->db->select("leave_record.*,admin.*, leave_record.id as id", FALSE);
				return $this->db->get('leave_record')->result();
			}
			
		}
	}
	
	function get_all_leaves()
	{
		//sort by alphabetically by default
		$this->db->order_by('application_date', 'DESC');
		$result	= $this->db->get('leave_record');

		return $result->result();
	}
	
	function get_filtered_products($product_ids, $limit = false, $offset = false)
	{
		
		if(count($product_ids)==0)
		{
			return array();
		}
		
		$this->db->select('id, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false)->from('products');
		
		if(count($product_ids)>1)
		{
			$querystr = '';
			foreach($product_ids as $id)
			{
				$querystr .= 'id=\''.$id.'\' OR ';
			}
		
			$querystr = substr($querystr, 0, -3);
			
			$this->db->where($querystr, null, false);
			
		} else {
			$this->db->where('id', $product_ids[0]);
		}
		
		$result	= $this->db->limit($limit)->offset($offset)->get()->result();

		//die($this->db->last_query());

		$contents	= array();
		$count		= 0;
		foreach ($result as $product)
		{

			$contents[$count]	= $this->get_leave($product->id);
			$count++;
		}

		return $contents;
		
	}
	
	function get_leaves($category_id = false, $limit = false, $offset = false, $by=false, $sort=false)
	{
		//if we are provided a category_id, then get products according to category
		if ($category_id)
		{
			$this->db->select('category_products.*, products.*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false)->from('category_products')->join('products', 'category_products.product_id=products.id')->where(array('category_id'=>$category_id, 'enabled'=>1));

			$this->db->order_by($by, $sort);
			
			$result	= $this->db->limit($limit)->offset($offset)->get()->result();
			
			return $result;
		}
		else
		{
			//sort by alphabetically by default
			$this->db->order_by('name', 'ASC');
			$result	= $this->db->get('products');

			return $result->result();
		}
	}
	
	function count_all_products()
	{
		return $this->db->count_all_results('leave_record');
	}
	
	function count_products($id)
	{
		return $this->db->select('product_id')->from('category_products')->join('products', 'category_products.product_id=products.id')->where(array('category_id'=>$id, 'enabled'=>1))->count_all_results();
	}

	function get_leave($id, $related=true)
	{
		$result	= $this->db->get_where('leave_record', array('id'=>$id))->row();
		if(!$result)
		{
			return false;
		}			
		return $result;
	}
	
	//this is function retrieve trace and record
	function get_leave_full_details($id)
	{
		$this->db->join('admin', 'admin.id=leave_record.applicants', 'left');
				
		$result	= $this->db->where('leave_record.id',$id)->get('leave_record')->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_slug($id)
	{
		return $this->db->get_where('products', array('id'=>$id))->row()->slug;
	}

	function check_slug($str, $id=false)
	{
		$this->db->select('slug');
		$this->db->from('products');
		$this->db->where('slug', $str);
		if ($id)
		{
			$this->db->where('id !=', $id);
		}
		$count = $this->db->count_all_results();

		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function save($leave)
	{
		
		if ($leave['id'])
		{
			$this->db->where('id', $leave['id']);
			$this->db->update('leave_record', $leave);

			$id	= $leave['id'];
		}
		else
		{
			$this->db->insert('leave_record', $leave);
			$id	= $this->db->insert_id();
		}
	
		//return the leave  id
		return $id;
	}
	
	function delete_leave($id)
	{
		// delete product 
		$this->db->where('id', $id);
		$this->db->delete('leave_record');
	}

	function add_product_to_category($product_id, $optionlist_id, $sequence)
	{
		$this->db->insert('product_categories', array('product_id'=>$product_id, 'category_id'=>$category_id, 'sequence'=>$sequence));
	}

	function search_products($term, $limit=false, $offset=false, $by=false, $sort=false)
	{
		$results		= array();
		
		$this->db->select('*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false);
		//this one counts the total number for our pagination
		$this->db->where('enabled', 1);
		$this->db->where('(name LIKE "%'.$term.'%" OR description LIKE "%'.$term.'%" OR excerpt LIKE "%'.$term.'%" OR sku LIKE "%'.$term.'%")');
		$results['count']	= $this->db->count_all_results('products');


		$this->db->select('*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false);
		//this one gets just the ones we need.
		$this->db->where('enabled', 1);
		$this->db->where('(name LIKE "%'.$term.'%" OR description LIKE "%'.$term.'%" OR excerpt LIKE "%'.$term.'%" OR sku LIKE "%'.$term.'%")');
		
		if($by && $sort)
		{
			$this->db->order_by($by, $sort);
		}
		
		$results['products']	= $this->db->get('products', $limit, $offset)->result();
		
		return $results;
	}

	// Build a cart-ready product array
	function get_cart_ready_product($id, $quantity=false)
	{
		$product	= $this->db->get_where('products', array('id'=>$id))->row();
		
		//unset some of the additional fields we don't need to keep
		if(!$product)
		{
			return false;
		}
		
		$product->base_price	= $product->price;
		
		if ($product->saleprice != 0.00)
		{ 
			$product->price	= $product->saleprice;
		}
		
		
		// Some products have n/a quantity, such as downloadables
		//overwrite quantity of the product with quantity requested
		if (!$quantity || $quantity <= 0 || $product->fixed_quantity==1)
		{
			$product->quantity = 1;
		}
		else
		{
			$product->quantity = $quantity;
		}
		
		
		// attach list of associated downloadables
		$product->file_list	= $this->Digital_Product_model->get_associations_by_product($id);
		
		return (array)$product;
	}
	
	function get_new_arrival($limit = false, $offset = false, $by=false, $sort=false)
	{
		$this->db->select('products.*, LEAST(IFNULL(NULLIF(saleprice, 0), price), price) as sort_price', false)->from('products')->where(array('enabled'=>1));
		//$result	= $this->db->get('products');
		$this->db->order_by($by, $sort);
		$result	= $this->db->limit($limit)->offset($offset)->get()->result();
	
		return $result;
	}
	
	/* Leave Trace 
	 * For record down applicants from begin until the end
	 * 
	 * 
	 * */
	function save_trace($leave)
	{	
		if ($leave['id'])
		{
			$this->db->where('id', $leave['id']);
			$this->db->update('leave_trace', $leave);
	
			$id	= $leave['id'];
		}
		else
		{
			$this->db->insert('leave_trace', $leave);
			$id	= $this->db->insert_id();
		}	
		//return the leave id
		return $id;
	}	
	
	function get_last_trace_record($recordID)
	{
		$this->db->order_by('id', 'DESC');
		$this->db->where('recordID', $recordID);
		
		return $this->db->limit(1)->get('leave_trace')->row();
	}

	function get_total_trace($applicants_id, $leave_type)
	{		
		$this->db->select('sum(`in`) - sum(`out`) as total', false);
		$this->db->where('applicants', $applicants_id);
		
		if($leave_type == 'Sick Leave'):
			$this->db->where('leave_type', $leave_type);		
		else:
			$this->db->where_in('leave_type', array('Annual Leave','Emergency Leave'));
		endif;
				
		$this->db->where('status', 'Enable');
		return $this->db->get('leave_trace')->row();;				
	}
	
	
	
	
	
}