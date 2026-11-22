
<?php

class StaffController extends Controller {
    private $model;

    public function __construct() {
        $this->model = $this->model("staffmodel");
    }

    // READ all staffs
    public function index() {
        $records = $this->model->readAll();
        $this->view("staffs", ["staffs" => $records]);
    }

    // CREATE a new staff
    public function save() {
        $data = $_POST;
        $this->model->create($data);

        $this->index();
    }

    // EDIT an existing staff
    public function edit($id) {
        $astaff = $this->model->readById($id);

        if (!$astaff) {
            exit;
        }

        $this->view("staffs", [
            "astaff" => $astaff,
            "staffs" => $this->model->readAll()
        ]);
    }

    // UPDATE an existing staff
    public function update() {
        $data = $_POST;
        $this->model->update($data);

        $this->index();
    }

    // DELETE a staff
    public function delete($id) {
        $astaff = $this->model->readById($id);

        if (!$astaff) {
            exit;
        }

        $this->model->delete($id);
        $this->index();
    }
}

?>
