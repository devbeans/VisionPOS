<?php
class Mclients extends Model {

	function Mclients()
	{
		parent::Model();
	}

	function getSearchResults ($search)
	{
	//echo print_r($search) . '<BR><BR>';
		$this->load->helper('format_phone_number');

		//if includemas90 checked then search mas90 otherwise do normal search
		if ( $search['includemas90'] == 'includemas90' )	{
			$this->db->select('customer_number as client_id, customer_name as firstname, propercase as lastname, address1 as address, city, state, phone, propercase as clientstatus, customer_number, archive');
			$this->db->like('customer_name', $search['search_term']);
			$this->db->order_by('customer_name');
			$query = $this->db->get('mas90data');
		} else 	{
			$this->db->select('client_id, firstname, lastname, address, city, state, phone, clientstatus');	
		
			if ( $search['searchoptionsname'] == 'nameonly' ) { 
				if  ( $search['namelike']  == 'like' )	{
					$this->db->or_like('lastname', $search['search_term']); 
					$this->db->or_like('firstname', $search['search_term']);
				} else {
					$this->db->or_where('lastname', $search['search_term']); 
					$this->db->or_where('firstname', $search['search_term']);
				}	
			}
			if ( $search['searchoptionsphone'] == 'phoneonly' ) { 
				$this->db->or_like('phone', $search['search_term']); 
				$this->db->or_like('phone2', $search['search_term']);
				$this->db->or_like('phone3', $search['search_term']);
			}
	
			if ( $search['searchoptionsaddress'] == 'addressonly' ) { 
				if ($search['addresslike'] == 'like' ) 	{
					$this->db->or_like('address', $search['search_term']); 
					$this->db->or_like('address2', $search['search_term']);
				} else {
					$this->db->or_where('address', $search['search_term']); 
					$this->db->or_where('address2', $search['search_term']);			
				}
			}
			
			if ( $search['searchoptionseverything'] == 'everything' ) { 
				$array = array('lastname' => $search['search_term'], 'firstname' => $search['search_term'], 'phone' => $search['search_term'], 'phone2' => $search['search_term'], 'phone3' => $search['search_term'], 'address' => $search['search_term'], 'city' => $search['search_term'], 'notes' => $search['search_term'] )  ;  //added notes to search everything 10-27 - Doug
				$this->db->or_like($array);
			}
			if (!$search['includearchived'] == 'includearchived' ) {	//if not include archive then...require clientstatus=1
				$this->db->having('clientstatus  =', 1);
			} 
	
			//$this->db->limit(50);	//removed at request of Pat.
					
			$this->db->orderby('lastname, firstname');
			$query = $this->db->get('clients');
		
		}

		if ($query->num_rows() > 0) {	
			$searchresults =  $query->result_array();
			return $searchresults;

		} 
	}
	
