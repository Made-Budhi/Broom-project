<?php
/**
 * @property CI_DB $db
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Upload $upload
 */
class Mrooms extends CI_Model {

    function tampildata($id): array|string
    {
        $hasil = array();
        $start=$this->input->post('tgl');
        $query = $this->db->select()->from('Reservasi')
                ->where_in('date_start', $start)->where_in('date_end', $start)
                ->where('ruangan_id', $id)->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $hasil[]=$row;
            }
        } else {
            $hasil="";	
        }
        
        return $hasil;
    }

    function tampilgedung(): array|string
    {
        $hasil = array();
        $query=$this->db->select()->from('Ruangan')->get();
        
        if ($query->num_rows()>0) {
            foreach ($query->result() as $row) {
                $hasil[]=$row;
            }	
        } else {
            $hasil="";	
        }
        
        return $hasil;
    }

	function search($searchStr): void
	{
		$searchStr = str_replace('%20', ' ', $searchStr);

		$results = $this->db->select('name, id')->from('Ruangan')
				->like('name', $searchStr)->get()->result();

		livesearch($searchStr, $results);
	}

	function add_room($data): void
	{
		$data['name'] = $this->input->post('name', true);
		$data['status'] = $this->input->post('status', true);
		$data['description'] = $this->input->post('description', true);

		$this->db->insert('Ruangan', $data);
	}

	/**
	 * Checking the number of reservation a 'Ruangan' has.
	 *
	 * @param array $data
	 * @return int
	 */
	function check_ruangan_availability(array $data): int
	{
		return $this->db->select()->from('Reservasi')
			->where('ruangan_id', $data['ruangan'])
			->get()->num_rows();
	}

}
