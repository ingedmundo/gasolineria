<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    private $data = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ion_auth');
        $this->load->library('grocery_CRUD');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->load->library('session');
            $this->load->helper(array('url','form'));
        }
    }

    public function grocery_usuarios()
    {

        $crud = new grocery_CRUD();

        $crud->where('username!=',"'root'", FALSE);

        $crud->set_table('users');

        #Relacion con la clientes
        $crud->set_relation('clave_cliente','clientes','razon_social');

        $crud->columns('username','active','clave_cliente');

        $crud->fields('username','password','email','active','clave_cliente');

        $crud->change_field_type('password','password');

        $crud->display_as('username','Usuario')
            ->display_as('email','Correo Electronico')
            ->display_as('clave_cliente','Razon Social');


        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('admin/listado_usuarios',$output);
        $this->load->view('template/footer');
    }

    public function configuracion()
    {
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('configuracion');

        $crud->set_field_upload('imagen_frontal','images/front');
        $crud->unset_add();

        $crud->unset_delete();

        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('admin/configuracion',$output);
        $this->load->view('template/footer');
    }


    public function clientes()
    {
        $this->load->model('clientes_model');

        $crud = new grocery_CRUD();

        $crud->set_table('clientes');

        $crud->unset_operations();

        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('admin/clientes',$output);
        $this->load->view('template/footer');

        $lst_clientes = $this->clientes_model->get_datos();

        $this->clientes_model->sincroniza();
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */