<?php
/**
 * @property CI_DB $db
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Upload $upload
 */
class Mrooms extends CI_Model {
	
	/**
	 * Fetch Ruangan data from database
	 *
	 * @param $id
	 * @return array|string
	 */
	function tampildata($id): array
	{
		$hasil = array();
		$start=$this->input->post('tgl');
		$query = $this->db->select('*, phone')->from('Reservasi')
			->join("Peminjam",
				"Reservasi.peminjam_id = Peminjam.id",
				"inner"
			)
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

	/**
	 * Shows all Ruangan or a particular ruangan's data
	 *
	 * @param string $id
	 * @return string|object
	 */
	function tampilgedung($id = ""): array
	{
		if (empty($id))
			return $this->db->select()->from('Ruangan')
				->get()->result();
		else
			return $this->db->select()->from('Ruangan')
				->where('id', $id)->get()->first_row();
	}
	
	/**
	 * Search all Ruangan base on user search string
	 *
	 * @param $searchStr
	 * @return void
	 */
	function search($searchStr): void
	{
		$searchStr = str_replace('%20', ' ', $searchStr);

		$results = $this->db->select('name, id')->from('Ruangan')
				->like('name', $searchStr)->get()->result();
		
		$result_html = function ($r, $d) {
			return room_result_dropdown($r, $d);
		};
		
		$default_html = function () {
			return default_result_dropdown('No Result');
		};
		
		$drop_result = function () {
			return room_head_result_dropdown();
		};

		livesearch($searchStr, $results, $result_html, $default_html,
				'rooms/detailrooms?id=', $drop_result);
	}
	
	/**
	 * Add new room to database
	 *
	 * @param $data
	 * @return void
	 */
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
	
	/**
	 * Edit current id of 'Ruangan'
	 *
	 * @param $data
	 * @return void
	 */
	function edit_room($data): void
	{
		$data['name'] = $this->input->post('name', true);
		$data['status'] = $this->input->post('status', true);
		$data['description'] = $this->input->post('description', true);
		
		$this->db->set($data)->where('id', $data['id'])->update('Ruangan');
	}

	function delete_rooom($id): void
	{
		$this->db->where('id', $id)->delete('Ruangan');
	}
	
}
