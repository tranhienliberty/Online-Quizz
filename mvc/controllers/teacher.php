<?php

/**
 * Class teacher
 */
class Teacher extends Controller
{
    /**
     * Exam constructor.
     */
    public function __construct()
    {
        if (!isset($_SESSION['is_admin'])) {
            $this->addErrorMessage('Vui lòng đăng nhập vào trang quản trị');
            return $this->redirect('?url=login');
        }
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->view('admin',
            [
                'page'      => 'teacher',
                'title'     => 'Danh sách giáo viên',
                'teacher'      => $this->getTeacher()
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function getTeacher()
    {
        $stuModel = $this->model('TeacherModel');
        return $stuModel->getAllTeacher();
    }

    /**
     * @return mixed
     */
    public function update()
    {
        $id = $_POST['id'] ?: null;
        $name = $_POST['name'] ?:null;
        $email = $_POST['email'] ?:null;
        $pass = $_POST['pass'] ?:null;

        try {
            if ($id) {
                $this->updateTeacher($id, $name, $email, $pass);
                $this->addSuccessMessage('Cập nhật thông tin thành công.');
            }else{
                $this->insertTeacher($name, $email, $pass);
                $this->addSuccessMessage('Thêm mới giáo viên thành công.');
            }
        } catch (\Exception $exception) {
            $this->addErrorMessage($exception->getMessage());
        }

        $this->redirect('?url=teacher');
    }

    public function insertTeacher($name, $email, $pass)
    {
        $teacherModel = $this->model('TeacherModel');
        return $teacherModel->insert($name, $email, $pass);
    }

    public function updateTeacher($id, $name, $email, $pass)
    {
        $teacherModel = $this->model('TeacherModel');
        return $teacherModel->update($id, $name, $email, $pass);
    }



    /**
     * @inheritDoc
     */
    public function edit($id = null)
    {
        $teacher = [];

        if ($id) {
            $teacher= $this->getTeacherById($id);
        }

        $title = 'Cập nhật giáo viên';
        if (!$id) $title = 'Thêm mới giáo viên';

        $this->view("admin",
            [
                "page"              => "teacher_new",
                "title"             => $title,
                "teacher"          => $teacher,
            ]
        );
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeacherById($id)
    {
        $model = $this->model('TeacherModel');
        return $model->getById($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->model('TeacherModel');
        $status = $model->deleteById($id);
        if($status){
            $this->addSuccessMessage('Xóa thành công.');
            $this->redirect('?url=teacher');
        }
    }

}