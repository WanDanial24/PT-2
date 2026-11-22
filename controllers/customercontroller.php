
<?php

class CustomerController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("customermodel");
    }

    // READ all customers
    public function index() {
        $records = $this->model->readAll();
        $this->view("customers", ["customers" => $records]);
    }

    // CREATE a new customer
    public function save() {
        $data = $_POST;
        $this->model->create($data);

        $this->index();
    }

    // EDIT an existing customer
    public function edit($id) {
        $acustomer = $this->model->readById($id);

        if (!$acustomer) {
            exit;
        }

        $this->view("customers", [
            "acustomer" => $acustomer,
            "customers" => $this->model->readAll()
        ]);
    }

    // UPDATE an existing customer
    public function update() {
        $data = $_POST;
        $this->model->update($data);

        $this->index();
    }

    // DELETE a customer
    public function delete($id) {
        $acustomer = $this->model->readById($id);

        if (!$acustomer) {
            exit;
        }

        $this->model->delete($id);
        $this->index();
    }
}

?>
