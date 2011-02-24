<?
class Address {};
date_default_timezone_set('America/New_York');
class Addresses extends Controller {
    var $id, $name, $description;

    /**
     * @constructor Addresses
     * @return void
     */
    function Addresses() {
        parent::Controller();
        $this->load->model('AddressModel', 'AddressModel');

        $this->id         =  $this->input->get_post('id', TRUE);
        $this->Address    =  new Address();
        $this->Address->id = $this->input->get_post('id', TRUE);

    }
    /**
     * @function getList returns list of Addresses via JSON data
     * @return void
     */
    function getList() {

        $data = json_encode($this->AddressModel->listAddresses());
        print $data;
    }

    /**
     * @function getAddresses returns a list of Addresses for a particular
     * @return void
     */
    function getAddresses() {
        if ($this->id) {
            print json_encode($this->AddressModel->getAddresses($this->id));
        }
        else {
            $this->_printSuccessFalse();
        }
    }

    function getAddress() {
        if ($this->id) {
            $data = $this->AddressModel->getAddress($this->id);

            $this->_printSuccessTrue($data);
        }
        else {
            $this->_printSuccessFalse();
        }
    }


    function setAddress() {
        $firstName = $this->input->get_post('firstName', TRUE);
        $lastName  = $this->input->get_post('lastName', TRUE);

        if (isset($firstName) && isset($lastName)) {
            // strict control on what columns are set for the database insert/update
            $data = array(
                'id'        => $this->input->get_post('id', TRUE),
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'street'    => $this->input->get_post('street', TRUE),
                'city'      => $this->input->get_post('city', TRUE),
                'state'     => $this->input->get_post('state', TRUE),
                'zip'       => $this->input->get_post('zip', TRUE),
                'phone'     => $this->input->get_post('phone', TRUE)
            );

            $data = $this->AddressModel->setAddress($data);

            if ($data) {
                $this->_printSuccessTrue(array(
                    "data" => $data
                ));
            }
            else {
                $this->_printSuccessFalse('No data?');
            }
        }
//        }
//        else {
//            $this->_printSuccessFalse('Unknown error');
//        }
    }


    function unsetAddress() {
        if ($this->id) {
            if ($this->AddressModel->unsetAddress($this->id)) {
                $this->_printSuccessTrue();
            }
            else {
                $this->_printSuccessFalse();
            }
        }
    }

    private   function _printSuccessTrue($data = null) {
        if ($data && is_object($data)){
            $data->success  = true;
            print json_encode($data);
        }
        else if ($data && is_array($data)){
            $data['success'] = true;
            print json_encode($data);
        }
        else {
            print "{success:true}";
        }

    }

    private function _printSuccessFalse($msg='') {
         print json_encode(array(
            'success' => false,
            'message' => $msg
         ));
    }

}


?>