	function getClientRecord()
	{
	
		$this->db->select('doctor_id');
		$this->db->where('client_id', $this->uri->segment(3));
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0) 
		{	
			$this->db->select('clients.firstname as clientfirstname, clients.doctor_id, clients.store_id, clients.lastname as clientlastname, doctors.firstname as doctorfirstname, doctors.lastname as doctorlastname, clients.address, clients.address2, clients.city, clients.state, clients.zip, clients.phone, clients.phone2, clients.phone3, clients.email, examtype.examtype as examtype, clients.examdate, clients.recalldate, clients.examdue, clients.lastcontact, clients.clientstatus, stores.name as storename, notes as notes');
			$this->db->where('client_id', $this->uri->segment(3));
			$this->db->join('doctors', 'doctors.doctor_id = clients.doctor_id', 'left');
			$this->db->join('stores', 'stores.store_id = clients.store_id', 'left');
			$this->db->join('examtype', 'clients.examtype = examtype.examtype_id', 'right');
			$query = $this->db->get('clients','','1');
			if ($query->num_rows() > 0) 
			{
				return $query->result_array(); 
			}
		} else {
			$this->db->select('*');
			$this->db->where('client_id', $this->uri->segment(3));
			$this->db->join('doctors', 'doctors.doctor_id = clients.doctor_id', 'left');
			$query = $this->db->get('clients','','1');
			if ($query->num_rows() > 0) 
			{
				return $query->result_array(); 
			}
		}
	}
		
	function recordRecalls($begindate, $enddate, $maxrecords, $store_id)
	{
		$recallbefore = date('Y-m-d', strtotime('today -21 days'));
		$this->load->helper('firstdayofmonth');
		$this->db->orderby('examdue');
		$this->db->where('examdue >', $begindate);
		$this->db->where('examdue <', $enddate);
		$this->db->where('store_id =', $store_id);
		$this->db->where('clientstatus =', '1');
		$this->db->where('recalldate <', $recallbefore);	//alternative method (replace $recallbefore with $begindate
		$this->db->limit($maxrecords);
		$todaysdate = $this->mclients->todaysdate();
		$data = array(
						'recalldate' => $todaysdate,
					);
				
		$query = $this->db->update('clients', $data);
		
	}

	function archiveRecalls($begindate, $enddate, $maxrecords, $store_id)
	{
		$recallbefore = date('Y-m-d', strtotime('today -21 days'));
		$this->load->helper('firstdayofmonth');
		$this->db->orderby('examdue');
		$this->db->where('examdue >', $begindate);
		$this->db->where('examdue <', $enddate);
		$this->db->where('store_id =', $store_id);
		$this->db->where('clientstatus =', '1');
		$this->db->where('recalldate <', $recallbefore);	//alternative method (replace $recallbefore with $begindate
		$this->db->limit($maxrecords);
		$data = array(
						'clientstatus' => '0',
					);
				
		$query = $this->db->update('clients', $data);	
	}
		
	function getRecalls ($begindate, $enddate, $maxrecords, $store_id)
	{
		//$recallbefore = date('Y-m-d', strtotime('today -21 days'));  //removed May12th at request of Pat - wants to be able to pull all recalls any time
		//$this->load->helper('firstdayofmonth');	//removed May12th at request of Pat - wants to be able to pull all recalls any time
		//$this->db->orderby('examdue');  Removed March 11th, 2010 - Pat requested Alphabetical results	
		$this->db->select('client_id, firstname, lastname, address, address2, city, state, zip, examtype, recalldate');
		$this->db->where('examdue >', $begindate);
		$this->db->where('examdue <', $enddate);
		$this->db->where('store_id =', $store_id);
		$this->db->where('clientstatus =', '1');
		//$this->db->where('recalldate <', $recallbefore);	//removed May12th at request of Pat - wants to be able to pull all recalls any time //alternative method (replace $recallbefore with $begindate
		$this->db->order_by('lastname asc, firstname asc');  //added March 11th, 2010 - Pat requested alphabetical results
		$this->db->limit($maxrecords);
		$query = $this->db->get('clients');
		
		return $query->result_array();
	}
	
	function getCallReport ($begindate, $enddate, $maxrecords, $store_id)
	{
		$recallbefore = date('Y-m-d', strtotime('today -21 days'));		// added 12/28 by request of Pat
		$this->load->helper('firstdayofmonth');
		$this->db->orderby('examdue');
		$this->db->select('clients.client_id, clients.firstname, clients.lastname, clients.address, clients.address2, clients.city, clients.state, clients.zip, clients.phone, clients.phone2, clients.phone3, examtype.examtype, clients.examdate as examdate, clients.lastcontact, clients.recalldate');
		$this->db->where('examdue >=', $begindate);		//change to EXAMDUE from RECALLDATE 12/28 by request of Pat
		$this->db->where('examdue <=', $enddate);		//change to EXAMDUE from RECALLDATE 12/28 by request of Pat
		$this->db->where('store_id =', $store_id);
		$this->db->where('phone <> ', '');		//modified March 23rd at Pat's request - previous change was in error.  It should be NOT Equal NULL rather than = Null
		$this->db->where('clientstatus =', '1');		// added 12/28 to include ONLY active clients	
		//$this->db->where('clients.lastcontact <', 'clients.recalldate');
		$this->db->join('examtype', 'clients.examtype = examtype.examtype_id', 'right');
		//$this->db->where('recalldate <', $recallbefore);	// added 12/28 by request of Pat	
		//$this->db->where('recalldate <', $begindate);	//alternative method (replace $recallbefore with $begindate
		$this->db->limit($maxrecords);
		$this->db->order_by('clients.lastname asc, clients.firstname asc');  //added March 11th, 2010 - Pat requested alphabetical results
		$query = $this->db->get('clients');
		
		return $query->result_array();
	}	
	
	function addClient()
	{
		if (isset($_POST['examdue'])){ $examdue = $_POST['examdue'];} else {$examdue = '0000-00-00';}
		if (isset($_POST['recalldate'])){ $recalldate = $_POST['recalldate'];} else {$recalldate = '0000-00-00';}
		if (isset($_POST['examdate'])){ $examdate = $_POST['examdate'];} else {$examdate = '0000-00-00';}
		if (isset($_POST['lastcontact'])){ $lastcontact = $_POST['lastcontact'];} else {$lastcontact = '0000-00-00';}
		$client_id = substr($_POST['firstname'],0,3) . substr($_POST['lastname'],0,3) . date('mdYHis') . '-' . rand(10000, 99999);

		$data = array( 
		'doctor_id' => $_POST['doctor_id'],
		'firstname' => $_POST['firstname'], 
		'lastname' => $_POST['lastname'], 
		'address' => $_POST['address'],
		'address2' => $_POST['address2'],
		'city' => $_POST['city'],
		'state' => $_POST['state'],
		'zip' => $_POST['zip'],
		'email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'phone2' => $_POST['phone2'], 
		'phone3' => $_POST['phone3'],
		'examtype' => $_POST['examtype'],
		'recalldate' => $recalldate,
		'examdate' => $examdate,
		'examdue' => $examdue,
		'lastcontact' => $lastcontact,
//		'lastpurchasedate' => $_POST['lastpurchasedate'],
//		'lastpurchaseamount' => $_POST['lastpurchaseamount'],
		'notes' => $_POST['notes'],
		'clientstatus' => '1',
		'client_id' => $client_id,
		'store_id' => $_POST['store_id']
		); 
		
		$this->db->insert('clients', $data); 	
	}
	
	function editClient()
	{
		if (isset($_POST['examdue'])){ $examdue = $_POST['examdue'];} else {$examdue = '0000-00-00';}
		if (isset($_POST['recalldate'])){ $recalldate = $_POST['recalldate'];} else {$recalldate = '0000-00-00';}
		if (isset($_POST['examdate'])){ $examdate = $_POST['examdate'];} else {$examdate = '0000-00-00';}

		
		$data = array( 
		'doctor_id' => $_POST['doctor_id'],
		'store_id' => $_POST['store_id'],
		'firstname' => $_POST['firstname'], 
		'lastname' => $_POST['lastname'], 
		'address' => $_POST['address'],
		'address2' => $_POST['address2'],
		'city' => $_POST['city'],
		'state' => $_POST['state'],
		'zip' => $_POST['zip'],
		'email' => $_POST['email'],
		'phone' => $_POST['phone'],
		'phone2' => $_POST['phone2'], 
		'phone3' => $_POST['phone3'],
		'examtype' => $_POST['examtype'],
//		'recalldate' => $_POST['recalldate'],
		'examdate' => $_POST['examdate'],
		'examdue'=> $_POST['examdue'],
		'lastcontact' => $_POST['lastcontact'],
//		'lastpurchasedate' => $_POST['lastpurchasedate'],
//		'lastpurchaseamount' => $_POST['lastpurchaseamount'],
		'notes' => $_POST['notes'],
		'clientstatus' => '1'
		); 
		
		$this->db->where('client_id', $_POST['client_id']);
		$this->db->update('clients', $data); 	
	}
	
	function archiveClient()
	{		
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->set('clientstatus', 0); 
		$query = $this->db->update('clients');
		//echo $query;	
	}
	
	function unarchiveClient()
	{		
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->set('clientstatus', 1);
		$query = $this->db->update('clients');
		//echo $query; 	
	}
	
	function calcdate($num_months)
	{
		$years = $num_months/12;
		$months = $num_months-($years*12);
		//echo $years . ' - ' . $months . ' - ';
		$reportyear = date('Y') - $years;
		$reportmonth = date('m') ; //- $months;
		$datexmonthsfromnow = $reportyear . '-' . $reportmonth . '-' . date('d');
		//echo 'newdate is: ' . $datexmonthsfromnow;
		return $datexmonthsfromnow;
	}
	
	function calnextduedate($num_months)
	{
		$years = $num_months/12;
		$months = $num_months-($years*12);
		//echo $years . ' - ' . $months . ' - ';
		$reportyear = date('Y') + $years;
		$reportmonth = date('m') ; //- $months;
		$datexmonthsfromnow = $reportyear . '-' . $reportmonth . '-' . date('d');
		//echo 'newdate is: ' . $datexmonthsfromnow;
		return $datexmonthsfromnow;
	}
	
	function todaysdate()
	{
		$todaysdate = date('Y') . '-' . date('m') . '-' . date('d');
		return $todaysdate;
	}
	
	function checkin($tilnextexam)
	{
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->set('examdate', $this->todaysdate());
		$this->db->set('examdue', $this->calnextduedate($tilnextexam) );
		$this->db->set('lastcontact', $this->todaysdate());
		return  $this->db->update('clients');
	}

	function logcontact()
	{
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->set('lastcontact', $this->todaysdate());
		return  $this->db->update('clients');
	}
	
	function getlastexamtype()
	{
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->select('examtype');
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0 )
		{
			$row = $query->row();			
			return $row->examtype;
		}	
	}
	
	function getdoctor_id()
	{
		$this->db->where('client_id', $this->uri->segment(3));
		$this->db->select('doctor_id');
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0 )
		{
			$row = $query->row();			
			return $row->doctor_id;
		}	
	}
	
	function get_insurance_info()
	{
		$this->db->where('client_id', $this->session->userdata( 'current_client' ));
		$this->db->select('insurance_id, insurance, dob, doctor_id');
		$query = $this->db->get('clients');
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}	
	}
	
	function get_client_name( $client_id ) 
	{
		$this->db->select('firstname, lastname');
		$this->db->where('client_id' , $client_id );
		$this->db->limit(1);
		$query = $this->db->get('clients');
	
		if ($query->num_rows() > 0 )
		{
			$row = $query->row();
			$firstname =  $row->firstname;
			$lastname = $row->lastname;
			return $firstname . ' ' . $lastname;
		}
	}
	
	function get_client_name_and_address ( $client_id ) 
	{
		$this->db->select('firstname, lastname, address, address2, phone, phone2, phone3, city, state, zip, email, dob');
		$this->db->where('client_id', $client_id );
		$query = $this->db->get('clients','','1');
	
		if ($query->num_rows() > 0) 
		{
			return $query->result_array(); 
		}
	
	}
	
	/**
	 * Updates a client record with new data
	 * @param	int		$client_id		client id
	 * @param	array	$client_data	an array of client data, key value pairs
	 * @return	void
	 */
	function updateClientById($client_id, $client_data)
	{
		$this->db->where('client_id', $client_id);
		$this->db->update('clients', $client_data);
	}
}