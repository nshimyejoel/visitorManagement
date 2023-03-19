<?php

// defined('BASEPATH') or exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/RestController.php';
class ApiDemoController extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visitor_Model');
    }

        public function index_get()
        {
            $visitor = new Visitor_Model();
            $visitor = $visitor->listAll();
            $this->response($visitor, 200);
        }

        // Create a new user
        public function index_post()
        {
            $visitor = new Visitor_Model();
            $data = [
            'VisitorName' => $this->post('VisitorName'),
            'MobileNumber' => $this->post('MobileNumber'),
            'Address' => $this->post('Address'),
            'Apartment' => $this->post('Apartment'),
            'Floor' => $this->post('Floor'),
            'WhomtoMeet' => $this->post('WhomtoMeet'),
            'ReasontoMeet' => $this->post('ReasontoMeet'),
            ];
            $result = $visitor->add($data['VisitorName'], $data['MobileNumber'], $data['Address'], $data['Apartment'], $data['Floor'], $data['WhomtoMeet'], $data['ReasontoMeet']);

            if ($result > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'User added successfully',
                ], RestController::HTTP_CREATED);
            } else {
                return $this->response([
                  'status' => false,
                  'message' => 'FAILED TO CREATE NEW VISITOR',
                  ], RestController::HTTP_BAD_REQUEST);
            }
        }
}
