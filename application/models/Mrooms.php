<?php
/**
 * @property CI_DB $db
 * @property CI_Input $input
 * @property CI_Loader $load
 * @property CI_Upload $upload
 */
class Mrooms extends CI_Model {
	/**
	 * Shows all Ruangan
	 *
	 * @param string $id
	 * @return string|object
	 */
    function tampilgedung($id = ""): array|object
    {
		if (empty($id))
			return $this->db->select()->from('Ruangan')
				->get()->result();
		else
			return $this->db->select()->from('Ruangan')
				->where('id', $id)->get()->first_row();
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
