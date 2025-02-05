<?php

class RNA extends CI_Controller
{
    public function index()
    {
        $data['data_rna'] = $this->M_SQL->data_rna()->result();

        $this->load->view('template/header', $data);
        $this->load->view('data-rna/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function add_rna()
    {
        $this->load->view('template/header');
        $this->load->view('create-rna/index');
        $this->load->view('template/footer');
    }

    public function create_rna()
    {
        $description_fasta      = $this->input->post('description_fasta');
        $function_fasta         = $this->input->post('function_fasta');
        $sequenceid_fasta       = $this->input->post('sequenceid_fasta');
        $sequencelength_fasta   = $this->input->post('sequencelength_fasta');
        $sequence_fasta         = $this->input->post('sequence_fasta');

        $data = array(
            'description_fasta'     => $description_fasta,
            'function_fasta'        => $function_fasta,
            'sequenceid_fasta'      => $sequenceid_fasta,
            'sequencelength_fasta'  => $sequencelength_fasta,
            'sequence_fasta'        => $sequence_fasta
        );
        $this->M_SQL->insert_data($data, 'tb_fasta');
        redirect('rna/add_rna');
    }
}
