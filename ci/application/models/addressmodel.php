<?

class AddressModel extends Model {

    function getAddress($addressId) {
        if ($addressId) {
            $this->db->where('id', $addressId);
            $rows = $this->db->get('addresses')->result();
            if (sizeof($rows)) {
                $address = $rows[0];
                $address->success = true;
            }
            else {
                $address = '';
                $address->success = false;
            }

            return $address;
        }
    }

    function setAddress($data)  {
        if ($data) {
            if (is_object($data)) {

                $this->db->set($data);
                $this->db->where('id', $data->id);
                $this->db->update('addresses');

                return $this->getAddress($data->id);
            }
            else if (isset($data['id']) && $data['id'] > 0) {
                if (strlen($data['dateFired']) < 2) {
                    unset($data['dateFired']);
                }
                $this->db->set($data);
                $this->db->where('id', $data['id']);
                $this->db->update('addresses');

                return $this->getAddress($data['id']);
            }
            else {
                $this->db->set($data);
                $this->db->insert('addresses');
                $id = $this->db->insert_id();
                if ($id) {
                    return $this->getAddress($id);
                }
                else {
                    return FALSE;
                }

            }
        }

    }


    function listAddresses() {
        $this->db->order_by('upper(lastName)', 'ASC');
        $addresses = $this->db->get('addresses')->result();

        return $addresses;
    }

    function deleteAddress($id = null) {
        if ($id) {
            $this->db->where('id', $id);
        }
        $this->db->update('addresses');
        return array('success'=>TRUE);
    }

}
?>